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
  subs_status ENUM('active', 'inactive') DEFAULT 'inactive',
  bill_status ENUM('paid', 'unpaid') DEFAULT 'unpaid',
  payment_id VARCHAR(255) NULL, 
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

-- 5. Bills
CREATE TABLE bills (
  id INT AUTO_INCREMENT PRIMARY KEY,
  connection_id INT,
  bill_month VARCHAR(20),
  amount DECIMAL(10,2),
  due_date DATE,
  status ENUM('paid','unpaid') DEFAULT 'unpaid',
  FOREIGN KEY (connection_id) REFERENCES connections(id) ON DELETE CASCADE
);

-- 6. Payments
CREATE TABLE payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  bill_id INT,
  payment_date DATE,
  amount DECIMAL(10,2),
  method VARCHAR(50),
  note TEXT,
  FOREIGN KEY (bill_id) REFERENCES bills(id) ON DELETE CASCADE
);
