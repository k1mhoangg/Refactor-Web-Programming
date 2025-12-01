-- Tạo database
CREATE DATABASE IF NOT EXISTS HomeDecor CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE HomeDecor;

-- Bảng User
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    phone VARCHAR(20),
    address TEXT,
    display_name VARCHAR(255) NULL,
    avatar VARCHAR(255) NULL,
    role ENUM('admin', 'customer', 'guest') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Product
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    discount_price DECIMAL(10, 2),
    category VARCHAR(50),
    stock INT DEFAULT 0,
    image_url VARCHAR(255),
    is_featured BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_price (price),
    INDEX idx_featured (is_featured)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Bảng Contact
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) DEFAULT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200),
    message TEXT NOT NULL,
    status ENUM('pending', 'replied', 'closed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    replied_at TIMESTAMP NULL,
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert dữ liệu mẫu cho User (password là 'password123' đã hash)
INSERT INTO users (username, email, password, full_name, phone, role) VALUES
('admin', 'admin@homedecor.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', '0901234567', 'admin'),
('john_doe', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'John Doe', '0912345678', 'customer'),
('jane_smith', 'jane@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jane Smith', '0923456789', 'customer');

-- Insert dữ liệu mẫu cho Product
INSERT INTO products (name, description, price, discount_price, category, stock, is_featured) VALUES
('Modern Sofa Set', 'Comfortable 3-seater sofa with elegant design', 15000000, 12000000, 'Living Room', 10, TRUE),
('Wooden Dining Table', 'Solid wood dining table for 6 people', 8500000, NULL, 'Dining Room', 5, TRUE),
('Queen Size Bed Frame', 'Luxury bed frame with storage', 12000000, 10500000, 'Bedroom', 8, FALSE),
('LED Floor Lamp', 'Modern adjustable floor lamp', 1500000, 1200000, 'Lighting', 20, FALSE),
('Wall Art Canvas', 'Abstract art canvas 120x80cm', 2500000, NULL, 'Decoration', 15, TRUE),
('Coffee Table', 'Tempered glass top coffee table', 3500000, 3000000, 'Living Room', 12, FALSE);

-- Insert dữ liệu mẫu cho Contact
INSERT INTO contacts (name, email, phone, subject, message, status) VALUES
('Nguyen Van A', 'nguyenvana@gmail.com', '0987654321', 'Product Inquiry', 'I want to know more about the Modern Sofa Set', 'pending'),
('Tran Thi B', 'tranthib@gmail.com', '0976543210', 'Delivery Question', 'How long does delivery take to Hanoi?', 'replied'),
('Le Van C', 'levanc@gmail.com', '0965432109', 'Custom Order', 'Can I order a custom-sized dining table?', 'pending');