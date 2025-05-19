<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$id = $_GET['id'];
$ekipman_adi = $adet = "";
$mesaj = "";

$sql = "SELECT * FROM ekipman WHERE EkipmanID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ekipman_adi = $_POST['ekipman_adi'];
    $adet = $_POST['adet'];
    
    $sql = "UPDATE ekipman SET EkipmanAdi = ?, Adet = ? WHERE EkipmanID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $ekipman_adi, $adet, $id);
    
    if ($stmt->execute()) {
        $mesaj = '<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>Ekipman bilgileri başarıyla güncellendi.</div>';
    } else {
        $mesaj = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>Hata: ' . $conn->error . '</div>';
    }
    $stmt->close();
}
?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-dumbbell me-2"></i>Ekipman Düzenle</h5>
    </div>
    <div class="card-body">
        <?php if($mesaj) echo $mesaj; ?>
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Ekipman Adı</label>
                <input type="text" class="form-control" name="ekipman_adi" value="<?php echo htmlspecialchars($row['EkipmanAdi']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Adet</label>
                <input type="number" class="form-control" name="adet" value="<?php echo htmlspecialchars($row['Adet']); ?>" min="0" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Kaydet
                </button>
                <a href="ekipman_listele.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Listeye Dön
                </a>
            </div>
        </form>
    </div>
</div>
<?php require_once '../../includes/footer.php'; ?> 