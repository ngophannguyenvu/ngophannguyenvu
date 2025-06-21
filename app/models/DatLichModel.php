<?php 
class DatLichModel 
{ 
private $conn; 
private $table_name = "datlich"; //
public function __construct($db) 
{ 
$this->conn = $db; 
} 
public function getDatLich() 
{ 
    $query = "SELECT 
                dl.MaDL,
                dl.Thoigiandatlich as ThoiGianDatLich,
                u.Hoten AS TenNguoiDung,
                u.SDT,
                dv.TenDichVu,
                p.TenPhong,
                ttp.TenTrangThaiPhong AS TrangThai
              FROM " . $this->table_name . " dl
              LEFT JOIN users u ON dl.Manguoidung = u.Manguoidung
              LEFT JOIN dichvu dv ON dl.MaDichVu = dv.MaDichVu
              LEFT JOIN phong p ON dl.Maphong = p.Maphong
              LEFT JOIN trangthaiphong ttp ON dl.MaTrangThaiPhong = ttp.MaTrangThaiPhong
              ORDER BY dl.Thoigiandatlich DESC";
    $stmt = $this->conn->prepare($query); 
    $stmt->execute(); 
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    return $result; 
} 
public function getDatLichById($id) 
{ 
    $query = "SELECT dl.MaDL, dl.Manguoidung, dl.Thoigiandatlich, dl.Trangthai_ 
    FROM " . $this->table_name . " dl 
    WHERE dl.MaDL = :id";

$stmt = $this->conn->prepare($query); 
$stmt->bindParam(':id', $id); 
$stmt->execute(); 
$result = $stmt->fetch(PDO::FETCH_OBJ);
return $result;

}
// Thêm mới danh mục
public function addDatLich($Manguoidung, $Thoigiandatlich,$Trangthai)
{
    $errors = [];

    if (empty($Manguoidung)) {
        $errors['Manguoidung'] = 'Ma nguoi không được để trống';
    }
    if (empty($Thoigiandatlich)) {
        $errors['Thoigiandatlich'] = 'Thoigiandatlich không được để trống';
    }
    if (empty($Trangthai)) {
        $errors['Trangthai'] = 'Trangthai không được để trống';
    }

    if (count($errors) > 0) {
        return $errors;
    }
//INSERT INTO datlich ( Manguoidung,Thoigiandatlich, Trangthai_) VALUE (1,NOW(),"123")
    $query = "INSERT INTO " . $this->table_name . " ( Manguoidung,Thoigiandatlich, Trangthai_) 
    VALUES (:Manguoidung, :Thoigiandatlich,:Trangthai)";
    $stmt = $this->conn->prepare($query);

    $Manguoidung = htmlspecialchars(strip_tags($Manguoidung));
    $Thoigiandatlich = (new DateTime())->format('Y-m-d H:i:s');
    $Trangthai = htmlspecialchars(strip_tags($Trangthai));
    
    $stmt->bindParam(':Manguoidung', $Manguoidung);
    $stmt->bindParam(':Thoigiandatlich', $Thoigiandatlich);
    $stmt->bindParam(':Trangthai', $Trangthai);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}

public function updateDatLich($id, $Manguoidung, $Thoigiandatlich,$Trangthai)
{
    $query = "UPDATE " . $this->table_name . " SET Manguoidung = :Manguoidung, Thoigiandatlich = :Thoigiandatlich,Trangthai_ = :Trangthai  WHERE MaDL = :id";
    $stmt = $this->conn->prepare($query);


    $Manguoidung = htmlspecialchars(strip_tags($Manguoidung));
    $Thoigiandatlich = (new DateTime())->format('Y-m-d H:i:s');
    $Trangthai = htmlspecialchars(strip_tags($Trangthai));

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':Manguoidung', $Manguoidung);
    $stmt->bindParam(':Thoigiandatlich', $Thoigiandatlich);
    $stmt->bindParam(':Trangthai', $Trangthai);
    if ($stmt->execute()) {
        return true;
    }

    return false;
}

public function deleteDatLich($MaDL)
{
    $query = "DELETE FROM " . $this->table_name . " WHERE MaDL = :MaDL";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':MaDL', $MaDL);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

public function getBookingStats()
{
    $stats = [];
    $today = date('Y-m-d');

    $query_today = "SELECT COUNT(*) as count FROM " . $this->table_name . " WHERE DATE(Thoigiandatlich) = :today";
    $stmt_today = $this->conn->prepare($query_today);
    $stmt_today->bindParam(':today', $today);
    $stmt_today->execute();
    $stats['today'] = $stmt_today->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;
    
    // MaTrangThaiPhong: 1: Chờ xác nhận, 2: Đã xác nhận, 3: Hoàn thành, 4: Đã hủy (giả định)
    $query_pending = "SELECT COUNT(*) as count FROM " . $this->table_name . " WHERE MaTrangThaiPhong = 1";
    $stmt_pending = $this->conn->prepare($query_pending);
    $stmt_pending->execute();
    $stats['pending'] = $stmt_pending->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;

    $query_confirmed = "SELECT COUNT(*) as count FROM " . $this->table_name . " WHERE MaTrangThaiPhong = 2";
    $stmt_confirmed = $this->conn->prepare($query_confirmed);
    $stmt_confirmed->execute();
    $stats['confirmed'] = $stmt_confirmed->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;

    $query_completed = "SELECT COUNT(*) as count FROM " . $this->table_name . " WHERE MaTrangThaiPhong = 3";
    $stmt_completed = $this->conn->prepare($query_completed);
    $stmt_completed->execute();
    $stats['completed'] = $stmt_completed->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;

    $query_cancelled = "SELECT COUNT(*) as count FROM " . $this->table_name . " WHERE MaTrangThaiPhong = 4";
    $stmt_cancelled = $this->conn->prepare($query_cancelled);
    $stmt_cancelled->execute();
    $stats['cancelled'] = $stmt_cancelled->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;

    return $stats;
}

public function getTotalBookings()
{
    $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'] ?? 0;
}

}