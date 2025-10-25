-- Database Schema

CREATE DATABASE isp_ms;
USE isp_ms;

-- 1. Users
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  address TEXT,
  phone VARCHAR(20),
  email VARCHAR(100),
  role_id INT,
  password VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE SET NULL
);

-- 2. Roles
CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role ENUM('admin','staff','customer')
);

-- 3. Staff
CREATE TABLE staff (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20) NULL,    
    designation VARCHAR(100) NULL, -- exmp: 'Technician', 'Accountant', 'Sales'
    department VARCHAR(100) NULL,  -- exmp: 'Field Ops', 'Billing', 'Support'
    is_active BOOLEAN DEFAULT TRUE, 
    password VARCHAR(255) NULL, 
    address TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- 3. Packages
CREATE TABLE packages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  package_code INT(10),
  package_name VARCHAR(100),
  speed VARCHAR(50),
  price DECIMAL(10,2),
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
