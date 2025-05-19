<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$ad = $soyad = $telefon = $email = $uzmanlik_alani = "";
$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $uzmanlik_alani = $_POST['uzmanlik_alani'];
    
    $sql = "INSERT INTO egitmen (Ad, Soyad, Telefon, Email, UzmanlikAlani) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $ad, $soyad, $telefon, $email, $uzmanlik_alani);
    if ($stmt->execute()) {
        $mesaj = '<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>Antrenör başarıyla eklendi.</div>';
        $ad = $soyad = $telefon = $email = $uzmanlik_alani = "";
    } else {
        $mesaj = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>Hata: ' . $conn->error . '</div>';
    }
    $stmt->close();
}
?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Yeni Antrenör Ekle</h5>
    </div>
    <div class="card-body">
        <?php if($mesaj) echo $mesaj; ?>
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Ad</label>
                <input type="text" class="form-control" name="ad" value="<?php echo htmlspecialchars($ad); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Soyad</label>
                <input type="text" class="form-control" name="soyad" value="<?php echo htmlspecialchars($soyad); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telefon</label>
                <input type="tel" class="form-control" name="telefon" value="<?php echo htmlspecialchars($telefon); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">E-posta</label>
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Uzmanlık Alanı</label>
                <input type="text" class="form-control" name="uzmanlik_alani" value="<?php echo htmlspecialchars($uzmanlik_alani); ?>" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Kaydet
                </button>
                <a href="antrenor_listele.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Listeye Dön
                </a>
            </div>
        </form>
    </div>
</div>
<?php require_once '../../includes/footer.php'; ?> 