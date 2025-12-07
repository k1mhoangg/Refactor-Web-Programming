# Hướng dẫn cài đặt

## 1. Cài đặt Composer

### Windows

1. Tải Composer từ: https://getcomposer.org/download/
2. Chạy file `Composer-Setup.exe`
3. Làm theo hướng dẫn cài đặt (chọn đường dẫn PHP nếu được yêu cầu)
4. Sau khi cài đặt xong, mở **Command Prompt** và kiểm tra:
```bash
composer --version
```

### macOS

Mở **Terminal** và chạy:
```bash
brew install composer
```

Hoặc cài đặt thủ công:
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
```

Kiểm tra:
```bash
composer --version
```

### Linux (Ubuntu/Debian)

Mở **Terminal** và chạy:
```bash
sudo apt update
sudo apt install composer
```

Hoặc cài đặt thủ công:
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
```

Kiểm tra:
```bash
composer --version
```

## 2. Cài đặt dependencies

Mở Terminal/Command Prompt, di chuyển vào thư mục project và chạy:

```bash
composer install
```

Lệnh này sẽ tải và cài đặt tất cả thư viện cần thiết (PHPMailer) vào thư mục `vendor/`.

## 3. Cấu hình file .env

### Bước 1: Tạo file .env

Copy file `.env.example` thành `.env`:

**Windows (Command Prompt):**
```bash
copy .env.example .env
```

**macOS/Linux (Terminal):**
```bash
cp .env.example .env
```

### Bước 2: Cấu hình Database

Mở file `.env` và điền thông tin:

```env
# Database
DB_HOST='localhost'
DB_NAME='homedecor_db'
DB_USER='root'
DB_PASS='your_password_here'
DB_CHARSET='utf8mb4'
```

**Ví dụ cụ thể:**
```env
DB_HOST='localhost'
DB_NAME='homedecor_db'
DB_USER='root'
DB_PASS='123456'
DB_CHARSET='utf8mb4'
```

### Bước 3: Cấu hình Email (Gmail SMTP)

#### Tạo App Password cho Gmail:

1. Truy cập: https://myaccount.google.com
2. Chọn **"Bảo mật"** (Security)
3. Bật **"Xác minh 2 bước"** (2-Step Verification)
4. Sau khi bật, truy cập: https://myaccount.google.com/apppasswords
5. Chọn **"App"** → **"Mail"** và **"Device"** → **"Other"**
6. Nhập tên: `Home Decor Shop`
7. Click **"Generate"** → Sao chép mật khẩu 16 ký tự

#### Điền vào file .env:

```env
# Email SMTP (Gmail)
EMAIL_HOST='smtp.gmail.com'
EMAIL_PORT='587'
EMAIL_USER='yourname@gmail.com'
EMAIL_PASS='your_app_password_here'
EMAIL_FROM='yourname@gmail.com'
EMAIL_FROM_NAME='Home Decor Shop'
EMAIL_ENCRYPTION='tls'
EMAIL_DEBUG='0'
```

**Ví dụ cụ thể:**
```env
EMAIL_HOST='smtp.gmail.com'
EMAIL_PORT='587'
EMAIL_USER='shop.homedecor@gmail.com'
EMAIL_PASS='abcd efgh ijkl mnop'
EMAIL_FROM='shop.homedecor@gmail.com'
EMAIL_FROM_NAME='Home Decor Shop'
EMAIL_ENCRYPTION='tls'
EMAIL_DEBUG='0'
```

**Lưu ý:**
- `EMAIL_PORT`: Dùng `587` cho TLS hoặc `465` cho SSL
- `EMAIL_ENCRYPTION`: Dùng `tls` hoặc `ssl`
- `EMAIL_DEBUG`: Đặt `0` (tắt) hoặc `2` (bật để xem lỗi)

## 4. Chạy ứng dụng

Sau khi cấu hình xong, chạy project bằng PHP built-in server:

```bash
php -S localhost:8000
```

Hoặc nếu dùng XAMPP/WAMP, đặt project vào thư mục `htdocs` hoặc `www` và truy cập:
```
http://localhost/homedecor
```


# Hướng dẫn cấu hình VirtualHost cho XAMPP

Hướng dẫn này sẽ giúp bạn cấu hình VirtualHost trên XAMPP cho các hệ điều hành Linux, Windows và MacOS.

## 📋 Yêu cầu

- XAMPP đã được cài đặt
- Quyền Administrator/Root để chỉnh sửa file hosts
- Trình soạn thảo text (Notepad++, VSCode, nano, vim, etc.)

---

## 🐧 Linux

### Bước 1: Kích hoạt VirtualHost trong httpd.conf

Mở file cấu hình Apache:

```bash
sudo nano /opt/lampp/etc/httpd.conf
```

Tìm và bỏ dấu `#` ở đầu dòng sau (nếu có):

```apache
# Include etc/extra/httpd-vhosts.conf
```

Thành:

```apache
Include etc/extra/httpd-vhosts.conf
```

Lưu file: `Ctrl + O`, `Enter`, sau đó thoát: `Ctrl + X`

### Bước 2: Mở file cấu hình VirtualHost

```bash
sudo nano /opt/lampp/etc/extra/httpd-vhosts.conf
```

### Bước 3: Thêm cấu hình VirtualHost

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

### Bước 4: Chỉnh sửa file hosts

```bash
sudo nano /etc/hosts
```

Thêm dòng sau:

```
127.0.0.1   refactor.local
```

### Bước 5: Khởi động lại Apache

```bash
sudo /opt/lampp/lampp restart
```

---

## 🪟 Windows

### Bước 1: Kích hoạt VirtualHost trong httpd.conf

Mở file với quyền Administrator:

```
C:\xampp\apache\conf\httpd.conf
```

Tìm và bỏ dấu `#` ở đầu dòng sau (nếu có):

```apache
# Include conf/extra/httpd-vhosts.conf
```

Thành:

```apache
Include conf/extra/httpd-vhosts.conf
```

### Bước 2: Mở file cấu hình VirtualHost

Mở file với quyền Administrator:

```
C:\xampp\apache\conf\extra\httpd-vhosts.conf
```

**Lưu ý**: Nhấp chuột phải vào Notepad++ hoặc trình soạn thảo và chọn "Run as Administrator"

### Bước 3: Thêm cấu hình VirtualHost

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

### Bước 4: Chỉnh sửa file hosts

Mở file với quyền Administrator:

```
C:\Windows\System32\drivers\etc\hosts
```

Thêm dòng sau:

```
127.0.0.1   refactor.local
```

### Bước 5: Khởi động lại Apache

Mở XAMPP Control Panel và nhấn nút "Stop" rồi "Start" cho Apache.

---

## 🍎 MacOS

### Bước 1: Kích hoạt VirtualHost trong httpd.conf

Mở file cấu hình Apache:

```bash
sudo nano /Applications/XAMPP/xamppfiles/etc/httpd.conf
```

Tìm và bỏ dấu `#` ở đầu dòng sau (nếu có):

```apache
# Include etc/extra/httpd-vhosts.conf
```

Thành:

```apache
Include etc/extra/httpd-vhosts.conf
```

### Bước 2: Mở file cấu hình VirtualHost

```bash
sudo nano /Applications/XAMPP/xamppfiles/etc/extra/httpd-vhosts.conf
```

### Bước 3: Thêm cấu hình VirtualHost

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

### Bước 4: Chỉnh sửa file hosts

```bash
sudo nano /etc/hosts
```

Thêm dòng sau:

```
127.0.0.1   refactor.local
```

### Bước 5: Khởi động lại Apache

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

1. **Kích hoạt VirtualHost**: Bước đầu tiên và quan trọng nhất là phải bỏ comment dòng `Include etc/extra/httpd-vhosts.conf` trong file `httpd.conf`, nếu không VirtualHost sẽ không hoạt động
2. **Đường dẫn**: Luôn sử dụng đường dẫn tuyệt đối và dấu `/` (forward slash)
3. **Quyền truy cập**: Trên Linux/MacOS, đảm bảo Apache có quyền đọc thư mục dự án
4. **Backup**: Nên backup file cấu hình trước khi chỉnh sửa
5. **Xóa VirtualHost mặc định**: Trong file `httpd-vhosts.conf`, XAMPP thường có sẵn 2 VirtualHost mẫu (dummy-host.example.com), bạn nên comment hoặc xóa chúng đi để tránh conflict

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