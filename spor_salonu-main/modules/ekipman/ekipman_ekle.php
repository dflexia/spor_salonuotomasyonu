<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$ekipman_adi = $adet = "";
$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ekipman_adi = $_POST['ekipman_adi'];
    $adet = $_POST['adet'];
    
    $sql = "INSERT INTO ekipman (EkipmanAdi, Adet) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $ekipman_adi, $adet);
    
    if ($stmt->execute()) {
        $mesaj = '<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>Ekipman başarıyla eklendi.</div>';
        $ekipman_adi = $adet = "";
    } else {
        $mesaj = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>Hata: ' . $conn->error . '</div>';
    }
    $stmt->close();
}
?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Yeni Ekipman Ekle</h5>
    </div>
    <div class="card-body">
        <?php if($mesaj) echo $mesaj; ?>
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Ekipman Adı</label>
                <input type="text" class="form-control" name="ekipman_adi" value="<?php echo htmlspecialchars($ekipman_adi); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Adet</label>
                <input type="number" class="form-control" name="adet" value="<?php echo htmlspecialchars($adet); ?>" min="0" required>
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