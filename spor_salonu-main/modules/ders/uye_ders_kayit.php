<?php
include '../../includes/header.php';
include '../../config/database.php';

$uye_id = $program_id = '';
$message = '';

// Üyeleri getir
$sql_uyeler = "SELECT * FROM uye ORDER BY Ad, Soyad";
$result_uyeler = $conn->query($sql_uyeler);

// Ders programını getir
$sql_program = "SELECT dp.*, d.DersAdi, e.Ad as EgitmenAdi, e.Soyad as EgitmenSoyadi 
                FROM ders_programi dp 
                JOIN ders d ON dp.DersID = d.DersID 
                JOIN egitmen e ON dp.EgitmenID = e.EgitmenID 
                ORDER BY FIELD(dp.Gun, 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'), dp.Saat";
$result_program = $conn->query($sql_program);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uye_id = $_POST['uye_id'];
    $program_id = $_POST['program_id'];
    
    // Önce bu üyenin bu derse zaten kayıtlı olup olmadığını kontrol et
    $sql_check = "SELECT * FROM uye_ders WHERE UyeID = ? AND ProgramID = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ii", $uye_id, $program_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    if ($result_check->num_rows > 0) {
        $message = "Bu üye zaten bu derse kayıtlı.";
    } else {
        // Dersin kapasitesini kontrol et
        $sql_capacity = "SELECT d.DersKapasitesi, COUNT(ud.UyeID) as KayitliUye 
                        FROM ders_programi dp 
                        JOIN ders d ON dp.DersID = d.DersID 
                        LEFT JOIN uye_ders ud ON dp.ProgramID = ud.ProgramID 
                        WHERE dp.ProgramID = ? 
                        GROUP BY d.DersKapasitesi";
        $stmt_capacity = $conn->prepare($sql_capacity);
        $stmt_capacity->bind_param("i", $program_id);
        $stmt_capacity->execute();
        $result_capacity = $stmt_capacity->get_result();
        $row_capacity = $result_capacity->fetch_assoc();
        
        if ($row_capacity['KayitliUye'] >= $row_capacity['DersKapasitesi']) {
            $message = "Bu ders için kontenjan dolmuştur.";
        } else {
            $sql = "INSERT INTO uye_ders (UyeID, ProgramID) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $uye_id, $program_id);
            
            if ($stmt->execute()) {
                $message = "Ders kaydı başarıyla yapıldı.";
                $uye_id = $program_id = '';
            } else {
                $message = "Hata: " . $stmt->error;
            }
        }
    }
}
?>
<h2>Üye Ders Kaydı</h2>
<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<form method="post" action="">
    <p>
        <label for="uye_id">Üye:</label><br>
        <select id="uye_id" name="uye_id" required>
            <option value="">Üye Seçin</option>
            <?php while($row = $result_uyeler->fetch_assoc()): ?>
                <option value="<?php echo $row['UyeID']; ?>" <?php echo ($uye_id == $row['UyeID']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['Ad'] . ' ' . $row['Soyad']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </p>
    <p>
        <label for="program_id">Ders Programı:</label><br>
        <select id="program_id" name="program_id" required>
            <option value="">Ders Seçin</option>
            <?php while($row = $result_program->fetch_assoc()): ?>
                <option value="<?php echo $row['ProgramID']; ?>" <?php echo ($program_id == $row['ProgramID']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['DersAdi'] . ' - ' . $row['Gun'] . ' ' . $row['Saat'] . 
                          ' (Eğitmen: ' . $row['EgitmenAdi'] . ' ' . $row['EgitmenSoyadi'] . ')'); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </p>
    <p>
        <input type="submit" value="Kaydet">
    </p>
</form>
<p><a href="uye_ders_listele.php">Ders Kayıt Listesine Dön</a></p>
<?php include '../../includes/footer.php'; ?> 