<?php 
$pageTitle = 'Đăng ký';
require_once __DIR__ . '/../layout/header.php'; 
?>

<h2>Đăng ký tài khoản</h2>
<p class="sub-heading">Điền thông tin của bạn để trở thành thành viên của Rosa Spa</p>

<div id="alert-box"></div>

<form id="register-form">
    <div class="form-row">
        <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input type="text" id="username" name="username" placeholder="Tên đăng nhập" required>
        </div>
        <div class="form-group">
            <label for="hoten">Họ tên</label>
            <input type="text" id="hoten" name="hoten" placeholder="Họ và tên" required>
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Địa chỉ email" required>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Xác nhận mật khẩu</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
        </div>
    </div>
    
    <button type="submit" class="auth-btn">Đăng ký</button>
</form>

<p class="auth-link">
    Đã có tài khoản? <a href="login.php">Đăng nhập</a>
</p>

<script>
document.getElementById('register-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const password = form.password.value;
    const confirm_password = form.confirm_password.value;
    const alertBox = document.getElementById('alert-box');

    if (password !== confirm_password) {
        alertBox.className = 'error';
        alertBox.textContent = 'Mật khẩu xác nhận không khớp.';
        alertBox.style.display = 'block';
        return;
    }

    const formData = {
        username: form.username.value,
        hoten: form.hoten.value,
        email: form.email.value,
        password: password,
        // sdt, diachi, etc. can be added here if they are in the form
    };

    fetch('/api/user/register', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Đăng ký thành công.') {
            alertBox.className = 'success';
            alertBox.textContent = 'Đăng ký thành công! Bạn sẽ được chuyển đến trang đăng nhập.';
            alertBox.style.display = 'block';
            setTimeout(() => {
                window.location.href = 'login.php';
            }, 2000);
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