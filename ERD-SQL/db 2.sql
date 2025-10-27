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


-- 4. Subscriptions
CREATE TABLE subscriptions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT, 
  package_id INT,
  subs_start DATE,
  subs_end DATE,
  subs_status ENUM('active', 'inactive', 'pending') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (package_id) REFERENCES packages(id) ON DELETE RESTRICT
)

-- 5. Connections
CREATE TABLE connections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    package_id INT NOT NULL,
    connection_point VARCHAR(255) NOT NULL,
    ip_address VARCHAR(45) NULL, 
    mac_address VARCHAR(17) NULL,
    installation_date DATE NOT NULL,
    is_active BOOLEAN DEFAULT TRUE, 
    termination_date DATE NULL,
    notes TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (package_id) REFERENCES packages(id) ON DELETE RESTRICT
);

-- 6. Bills
CREATE TABLE bills (
  id INT AUTO_INCREMENT PRIMARY KEY,
  subscription_id INT,
  billing_cycle DATE NOT NULL,
  package_price DECIMAL(10, 2) NOT NULL,
  discount DECIMAL(10, 2) DEFAULT 0.00,
  total_amount DECIMAL(10, 2) NOT NULL,
  is_paid BOOLEAN DEFAULT FALSE,
  -- status ENUM('paid','unpaid') DEFAULT 'unpaid',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (subscription_id) REFERENCES subscriptions(id) ON DELETE CASCADE
);

-- 7. Payments
CREATE TABLE payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  bill_id INT,
  amount DECIMAL(10,2) NOT NULL,
  payment_date DATETIME NOT NULL,
  payment_method ENUM('cash', 'bank_transfer', 'mobile_money', 'card') NOT NULL,
  transaction_id VARCHAR(255) NULL,
  received_by INT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (bill_id) REFERENCES bills(id) ON DELETE CASCADE,
  FOREIGN KEY (received_by) REFERENCES staff(id) ON DELETE SET NULL
);
