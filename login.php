<?php 
$pageTitle = 'Đăng nhập';
require_once __DIR__ . '/../layout/header.php'; 
?>

<h2>Chào mừng trở lại</h2>
<p class="sub-heading">Đăng nhập để tiếp tục trải nghiệm dịch vụ của Rosa Spa</p>

<div id="alert-box"></div>

<form id="login-form">
    <div class="form-group">
        <label for="username">Tên đăng nhập</label>
        <i class="fa fa-user"></i>
        <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
    </div>
    <div class="form-group">
        <label for="password">Mật khẩu</label>
        <i class="fa fa-lock"></i>
        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
    </div>
    <button type="submit" class="auth-btn">Đăng nhập</button>
</form>

<p class="auth-link">
    Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
</p>

<script>
document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const alertBox = document.getElementById('alert-box');

    fetch('/api/user/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username, password })
    })
    .then(response => response.json())
    .then(data => {
        if (data.user) {
            alertBox.className = 'success';
            alertBox.textContent = data.message + ' Đang chuyển hướng...';
            alertBox.style.display = 'block';
            setTimeout(() => {
                window.location.href = '/index.php';
            }, 1500);
        } else {
            alertBox.className = 'error';
            alertBox.textContent = data.error || 'Đã có lỗi xảy ra.';
            alertBox.style.display = 'block';
        }
    })
    .catch(error => {
        alertBox.className = 'error';
        alertBox.textContent = 'Lỗi kết nối. Vui lòng thử lại.';
        alertBox.style.display = 'block';
    });
});
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?> 