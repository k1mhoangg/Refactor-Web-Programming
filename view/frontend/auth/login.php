<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Đăng nhập</title>
    <!-- External stylesheets -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <?php include BASE_PATH . 'components/header.php'; ?>

    <main class="max-w-md mx-auto mt-8 bg-white p-6 rounded shadow mb-36">
        <h1 class="text-xl font-semibold mb-4">Đăng nhập</h1>

        <?php
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        if (!empty($_SESSION['flash'])) {
            $f = $_SESSION['flash'];
            $cls = ($f['type'] === 'success') ? 'text-green-700' : 'text-red-700';
            echo '<div class="' . $cls . ' mb-3">' . htmlspecialchars($f['message']) . '</div>';
            unset($_SESSION['flash']);
        }
        ?>

        <form method="POST" action="/login">
            <div class="mb-3">
                <label class="block text-sm font-medium">Tên đăng nhập</label>
                <input name="username" class="w-full border px-3 py-2 rounded" required />
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Mật khẩu</label>
                <input name="password" type="password" class="w-full border px-3 py-2 rounded" required />
            </div>
            <div class="flex items-center gap-3">
                <button class="bg-gray-800 text-white px-4 py-2 rounded">Đăng nhập</button>
                <a href="/register" class="text-sm text-blue-600">Chưa có tài khoản? Đăng ký</a>
            </div>
        </form>
    </main>

    <?php include BASE_PATH . 'components/footer.php'; ?>
</body>

</html>