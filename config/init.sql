-- Tạo database
CREATE DATABASE IF NOT EXISTS HomeDecor CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE HomeDecor;

-- Bảng User
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) UNIQUE,
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

-- Tạo bảng products với DECIMAL lớn hơn
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(12, 2) NOT NULL,
    discount_price DECIMAL(12, 2),
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

-- Chèn 50 sản phẩm (giá bằng VNĐ)
INSERT INTO products (name, description, price, discount_price, category, stock, image_url, is_featured, is_active) VALUES
('Thiết kế biệt thự 100m2 phong cách hiện đại', 'Thiết kế nội thất biệt thự 100m2 sang trọng, tối ưu không gian sống với phong cách hiện đại, tiện nghi đầy đủ', 85000000.00, 78000000.00, 'Biệt thự', 5, 'images/products/prod_1.jpg', TRUE, TRUE),
('Nội thất biệt thú 100m2 cao cấp', 'Giải pháp thiết kế nội thất biệt thự 100m2 với chất liệu cao cấp, màu sắc hài hòa, phù hợp gia đình trẻ', 92000000.00, 85000000.00, 'Biệt thự', 3, 'images/products/prod_2.jpg', TRUE, TRUE),
('Thiết kế biệt thự 100m2 phong cách Bắc Âu', 'Thiết kế nội thất biệt thự tối giản với gam màu trung tính, ánh sáng tự nhiên tràn ngập', 88000000.00, NULL, 'Biệt thự', 4, 'images/products/prod_3.jpg', FALSE, TRUE),
('Nội thất biệt thự 80m2 thông minh', 'Thiết kế biệt thự 80m2 tối ưu diện tích, đầy đủ công năng với phong cách hiện đại', 72000000.00, 68000000.00, 'Biệt thự', 6, 'images/products/prod_4.jpg', FALSE, TRUE),
('Thiết kế biệt thự 80m2 ấm cúng', 'Không gian biệt thự 80m2 ấm áp với gam màu trầm, nội thất gỗ tự nhiên cao cấp', 75000000.00, NULL, 'Biệt thự', 5, 'images/products/prod_5.jpg', TRUE, TRUE),
('Nội thất biệt thự 80m2 sang trọng', 'Thiết kế nội thất biệt thự 80m2 sang trọng với đường nét tinh tế, màu sắc nhẹ nhàng', 78000000.00, 72000000.00, 'Biệt thự', 4, 'images/products/prod_6.jpg', FALSE, TRUE),
('Thiết kế căn biệt thự đẳng cấp', 'Nội thất biệt thự cao cấp với thiết kế độc đáo, chất liệu nhập khẩu', 125000000.00, 115000000.00, 'Biệt thự', 2, 'images/products/prod_7.jpg', TRUE, TRUE),
('Nội thất biệt thự phong cách tân cổ điển', 'Thiết kế biệt thự kết hợp giữa cổ điển và hiện đại, tạo không gian sang trọng', 135000000.00, NULL, 'Biệt thự', 3, 'images/products/prod_8.jpg', TRUE, TRUE),
('Thiết kế biệt thự hiện đại luxury', 'Biệt thự thiết kế hiện đại với đầy đủ tiện nghi, không gian mở thoáng đãng', 145000000.00, 135000000.00, 'Biệt thự', 2, 'images/products/prod_9.jpg', FALSE, TRUE),
('Nội thất chung cư 120m2 hiện đại', 'Thiết kế chung cư 120m2 với không gian mở, tối ưu ánh sáng tự nhiên', 65000000.00, 60000000.00, 'Chung cư', 8, 'images/products/prod_10.jpg', TRUE, TRUE),
('Thiết kế chung cư 120m2 thông minh', 'Giải pháp nội thất chung cư 120m2 thông minh, đa năng cho gia đình 4-5 người', 68000000.00, NULL, 'Chung cư', 7, 'images/products/prod_11.jpg', FALSE, TRUE),
('Nội thất chung cư 120m2 sang trọng', 'Thiết kế nội thất chung cư 120m2 cao cấp với chất liệu nhập khẩu', 72000000.00, 68000000.00, 'Chung cư', 6, 'images/products/prod_12.jpg', TRUE, TRUE),
('Thiết kế chung cư 70m2 tối ưu', 'Nội thất chung cư 70m2 tối ưu không gian, phù hợp gia đình trẻ', 42000000.00, 38000000.00, 'Chung cư', 10, 'images/products/prod_13.jpg', FALSE, TRUE),
('Nội thất chung cư 70m2 hiện đại', 'Thiết kế chung cư 70m2 phong cách hiện đại, tiện nghi đầy đủ', 45000000.00, NULL, 'Chung cư', 9, 'images/products/prod_14.jpg', TRUE, TRUE),
('Thiết kế chung cư 70m2 Bắc Âu', 'Nội thất chung cư 70m2 phong cách Bắc Âu tối giản, thanh lịch', 48000000.00, 45000000.00, 'Chung cư', 8, 'images/products/prod_15.jpg', FALSE, TRUE),
('Nội thất chung cư 70m2 ấm cúng', 'Thiết kế chung cư 70m2 với gam màu ấm, tạo cảm giác thư giãn', 46000000.00, NULL, 'Chung cư', 7, 'images/products/prod_16.jpg', FALSE, TRUE),
('Thiết kế chung cư 80m2 hiện đại', 'Nội thất chung cư 80m2 hiện đại với đường nét tinh tế, màu sắc hài hòa', 52000000.00, 48000000.00, 'Chung cư', 10, 'images/products/prod_17.jpg', TRUE, TRUE),
('Nội thất chung cư 80m2 thông minh', 'Thiết kế chung cư 80m2 tối ưu diện tích, đa chức năng', 55000000.00, NULL, 'Chung cư', 9, 'images/products/prod_18.jpg', FALSE, TRUE),
('Thiết kế chung cư 80m2 sang trọng', 'Nội thất chung cư 80m2 cao cấp với chất liệu đẹp, bền', 58000000.00, 54000000.00, 'Chung cư', 8, 'images/products/prod_19.jpg', FALSE, TRUE),
('Nội thất chung cư 90m2 đẹp', 'Thiết kế chung cư 90m2 với phong cách hiện đại, thoáng đãng', 58000000.00, 54000000.00, 'Chung cư', 7, 'images/products/prod_20.jpg', TRUE, TRUE),
('Thiết kế chung cư 90m2 tiện nghi', 'Nội thất chung cư 90m2 tiện nghi, phù hợp gia đình 3-4 người', 60000000.00, NULL, 'Chung cư', 6, 'images/products/prod_21.jpg', FALSE, TRUE),
('Nội thất chung cư 90m2 hiện đại', 'Thiết kế chung cư 90m2 phong cách hiện đại với màu sắc trung tính', 62000000.00, 58000000.00, 'Chung cư', 8, 'images/products/prod_22.jpg', FALSE, TRUE),
('Thiết kế chung cư 92m2 thông minh', 'Nội thất chung cư 92m2 tối ưu không gian, thiết kế thông minh', 59000000.00, NULL, 'Chung cư', 7, 'images/products/prod_23.jpg', FALSE, TRUE),
('Nội thất chung cư 95m2 cao cấp', 'Thiết kế chung cư 95m2 cao cấp với nội thất nhập khẩu', 64000000.00, 60000000.00, 'Chung cư', 6, 'images/products/prod_24.jpg', TRUE, TRUE),
('Thiết kế chung cư 95m2 sang trọng', 'Nội thất chung cư 95m2 sang trọng với đường nét tinh tế', 66000000.00, NULL, 'Chung cư', 5, 'images/products/prod_25.jpg', FALSE, TRUE),
('Nội thất chung cư 95m2 hiện đại', 'Thiết kế chung cư 95m2 hiện đại với không gian mở', 68000000.00, 64000000.00, 'Chung cư', 7, 'images/products/prod_26.jpg', FALSE, TRUE),
('Thiết kế chung cư 95m2 Bắc Âu', 'Nội thất chung cư 95m2 phong cách Bắc Âu tối giản', 65000000.00, NULL, 'Chung cư', 6, 'images/products/prod_27.jpg', TRUE, TRUE),
('Nội thất chung cư 95m2 ấm cúng', 'Thiết kế chung cư 95m2 ấm cúng với gam màu trầm', 67000000.00, 63000000.00, 'Chung cư', 5, 'images/products/prod_28.jpg', FALSE, TRUE),
('Thiết kế chung cư 95m2 đẹp', 'Nội thất chung cư 95m2 đẹp mắt, tiện nghi đầy đủ', 63000000.00, NULL, 'Chung cư', 8, 'images/products/prod_29.jpg', FALSE, TRUE),
('Nội thất chung cư 100m2 luxury', 'Thiết kế chung cư 100m2 cao cấp với phong cách sang trọng', 70000000.00, 65000000.00, 'Chung cư', 6, 'images/products/prod_30.jpg', TRUE, TRUE),
('Thiết kế chung cư 100m2 hiện đại', 'Nội thất chung cư 100m2 hiện đại với không gian thoáng đãng', 72000000.00, NULL, 'Chung cư', 5, 'images/products/prod_31.jpg', FALSE, TRUE),
('Nội thất chung cư 100m2 thông minh', 'Thiết kế chung cư 100m2 tối ưu diện tích, đa chức năng', 68000000.00, 64000000.00, 'Chung cư', 7, 'images/products/prod_32.jpg', TRUE, TRUE),
('Thiết kế chung cư 100m2 đẹp', 'Nội thất chung cư 100m2 đẹp với màu sắc hài hòa', 69000000.00, NULL, 'Chung cư', 6, 'images/products/prod_33.jpg', FALSE, TRUE),
('Nội thất chung cư 100m2 sang trọng', 'Thiết kế chung cư 100m2 sang trọng với chất liệu cao cấp', 74000000.00, 70000000.00, 'Chung cư', 5, 'images/products/prod_34.jpg', FALSE, TRUE),
('Thiết kế chung cư 110m2 cao cấp', 'Nội thất chung cư 110m2 cao cấp với thiết kế độc đáo', 78000000.00, NULL, 'Chung cư', 4, 'images/products/prod_35.jpg', TRUE, TRUE),
('Nội thất chung cư 110m2 hiện đại', 'Thiết kế chung cư 110m2 hiện đại với đường nét tinh tế', 80000000.00, 75000000.00, 'Chung cư', 5, 'images/products/prod_36.jpg', FALSE, TRUE),
('Thiết kế chung cư 110m2 sang trọng', 'Nội thất chung cư 110m2 sang trọng, tiện nghi', 76000000.00, NULL, 'Chung cư', 6, 'images/products/prod_37.jpg', TRUE, TRUE),
('Nội thất chung cư 110m2 đẹp', 'Thiết kế chung cư 110m2 đẹp mắt với màu sắc nhẹ nhàng', 77000000.00, 73000000.00, 'Chung cư', 5, 'images/products/prod_38.jpg', FALSE, TRUE),
('Thiết kế chung cư 110m2 tối ưu', 'Nội thất chung cư 110m2 tối ưu không gian sống', 79000000.00, NULL, 'Chung cư', 4, 'images/products/prod_39.jpg', FALSE, TRUE),
('Nội thất chung cư 110m2 luxury', 'Thiết kế chung cư 110m2 luxury với nội thất nhập khẩu', 82000000.00, 78000000.00, 'Chung cư', 3, 'images/products/prod_40.jpg', TRUE, TRUE),
('Thiết kế chung cư 110m2 thông minh', 'Nội thất chung cư 110m2 thông minh, đa năng', 75000000.00, NULL, 'Chung cư', 6, 'images/products/prod_41.jpg', FALSE, TRUE),
('Nội thất chung cư 130m2 cao cấp', 'Thiết kế chung cư 130m2 cao cấp với không gian rộng rãi', 88000000.00, 82000000.00, 'Chung cư', 4, 'images/products/prod_42.jpg', TRUE, TRUE),
('Thiết kế chung cư 130m2 sang trọng', 'Nội thất chung cư 130m2 sang trọng với phong cách hiện đại', 92000000.00, NULL, 'Chung cư', 3, 'images/products/prod_43.jpg', FALSE, TRUE),
('Nội thất chung cư phong cách Âu', 'Thiết kế chung cư phong cách Âu thanh lịch, tinh tế', 72000000.00, 68000000.00, 'Chung cư', 5, 'images/products/prod_44.jpg', FALSE, TRUE),
('Thiết kế chung cư Âu hiện đại', 'Nội thất chung cư phong cách Âu hiện đại, sang trọng', 75000000.00, NULL, 'Chung cư', 4, 'images/products/prod_45.jpg', TRUE, TRUE),
('Nội thất chung cư Âu sang trọng', 'Thiết kế chung cư Âu sang trọng với nội thất cao cấp', 78000000.00, 74000000.00, 'Chung cư', 5, 'images/products/prod_46.jpg', FALSE, TRUE),
('Thiết kế chung cư Âu đẹp', 'Nội thất chung cư phong cách Âu đẹp mắt, tiện nghi', 76000000.00, NULL, 'Chung cư', 6, 'images/products/prod_47.jpg', FALSE, TRUE),
('Nội thất chung cư Bắc Âu 69m2', 'Thiết kế chung cư Bắc Âu 69m2 tối giản, hiện đại', 48000000.00, 45000000.00, 'Chung cư', 8, 'images/products/prod_48.jpg', TRUE, TRUE),
('Thiết kế chung cư Bắc Âu 69m2 đẹp', 'Nội thất chung cư Bắc Âu 69m2 với màu sắc nhẹ nhàng', 50000000.00, NULL, 'Chung cư', 7, 'images/products/prod_49.jpg', FALSE, TRUE),
('Nội thất chung cư nhà đẹp cao cấp', 'Thiết kế chung cư nhà đẹp với nội thất cao cấp, sang trọng', 82000000.00, 78000000.00, 'Chung cư', 4, 'images/products/prod_50.jpg', TRUE, TRUE);
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
('admin', 'admin@homedecor.com', '$2y$10$sN8S4tajg1REncAWQuj7KuZZ1J.2Vl828TDnnG2fgYJHscTxNv7MC', 'Administrator', '0901234567', 'admin'),
('john_doe', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'John Doe', '0912345678', 'customer'),
('jane_smith', 'jane@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jane Smith', '0923456789', 'customer');


-- Insert dữ liệu mẫu cho Contact
INSERT INTO contacts (name, email, phone, subject, message, status) VALUES
('Nguyen Van A', 'nguyenvana@gmail.com', '0987654321', 'Product Inquiry', 'I want to know more about the Modern Sofa Set', 'pending'),
('Tran Thi B', 'tranthib@gmail.com', '0976543210', 'Delivery Question', 'How long does delivery take to Hanoi?', 'replied'),
('Le Van C', 'levanc@gmail.com', '0965432109', 'Custom Order', 'Can I order a custom-sized dining table?', 'pending');


-- Bảng carts: mỗi user có 1 giỏ hàng
CREATE TABLE IF NOT EXISTS carts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,     -- Mỗi user chỉ có 1 cart
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Bảng cart_items: danh sách sản phẩm trong giỏ hàng
CREATE TABLE IF NOT EXISTS cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cart_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,   -- Số lượng sản phẩm trong giỏ

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,

    -- 1 sản phẩm không được trùng trong cùng 1 giỏ hàng
    UNIQUE (cart_id, product_id)
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_price DECIMAL(12,2) NOT NULL DEFAULT 0,
    status ENUM('chua_thanh_toan', 'da_thanh_toan') 
        NOT NULL DEFAULT 'chua_thanh_toan',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id)
);
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    price_each DECIMAL(10,2) NOT NULL,
    total_price DECIMAL(12,2) NOT NULL,

    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

