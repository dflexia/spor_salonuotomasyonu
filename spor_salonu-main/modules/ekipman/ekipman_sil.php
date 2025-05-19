<?php
include '../../includes/header.php';
include '../../config/database.php';

$mesaj = "";

if (isset($_GET['id'])) {
    $ekipman_id = $_GET['id'];
    
    $sql = "DELETE FROM ekipman WHERE EkipmanID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ekipman_id);
    if ($stmt->execute()) {
        $mesaj = "Ekipman başarıyla silindi.";
    } else {
        $mesaj = "Hata: " . $conn->error;
    }
    $stmt->close();
} else {
    $mesaj = "Geçersiz ekipman ID.";
}
?>
<h2>Ekipman Sil</h2>
<?php if($mesaj) echo '<p>'.$mesaj.'</p>'; ?>
<p><a href="ekipman_listele.php">Ekipman Listesine Dön</a></p>
<?php include '../../includes/footer.php'; ?> 