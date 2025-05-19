<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$ad = $soyad = $telefon = $email = $adres = $paket_id = "";
$mesaj = "";

// Paketleri getir
$paketler = $conn->query("SELECT * FROM uyelik_paketi ORDER BY PaketAdi");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $adres = $_POST['adres'];
    $paket_id = $_POST['paket_id'];
    
    $sql = "INSERT INTO uye (Ad, Soyad, Telefon, Email, Adres, PaketID, UyelikBaslangic, UyelikBitis) 
            VALUES (?, ?, ?, ?, ?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL (SELECT PaketSuresi FROM uyelik_paketi WHERE PaketID = ?) DAY))";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssii", $ad, $soyad, $telefon, $email, $adres, $paket_id, $paket_id);
    
    if ($stmt->execute()) {
        $mesaj = '<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>Üye başarıyla eklendi.</div>';
        $ad = $soyad = $telefon = $email = $adres = $paket_id = "";
    } else {
        $mesaj = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>Hata: ' . $conn->error . '</div>';
    }
    $stmt->close();
}
?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Yeni Üye Ekle</h5>
    </div>
    <div class="card-body">
        <?php if($mesaj) echo $mesaj; ?>
        <form method="post" action="">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Ad</label>
                    <input type="text" class="form-control" name="ad" value="<?php echo htmlspecialchars($ad); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Soyad</label>
                    <input type="text" class="form-control" name="soyad" value="<?php echo htmlspecialchars($soyad); ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Telefon</label>
                    <input type="tel" class="form-control" name="telefon" value="<?php echo htmlspecialchars($telefon); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">E-posta</label>
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Adres</label>
                <textarea class="form-control" name="adres" rows="3" required><?php echo htmlspecialchars($adres); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Üyelik Paketi</label>
                <select class="form-select" name="paket_id" required>
                    <option value="">Paket Seçin</option>
                    <?php while($paket = $paketler->fetch_assoc()): ?>
                        <option value="<?php echo $paket['PaketID']; ?>" <?php echo ($paket['PaketID'] == $paket_id) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($paket['PaketAdi']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Kaydet
                </button>
                <a href="uye_listele.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Listeye Dön
                </a>
            </div>
        </form>
    </div>
</div>
<?php require_once '../../includes/footer.php'; ?>
