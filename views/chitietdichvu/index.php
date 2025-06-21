<style>
.service-management-page {
    font-family: 'Poppins', sans-serif;
}
.page-header {
    background-color: var(--primary-color);
    color: white;
    padding: 20px 30px;
    border-radius: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}
.page-header h2 {
    margin: 0;
    font-size: 1.8em;
}
.page-header p {
    margin: 5px 0 0;
    opacity: 0.9;
}
.add-service-btn {
    background-color: white;
    color: var(--primary-color);
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    display: flex;
    align-items: center;
    gap: 8px;
}
.service-kpi-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}
.kpi-card {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.kpi-card .icon {
    font-size: 1.5em;
    color: var(--primary-color);
    margin-bottom: 15px;
}
.kpi-card .label {
    font-size: 0.9em;
    color: #888;
    margin-bottom: 5px;
}
.kpi-card .value {
    font-size: 1.8em;
    font-weight: 600;
}
.controls-container {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 30px;
}
.search-and-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 15px;
}
.search-box {
    flex-grow: 1;
    position: relative;
    min-width: 300px;
}
.search-box input {
    width: 100%;
    padding: 12px 12px 12px 40px;
    border: 1px solid #ddd;
    border-radius: 8px;
}
.search-box i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #aaa;
}
.action-buttons {
    display: flex;
    gap: 10px;
}
.action-buttons .action-btn {
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background: #f9f9f9;
    cursor: pointer;
}
.filter-section h3 {
    font-size: 1.2em;
    margin-bottom: 15px;
}
.filter-controls {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
    align-items: flex-end;
}
.filter-group input, .filter-group select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
}
.filter-group label {
    display: block;
    font-size: 0.9em;
    margin-bottom: 5px;
    color: #555;
}
.apply-btn {
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    background: var(--primary-color);
    color: white;
    cursor: pointer;
    font-weight: 600;
}
.service-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
}
.service-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    position: relative;
}
.service-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.service-card-content {
    padding: 20px;
}
.service-card h4 {
    margin: 0 0 10px;
    font-size: 1.2em;
}
.service-card .price {
    font-size: 1.1em;
    font-weight: 600;
    color: var(--primary-color);
}
.featured-tag {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #ffc107;
    color: #333;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 0.8em;
    font-weight: 600;
}
</style>
<div class="service-management-page">
    <div class="page-header">
        <div>
            <h2>Quản Lý Dịch Vụ</h2>
            <p>Thêm, sửa, xóa và theo dõi trạng thái các dịch vụ của spa</p>
        </div>
        <button class="add-service-btn"><i class="fas fa-plus"></i> Thêm dịch vụ</button>
    </div>

    <div class="service-kpi-cards">
        <div class="kpi-card">
            <div class="icon"><i class="fas fa-concierge-bell"></i></div>
            <div class="label">Tổng Dịch Vụ</div>
            <div class="value" id="total-services-kpi">0</div>
        </div>
        <div class="kpi-card">
            <div class="icon"><i class="fas fa-dollar-sign"></i></div>
            <div class="label">Giá Trung Bình</div>
            <div class="value" id="avg-price-kpi">0 VNĐ</div>
        </div>
        <div class="kpi-card">
            <div class="icon"><i class="fas fa-fire"></i></div>
            <div class="label">Dịch Vụ Đặt Nhiều Nhất</div>
            <div class="value" id="most-booked-kpi">N/A</div>
        </div>
    </div>

    <div class="controls-container">
        <div class="search-and-actions">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="service-search-input" placeholder="Tìm kiếm dịch vụ...">
            </div>
        </div>
        <div class="filter-section">
            <h3>Bộ Lọc</h3>
            <div class="filter-controls">
                <div class="filter-group">
                    <label for="min-price">Giá tối thiểu</label>
                    <input type="number" id="min-price" placeholder="VND">
                </div>
                <div class="filter-group">
                    <label for="max-price">Giá tối đa</label>
                    <input type="number" id="max-price" placeholder="VND">
                </div>
                <div class="filter-group">
                    <label for="sort-by">Sắp xếp theo</label>
                    <select id="sort-by">
                        <option value="name_asc">Tên (A-Z)</option>
                        <option value="name_desc">Tên (Z-A)</option>
                        <option value="price_asc">Giá (Thấp-Cao)</option>
                        <option value="price_desc">Giá (Cao-Thấp)</option>
                    </select>
                </div>
                <button class="apply-btn">Áp dụng</button>
            </div>
        </div>
    </div>

    <div class="service-grid" id="service-grid">
        <!-- Service cards will be loaded here by JavaScript -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceGrid = document.getElementById('service-grid');
    const searchInput = document.getElementById('service-search-input');
    const applyFilterBtn = document.querySelector('.apply-btn');
    let allServices = [];

    const formatter = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });

    function renderServiceGrid(services) {
        serviceGrid.innerHTML = '';
        if (services.length === 0) {
            serviceGrid.innerHTML = '<p>Không tìm thấy dịch vụ nào.</p>';
            return;
        }

        services.forEach(service => {
            const card = document.createElement('div');
            card.className = 'service-card';
            card.innerHTML = `
                ${service.isFeatured ? '<div class="featured-tag"><i class="fas fa-star"></i> Nổi bật</div>' : ''}
                <div class="service-card-content">
                    <h4><i class="fas fa-spa" style="margin-right: 10px; color: var(--primary-color);"></i>${service.TenDichVu}</h4>
                    <p class="price">${formatter.format(service.Gia)}</p>
                </div>
            `;
            serviceGrid.appendChild(card);
        });
    }

    function updateKPIs(services) {
        document.getElementById('total-services-kpi').innerText = services.length;
        
        const total_price = services.reduce((sum, s) => sum + parseFloat(s.Gia), 0);
        const avg_price = services.length > 0 ? total_price / services.length : 0;
        document.getElementById('avg-price-kpi').innerText = formatter.format(avg_price);

        // Most booked KPI would need more complex data from backend, mocking for now
        document.getElementById('most-booked-kpi').innerText = services.length > 0 ? services[0].TenDichVu : 'N/A';
    }

    function filterAndSortServices() {
        let filtered = [...allServices];
        const searchTerm = searchInput.value.toLowerCase();
        const minPrice = parseFloat(document.getElementById('min-price').value) || 0;
        const maxPrice = parseFloat(document.getElementById('max-price').value) || Infinity;
        const sortBy = document.getElementById('sort-by').value;

        // Filter
        filtered = filtered.filter(s => {
            const nameMatch = s.TenDichVu.toLowerCase().includes(searchTerm);
            const priceMatch = parseFloat(s.Gia) >= minPrice && parseFloat(s.Gia) <= maxPrice;
            return nameMatch && priceMatch;
        });

        // Sort
        switch (sortBy) {
            case 'name_asc':
                filtered.sort((a, b) => a.TenDichVu.localeCompare(b.TenDichVu));
                break;
            case 'name_desc':
                filtered.sort((a, b) => b.TenDichVu.localeCompare(a.TenDichVu));
                break;
            case 'price_asc':
                filtered.sort((a, b) => parseFloat(a.Gia) - parseFloat(b.Gia));
                break;
            case 'price_desc':
                filtered.sort((a, b) => parseFloat(b.Gia) - parseFloat(a.Gia));
                break;
        }

        renderServiceGrid(filtered);
    }
    
    function fetchServices() {
        // NOTE: The API endpoint might be /api/dichvu or /api/chitietdichvu. Using /api/dichvu for now.
        fetch('/api/chitietdichvu')
            .then(res => {
                if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
                return res.json();
            })
            .then(data => {
                allServices = data;
                renderServiceGrid(allServices);
                updateKPIs(allServices);
            })
            .catch(error => {
                console.error('Failed to fetch services:', error);
                serviceGrid.innerHTML = '<p style="color:red;">Không thể tải dữ liệu dịch vụ.</p>';
            });
    }

    searchInput.addEventListener('input', filterAndSortServices);
    applyFilterBtn.addEventListener('click', filterAndSortServices);
    
    fetchServices();
});
</script>
 