<?php 
class HoaDonVaThanhToanModel 
{ 
private $conn; 
private $table_name = "hoadon_va_thanhtoan"; //
public function __construct($db) 
{ 
$this->conn = $db; 
} 
public function getHoaDonVaThanhToans() 
{ 
    $query = "SELECT 
                h.MaHD, 
                h.Ngaythanhtoan AS NgayThanhToan, 
                h.Tongtien AS TongTien, 
                u.Hoten, 
                u.SDT,
                (SELECT GROUP_CONCAT(dv.Tendichvu SEPARATOR ', ') 
                 FROM chitietdichvu ctdv 
                 JOIN DICHVU dv ON ctdv.MaDV = dv.MaDV 
                 WHERE ctdv.MaDL = h.MaDL) as DichVu,
                pt.TenPT as PhuongThuc, 
                t.Tentrangthai as TrangThai
              FROM HOADON_VA_THANHTOAN h
              LEFT JOIN users u ON h.Manguoidung = u.Manguoidung
              LEFT JOIN PHUONGTHUC pt ON h.MaPT = pt.MaPT
              LEFT JOIN TRANGTHAI t ON h.Matrangthai = t.Matrangthai";
    $stmt = $this->conn->prepare($query); 
    $stmt->execute(); 
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    return $result; 
} 

public function getHoaDonVaThanhToanById($id) 
{ 
    $query = "SELECT h.MaHD, h.NgayThanhToan, h.Tongtien, h.MaD, h.Manguoidung, h.Maphong, h.MaPT, h.Matrangthai FROM " . $this->table_name . " h WHERE h.MaHD = :id";
    $stmt = $this->conn->prepare($query); 
    $stmt->bindParam(':id', $id); 
    $stmt->execute(); 
    $result = $stmt->fetch(PDO::FETCH_OBJ); 
    return $result; 
}

public function addHoaDonVaThanhToan($NgayThanhToan, $Tongtien,$MaDL, $Manguoidung, $Maphong, $MaPT, $Matrangthai)
{
    $query = "INSERT INTO " . $this->table_name . " (NgayThanhToan, Tongtien, MaDL,Manguoidung, Maphong, MaPT, Matrangthai)
              VALUES (:NgayThanhToan, :Tongtien, :MaDL,:Manguoidung,:Maphong, :MaPT, :Matrangthai)";
    $stmt = $this->conn->prepare($query);

    $NgayThanhToan = htmlspecialchars(strip_tags($NgayThanhToan));
    $Tongtien = htmlspecialchars(strip_tags($Tongtien));
    $MaDL = htmlspecialchars(strip_tags($MaDL));
    $Manguoidung = htmlspecialchars(strip_tags($Manguoidung));
    $Maphong = htmlspecialchars(strip_tags($Maphong));
    $MaPT = htmlspecialchars(strip_tags($MaPT));
    $Matrangthai = htmlspecialchars(strip_tags($Matrangthai));


    $stmt->bindParam(':NgayThanhToan', $NgayThanhToan);
    $stmt->bindParam(':Tongtien', $Tongtien);
    $stmt->bindParam(':MaDL', $MaDL);
    $stmt->bindParam(':Manguoidung', $Manguoidung);
    $stmt->bindParam(':Maphong', $Maphong);
    $stmt->bindParam(':MaPT', $MaPT);
    $stmt->bindParam(':Matrangthai', $Matrangthai);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

public function updateHoaDonVaThanhToan($MaHD, $NgayThanhToan, $Tongtien, $MaDL, $Manguoidung, $Maphong, $MaPT, $Matrangthai)
{
    $query = "UPDATE " . $this->table_name . " SET NgayThanhToan = :NgayThanhToan, Tongtien = :Tongtien, MaDL = :MaDL, Manguoidung = :Manguoidung, Maphong = :Maphong, MaPT = :MaPT, Matrangthai = :Matrangthai WHERE MaHD = :MaHD";
    $stmt = $this->conn->prepare($query);

    $NgayThanhToan = htmlspecialchars(strip_tags($NgayThanhToan));
    $Tongtien = htmlspecialchars(strip_tags($Tongtien));
    $MaDL = htmlspecialchars(strip_tags($MaDL));
    $Manguoidung = htmlspecialchars(strip_tags($Manguoidung));
    $Maphong = htmlspecialchars(strip_tags($Maphong));
    $MaPT = htmlspecialchars(strip_tags($MaPT));
    $Matrangthai = htmlspecialchars(strip_tags($Matrangthai));

    $stmt->bindParam(':NgayThanhToan', $NgayThanhToan);
    $stmt->bindParam(':Tongtien', $Tongtien);
    $stmt->bindParam(':MaDL', $MaDL);
    $stmt->bindParam(':Manguoidung', $Manguoidung);
    $stmt->bindParam(':Maphong', $Maphong);
    $stmt->bindParam(':MaPT', $MaPT);
    $stmt->bindParam(':Matrangthai', $Matrangthai);
    $stmt->bindParam(':MaHD', $MaHD);

    if ($stmt->execute()) {
        return true;
    }
    return false;
}

public function deleteHoaDonVaThanhToan($MaHD)
{
    $query = "DELETE FROM " . $this->table_name . " WHERE MaHD = :MaHD";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':MaHD', $MaHD);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

public function getInvoiceStats()
{
    $stats = [];

    // Tổng số hóa đơn
    $query_total = "SELECT COUNT(*) as totalInvoices FROM " . $this->table_name;
    $stmt_total = $this->conn->prepare($query_total);
    $stmt_total->execute();
    $stats['totalInvoices'] = $stmt_total->fetch(PDO::FETCH_ASSOC)['totalInvoices'] ?? 0;

    // Tổng doanh thu
    $query_revenue = "SELECT SUM(Tongtien) as totalRevenue FROM " . $this->table_name;
    $stmt_revenue = $this->conn->prepare($query_revenue);
    $stmt_revenue->execute();
    $stats['totalRevenue'] = $stmt_revenue->fetch(PDO::FETCH_ASSOC)['totalRevenue'] ?? 0;

    // Doanh thu tháng này
    $query_monthly = "SELECT SUM(Tongtien) as monthlyRevenue FROM " . $this->table_name . " WHERE MONTH(Ngaythanhtoan) = MONTH(CURRENT_DATE()) AND YEAR(Ngaythanhtoan) = YEAR(CURRENT_DATE())";
    $stmt_monthly = $this->conn->prepare($query_monthly);
    $stmt_monthly->execute();
    $stats['monthlyRevenue'] = $stmt_monthly->fetch(PDO::FETCH_ASSOC)['monthlyRevenue'] ?? 0;

    // Số hóa đơn đã thanh toán (Giả sử Matrangthai = 1 là đã thanh toán)
    $query_paid = "SELECT COUNT(*) as paidInvoices FROM " . $this->table_name . " WHERE Matrangthai = 1";
    $stmt_paid = $this->conn->prepare($query_paid);
    $stmt_paid->execute();
    $stats['paidInvoices'] = $stmt_paid->fetch(PDO::FETCH_ASSOC)['paidInvoices'] ?? 0;

    return $stats;
}

public function getTotalRevenue()
{
    $query = "SELECT SUM(Tongtien) as total FROM " . $this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'] ?? 0;
}

} 