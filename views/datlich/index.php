<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Chi tiết Dịch vụ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff4081;
            --secondary-color: #fdf2f8;
            --text-color: #555;
            --heading-color: #333;
            --border-color: #eee;
            --green-color: #2ecc71;
            --blue-color: #3498db;
            --yellow-color: #f1c40f;
            --orange-color: #f39c12;
            --red-color: #e74c3c;
        }

        .booking-page {
            font-family: 'Segoe UI', 'Poppins', sans-serif;
            background-color: #f9f9f9;
        }

        /* Header */
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
        .page-header .header-title h2 { margin: 0; font-size: 1.8em; font-weight: 700; }
        .page-header .header-title p { margin: 5px 0 0; opacity: 0.9; font-size: 0.9em; }
        .header-actions button {
            background-color: white;
            color: var(--primary-color);
            border: none;
            padding: 12px 22px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-left: 15px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }
        .header-actions button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* KPI Cards */
        .kpi-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .kpi-card {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }
        .kpi-card .card-icon {
            font-size: 1.5em;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
            color: white;
        }
        .kpi-card .card-value { font-size: 2em; font-weight: 700; color: var(--heading-color); }
        .kpi-card .card-label { font-size: 0.9em; color: var(--text-color); margin-top: 5px; }
        .kpi-card .card-progress {
            height: 4px; background-color: #f0f0f0;
            border-radius: 2px; margin-top: 15px; overflow: hidden;
        }
        .kpi-card .card-progress .progress-bar { height: 100%; width: 100%; border-radius: 2px; }
        /* Icon and Progress Colors */
        .kpi-card .icon-today { background-color: var(--green-color); }
        .kpi-card .progress-today { background-color: var(--green-color); }
        .kpi-card .icon-pending { background-color: var(--yellow-color); }
        .kpi-card .progress-pending { background-color: var(--yellow-color); }
        .kpi-card .icon-confirmed { background-color: var(--blue-color); }
        .kpi-card .progress-confirmed { background-color: var(--blue-color); }
        .kpi-card .icon-completed { background-color: var(--orange-color); }
        .kpi-card .progress-completed { background-color: var(--orange-color); }
        .kpi-card .icon-cancelled { background-color: var(--red-color); }
        .kpi-card .progress-cancelled { background-color: var(--red-color); }

        /* List & Filters */
        .list-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }
        .list-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .list-header h3 { margin: 0; font-size: 1.5em; color: var(--primary-color); font-weight: 700; }
        .list-header h3 i { margin-right: 10px; }
        .list-header .filter-buttons { display: flex; gap: 10px; }
        .list-header .filter-buttons button {
            width: 35px; height: 35px; border-radius: 50%;
            border: 1px solid #ddd; background: white;
            cursor: pointer; font-size: 1.1em; color: #777;
        }

        .filters-container {
            padding: 20px;
            background-color: #fbfbfb;
            border: 1px solid #f0f0f0;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .filter-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        .filter-item input, .filter-item select {
            width: 100%; padding: 10px;
            border: 1px solid #ddd; border-radius: 6px; font-size: 0.9em;
        }

        /* Table */
        .booking-table { width: 100%; border-collapse: collapse; }
        .booking-table th, .booking-table td {
            padding: 12px 15px; text-align: left;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.9em; vertical-align: middle;
        }
        .booking-table th { background-color: #fafafa; font-weight: 600; color: #888; }
        .user-cell .name { font-weight: 600; }
        .user-cell .contact { font-size: 0.9em; color: #777; }
        .status-cell span {
            padding: 4px 12px; border-radius: 12px;
            font-weight: 600; font-size: 0.8em; color: white;
        }
        .status-confirmed { background-color: var(--blue-color); }
        .status-pending { background-color: var(--yellow-color); }
        .status-completed { background-color: var(--orange-color); }
        .status-cancelled { background-color: var(--red-color); }
        .action-cell button {
            width: 32px; height: 32px; border-radius: 50%;
            border: none; color: white; cursor: pointer; margin: 0 4px;
        }
        .action-cell .btn-view { background-color: var(--blue-color); }
        .action-cell .btn-edit { background-color: var(--orange-color); }
        .action-cell .btn-delete { background-color: var(--red-color); }
    </style>
</head>
<body>
    <div class="booking-page">
        <div class="page-header">
            <div class="header-title">
                <h2><i class="fas fa-calendar-check"></i> Quản Lý Đặt Lịch</h2>
                <p>Quản lý và theo dõi lịch đặt dịch vụ</p>
            </div>
            <div class="header-actions">
                <button id="btn-stats"><i class="fas fa-chart-pie"></i> Thống Kê</button>
                <button id="btn-add-booking"><i class="fas fa-plus"></i> Thêm Lịch Đặt</button>
            </div>
        </div>

        <div class="kpi-cards">
            <!-- KPI Cards -->
            <div class="kpi-card">
                <div class="card-icon icon-today"><i class="fas fa-calendar-day"></i></div>
                <div id="kpi-today" class="card-value">0</div>
                <div class="card-label">Lịch Đặt Hôm Nay</div>
                <div class="card-progress"><div class="progress-bar progress-today"></div></div>
            </div>
            <div class="kpi-card">
                <div class="card-icon icon-pending"><i class="fas fa-hourglass-half"></i></div>
                <div id="kpi-pending" class="card-value">0</div>
                <div class="card-label">Chờ Xác Nhận</div>
                <div class="card-progress"><div class="progress-bar progress-pending"></div></div>
            </div>
            <div class="kpi-card">
                <div class="card-icon icon-confirmed"><i class="fas fa-check"></i></div>
                <div id="kpi-confirmed" class="card-value">0</div>
                <div class="card-label">Đã Xác Nhận</div>
                <div class="card-progress"><div class="progress-bar progress-confirmed"></div></div>
            </div>
            <div class="kpi-card">
                <div class="card-icon icon-completed"><i class="fas fa-flag-checkered"></i></div>
                <div id="kpi-completed" class="card-value">0</div>
                <div class="card-label">Hoàn Thành</div>
                <div class="card-progress"><div class="progress-bar progress-completed"></div></div>
            </div>
            <div class="kpi-card">
                <div class="card-icon icon-cancelled"><i class="fas fa-ban"></i></div>
                <div id="kpi-cancelled" class="card-value">0</div>
                <div class="card-label">Đã Hủy</div>
                <div class="card-progress"><div class="progress-bar progress-cancelled"></div></div>
            </div>
        </div>

        <div class="list-container">
            <div class="list-header">
                <h3><i class="fas fa-list"></i> Danh Sách Lịch Đặt</h3>
                <div class="filter-buttons">
                    <button title="Làm mới"><i class="fas fa-sync-alt"></i></button>
                    <button title="Bộ lọc"><i class="fas fa-filter"></i></button>
                </div>
            </div>
            <div class="filters-container">
                <div class="filter-grid">
                    <div class="filter-item">
                         <input type="text" id="search-input" placeholder="Tìm kiếm theo tên người dùng, số điện thoại, dịch vụ, mã đặt lịch...">
                    </div>
                     <div class="filter-item">
                        <select id="user-filter">
                            <option value="">-- Tất cả người dùng --</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <select id="service-filter">
                            <option value="">-- Tất cả dịch vụ --</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <select id="status-filter">
                            <option value="">-- Tất cả trạng thái --</option>
                        </select>
                    </div>
                </div>
            </div>
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>Mã ĐL</th>
                        <th>Khách Hàng</th>
                        <th>Dịch Vụ</th>
                        <th>Phòng</th>
                        <th>Thời Gian Đặt</th>
                        <th>Trạng Thái</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody id="booking-table-body">
                    <!-- Data will be loaded by JS -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.getElementById('booking-table-body');
        let allBookings = [];

        function fetchStats() {
            fetch('/ngophannguyenvu/api/datlich/stats')
                .then(res => res.json())
                .then(stats => {
                    document.getElementById('kpi-today').textContent = stats.today || 0;
                    document.getElementById('kpi-pending').textContent = stats.pending || 0;
                    document.getElementById('kpi-confirmed').textContent = stats.confirmed || 0;
                    document.getElementById('kpi-completed').textContent = stats.completed || 0;
                    document.getElementById('kpi-cancelled').textContent = stats.cancelled || 0;
                })
                .catch(err => console.error('Error fetching stats:', err));
        }

        function fetchBookings() {
            fetch('/ngophannguyenvu/api/datlich/getall')
                .then(res => res.json())
                .then(data => {
                    allBookings = data;
                    renderTable(allBookings);
                })
                .catch(err => {
                    console.error('Error fetching bookings:', err);
                    tableBody.innerHTML = `<tr><td colspan="7" style="text-align:center">Lỗi khi tải dữ liệu.</td></tr>`;
                });
        }

        function renderTable(bookings) {
            tableBody.innerHTML = '';
            if (!bookings || bookings.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="7" style="text-align:center">Không có lịch đặt nào.</td></tr>`;
                return;
            }

            bookings.forEach(booking => {
                let statusClass = '';
                switch(booking.TrangThai) {
                    case 'Đã xác nhận': statusClass = 'status-confirmed'; break;
                    case 'Chờ xác nhận': statusClass = 'status-pending'; break;
                    case 'Hoàn thành': statusClass = 'status-completed'; break;
                    case 'Đã hủy': statusClass = 'status-cancelled'; break;
                    default: statusClass = 'status-pending';
                }

                const row = `
                    <tr>
                        <td>${booking.MaDL}</td>
                        <td class="user-cell">
                            <div class="name">${booking.TenNguoiDung || 'N/A'}</div>
                            <div class="contact">${booking.SDT || ''}</div>
                        </td>
                        <td>${booking.TenDichVu || 'N/A'}</td>
                        <td>${booking.TenPhong || 'N/A'}</td>
                        <td>${booking.ThoiGianDatLich ? new Date(booking.ThoiGianDatLich).toLocaleString('vi-VN') : 'N/A'}</td>
                        <td><span class="status-cell ${statusClass}">${booking.TrangThai || 'Chờ xác nhận'}</span></td>
                        <td class="action-cell">
                            <button class="btn-view" title="Xem"><i class="fas fa-eye"></i></button>
                            <button class="btn-edit" title="Sửa"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" title="Xóa"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        }

        fetchStats();
        fetchBookings();
    });
    </script>
</body>
</html>