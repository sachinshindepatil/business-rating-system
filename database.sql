-- Create Database
CREATE DATABASE IF NOT EXISTS business_rating_system;

USE business_rating_system;

-- Table: businesses 

CREATE TABLE businesses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: ratings
CREATE TABLE ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    business_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    rating DECIMAL(2,1) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (business_id) 
    REFERENCES businesses(id)
    ON DELETE CASCADE
);

-- Sample Data 

INSERT INTO businesses (name, address, phone, email) VALUES
('ABC Restaurant', '123 Main Street', '9876543210', 'abc@example.com'),
('Tech Solutions', '45 IT Park Road', '9123456789', 'tech@example.com'),
('City Hospital', '78 Health Avenue', '9988776655', 'hospital@example.com');

INSERT INTO ratings (business_id, name, email, phone, rating) VALUES
(1, 'Rahul Sharma', 'rahul@test.com', '9000000001', 4.5),
(1, 'Priya Patel', 'priya@test.com', '9000000002', 3.5),
(2, 'Amit Verma', 'amit@test.com', '9000000003', 5.0);