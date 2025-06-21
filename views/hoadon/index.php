<style>
:root {
    --primary-color: #ff4081;
    --secondary-color: #fdf2f8;
    --text-color: #555;
    --heading-color: #333;
    --border-color: #eee;
    --green-color: #2ecc71;
    --blue-color: #3498db;
}

.invoice-page {
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
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
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
    color: var(--primary-color);
    background-color: var(--secondary-color);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 15px;
}
.kpi-card .card-value {
    font-size: 2em;
    font-weight: 700;
    color: var(--heading-color);
}
.kpi-card .card-label {
    font-size: 0.95em;
    color: var(--text-color);
    margin-top: 5px;
}
.kpi-card .card-progress {
    height: 4px;
    background-color: #f0f0f0;
    border-radius: 2px;
    margin-top: 15px;
    overflow: hidden;
}
.kpi-card .card-progress .progress-bar {
    height: 100%;
    width: 60%; /* Example width */
    background-color: var(--primary-color);
    border-radius: 2px;
}
.kpi-card .card-icon.paid {
    color: var(--green-color);
    background-color: #e8f5e9;
}
.kpi-card .progress-bar.paid {
    background-color: var(--green-color);
}


/* List Container */
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
    margin-bottom: 15px;
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

/* Filters */
.filters-container {
    padding: 20px;
    background-color: #fbfbfb;
    border-radius: 8px;
    margin-bottom: 25px;
    border: 1px solid #f0f0f0;
}
.filter-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}
.filter-item {
    display: flex;
    flex-direction: column;
}
.filter-item label {
    font-size: 0.85em;
    font-weight: 600;
    margin-bottom: 8px;
    color: #666;
}
.filter-item input, .filter-item select {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.9em;
}
.filter-actions {
    grid-column: 1 / -1;
    display: flex;
    gap: 15px;
    align-items: center;
    margin-top: 10px;
}
.filter-actions button {
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    border: 1px solid transparent;
}
.filter-actions .btn-search { background-color: var(--primary-color); color: white; }
.filter-actions .btn-reset { background-color: #6c757d; color: white; }
.filter-actions .btn-export { background-color: var(--green-color); color: white; }

/* Table */
.invoice-table {
    width: 100%;
    border-collapse: collapse;
}
.invoice-table th, .invoice-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #f0f0f0;
    font-size: 0.9em;
    vertical-align: middle;
}
.invoice-table th {
    background-color: #fafafa;
    font-weight: 600;
    color: #888;
}

.user-cell .user-name { font-weight: 600; }
.user-cell .user-contact { font-size: 0.9em; color: #777; }
.service-cell .service-name { font-weight: 500; }
.service-cell .service-time { font-size: 0.9em; color: #777; }
.status-cell span {
    padding: 4px 10px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.85em;
}
.status-cell .status-paid { background-color: #e8f5e9; color: #388e3c; }
.status-cell .status-pending { background-color: #fff8e1; color: #f57c00; }
.action-cell button {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: none;
    color: white;
    cursor: pointer;
    margin: 0 4px;
}
.action-cell .btn-view { background-color: var(--blue-color); }
.action-cell .btn-edit { background-color: #f1c40f; }
.action-cell .btn-delete { background-color: #e74c3c; }

</style>
<div class="invoice-page">
    <div class="page-header">
        <div class="header-title">
            <h2>Quản Lý Hóa Đơn và Thanh Toán</h2>
            <p>Quản lý và theo dõi hóa đơn thanh toán dịch vụ</p>
        </div>
        <div class="header-actions">
            <button id="btn-stats"><i class="fas fa-chart-bar"></i> Lọc Thống Kê</button>
            <button id="btn-add-invoice"><i class="fas fa-plus"></i> Thêm Hóa Đơn</button>
        </div>
    </div>

    <div class="kpi-cards">
        <div class="kpi-card">
            <div class="card-icon"><i class="fas fa-file-invoice"></i></div>
            <div id="kpi-total-invoices" class="card-value">0</div>
            <div class="card-label">Tổng Số Hóa Đơn</div>
            <div class="card-progress"><div class="progress-bar"></div></div>
        </div>
        <div class="kpi-card">
            <div class="card-icon"><i class="fas fa-cash-register"></i></div>
            <div id="kpi-total-revenue" class="card-value">0</div>
            <div class="card-label">Tổng Doanh Thu (VND)</div>
            <div class="card-progress"><div class="progress-bar"></div></div>
        </div>
        <div class="kpi-card">
            <div class="card-icon"><i class="fas fa-calendar-day"></i></div>
            <div id="kpi-monthly-revenue" class="card-value">0</div>
            <div class="card-label">Doanh Thu Tháng Này (VND)</div>
            <div class="card-progress"><div class="progress-bar"></div></div>
        </div>
        <div class="kpi-card">
            <div class="card-icon paid"><i class="fas fa-check-circle"></i></div>
            <div id="kpi-paid-invoices" class="card-value">0</div>
            <div class="card-label">Đã Thanh Toán</div>
            <div class="card-progress"><div class="progress-bar paid"></div></div>
        </div>
    </div>

    <div class="list-container">
        <div class="list-header">
            <h3><i class="fas fa-list"></i> Danh Sách Hóa Đơn</h3>
        </div>
        <div class="filters-container">
            <div class="filter-grid">
                 <!-- Filters will be added here -->
            </div>
            <div class="filter-actions">
                <button class="btn-search"><i class="fas fa-search"></i> Tìm Kiếm</button>
                <button class="btn-reset"><i class="fas fa-undo"></i> Đặt Lại</button>
                <button class="btn-export"><i class="fas fa-file-excel"></i> Xuất Excel</button>
            </div>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Mã HĐ</th>
                    <th>Người Dùng</th>
                    <th>Dịch Vụ</th>
                    <th>Ngày Thanh Toán</th>
                    <th>Tổng Tiền</th>
                    <th>Phương Thức</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody id="invoice-table-body">
                <!-- Data will be loaded by JS -->
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.getElementById('invoice-table-body');
    let allInvoices = [];

    const formatCurrency = (value) => new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value || 0);

    function fetchStats() {
        fetch('/ngophannguyenvu/api/hoadon/stats')
            .then(res => res.json())
            .then(stats => {
                document.getElementById('kpi-total-invoices').textContent = stats.totalInvoices || 0;
                document.getElementById('kpi-total-revenue').textContent = formatCurrency(stats.totalRevenue).replace('₫', '');
                document.getElementById('kpi-monthly-revenue').textContent = formatCurrency(stats.monthlyRevenue).replace('₫', '');
                document.getElementById('kpi-paid-invoices').textContent = stats.paidInvoices || 0;
            })
            .catch(err => console.error('Error fetching stats:', err));
    }

    function fetchInvoices() {
        fetch('/ngophannguyenvu/api/hoadon/getall')
            .then(res => res.json())
            .then(data => {
                allInvoices = data;
                renderTable(allInvoices);
            })
            .catch(err => {
                console.error('Error fetching invoices:', err);
                tableBody.innerHTML = `<tr><td colspan="8" class="text-center">Lỗi khi tải dữ liệu.</td></tr>`;
            });
    }

    function renderTable(invoices) {
        tableBody.innerHTML = '';
        if (!invoices || invoices.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="8" class="text-center">Không có hóa đơn nào.</td></tr>`;
            return;
        }

        invoices.forEach(invoice => {
            const statusClass = (invoice.TrangThai === 'Đã thanh toán' || invoice.Matrangthai == 1) ? 'status-paid' : 'status-pending';
            const statusText = (invoice.TrangThai === 'Đã thanh toán' || invoice.Matrangthai == 1) ? 'Đã thanh toán' : 'Chưa thanh toán';

            const row = `
                <tr>
                    <td>${invoice.MaHD}</td>
                    <td class="user-cell">
                        <div class="user-name">${invoice.Hoten || 'N/A'}</div>
                        <div class="user-contact">${invoice.SDT || ''}</div>
                    </td>
                    <td class="service-cell">
                        <div class="service-name">${invoice.DichVu || 'N/A'}</div>
                    </td>
                    <td>${invoice.NgayThanhToan ? new Date(invoice.NgayThanhToan).toLocaleDateString('vi-VN') : 'N/A'}</td>
                    <td>${formatCurrency(invoice.TongTien)}</td>
                    <td>${invoice.PhuongThuc || 'N/A'}</td>
                    <td class="status-cell"><span class="${statusClass}">${statusText}</span></td>
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
    fetchInvoices();
});
</script> 