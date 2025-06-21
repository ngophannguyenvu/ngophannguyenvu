<?php
require_once 'app/models/UserModel.php';
require_once 'app/models/DatLichModel.php';
require_once 'app/models/DanhGiaModel.php';
require_once 'app/models/HoaDonVaThanhToanModel.php';

class DashboardApiController {
    private $db;
    private $userModel;
    private $datLichModel;
    private $danhGiaModel;
    private $hoaDonModel;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->userModel = new UserModel($this->db);
        $this->datLichModel = new DatLichModel($this->db);
        $this->danhGiaModel = new DanhGiaModel($this->db);
        $this->hoaDonModel = new HoaDonVaThanhToanModel($this->db);
    }

    public function getStats() {
        header('Content-Type: application/json');
        
        $totalUsers = $this->userModel->getTotalUsers();
        $totalBookings = $this->datLichModel->getTotalBookings();
        $totalReviews = $this->danhGiaModel->getTotalReviews();
        $totalRevenue = $this->hoaDonModel->getTotalRevenue();

        echo json_encode([
            'total_customers' => $totalUsers,
            'total_bookings' => $totalBookings,
            'total_reviews' => $totalReviews,
            'total_revenue' => $totalRevenue
        ]);
    }
}
?> 