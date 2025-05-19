<?php
include '../../includes/header.php';
include '../../config/database.php';

$program_id = $ders_id = $egitmen_id = $gun = $saat = '';
$message = '';

// Dersleri getir
$sql_dersler = "SELECT * FROM ders ORDER BY DersAdi";
$result_dersler = $conn->query($sql_dersler);

// Eğitmenleri getir
$sql_egitmenler = "SELECT * FROM egitmen ORDER BY Ad";
$result_egitmenler = $conn->query($sql_egitmenler);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM ders_programi WHERE ProgramID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $program_id = $row['ProgramID'];
        $ders_id = $row['DersID'];
        $egitmen_id = $row['EgitmenID'];
        $gun = $row['Gun'];
        $saat = $row['Saat'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $program_id = $_POST['program_id'];
    $ders_id = $_POST['ders_id'];
    $egitmen_id = $_POST['egitmen_id'];
    $gun = $_POST['gun'];
    $saat = $_POST['saat'];
    
    $sql = "UPDATE ders_programi SET DersID = ?, EgitmenID = ?, Gun = ?, Saat = ? WHERE ProgramID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissi", $ders_id, $egitmen_id, $gun, $saat, $program_id);
    
    if ($stmt->execute()) {
        $message = "Ders programı başarıyla güncellendi.";
    } else {
        $message = "Hata: " . $stmt->error;
    }
}
?>
<h2>Ders Programı Düzenle</h2>
<?php if ($message): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<form method="post" action="">
    <input type="hidden" name="program_id" value="<?php echo $program_id; ?>">
    <p>
        <label for="ders_id">Ders:</label><br>
        <select id="ders_id" name="ders_id" required>
            <option value="">Ders Seçin</option>
            <?php while($row = $result_dersler->fetch_assoc()): ?>
                <option value="<?php echo $row['DersID']; ?>" <?php echo ($ders_id == $row['DersID']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['DersAdi']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </p>
    <p>
        <label for="egitmen_id">Eğitmen:</label><br>
        <select id="egitmen_id" name="egitmen_id" required>
            <option value="">Eğitmen Seçin</option>
            <?php while($row = $result_egitmenler->fetch_assoc()): ?>
                <option value="<?php echo $row['EgitmenID']; ?>" <?php echo ($egitmen_id == $row['EgitmenID']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['Ad'] . ' ' . $row['Soyad']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </p>
    <p>
        <label for="gun">Gün:</label><br>
        <select id="gun" name="gun" required>
            <option value="">Gün Seçin</option>
            <option value="Pazartesi" <?php echo ($gun == 'Pazartesi') ? 'selected' : ''; ?>>Pazartesi</option>
            <option value="Salı" <?php echo ($gun == 'Salı') ? 'selected' : ''; ?>>Salı</option>
            <option value="Çarşamba" <?php echo ($gun == 'Çarşamba') ? 'selected' : ''; ?>>Çarşamba</option>
            <option value="Perşembe" <?php echo ($gun == 'Perşembe') ? 'selected' : ''; ?>>Perşembe</option>
            <option value="Cuma" <?php echo ($gun == 'Cuma') ? 'selected' : ''; ?>>Cuma</option>
            <option value="Cumartesi" <?php echo ($gun == 'Cumartesi') ? 'selected' : ''; ?>>Cumartesi</option>
            <option value="Pazar" <?php echo ($gun == 'Pazar') ? 'selected' : ''; ?>>Pazar</option>
        </select>
    </p>
    <p>
        <label for="saat">Saat:</label><br>
        <input type="time" id="saat" name="saat" value="<?php echo htmlspecialchars($saat); ?>" required>
    </p>
    <p>
        <input type="submit" value="Güncelle">
    </p>
</form>
<p><a href="ders_programi_listele.php">Ders Programı Listesine Dön</a></p>
<?php include '../../includes/footer.php'; ?> 