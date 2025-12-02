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
('Thiết kế biệt thự 100m2 phong cách hiện đại', 'Thiết kế nội thất biệt thự 100m2 sang trọng, tối ưu không gian sống với phong cách hiện đại, tiện nghi đầy đủ', 85000000.00, 78000000.00, 'Biệt thự', 5, 'https://bizweb.dktcdn.net/100/178/833/files/biet-thu-100m2-home-decor-vn-1.jpg?v=1586921294467', TRUE, TRUE),
('Nội thất biệt thú 100m2 cao cấp', 'Giải pháp thiết kế nội thất biệt thự 100m2 với chất liệu cao cấp, màu sắc hài hòa, phù hợp gia đình trẻ', 92000000.00, 85000000.00, 'Biệt thự', 3, 'https://bizweb.dktcdn.net/100/178/833/files/biet-thu-100m2-home-decor-vn-4.jpg?v=1586921503334', TRUE, TRUE),
('Thiết kế biệt thự 100m2 phong cách Bắc Âu', 'Thiết kế nội thất biệt thự tối giản với gam màu trung tính, ánh sáng tự nhiên tràn ngập', 88000000.00, NULL, 'Biệt thự', 4, 'https://bizweb.dktcdn.net/100/178/833/files/biet-thu-100m2-home-decor-vn-6.jpg?v=1586921428552', FALSE, TRUE),
('Nội thất biệt thự 80m2 thông minh', 'Thiết kế biệt thự 80m2 tối ưu diện tích, đầy đủ công năng với phong cách hiện đại', 72000000.00, 68000000.00, 'Biệt thự', 6, 'https://bizweb.dktcdn.net/100/178/833/files/biet-thu-80m2-home-decor-vn-12.jpg?v=1586920630169', FALSE, TRUE),
('Thiết kế biệt thự 80m2 ấm cúng', 'Không gian biệt thự 80m2 ấm áp với gam màu trầm, nội thất gỗ tự nhiên cao cấp', 75000000.00, NULL, 'Biệt thự', 5, 'https://bizweb.dktcdn.net/100/178/833/files/biet-thu-80m2-home-decor-vn-15.jpg?v=1586920557567', TRUE, TRUE),
('Nội thất biệt thự 80m2 sang trọng', 'Thiết kế nội thất biệt thự 80m2 sang trọng với đường nét tinh tế, màu sắc nhẹ nhàng', 78000000.00, 72000000.00, 'Biệt thự', 4, 'https://bizweb.dktcdn.net/100/178/833/files/biet-thu-80m2-home-decor-vn-16.jpg?v=1586920595326', FALSE, TRUE),
('Thiết kế căn biệt thự đẳng cấp', 'Nội thất biệt thự cao cấp với thiết kế độc đáo, chất liệu nhập khẩu', 125000000.00, 115000000.00, 'Biệt thự', 2, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-biet-thu-home-decor-vn-14.jpg?v=1586922332590', TRUE, TRUE),
('Nội thất biệt thự phong cách tân cổ điển', 'Thiết kế biệt thự kết hợp giữa cổ điển và hiện đại, tạo không gian sang trọng', 135000000.00, NULL, 'Biệt thự', 3, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-biet-thu-home-decor-vn-32.jpg?v=1586922190729', TRUE, TRUE),
('Thiết kế biệt thự hiện đại luxury', 'Biệt thự thiết kế hiện đại với đầy đủ tiện nghi, không gian mở thoáng đãng', 145000000.00, 135000000.00, 'Biệt thự', 2, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-biet-thu-home-decor-vn-37.jpg?v=1586922110995', FALSE, TRUE),
('Nội thất chung cư 120m2 hiện đại', 'Thiết kế chung cư 120m2 với không gian mở, tối ưu ánh sáng tự nhiên', 65000000.00, 60000000.00, 'Chung cư', 8, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-120m2-home-decor-12.jpg?v=1586230840893', TRUE, TRUE),
('Thiết kế chung cư 120m2 thông minh', 'Giải pháp nội thất chung cư 120m2 thông minh, đa năng cho gia đình 4-5 người', 68000000.00, NULL, 'Chung cư', 7, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-120m2-home-decor-19.jpg?v=1586230928755', FALSE, TRUE),
('Nội thất chung cư 120m2 sang trọng', 'Thiết kế nội thất chung cư 120m2 cao cấp với chất liệu nhập khẩu', 72000000.00, 68000000.00, 'Chung cư', 6, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-120m2-home-decor-22.jpg?v=1586230894549', TRUE, TRUE),
('Thiết kế chung cư 70m2 tối ưu', 'Nội thất chung cư 70m2 tối ưu không gian, phù hợp gia đình trẻ', 42000000.00, 38000000.00, 'Chung cư', 10, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-70m2-home-decor-1.jpg?v=1586231311572', FALSE, TRUE),
('Nội thất chung cư 70m2 hiện đại', 'Thiết kế chung cư 70m2 phong cách hiện đại, tiện nghi đầy đủ', 45000000.00, NULL, 'Chung cư', 9, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-70m2-home-decor-12-13.jpg?v=1586231341797', TRUE, TRUE),
('Thiết kế chung cư 70m2 Bắc Âu', 'Nội thất chung cư 70m2 phong cách Bắc Âu tối giản, thanh lịch', 48000000.00, 45000000.00, 'Chung cư', 8, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-70m2-home-decor-4.jpg?v=1586231321937', FALSE, TRUE),
('Nội thất chung cư 70m2 ấm cúng', 'Thiết kế chung cư 70m2 với gam màu ấm, tạo cảm giác thư giãn', 46000000.00, NULL, 'Chung cư', 7, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-70m2-home-decor-6.jpg?v=1586231260824', FALSE, TRUE),
('Thiết kế chung cư 80m2 hiện đại', 'Nội thất chung cư 80m2 hiện đại với đường nét tinh tế, màu sắc hài hòa', 52000000.00, 48000000.00, 'Chung cư', 10, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-80m2-home-decor-1.jpg?v=1586229828132', TRUE, TRUE),
('Nội thất chung cư 80m2 thông minh', 'Thiết kế chung cư 80m2 tối ưu diện tích, đa chức năng', 55000000.00, NULL, 'Chung cư', 9, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-80m2-home-decor-7.jpg?v=1586229881898', FALSE, TRUE),
('Thiết kế chung cư 80m2 sang trọng', 'Nội thất chung cư 80m2 cao cấp với chất liệu đẹp, bền', 58000000.00, 54000000.00, 'Chung cư', 8, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-80m2-home-decor-9.jpg?v=1586229962210', FALSE, TRUE),
('Nội thất chung cư 90m2 đẹp', 'Thiết kế chung cư 90m2 với phong cách hiện đại, thoáng đãng', 58000000.00, 54000000.00, 'Chung cư', 7, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-90m2-home-decor-1.jpg?v=1586231002143', TRUE, TRUE),
('Thiết kế chung cư 90m2 tiện nghi', 'Nội thất chung cư 90m2 tiện nghi, phù hợp gia đình 3-4 người', 60000000.00, NULL, 'Chung cư', 6, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-90m2-home-decor-4.jpg?v=1586231030260', FALSE, TRUE),
('Nội thất chung cư 90m2 hiện đại', 'Thiết kế chung cư 90m2 phong cách hiện đại với màu sắc trung tính', 62000000.00, 58000000.00, 'Chung cư', 8, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-90m2-home-decor-7.jpg?v=1586231083058', FALSE, TRUE),
('Thiết kế chung cư 92m2 thông minh', 'Nội thất chung cư 92m2 tối ưu không gian, thiết kế thông minh', 59000000.00, NULL, 'Chung cư', 7, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-92m2-home-decor-4.jpg?v=1586230083627', FALSE, TRUE),
('Nội thất chung cư 95m2 cao cấp', 'Thiết kế chung cư 95m2 cao cấp với nội thất nhập khẩu', 64000000.00, 60000000.00, 'Chung cư', 6, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-95m2-home-decor-10.jpg?v=1586231826862', TRUE, TRUE),
('Thiết kế chung cư 95m2 sang trọng', 'Nội thất chung cư 95m2 sang trọng với đường nét tinh tế', 66000000.00, NULL, 'Chung cư', 5, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-95m2-home-decor-15.jpg?v=1586231901291', FALSE, TRUE),
('Nội thất chung cư 95m2 hiện đại', 'Thiết kế chung cư 95m2 hiện đại với không gian mở', 68000000.00, 64000000.00, 'Chung cư', 7, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-95m2-home-decor-20.jpg?v=1586231982624', FALSE, TRUE),
('Thiết kế chung cư 95m2 Bắc Âu', 'Nội thất chung cư 95m2 phong cách Bắc Âu tối giản', 65000000.00, NULL, 'Chung cư', 6, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-95m2-home-decor-25.jpg?v=1586232034462', TRUE, TRUE),
('Nội thất chung cư 95m2 ấm cúng', 'Thiết kế chung cư 95m2 ấm cúng với gam màu trầm', 67000000.00, 63000000.00, 'Chung cư', 5, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-95m2-home-decor-28.jpg?v=1586232077331', FALSE, TRUE),
('Thiết kế chung cư 95m2 đẹp', 'Nội thất chung cư 95m2 đẹp mắt, tiện nghi đầy đủ', 63000000.00, NULL, 'Chung cư', 8, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-can-chung-cu-95m2-home-decor-7.jpg?v=1586231770904', FALSE, TRUE),
('Nội thất chung cư 100m2 luxury', 'Thiết kế chung cư 100m2 cao cấp với phong cách sang trọng', 70000000.00, 65000000.00, 'Chung cư', 6, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-100m2-home-decor-vn-1.jpg?v=1586922953916', TRUE, TRUE),
('Thiết kế chung cư 100m2 hiện đại', 'Nội thất chung cư 100m2 hiện đại với không gian thoáng đãng', 72000000.00, NULL, 'Chung cư', 5, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-100m2-home-decor-vn-12.jpg?v=1586923069778', FALSE, TRUE),
('Nội thất chung cư 100m2 thông minh', 'Thiết kế chung cư 100m2 tối ưu diện tích, đa chức năng', 68000000.00, 64000000.00, 'Chung cư', 7, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-100m2-home-decor-vn-15.jpg?v=1587365234809', TRUE, TRUE),
('Thiết kế chung cư 100m2 đẹp', 'Nội thất chung cư 100m2 đẹp với màu sắc hài hòa', 69000000.00, NULL, 'Chung cư', 6, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-100m2-home-decor-vn-2.jpg?v=1586922898947', FALSE, TRUE),
('Nội thất chung cư 100m2 sang trọng', 'Thiết kế chung cư 100m2 sang trọng với chất liệu cao cấp', 74000000.00, 70000000.00, 'Chung cư', 5, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-100m2-home-decor-vn-7.jpg?v=1586922914948', FALSE, TRUE),
('Thiết kế chung cư 110m2 cao cấp', 'Nội thất chung cư 110m2 cao cấp với thiết kế độc đáo', 78000000.00, NULL, 'Chung cư', 4, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-110m2-home-decor-vn-12.jpg?v=1586924113233', TRUE, TRUE),
('Nội thất chung cư 110m2 hiện đại', 'Thiết kế chung cư 110m2 hiện đại với đường nét tinh tế', 80000000.00, 75000000.00, 'Chung cư', 5, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-110m2-home-decor-vn-17.jpg?v=1586924245389', FALSE, TRUE),
('Thiết kế chung cư 110m2 sang trọng', 'Nội thất chung cư 110m2 sang trọng, tiện nghi', 76000000.00, NULL, 'Chung cư', 6, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-110m2-home-decor-vn-2.jpg?v=1586924043027', TRUE, TRUE),
('Nội thất chung cư 110m2 đẹp', 'Thiết kế chung cư 110m2 đẹp mắt với màu sắc nhẹ nhàng', 77000000.00, 73000000.00, 'Chung cư', 5, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-110m2-home-decor-vn-21.jpg?v=1586923765242', FALSE, TRUE),
('Thiết kế chung cư 110m2 tối ưu', 'Nội thất chung cư 110m2 tối ưu không gian sống', 79000000.00, NULL, 'Chung cư', 4, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-110m2-home-decor-vn-24.jpg?v=1586923569863', FALSE, TRUE),
('Nội thất chung cư 110m2 luxury', 'Thiết kế chung cư 110m2 luxury với nội thất nhập khẩu', 82000000.00, 78000000.00, 'Chung cư', 3, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-110m2-home-decor-vn-33.jpg?v=1586923509422', TRUE, TRUE),
('Thiết kế chung cư 110m2 thông minh', 'Nội thất chung cư 110m2 thông minh, đa năng', 75000000.00, NULL, 'Chung cư', 6, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-110m2-home-decor-vn-8.jpg?v=1586924075043', FALSE, TRUE),
('Nội thất chung cư 130m2 cao cấp', 'Thiết kế chung cư 130m2 cao cấp với không gian rộng rãi', 88000000.00, 82000000.00, 'Chung cư', 4, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-130m2-home-decor-vn-4.jpg?v=1586925015483', TRUE, TRUE),
('Thiết kế chung cư 130m2 sang trọng', 'Nội thất chung cư 130m2 sang trọng với phong cách hiện đại', 92000000.00, NULL, 'Chung cư', 3, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-130m2-home-decor-vn-8.jpg?v=1586925133583', FALSE, TRUE),
('Nội thất chung cư phong cách Âu', 'Thiết kế chung cư phong cách Âu thanh lịch, tinh tế', 72000000.00, 68000000.00, 'Chung cư', 5, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-au-home-decor-vn-10.jpg?v=1586925730824', FALSE, TRUE),
('Thiết kế chung cư Âu hiện đại', 'Nội thất chung cư phong cách Âu hiện đại, sang trọng', 75000000.00, NULL, 'Chung cư', 4, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-au-home-decor-vn-15.jpg?v=1586925782689', TRUE, TRUE),
('Nội thất chung cư Âu sang trọng', 'Thiết kế chung cư Âu sang trọng với nội thất cao cấp', 78000000.00, 74000000.00, 'Chung cư', 5, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-au-home-decor-vn-4.jpg?v=1586925714583', FALSE, TRUE),
('Thiết kế chung cư Âu đẹp', 'Nội thất chung cư phong cách Âu đẹp mắt, tiện nghi', 76000000.00, NULL, 'Chung cư', 6, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-au-home-decor-vn-8.jpg?v=1586925948076', FALSE, TRUE),
('Nội thất chung cư Bắc Âu 69m2', 'Thiết kế chung cư Bắc Âu 69m2 tối giản, hiện đại', 48000000.00, 45000000.00, 'Chung cư', 8, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-bac-au-69m2-home-decor-vn-16.jpg?v=1586926624181', TRUE, TRUE),
('Thiết kế chung cư Bắc Âu 69m2 đẹp', 'Nội thất chung cư Bắc Âu 69m2 với màu sắc nhẹ nhàng', 50000000.00, NULL, 'Chung cư', 7, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-bac-au-69m2-home-decor-vn-6.jpg?v=1586926798285', FALSE, TRUE),
('Nội thất chung cư nhà đẹp cao cấp', 'Thiết kế chung cư nhà đẹp với nội thất cao cấp, sang trọng', 82000000.00, 78000000.00, 'Chung cư', 4, 'https://bizweb.dktcdn.net/100/178/833/files/thiet-ke-chung-cu-nha-dep-home-decor-vn-26.jpg?v=1586927527275', TRUE, TRUE);

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

-- Bảng Page (quản lý nội dung trang tĩnh)
CREATE TABLE IF NOT EXISTS pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(150) NOT NULL UNIQUE,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    meta TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug)
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