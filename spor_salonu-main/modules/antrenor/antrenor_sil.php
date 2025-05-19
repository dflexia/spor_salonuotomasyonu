<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$id = $_GET['id'];
$mesaj = "";

// Önce antrenörün derslerde kullanılıp kullanılmadığını kontrol et
$sql_check = "SELECT COUNT(*) as count FROM ders_programi WHERE EgitmenID = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$row_check = $result_check->fetch_assoc();

if ($row_check['count'] > 0) {
    $mesaj = '<div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle me-2"></i>
        Bu antrenör derslerde kullanıldığı için silinemez. Önce antrenörün derslerini başka bir antrenöre atayın veya dersleri silin.
    </div>';
} else {
    // Antrenörü sil
    $sql = "DELETE FROM egitmen WHERE EgitmenID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $mesaj = '<div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>
            Antrenör başarıyla silindi.
        </div>';
    } else {
        $mesaj = '<div class="alert alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i>
            Hata: ' . $conn->error . '
        </div>';
    }
    $stmt->close();
}
$stmt_check->close();
?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-user-minus me-2"></i>Antrenör Sil</h5>
    </div>
    <div class="card-body">
        <?php echo $mesaj; ?>
        <div class="text-center mt-3">
            <a href="antrenor_listele.php" class="btn btn-primary">
                <i class="fas fa-arrow-left me-1"></i>Antrenör Listesine Dön
            </a>
        </div>
    </div>
</div>
<?php require_once '../../includes/footer.php'; ?>