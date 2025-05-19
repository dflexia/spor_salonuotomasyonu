<?php
include '../../includes/header.php';
include '../../config/database.php';

$sql = "SELECT ud.*, u.Ad as UyeAdi, u.Soyad as UyeSoyadi, 
               d.DersAdi, dp.Gun, dp.Saat, 
               e.Ad as EgitmenAdi, e.Soyad as EgitmenSoyadi
        FROM uye_ders ud 
        JOIN uye u ON ud.UyeID = u.UyeID 
        JOIN ders_programi dp ON ud.ProgramID = dp.ProgramID 
        JOIN ders d ON dp.DersID = d.DersID 
        JOIN egitmen e ON dp.EgitmenID = e.EgitmenID 
        ORDER BY u.Ad, u.Soyad, FIELD(dp.Gun, 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'), dp.Saat";
$result = $conn->query($sql);
?>
<h2>Üye Ders Kayıtları</h2>
<p><a href="uye_ders_kayit.php">Yeni Ders Kaydı</a></p>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Üye</th>
        <th>Ders</th>
        <th>Gün</th>
        <th>Saat</th>
        <th>Eğitmen</th>
        <th>İşlemler</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['KayitID']; ?></td>
        <td><?php echo htmlspecialchars($row['UyeAdi'] . ' ' . $row['UyeSoyadi']); ?></td>
        <td><?php echo htmlspecialchars($row['DersAdi']); ?></td>
        <td><?php echo htmlspecialchars($row['Gun']); ?></td>
        <td><?php echo htmlspecialchars($row['Saat']); ?></td>
        <td><?php echo htmlspecialchars($row['EgitmenAdi'] . ' ' . $row['EgitmenSoyadi']); ?></td>
        <td>
            <a href="uye_ders_sil.php?id=<?php echo $row['KayitID']; ?>" onclick="return confirm('Silmek istediğinize emin misiniz?');">Sil</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php include '../../includes/footer.php'; ?>