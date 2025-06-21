<style>
:root {
    --primary-color: #ff4081;
    --secondary-color: #fdf2f8;
    --text-color: #555;
    --heading-color: #333;
    --border-color: #eee;
    --green-color: #2ecc71;
    --blue-color: #3498db;
    --star-color: #f1c40f;
}

.review-page {
    font-family: 'Segoe UI', 'Poppins', sans-serif;
    background-color: #f9f9f9;
}

.page-header {
    background: var(--primary-color);
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
    background: white;
    color: var(--primary-color);
    border: none;
    padding: 12px 22px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
}
.header-actions button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.kpi-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 30px;
    margin-bottom: 30px;
}
.kpi-card {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    border: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    gap: 20px;
}
.kpi-card .icon {
    font-size: 2em;
    color: var(--primary-color);
    background: var(--secondary-color);
    min-width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.kpi-card .info .value { font-size: 2em; font-weight: 700; color: var(--heading-color); }
.kpi-card .info .label { font-size: 0.95em; color: var(--text-color); margin-top: 2px; }
.kpi-card .icon.good { color: var(--green-color); background-color: #e8f5e9; }

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
    flex-wrap: wrap;
    gap: 15px;
}
.list-header h3 { margin: 0; font-size: 1.5em; color: var(--primary-color); font-weight: 700; }
.list-header h3 i { margin-right: 10px; }
.list-header .add-review-btn {
    background-color: var(--primary-color);
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
}

.filters-container {
    padding: 20px;
    background-color: #fbfbfb;
    border: 1px solid #f0f0f0;
    border-radius: 8px;
    margin-bottom: 25px;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    align-items: flex-end;
}
.filter-item { display: flex; flex-direction: column; }
.filter-item label { font-size: 0.85em; font-weight: 600; margin-bottom: 8px; color: #666; }
.filter-item input, .filter-item select {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.9em;
    min-width: 150px;
}
.filter-actions button {
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    border: 1px solid transparent;
}
.filter-actions .btn-filter { background-color: var(--primary-color); color: white; }
.filter-actions .btn-reset { background-color: #6c757d; color: white; }

.review-table { width: 100%; border-collapse: collapse; }
.review-table th, .review-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #f0f0f0;
    font-size: 0.9em;
    vertical-align: middle;
}
.review-table th { background-color: #fafafa; font-weight: 600; color: #888; }

.customer-cell .name { font-weight: 600; }
.customer-cell .email { font-size: 0.9em; color: #777; }
.rating-cell {
    background-color: var(--primary-color);
    color: white;
    padding: 5px 12px;
    border-radius: 15px;
    font-weight: 600;
    text-align: center;
}
.rating-cell i { color: var(--star-color); margin-left: 4px; }
.action-cell button {
    width: 30px; height: 30px;
    border-radius: 8px; border: none;
    color: white; cursor: pointer; margin: 0 3px;
}
.action-cell .btn-view { background-color: var(--blue-color); }
.action-cell .btn-edit { background-color: #f1c40f; }
.action-cell .btn-delete { background-color: #e74c3c; }
</style>

<div class="review-page">
    <div class="page-header">
        <div class="header-title">
            <h2><i class="fas fa-star"></i> Quản Lý Đánh Giá</h2>
            <p>Tối ưu trải nghiệm và phục vụ Khách hàng tốt nhất</p>
        </div>
        <div class="header-actions">
            <button id="btn-export-excel"><i class="fas fa-file-excel"></i> Xuất Excel</button>
        </div>
    </div>

    <div class="kpi-cards">
        <div class="kpi-card">
            <div class="icon"><i class="fas fa-comments"></i></div>
            <div class="info">
                <div id="kpi-total-reviews" class="value">0</div>
                <div class="label">Tổng Đánh Giá</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="icon"><i class="fas fa-calendar-plus"></i></div>
            <div class="info">
                <div id="kpi-new-reviews" class="value">0</div>
                <div class="label">Đánh Giá Mới (Tháng Này)</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="icon good"><i class="fas fa-thumbs-up"></i></div>
            <div class="info">
                <div id="kpi-good-rate" class="value">0%</div>
                <div class="label">Tỷ Lệ Đánh Giá Tốt</div>
            </div>
        </div>
    </div>

    <div class="list-container">
        <div class="list-header">
            <h3><i class="fas fa-list-ul"></i> Danh Sách Đánh Giá</h3>
            <button class="header-actions add-review-btn"><i class="fas fa-plus"></i> Thêm đánh giá</button>
        </div>
        <div class="filters-container">
            <!-- Filter controls will be here -->
             <div class="filter-actions">
                <button class="btn-filter"><i class="fas fa-filter"></i> Lọc</button>
                <button class="btn-reset"><i class="fas fa-undo"></i> Đặt lại</button>
            </div>
        </div>
        <table class="review-table">
            <thead>
                <tr>
                    <th>Mã ĐG</th>
                    <th>Khách hàng</th>
                    <th>Đánh giá</th>
                    <th>Nhận xét</th>
                    <th>Phòng</th>
                    <th>Ngày đánh giá</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="review-table-body">
                <!-- Data will be loaded here by JS -->
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.getElementById('review-table-body');
    let allReviews = [];

    function fetchStats() {
        fetch('/ngophannguyenvu/api/danhgia/stats')
            .then(res => res.json())
            .then(stats => {
                document.getElementById('kpi-total-reviews').textContent = stats.totalReviews || 0;
                document.getElementById('kpi-new-reviews').textContent = stats.newReviews || 0;
                document.getElementById('kpi-good-rate').textContent = `${stats.goodReviewRate || 0}%`;
            })
            .catch(err => console.error('Error fetching stats:', err));
    }

    function fetchReviews() {
        fetch('/ngophannguyenvu/api/danhgia/getall')
            .then(res => res.json())
            .then(data => {
                allReviews = data;
                renderTable(allReviews);
            })
            .catch(err => {
                console.error('Error fetching reviews:', err);
                tableBody.innerHTML = `<tr><td colspan="7" style="text-align:center;">Lỗi khi tải dữ liệu.</td></tr>`;
            });
    }

    function renderTable(reviews) {
        tableBody.innerHTML = '';
        if (!reviews || reviews.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="7" style="text-align:center;">Không có đánh giá nào.</td></tr>`;
            return;
        }

        reviews.forEach(review => {
            const row = `
                <tr>
                    <td>${review.MaDG}</td>
                    <td class="customer-cell">
                        <div class="name">${review.Hoten || 'N/A'}</div>
                        <div class="email">${review.Email || 'N/A'}</div>
                    </td>
                    <td><div class="rating-cell">${review.Danhgiasao}/5 <i class="fas fa-star"></i></div></td>
                    <td>${review.Nhanxet || ''}</td>
                    <td>${review.Tenphong || 'N/A'}</td>
                    <td>${review.Ngaydanhgia ? new Date(review.Ngaydanhgia).toLocaleString('vi-VN') : 'N/A'}</td>
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
    fetchReviews();
});
</script> 