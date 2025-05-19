<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$ders_adi = $ders_suresi = $ders_saati = $ders_kapasitesi = "";
$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ders_adi = $_POST['ders_adi'];
    $ders_suresi = $_POST['ders_suresi'];
    $ders_saati = $_POST['ders_saati'];
    $ders_kapasitesi = $_POST['ders_kapasitesi'];
    
    $sql = "INSERT INTO ders (DersAdi, DersSuresi, DersSaati, DersKapasitesi) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisi", $ders_adi, $ders_suresi, $ders_saati, $ders_kapasitesi);
    
    if ($stmt->execute()) {
        $mesaj = '<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>Ders başarıyla eklendi.</div>';
        $ders_adi = $ders_suresi = $ders_saati = $ders_kapasitesi = "";
    } else {
        $mesaj = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>Hata: ' . $conn->error . '</div>';
    }
    $stmt->close();
}
?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Yeni Ders Ekle</h5>
    </div>
    <div class="card-body">
        <?php if($mesaj) echo $mesaj; ?>
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Ders Adı</label>
                <input type="text" class="form-control" name="ders_adi" value="<?php echo htmlspecialchars($ders_adi); ?>" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Ders Süresi (Dakika)</label>
                    <input type="number" class="form-control" name="ders_suresi" value="<?php echo htmlspecialchars($ders_suresi); ?>" min="1" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Ders Saati</label>
                    <input type="time" class="form-control" name="ders_saati" value="<?php echo htmlspecialchars($ders_saati); ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Ders Kapasitesi</label>
                <input type="number" class="form-control" name="ders_kapasitesi" value="<?php echo htmlspecialchars($ders_kapasitesi); ?>" min="1" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Kaydet
                </button>
                <a href="ders_listele.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Listeye Dön
                </a>
            </div>
        </form>
    </div>
</div>
<?php require_once '../../includes/footer.php'; ?> 