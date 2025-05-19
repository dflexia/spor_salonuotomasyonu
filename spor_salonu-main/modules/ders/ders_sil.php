<?php
include '../../includes/header.php';
include '../../config/database.php';

$message = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM ders WHERE DersID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Ders başarıyla silindi.";
    } else {
        $message = "Hata: " . $stmt->error;
    }
}
?>
<h2>Ders Sil</h2>
<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<p><a href="ders_listele.php">Ders Listesine Dön</a></p>
<?php include '../../includes/footer.php'; ?> 