<?php
include '../../includes/header.php';
include '../../config/database.php';

$sql = "SELECT dp.*, d.DersAdi, e.Ad as EgitmenAdi, e.Soyad as EgitmenSoyadi 
        FROM ders_programi dp 
        JOIN ders d ON dp.DersID = d.DersID 
        JOIN egitmen e ON dp.EgitmenID = e.EgitmenID 
        ORDER BY FIELD(dp.Gun, 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'), dp.Saat";
$result = $conn->query($sql);
?>
<h2>Ders Programı</h2>
<p><a href="ders_programi_ekle.php">Yeni Ders Programı Ekle</a></p>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Ders</th>
        <th>Eğitmen</th>
        <th>Gün</th>
        <th>Saat</th>
        <th>İşlemler</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['ProgramID']; ?></td>
        <td><?php echo htmlspecialchars($row['DersAdi']); ?></td>
        <td><?php echo htmlspecialchars($row['EgitmenAdi'] . ' ' . $row['EgitmenSoyadi']); ?></td>
        <td><?php echo htmlspecialchars($row['Gun']); ?></td>
        <td><?php echo htmlspecialchars($row['Saat']); ?></td>
        <td>
            <a href="ders_programi_duzenle.php?id=<?php echo $row['ProgramID']; ?>">Düzenle</a> |
            <a href="ders_programi_sil.php?id=<?php echo $row['ProgramID']; ?>" onclick="return confirm('Silmek istediğinize emin misiniz?');">Sil</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php include '../../includes/footer.php'; ?> 