<?php
include '../../includes/header.php';
include '../../config/database.php';

$message = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM uye WHERE UyeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Üye başarıyla silindi.";
    } else {
        $message = "Hata: " . $stmt->error;
    }
}
?>
<h2>Üye Sil</h2>
<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<p><a href="uye_listele.php">Üye Listesine Dön</a></p>
<?php include '../../includes/footer.php'; ?> 