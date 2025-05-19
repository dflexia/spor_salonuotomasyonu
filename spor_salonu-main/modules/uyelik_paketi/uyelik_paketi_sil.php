<?php
include '../../includes/header.php';
include '../../config/database.php';

$mesaj = "";

if (isset($_GET['id'])) {
    $paket_id = $_GET['id'];
    
    // Önce bu paketi kullanan üyeleri kontrol et
    $check_sql = "SELECT COUNT(*) as uye_sayisi FROM uye WHERE PaketID = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $paket_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    $row = $result->fetch_assoc();
    $check_stmt->close();

    if ($row['uye_sayisi'] > 0) {
        $mesaj = "Bu paket " . $row['uye_sayisi'] . " üye tarafından kullanılıyor. Önce bu üyelerin paketlerini değiştirmeniz gerekiyor.";
    } else {
        // Paketi kullanan üye yoksa silme işlemini gerçekleştir
        $sql = "DELETE FROM uyelik_paketi WHERE PaketID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $paket_id);
        if ($stmt->execute()) {
            $mesaj = "Üyelik paketi başarıyla silindi.";
        } else {
            $mesaj = "Hata: " . $conn->error;
        }
        $stmt->close();
    }
} else {
    $mesaj = "Geçersiz paket ID.";
}
?>
<h2>Üyelik Paketi Sil</h2>
<?php if($mesaj) echo '<p>'.$mesaj.'</p>'; ?>
<p><a href="uyelik_paketi_listele.php">Üyelik Paketi Listesine Dön</a></p>
<?php include '../../includes/footer.php'; ?> 