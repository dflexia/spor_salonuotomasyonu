<?php
include '../../includes/header.php';
include '../../config/database.php';

$message = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM ders_programi WHERE ProgramID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $message = "Ders programı başarıyla silindi.";
    } else {
        $message = "Hata: " . $stmt->error;
    }
}
?>
<h2>Ders Programı Sil</h2>
<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<p><a href="ders_programi_listele.php">Ders Programı Listesine Dön</a></p>
<?php include '../../includes/footer.php'; ?> 