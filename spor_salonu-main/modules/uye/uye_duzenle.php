<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$id = $_GET['id'];
$ad = $soyad = $telefon = $email = $paket_id = "";
$mesaj = "";

// Üye bilgilerini getir
$sql = "SELECT * FROM uye WHERE UyeID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Paketleri getir
$paketler = $conn->query("SELECT * FROM uyelik_paketi ORDER BY PaketAdi");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $paket_id = $_POST['paket_id'];
    
    $sql = "UPDATE uye SET Ad = ?, Soyad = ?, Telefon = ?, Email = ?, PaketID = ? WHERE UyeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $ad, $soyad, $telefon, $email, $paket_id, $id);
    
    if ($stmt->execute()) {
        $mesaj = '<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>Üye bilgileri başarıyla güncellendi.</div>';
    } else {
        $mesaj = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>Hata: ' . $conn->error . '</div>';
    }
    $stmt->close();
}
?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i>Üye Düzenle</h5>
    </div>
    <div class="card-body">
        <?php if($mesaj) echo $mesaj; ?>
        <form method="post" action="">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Ad</label>
                    <input type="text" class="form-control" name="ad" value="<?php echo htmlspecialchars($row['Ad']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Soyad</label>
                    <input type="text" class="form-control" name="soyad" value="<?php echo htmlspecialchars($row['Soyad']); ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Telefon</label>
                    <input type="tel" class="form-control" name="telefon" value="<?php echo htmlspecialchars($row['Telefon']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">E-posta</label>
                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Adres</label>
                    <input type="text" class="form-control" name="adres" value="<?php echo htmlspecialchars($row['Adres']); ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Üyelik Paketi</label>
                <select class="form-select" name="paket_id" required>
                    <option value="">Paket Seçin</option>
                    <?php while($paket = $paketler->fetch_assoc()): ?>
                        <option value="<?php echo $paket['PaketID']; ?>" <?php echo ($paket['PaketID'] == $row['PaketID']) ? 'selected' : ''; ?>>
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