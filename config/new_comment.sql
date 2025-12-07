CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    summary TEXT,
    content LONGTEXT,
    image_url VARCHAR(500),
    is_published TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO news (title, slug, summary, content, image_url, is_published) VALUES
('Xu hướng nội thất 2025', 'xu-huong-noi-that-2025',
 'Các phong cách nội thất dự đoán dẫn đầu năm 2025.',
 'Nội dung chi tiết của bài viết Xu hướng nội thất 2025...',
 'https://picsum.photos/seed/111/600/400', 1),

('Cách chọn sofa phù hợp cho phòng khách nhỏ', 'chon-sofa-phong-khach-nho',
 'Gợi ý chọn sofa tối ưu diện tích phòng khách nhỏ.',
 'Hướng dẫn chi tiết chọn sofa cho phòng khách nhỏ...',
 'https://picsum.photos/seed/112/600/400', 1),

('10 mẫu đèn trang trí bán chạy nhất', '10-mau-den-trang-tri',
 'Danh sách 10 mẫu đèn trang trí nổi bật.',
 'Nội dung chi tiết về các mẫu đèn trang trí...',
 'https://picsum.photos/seed/113/600/400', 1),

('Bí quyết chọn bàn ăn cho gia đình 4 người', 'bi-quyet-chon-ban-an',
 'Cách chọn bộ bàn ăn tiết kiệm diện tích nhưng vẫn sang.',
 'Nội dung chi tiết về bí quyết chọn bàn ăn...',
 'https://picsum.photos/seed/114/600/400', 1),

('Gam màu pastel thống trị nội thất 2025', 'gam-mau-pastel-noi-that',
 'Pastel đang trở thành xu hướng chủ đạo.',
 'Nội dung chi tiết về gam màu pastel...',
 'https://picsum.photos/seed/115/600/400', 1),

('Mẹo giữ gỗ nội thất luôn bền đẹp', 'meo-giu-go-noi-that',
 'Các mẹo giúp vật dụng gỗ luôn như mới.',
 'Nội dung chi tiết về bảo quản gỗ...',
 'https://picsum.photos/seed/116/600/400', 1),

('Xu hướng đèn treo trần hiện đại', 'xu-huong-den-treo-tran',
 'Khám phá các mẫu đèn treo thịnh hành.',
 'Nội dung bài viết về đèn treo trần...',
 'https://picsum.photos/seed/117/600/400', 1),

('Top 5 phong cách nội thất đẹp nhất 2024–2025', 'top-5-phong-cach-noi-that',
 'Các phong cách Nordic, Japandi, Minimalistic...',
 'Nội dung chi tiết về phong cách nội thất...',
 'https://picsum.photos/seed/118/600/400', 1),

('Cách chọn kệ gỗ trang trí nhà cửa', 'chon-ke-go-trang-tri',
 'Những lưu ý khi mua kệ gỗ.',
 'Nội dung chi tiết về chọn kệ...',
 'https://picsum.photos/seed/119/600/400', 1),

('Ý tưởng trang trí phòng ngủ ấm cúng', 'y-tuong-trang-tri-phong-ngu',
 'Các cách giúp phòng ngủ ấm hơn.',
 'Nội dung chi tiết về phòng ngủ ấm cúng...',
 'https://picsum.photos/seed/120/600/400', 1),

('Cách bố trí đèn phòng khách hợp phong thủy', 'cach-bo-tri-den-phong-khach',
 'Đèn phòng khách cũng cần phong thủy.',
 'Nội dung chi tiết về bố trí đèn phòng khách...',
 'https://picsum.photos/seed/121/600/400', 1),

('Những mẫu bàn làm việc tối giản', 'ban-lam-viec-toi-gian',
 'Bàn làm việc tối giản đang rất hot.',
 'Nội dung chi tiết về bàn làm việc tối giản...',
 'https://picsum.photos/seed/122/600/400', 1),

('Gợi ý chọn thảm trải sàn phòng khách', 'goi-y-chon-tham-san',
 'Cách chọn thảm giúp phòng khách nổi bật.',
 'Nội dung chi tiết về chọn thảm...',
 'https://picsum.photos/seed/123/600/400', 1),

('Tối ưu hóa không gian bếp nhỏ', 'toi-uu-khong-gian-bep',
 'Cách tận dụng không gian bếp hẹp.',
 'Nội dung chi tiết về tối ưu bếp...',
 'https://picsum.photos/seed/124/600/400', 1),

('Nội thất phong cách Japandi', 'noi-that-japandi',
 'Sự kết hợp giữa Nhật Bản và Bắc Âu.',
 'Nội dung chi tiết về phong cách Japandi...',
 'https://picsum.photos/seed/125/600/400', 1),

('Có nên chọn tủ nhựa hay tủ gỗ?', 'tu-nhua-hay-tu-go',
 'So sánh ưu nhược điểm giữa tủ nhựa và tủ gỗ.',
 'Nội dung chi tiết về so sánh tủ...',
 'https://picsum.photos/seed/126/600/400', 1),

('7 ý tưởng giúp phòng khách sang hơn', '7-y-tuong-phong-khach-sang-hon',
 'Các cách tăng độ sang trọng cho phòng khách.',
 'Nội dung chi tiết về phòng khách sang...',
 'https://picsum.photos/seed/127/600/400', 1),

('Trang trí tường bằng tranh canvas', 'trang-tri-tranh-canvas',
 'Tranh canvas đang là lựa chọn phổ biến.',
 'Nội dung chi tiết về tranh canvas...',
 'https://picsum.photos/seed/128/600/400', 1),

('Mẹo dọn nhà nhanh dành cho người bận rộn', 'meo-don-nha-nhanh',
 'Tips dọn nhà nhanh và sạch.',
 'Nội dung chi tiết về mẹo dọn nhà...',
 'https://picsum.photos/seed/129/600/400', 1),

('Cách chọn ghế ăn đúng chuẩn công thái học', 'ghe-an-cong-thai-hoc',
 'Ghế ăn cũng cần ergonomic để ngồi lâu.',
 'Nội dung chi tiết về ghế công thái học...',
 'https://picsum.photos/seed/130/600/400', 1);


CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    news_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    status ENUM('pending','approved','rejected') DEFAULT 'approved',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (news_id) REFERENCES news(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO comments (news_id, name, email, content, status) VALUES
(1, 'Nguyễn Văn A', 'vana@example.com', 'Bài viết rất hữu ích, cảm ơn bạn!', 'approved'),
(1, 'Trần Thị B', 'thib@example.com', 'Nội dung rõ ràng, dễ hiểu.', 'approved'),
(1, 'Lê Minh C', 'minhc@example.com', 'Phong cách viết tốt, hình ảnh đẹp.', 'approved'),
(1, 'Hoàng Dũng', 'dung@example.com', 'Thông tin chi tiết, rất đáng tham khảo.', 'approved'),
(1, 'Ngọc Trâm', 'tram@example.com', 'Website trình bày đẹp, thích lắm!', 'approved'),

(2, 'Phạm Huy', 'huy@example.com', 'Bài viết hay quá trời luôn.', 'approved'),
(2, 'Hà Vy', 'vy@example.com', 'Mình đọc mà thích mê.', 'approved'),
(2, 'Tuấn Kiệt', 'kiet@example.com', 'Còn thiếu vài thông tin nhỏ.', 'pending'),
(2, 'Thiên An', 'an@example.com', 'Rất bổ ích, cảm ơn tác giả.', 'approved'),
(2, 'Gia Hân', 'han@example.com', 'Hình minh họa đẹp.', 'approved'),

(3, 'Minh Quân', 'quan@example.com', 'Bài viết chi tiết, hữu ích.', 'approved'),
(3, 'Hữu Tín', 'tin@example.com', 'Tác giả viết có tâm thật.', 'approved'),
(3, 'Mai Chi', 'chi@example.com', 'Cách trình bày rất rõ ràng.', 'approved'),
(3, 'Khánh Linh', 'linh@example.com', 'Phù hợp với dự án mình đang làm.', 'approved'),
(3, 'Đức Trọng', 'trong@example.com', 'Rất tốt, ủng hộ thêm nhiều bài nữa.', 'approved'),

(4, 'Linh San', 'san@example.com', 'Thông tin thực sự giá trị.', 'approved'),
(4, 'Tuệ Nhi', 'nhi@example.com', 'Trình bày hợp lý, dễ đọc.', 'approved'),
(4, 'Tường Vy', 'vy2@example.com', 'Nhìn bố cục rất chuyên nghiệp.', 'pending'),
(4, 'Thiện Nhân', 'nhan@example.com', 'Bài viết chất lượng.', 'approved'),
(4, 'Hoàng Yến', 'yen@example.com', 'Nên thêm vài ví dụ thực tế.', 'approved'),

(5, 'Trúc Anh', 'anh@example.com', 'Rất thích cách viết này.', 'approved'),
(5, 'Hồ Nam', 'nam@example.com', 'OK lắm luôn.', 'approved'),
(5, 'Mỹ Duyên', 'duyen@example.com', 'Nội dung hợp lý và thú vị.', 'approved'),
(5, 'Hữu Hiếu', 'hieu@example.com', 'Bài viết đáng để chia sẻ.', 'approved'),
(5, 'Phương Uyên', 'uyen@example.com', 'Mình sẽ đọc thêm bài khác nữa.', 'approved'),

(6, 'Bảo Châu', 'chau@example.com', 'Tuyệt vời, rất hay.', 'approved'),
(6, 'Việt Hoàng', 'hoang@example.com', 'Có tâm ghê.', 'approved'),
(6, 'Thiên Phúc', 'phuc@example.com', 'Bài viết hơi dài nhưng hay.', 'approved'),
(6, 'Minh Hà', 'ha@example.com', 'Mình đã lưu lại để xem tiếp.', 'approved'),
(6, 'Lan Anh', 'lananh@example.com', 'Trình bày xuất sắc.', 'pending'),

(7, 'Kim Ngân', 'ngan@example.com', 'Bài viết lọt top chất lượng luôn.', 'approved'),
(7, 'Phúc Lộc', 'loc@example.com', 'Rất hữu ích cho người mới.', 'approved'),
(7, 'Tấn Lợi', 'loi@example.com', 'Mình hiểu thêm nhiều điều.', 'approved'),
(7, 'Mai Hương', 'huong@example.com', 'Tác giả viết rất dễ hiểu.', 'approved'),
(7, 'Thu Hà', 'thuha@example.com', 'Hay nhưng hơi ít hình.', 'approved'),

(8, 'Khánh Hòa', 'hoa@example.com', 'Bài viết xuất sắc!', 'approved'),
(8, 'Thế Bảo', 'bao@example.com', 'Nên có thêm video minh họa.', 'pending'),
(8, 'Diệp Nhi', 'diepnhi@example.com', 'Cảm ơn vì bài viết chất lượng.', 'approved'),
(8, 'Hoàng Phúc', 'hphuc@example.com', 'Rất thực tế.', 'approved'),
(8, 'Hà My', 'hamy@example.com', 'Like mạnh.', 'approved'),

(9, 'Thanh Trúc', 'thutruc@example.com', 'Rất nhiều thông tin mới.', 'approved'),
(9, 'Quốc Khánh', 'khanh@example.com', 'Đọc xong mở mang kiến thức.', 'approved'),
(9, 'Anh Tú', 'tuanh@example.com', 'Nội dung hơi ngắn.', 'approved'),
(9, 'Lê Hồng', 'hong@example.com', 'Ổn áp.', 'approved'),
(9, 'Bảo Long', 'long@example.com', 'Quá trời hữu ích.', 'approved'),

(10, 'Khả Vy', 'khavy@example.com', 'Hay cực kỳ.', 'approved'),
(10, 'Đình Khang', 'khang@example.com', 'Thông tin giá trị.', 'approved'),
(10, 'Minh Tuấn', 'tuan@example.com', 'Cách viết chuyên nghiệp.', 'approved'),
(10, 'Hữu Phát', 'phat@example.com', 'Không chê được điểm nào.', 'approved'),
(10, 'Anh Thư', 'thu@example.com', 'Sẽ quay lại đọc thêm.', 'approved');
