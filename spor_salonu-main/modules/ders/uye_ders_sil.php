<?php
include '../../includes/header.php';
include '../../config/database.php';

$message = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM uye_ders WHERE KayitID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Ders kaydı başarıyla silindi.";
    } else {
        $message = "Hata: " . $stmt->error;
    }
} else {
    $message = "Geçersiz kayıt ID.";
}
?>
<h2>Ders Kaydı Sil</h2>
<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<p><a href="uye_ders_listele.php">Ders Kayıt Listesine Dön</a></p>
<?php include '../../includes/footer.php'; ?>