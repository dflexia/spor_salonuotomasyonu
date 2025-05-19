<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$sql = "SELECT * FROM ders ORDER BY DersID DESC";
$result = $conn->query($sql);
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-dumbbell me-2"></i>Ders Listesi</h5>
        <a href="ders_ekle.php" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Yeni Ders Ekle
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ders Adı</th>
                        <th>Ders Süresi</th>
                        <th>Ders Saati</th>
                        <th>Ders Kapasitesi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['DersID']; ?></td>
                        <td><?php echo htmlspecialchars($row['DersAdi']); ?></td>
                        <td><?php echo htmlspecialchars($row['DersSuresi']); ?> dakika</td>
                        <td><?php echo htmlspecialchars($row['DersSaati']); ?></td>
                        <td><?php echo htmlspecialchars($row['DersKapasitesi']); ?></td>
                        <td>
                            <a href="ders_duzenle.php?id=<?php echo $row['DersID']; ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="ders_sil.php?id=<?php echo $row['DersID']; ?>" 
                               onclick="return confirm('Bu dersi silmek istediğinize emin misiniz?');" 
                               class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once '../../includes/footer.php'; ?> 