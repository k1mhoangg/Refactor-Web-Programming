# Hướng dẫn cấu hình VirtualHost cho XAMPP

Hướng dẫn này sẽ giúp bạn cấu hình VirtualHost trên XAMPP cho các hệ điều hành Linux, Windows và MacOS.

## 📋 Yêu cầu

- XAMPP đã được cài đặt
- Quyền Administrator/Root để chỉnh sửa file hosts
- Trình soạn thảo text (Notepad++, VSCode, nano, vim, etc.)

---

## 🐧 Linux

### Bước 1: Mở file cấu hình VirtualHost

```bash
sudo nano /opt/lampp/etc/extra/httpd-vhosts.conf
```

### Bước 2: Thêm cấu hình VirtualHost

Thêm đoạn code sau vào cuối file:

```apache
<VirtualHost *:80>
    ServerAdmin webmaster@refactor.local
    DocumentRoot "/opt/lampp/prj/Refactor-Web-Programming/public"
    ServerName refactor.local
    <Directory "/opt/lampp/prj/Refactor-Web-Programming/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog "logs/refactor.local-error_log"
    CustomLog "logs/refactor.local-access_log" common
    php_admin_value display_errors On
    php_admin_value display_startup_errors On
    php_admin_value error_reporting E_ALL
</VirtualHost>
```

Lưu file: `Ctrl + O`, `Enter`, sau đó thoát: `Ctrl + X`

### Bước 3: Chỉnh sửa file hosts

```bash
sudo nano /etc/hosts
```

Thêm dòng sau:

```
127.0.0.1   refactor.local
```

### Bước 4: Khởi động lại Apache

```bash
sudo /opt/lampp/lampp restart
```

---

## 🪟 Windows

### Bước 1: Mở file cấu hình VirtualHost

Mở file với quyền Administrator:

```
C:\xampp\apache\conf\extra\httpd-vhosts.conf
```

**Lưu ý**: Nhấp chuột phải vào Notepad++ hoặc trình soạn thảo và chọn "Run as Administrator"

### Bước 2: Thêm cấu hình VirtualHost

Thêm đoạn code sau vào cuối file (điều chỉnh đường dẫn cho phù hợp):

```apache
<VirtualHost *:80>
    ServerAdmin webmaster@refactor.local
    DocumentRoot "C:/xampp/htdocs/Refactor-Web-Programming/public"
    ServerName refactor.local
    <Directory "C:/xampp/htdocs/Refactor-Web-Programming/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog "logs/refactor.local-error_log"
    CustomLog "logs/refactor.local-access_log" common
    php_admin_value display_errors On
    php_admin_value display_startup_errors On
    php_admin_value error_reporting E_ALL
</VirtualHost>
```

**Quan trọng**: Sử dụng dấu `/` (forward slash) thay vì `\` (backslash) trong đường dẫn.

### Bước 3: Chỉnh sửa file hosts

Mở file với quyền Administrator:

```
C:\Windows\System32\drivers\etc\hosts
```

Thêm dòng sau:

```
127.0.0.1   refactor.local
```

### Bước 4: Khởi động lại Apache

Mở XAMPP Control Panel và nhấn nút "Stop" rồi "Start" cho Apache.

---

## 🍎 MacOS

### Bước 1: Mở file cấu hình VirtualHost

```bash
sudo nano /Applications/XAMPP/xamppfiles/etc/extra/httpd-vhosts.conf
```

### Bước 2: Thêm cấu hình VirtualHost

Thêm đoạn code sau vào cuối file:

```apache
<VirtualHost *:80>
    ServerAdmin webmaster@refactor.local
    DocumentRoot "/Applications/XAMPP/xamppfiles/htdocs/Refactor-Web-Programming/public"
    ServerName refactor.local
    <Directory "/Applications/XAMPP/xamppfiles/htdocs/Refactor-Web-Programming/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog "logs/refactor.local-error_log"
    CustomLog "logs/refactor.local-access_log" common
    php_admin_value display_errors On
    php_admin_value display_startup_errors On
    php_admin_value error_reporting E_ALL
</VirtualHost>
```

### Bước 3: Chỉnh sửa file hosts

```bash
sudo nano /etc/hosts
```

Thêm dòng sau:

```
127.0.0.1   refactor.local
```

### Bước 4: Khởi động lại Apache

```bash
sudo /Applications/XAMPP/xamppfiles/xampp restart
```

Hoặc sử dụng XAMPP Control Panel.

---

## 🔍 Kiểm tra cấu hình

### 1. Kiểm tra cú pháp Apache

**Linux/MacOS:**
```bash
sudo /opt/lampp/bin/apachectl configtest
# hoặc
sudo /Applications/XAMPP/xamppfiles/bin/apachectl configtest
```

**Windows:**
```cmd
C:\xampp\apache\bin\httpd.exe -t
```

Kết quả mong đợi: `Syntax OK`

### 2. Truy cập website

Mở trình duyệt và truy cập:

```
http://refactor.local
```

---

## ⚙️ Giải thích các tham số

| Tham số | Mô tả |
|---------|-------|
| `ServerAdmin` | Email quản trị viên |
| `DocumentRoot` | Đường dẫn thư mục gốc của website |
| `ServerName` | Tên miền ảo |
| `Directory` | Cấu hình quyền truy cập thư mục |
| `AllowOverride All` | Cho phép sử dụng file .htaccess |
| `Require all granted` | Cho phép truy cập từ mọi IP |
| `ErrorLog` | File log lỗi |
| `CustomLog` | File log truy cập |

---

## ❗ Xử lý lỗi thường gặp

### Lỗi: "Access forbidden"

**Giải pháp**: Kiểm tra quyền của thư mục và đảm bảo `Require all granted` được cấu hình đúng.

### Lỗi: "404 Not Found"

**Giải pháp**: 
- Kiểm tra đường dẫn `DocumentRoot` có chính xác không
- Đảm bảo file `index.php` hoặc `index.html` tồn tại

### Không truy cập được domain

**Giải pháp**:
- Xóa cache DNS: `ipconfig /flushdns` (Windows) hoặc `sudo dscacheutil -flushcache` (MacOS)
- Kiểm tra file hosts đã lưu đúng chưa
- Khởi động lại Apache

### Port 80 đã được sử dụng

**Giải pháp**: Đổi port trong cấu hình VirtualHost từ `*:80` sang `*:8080` và truy cập bằng `http://refactor.local:8080`

---

## 📝 Lưu ý quan trọng

1. **Đường dẫn**: Luôn sử dụng đường dẫn tuyệt đối và dấu `/` (forward slash)
2. **Quyền truy cập**: Trên Linux/MacOS, đảm bảo Apache có quyền đọc thư mục dự án
3. **Backup**: Nên backup file cấu hình trước khi chỉnh sửa
4. **Module vhosts**: Đảm bảo module VirtualHost đã được bật trong file `httpd.conf`

```apache
# Bỏ dấu # ở dòng này trong httpd.conf
Include etc/extra/httpd-vhosts.conf
```

---

## 🎯 Tạo nhiều VirtualHost

Bạn có thể tạo nhiều VirtualHost bằng cách thêm nhiều block cấu hình:

```apache
<VirtualHost *:80>
    ServerName project1.local
    DocumentRoot "/path/to/project1/public"
    ...
</VirtualHost>

<VirtualHost *:80>
    ServerName project2.local
    DocumentRoot "/path/to/project2/public"
    ...
</VirtualHost>
```

Và thêm tương ứng trong file hosts:

```
127.0.0.1   project1.local
127.0.0.1   project2.local
```

---

## ✅ Hoàn tất

Bây giờ bạn đã có thể truy cập dự án của mình thông qua tên miền tùy chỉnh thay vì `localhost`!

**Chúc bạn code vui vẻ! 🚀**