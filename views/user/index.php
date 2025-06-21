<style>
:root {
    --primary-color: #ff4081;
    --secondary-color: #fdf2f8;
    --text-color: #555;
    --heading-color: #333;
    --border-color: #fce4ec;
}

.user-management-page {
    font-family: 'Segoe UI', 'Poppins', sans-serif;
    background-color: #f9f9f9;
}

.page-header {
    background-color: var(--primary-color);
    color: white;
    padding: 20px 40px;
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}
.page-header .header-title h2 {
    margin: 0;
    font-size: 1.8em;
    font-weight: 700;
}
.page-header .header-title p {
    margin: 5px 0 0;
    opacity: 0.9;
    font-size: 0.9em;
}
.add-user-btn {
    background-color: white;
    color: var(--primary-color);
    border: none;
    padding: 12px 22px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
}
.add-user-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.user-kpi-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    margin-bottom: 30px;
}
.kpi-card {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 20px;
    border: 1px solid #eee;
}
.kpi-card .icon {
    font-size: 2.2em;
    color: var(--primary-color);
    background: var(--secondary-color);
    min-width: 65px;
    height: 65px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.kpi-card .info .value {
    font-size: 2.1em;
    font-weight: 700;
    color: var(--heading-color);
}
.kpi-card .info .label {
    font-size: 0.95em;
    color: var(--text-color);
    margin-top: 2px;
}

.user-list-container {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    border: 1px solid #eee;
}
.list-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 15px;
}
.list-header h3 {
    margin: 0;
    font-size: 1.5em;
    color: var(--primary-color);
    font-weight: 700;
}
.list-header h3 i {
    margin-right: 10px;
}
.list-controls {
    display: flex;
    gap: 20px;
    align-items: center;
}
.list-controls .search-box {
    position: relative;
}
.list-controls .search-box input {
    min-width: 300px;
    padding: 12px 12px 12px 40px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
}
.list-controls .search-box i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #aaa;
}
.list-controls .filter-box {
    display: flex;
    align-items: center;
    gap: 10px;
}
.list-controls .filter-box label {
    font-weight: 600;
    color: var(--text-color);
}
.list-controls .filter-box select {
    padding: 11px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #fff;
}

.user-table {
    width: 100%;
    border-collapse: collapse;
}
.user-table th, .user-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #f0f0f0;
    font-size: 0.9em;
    vertical-align: middle;
}
.user-table th {
    font-size: 0.85em;
    text-transform: uppercase;
    color: #888;
    background-color: #fafafa;
}
.user-table td {
    font-size: 0.95em;
    vertical-align: top;
}
.user-table td.actions {
    text-align: center;
}

.customer-info {
    display: flex;
    flex-direction: column;
}
.customer-info .name { font-weight: 600; color: var(--heading-color); }
.customer-info .id { font-size: 0.85em; color: #999; margin-top: 3px; }

.contact-info .info-item { display: flex; align-items: center; gap: 8px; margin-bottom: 5px; }
.contact-info .info-item i { color: #aaa; font-size: 0.9em; width: 15px; text-align: center; }
.contact-info .info-item span { font-size: 0.9em; }

.services-info .count { font-weight: 600; color: var(--primary-color); }
.services-info .service-list { list-style: none; padding: 0; margin: 5px 0 0 0; font-size: 0.85em; color: #777; }
.services-info .service-list li { margin-top: 3px; }

.membership-info { font-weight: 600; color: #e67e22; }

.action-buttons button {
    border: none;
    background: none;
    cursor: pointer;
    font-size: 1.2em;
    margin: 0 8px;
    color: #bbb;
    transition: color 0.2s ease;
}
.action-buttons button.view-btn:hover { color: #3498db; }
.action-buttons button.edit-btn:hover { color: #f1c40f; }
.action-buttons button.delete-btn:hover { color: #e74c3c; }

</style>
<div class="user-management-page">
    <div class="page-header">
        <div class="header-title">
            <h2><i class="fas fa-users-cog"></i> Quản Lý Khách Hàng</h2>
            <p>Tối ưu trải nghiệm và phục vụ khách hàng tốt nhất</p>
        </div>
        <button class="add-user-btn"><i class="fas fa-plus"></i> Thêm Khách Hàng Mới</button>
    </div>

    <div class="user-kpi-cards">
        <div class="kpi-card">
            <div class="icon"><i class="fas fa-users"></i></div>
            <div class="info">
                <div id="total-users-kpi" class="value">0</div>
                <div class="label">Tổng Khách Hàng</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="icon"><i class="fas fa-user-plus"></i></div>
            <div class="info">
                <div id="new-users-kpi" class="value">0</div>
                <div class="label">Khách Hàng Mới (Tháng Này)</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="icon"><i class="fas fa-venus-mars"></i></div>
            <div class="info">
                <div id="female-users-kpi" class="value">0%</div>
                <div class="label">Tỷ Lệ Khách Hàng Nữ</div>
            </div>
        </div>
    </div>

    <div class="user-list-container">
        <div class="list-header">
            <h3><i class="fas fa-list-ul"></i> Danh Sách Khách Hàng</h3>
            <div class="list-controls">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="user-search-input" placeholder="Tìm kiếm theo tên, email, sđt...">
                </div>
            </div>
        </div>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Mã KH</th>
                    <th>Họ Tên</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Địa Chỉ</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody id="user-table-body">
                <!-- Dữ liệu người dùng sẽ được chèn vào đây bằng JavaScript -->
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const userTableBody = document.getElementById('user-table-body');
    const totalUsersKpi = document.getElementById('total-users-kpi');
    const newUsersKpi = document.getElementById('new-users-kpi');
    const femaleUsersKpi = document.getElementById('female-users-kpi');
    const searchInput = document.getElementById('user-search-input');

    let allUsers = [];

    function fetchUsers() {
        fetch('/ngophannguyenvu/api/user/getall')
            .then(response => response.json())
            .then(data => {
                allUsers = data;
                updateDashboard(allUsers);
                renderTable(allUsers);
            })
            .catch(error => {
                console.error('Error fetching users:', error);
                userTableBody.innerHTML = '<tr><td colspan="8" style="text-align:center;">Lỗi khi tải dữ liệu.</td></tr>';
            });
    }

    function renderTable(users) {
        userTableBody.innerHTML = '';
        if (users.length === 0) {
            userTableBody.innerHTML = '<tr><td colspan="8" style="text-align:center;">Không tìm thấy khách hàng nào.</td></tr>';
            return;
        }

        users.forEach(user => {
            const row = `
                <tr>
                    <td>${user.Manguoidung}</td>
                    <td>${user.Hoten || 'Chưa có'}</td>
                    <td>${user.Email || 'Chưa có'}</td>
                    <td>${user.SDT || 'Chưa có'}</td>
                    <td>${user.DiaChi || 'Chưa có'}</td>
                    <td>${user.Gioitinh || 'Chưa có'}</td>
                    <td>${user.Ngaysinh ? new Date(user.Ngaysinh).toLocaleDateString('vi-VN') : 'Chưa có'}</td>
                    <td class="action-buttons">
                        <button class="view-btn" title="Xem Chi Tiết" onclick="viewUser(${user.Manguoidung})"><i class="fas fa-eye"></i></button>
                        <button class="edit-btn" title="Chỉnh Sửa" onclick="editUser(${user.Manguoidung})"><i class="fas fa-edit"></i></button>
                        <button class="delete-btn" title="Xóa" onclick="deleteUser(${user.Manguoidung})"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `;
            userTableBody.innerHTML += row;
        });
    }
    
    function updateDashboard(users) {
        const totalUsers = users.length;
        totalUsersKpi.textContent = totalUsers;

        const femaleUsers = users.filter(u => u.Gioitinh && u.Gioitinh.toLowerCase() === 'nữ').length;
        const femalePercentage = totalUsers > 0 ? Math.round((femaleUsers / totalUsers) * 100) : 0;
        femaleUsersKpi.textContent = `${femalePercentage}%`;
        
        const thisMonthUsers = users.filter(u => {
            // Assuming users are created with a creation date field. Since we don't have one, this is a placeholder.
            // Let's use NgaySinh for demonstration, though it's not correct logically.
            if (!u.Ngaysinh) return false;
            const creationDate = new Date(u.Ngaysinh); 
            const today = new Date();
            return creationDate.getMonth() === today.getMonth() && creationDate.getFullYear() === today.getFullYear();
        }).length;
        newUsersKpi.textContent = thisMonthUsers;
    }

    function filterAndSearch() {
        const searchTerm = searchInput.value.toLowerCase();

        let filteredUsers = allUsers.filter(user => {
            return (user.Hoten && user.Hoten.toLowerCase().includes(searchTerm)) ||
                   (user.Email && user.Email.toLowerCase().includes(searchTerm)) ||
                   (user.SDT && user.SDT.includes(searchTerm));
        });

        renderTable(filteredUsers);
    }

    searchInput.addEventListener('input', filterAndSearch);

    document.querySelector('.add-user-btn').addEventListener('click', () => {
        window.location.href = '/ngophannguyenvu/views/user/add.php';
    });

    fetchUsers();
});

function viewUser(userId) {
    window.location.href = `/ngophannguyenvu/user/detail/${userId}`;
}

function editUser(userId) {
    window.location.href = `/ngophannguyenvu/user/edit/${userId}`;
}

function deleteUser(userId) {
    if (confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')) {
        fetch(`/ngophannguyenvu/api/user/delete/${userId}`, {
                method: 'DELETE'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Xóa khách hàng thành công!');
                    location.reload(); 
                } else {
                    alert('Lỗi: ' + (data.error || 'Không thể xóa khách hàng.'));
                }
            })
            .catch(error => {
                console.error('Error deleting user:', error);
                alert('Có lỗi xảy ra khi xóa khách hàng.');
            });
    }
}
</script> 