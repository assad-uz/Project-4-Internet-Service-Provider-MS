-- Database Schema

CREATE DATABASE isp_ms;
USE isp_ms;

-- 1. Users
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'manager', 'technician') NOT NULL DEFAULT 'technician',
    avatar VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    last_login_at TIMESTAMP NULL, 
);



-- 2. Customers
CREATE TABLE customers (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  phone VARCHAR(20) NOT NULL UNIQUE,
  email VARCHAR(100) NULL UNIQUE,
  address TEXT NOT NULL,
  area_id BIGINT UNSIGNED NOT NULL,
  customer_type_id BIGINT UNSIGNED NOT NULL,
  status ENUM('active', 'inactive', 'suspended') NOT NULL DEFAULT 'inactive',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_customer_area FOREIGN KEY (area_id) REFERENCES areas(id),
  CONSTRAINT fk_customer_type FOREIGN KEY (customer_type_id) REFERENCES customer_types(id)
);

-- 3. Areas
CREATE TABLE areas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 4. Packages
CREATE TABLE packages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  package_code INT(10),
  package_name VARCHAR(100),
  speed INT(10),
  price DECIMAL(10,2),
);

-- 5. Customer types
CREATE TABLE customer_types (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,  -- (Ex Residential, Corporate, SME)    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 6. Distribution boxes
CREATE TABLE distribution_boxes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    box_code VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(150) NULL,               
    area_id BIGINT UNSIGNED NOT NULL,     
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_box_area FOREIGN KEY (area_id) REFERENCES areas(id)
);


-- 7. Connections
CREATE TABLE connections (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id BIGINT UNSIGNED NOT NULL,       
    package_id BIGINT UNSIGNED NOT NULL,       
    distribution_box_id BIGINT UNSIGNED NOT NULL, 
    username VARCHAR(100) NOT NULL UNIQUE,    
    password VARCHAR(255) NOT NULL,
    ip_address VARCHAR(50) NULL,                
    mac_address VARCHAR(20) NULL,             
    box_port_number SMALLINT UNSIGNED NULL, 
    connection_type ENUM('Optical Fiber', 'CAT5', 'UTP') NOT NULL, 
    connection_date DATE NOT NULL,            
    status ENUM('active', 'suspended', 'terminated') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_conn_customer FOREIGN KEY (customer_id) REFERENCES customers(id),
    CONSTRAINT fk_conn_package FOREIGN KEY (package_id) REFERENCES packages(id),
    CONSTRAINT fk_conn_box FOREIGN KEY (distribution_box_id) REFERENCES distribution_boxes(id)
);

-- 8. Bills
CREATE TABLE billings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id BIGINT UNSIGNED NOT NULL,       
    connection_id BIGINT UNSIGNED NOT NULL,     
    package_id BIGINT UNSIGNED NOT NULL,        
    billing_month DATE NOT NULL,               
    amount DECIMAL(10, 2) NOT NULL,            
    due_date DATE NOT NULL,                    
    discount DECIMAL(10, 2) DEFAULT 0.00,      
    status ENUM('unpaid', 'paid', 'partially_paid', 'cancelled') NOT NULL DEFAULT 'unpaid',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_billing_customer FOREIGN KEY (customer_id) REFERENCES customers(id),
    CONSTRAINT fk_billing_connection FOREIGN KEY (connection_id) REFERENCES connections(id),
    CONSTRAINT fk_billing_package FOREIGN KEY (package_id) REFERENCES packages(id),
    UNIQUE KEY uk_connection_month (connection_id, billing_month)
);

-- 9. Payments
CREATE TABLE payments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    billing_id BIGINT UNSIGNED NOT NULL,   
    customer_id BIGINT UNSIGNED NOT NULL,    
    collected_by BIGINT UNSIGNED NULL,        
    payment_method ENUM('cash', 'bKash', 'card', 'bank') NOT NULL,
    transaction_id VARCHAR(100) NULL,         
    amount DECIMAL(10, 2) NOT NULL,          
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_payment_billing FOREIGN KEY (billing_id) REFERENCES billings(id),
    CONSTRAINT fk_payment_customer FOREIGN KEY (customer_id) REFERENCES customers(id),
    CONSTRAINT fk_payment_collector FOREIGN KEY (collected_by) REFERENCES users(id)
);

-- 10. Tickets
CREATE TABLE tickets (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id BIGINT UNSIGNED NOT NULL,       
    connection_id BIGINT UNSIGNED NULL,        
    assigned_to BIGINT UNSIGNED NULL,         
    subject VARCHAR(255) NOT NULL,             
    description TEXT NOT NULL,                
    priority ENUM('low', 'medium', 'high', 'critical') NOT NULL DEFAULT 'medium',
    status ENUM('open', 'in_progress', 'closed', 'cancelled') NOT NULL DEFAULT 'open',
    closed_at TIMESTAMP NULL,                   
    solution_notes TEXT NULL,                
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_ticket_customer FOREIGN KEY (customer_id) REFERENCES customers(id),
    CONSTRAINT fk_ticket_conn FOREIGN KEY (connection_id) REFERENCES connections(id),
    CONSTRAINT fk_ticket_assignee FOREIGN KEY (assigned_to) REFERENCES users(id)
);

-- Extra
-- 11. Contact Messages
CREATE TABLE contact_messages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(100) NULL,
    phone VARCHAR(20) NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--12. subscriptions
CREATE TABLE subscriptions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    is_confirmed BOOLEAN NOT NULL DEFAULT TRUE, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--13. 
CREATE TABLE notifications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,               
    
    -- নোটিফিকেশন প্রাপক
    notifiable_type VARCHAR(255) NOT NULL,    -- মডেলের নাম (যেমন: 'App\Models\User')
    notifiable_id BIGINT UNSIGNED NOT NULL,   -- প্রাপকের ID (users টেবিলের ID)
    
    -- নোটিফিকেশন ডেটা
    type VARCHAR(255) NOT NULL,               -- ইভেন্টের প্রকার (যেমন: 'NewCustomerRegistration', 'NewContactMessage')
    data JSON NOT NULL,                       -- নোটিফিকেশনের সম্পূর্ণ ডেটা (JSON ফরম্যাটে)
    
    -- স্ট্যাটাস ট্র্যাকিং
    read_at TIMESTAMP NULL,                   -- কখন পড়া হয়েছে
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- পলিমরফিক রিলেশনের জন্য ইনডেক্স
    INDEX idx_notifiable (notifiable_type, notifiable_id)
);