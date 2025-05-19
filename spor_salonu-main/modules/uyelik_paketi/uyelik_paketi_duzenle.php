<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$paket_id = $paket_adi = $paket_aciklamasi = $paket_suresi = $fiyat = "";
$mesaj = "";

if (isset($_GET['id'])) {
    $paket_id = $_GET['id'];
    $sql = "SELECT * FROM uyelik_paketi WHERE PaketID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $paket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $paket_adi = $row['PaketAdi'];
        $paket_aciklamasi = $row['PaketAciklamasi'];
        $paket_suresi = $row['PaketSuresi'];
        $fiyat = $row['Fiyat'];
    } else {
        $mesaj = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>Paket bulunamadı.</div>';
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paket_id = $_POST['paket_id'];
    $paket_adi = $_POST['paket_adi'];
    $paket_aciklamasi = $_POST['paket_aciklamasi'];
    $paket_suresi = $_POST['paket_suresi'];
    $fiyat = $_POST['fiyat'];
    
    $sql = "UPDATE uyelik_paketi SET PaketAdi = ?, PaketAciklamasi = ?, PaketSuresi = ?, Fiyat = ? WHERE PaketID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssidi", $paket_adi, $paket_aciklamasi, $paket_suresi, $fiyat, $paket_id);
    if ($stmt->execute()) {
        $mesaj = '<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>Üyelik paketi başarıyla güncellendi.</div>';
    } else {
        $mesaj = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>Hata: ' . $conn->error . '</div>';
    }
    $stmt->close();
}
?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Üyelik Paketi Düzenle</h5>
    </div>
    <div class="card-body">
        <?php if($mesaj) echo $mesaj; ?>
        <form method="post" action="">
            <input type="hidden" name="paket_id" value="<?php echo htmlspecialchars($paket_id); ?>">
            <div class="mb-3">
                <label class="form-label">Paket Adı</label>
                <input type="text" class="form-control" name="paket_adi" value="<?php echo htmlspecialchars($paket_adi); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Paket Açıklaması</label>
                <textarea class="form-control" name="paket_aciklamasi" rows="4"><?php echo htmlspecialchars($paket_aciklamasi); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Paket Süresi (Gün)</label>
                <input type="number" class="form-control" name="paket_suresi" value="<?php echo htmlspecialchars($paket_suresi); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fiyat (TL)</label>
                <input type="number" step="0.01" class="form-control" name="fiyat" value="<?php echo htmlspecialchars($fiyat); ?>" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Kaydet
                </button>
                <a href="uyelik_paketi_listele.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Listeye Dön
                </a>
            </div>
        </form>

<p><a href="uyelik_paketi_listele.php">Üyelik Paketi Listesine Dön</a></p>
<?php include '../../includes/footer.php'; ?> 