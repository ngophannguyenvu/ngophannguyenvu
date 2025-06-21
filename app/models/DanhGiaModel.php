<?php 
class DanhGiaModel 
{ 
private $conn; 
private $table_name = "danhgia"; //
public function __construct($db) 
{ 
$this->conn = $db; 
} 
public function getDanhGias() 
{ 
    $query = "SELECT 
                dg.MaDG, 
                dg.Danhgiasao, 
                dg.Nhanxet, 
                dg.Ngaydanhgia,
                u.Hoten,
                u.Email,
                p.Tenphong
              FROM " . $this->table_name . " dg
              LEFT JOIN users u ON dg.Manguoidung = u.Manguoidung
              LEFT JOIN hoadon_va_thanhtoan hd ON dg.MaHD = hd.MaHD
              LEFT JOIN phong p ON hd.Maphong = p.Maphong
              ORDER BY dg.Ngaydanhgia DESC";

    $stmt = $this->conn->prepare($query); 
    $stmt->execute(); 
    $result = $stmt->fetchAll(PDO::FETCH_OBJ); 
    return $result; 
} 
public function getDanhGiaById($id) 
{ 
$query = "SELECT dg.MaDG, dg.Danhgiasao, dg.Nhanxet, dg.Ngaydanhgia, dg.Manguoidung, dg.MaHD FROM " . $this->table_name . " dg WHERE dg.MaDG = :id";

$stmt = $this->conn->prepare($query); 
$stmt->bindParam(':id', $id); 
$stmt->execute(); 
$result = $stmt->fetch(PDO::FETCH_OBJ); 
return $result; 
}
// Thêm mới 
public function addDanhGia($Danhgiasao,$Nhanxet,$Ngaydanhgia,$Manguoidung,$MaHD)       
{
    $errors = [];

    if (empty($Danhgiasao)) {
        $errors['Danhgiasao'] = 'Danh gia sao không được để trống';
    }
    if (empty($Nhanxet)) {
        $errors['Nhanxet'] = 'Nhanxet không được để trống';
    }
    if (empty($Ngaydanhgia)) {
        $errors['Ngaydanhgia'] = 'Ngaydanhgia không được để trống';
    }
    if (empty($Manguoidung)) {
        $errors['Manguoidung'] = 'Manguoidung không được để trống';
    }
    if (empty($MaHD)) {
        $errors['MaHD'] = 'MaHD không được để trống';
    }
    if (count($errors) > 0) {
        return $errors;
    }
//INSERT INTO danhgia (Danhgiasao,Nhanxet,Ngaydanhgia,Manguoidung,MaHD) VALUE ("4","hssj",NOW(),"1","1")
    $query = "INSERT INTO " . $this->table_name . " ( Danhgiasao,Nhanxet,Ngaydanhgia,Manguoidung,MaHD) 
    VALUES (:Danhgiasao,:Nhanxet,:Ngaydanhgia,:Manguoidung,:MaHD)";
    $stmt = $this->conn->prepare($query);

    $Danhgiasao = htmlspecialchars(strip_tags($Danhgiasao));
    $Nhanxet = htmlspecialchars(strip_tags($Nhanxet));
    $Ngaydanhgia = (new DateTime())->format('Y-m-d H:i:s');
    $Manguoidung = htmlspecialchars(strip_tags($Manguoidung));
    $MaHD = htmlspecialchars(strip_tags($MaHD));

    $stmt->bindParam(':Danhgiasao', $Danhgiasao);
    $stmt->bindParam(':Nhanxet', $Nhanxet);
    $stmt->bindParam(':Ngaydanhgia', $Ngaydanhgia);
    $stmt->bindParam(':Manguoidung', $Manguoidung);
    $stmt->bindParam(':MaHD', $MaHD);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}

public function updateDanhGia($id, $Danhgiasao,$Nhanxet,$Ngaydanhgia,$Manguoidung,$MaHD)
{
    $query = "UPDATE " . $this->table_name . " SET Danhgiasao = :Danhgiasao, Nhanxet = :Nhanxet,Ngaydanhgia = :Ngaydanhgia, Manguoidung = :Manguoidung,
    MaHD = :MaHD WHERE MaDG = :id";
    $stmt = $this->conn->prepare($query);


    $Danhgiasao = htmlspecialchars(strip_tags($Danhgiasao));
    $Nhanxet = htmlspecialchars(strip_tags($Nhanxet));
    $Ngaydanhgia = (new DateTime())->format('Y-m-d H:i:s');
    $Manguoidung = htmlspecialchars(strip_tags($Manguoidung));
    $MaHD = htmlspecialchars(strip_tags($MaHD));

    $stmt->bindParam(':Danhgiasao', $Danhgiasao);
    $stmt->bindParam(':Nhanxet', $Nhanxet);
    $stmt->bindParam(':Ngaydanhgia', $Ngaydanhgia);
    $stmt->bindParam(':Manguoidung', $Manguoidung);
    $stmt->bindParam(':MaHD', $MaHD);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        return true;
    }

    return false;
}

public function deleteDanhGia($MaDG)
{
    $query = "DELETE FROM " . $this->table_name . " WHERE MaDG = :MaDG";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':MaDG', $MaDG);
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

public function getTotalReviews()
{
    $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'] ?? 0;
}

public function getReviewStats()
{
    $stats = [];
    $query_total = "SELECT COUNT(*) as totalReviews FROM " . $this->table_name;
    $stmt_total = $this->conn->prepare($query_total);
    $stmt_total->execute();
    $totalReviews = $stmt_total->fetch(PDO::FETCH_ASSOC)['totalReviews'] ?? 0;
    $stats['totalReviews'] = $totalReviews;

    $query_monthly = "SELECT COUNT(*) as newReviews FROM " . $this->table_name . " WHERE MONTH(Ngaydanhgia) = MONTH(CURRENT_DATE()) AND YEAR(Ngaydanhgia) = YEAR(CURRENT_DATE())";
    $stmt_monthly = $this->conn->prepare($query_monthly);
    $stmt_monthly->execute();
    $stats['newReviews'] = $stmt_monthly->fetch(PDO::FETCH_ASSOC)['newReviews'] ?? 0;

    $query_good = "SELECT COUNT(*) as goodReviews FROM " . $this->table_name . " WHERE Danhgiasao >= 4";
    $stmt_good = $this->conn->prepare($query_good);
    $stmt_good->execute();
    $goodReviews = $stmt_good->fetch(PDO::FETCH_ASSOC)['goodReviews'] ?? 0;
    
    $stats['goodReviewRate'] = ($totalReviews > 0) ? round(($goodReviews / $totalReviews) * 100) : 0;
    
    return $stats;
}
} 