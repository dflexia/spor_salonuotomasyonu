<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$sql = "SELECT * FROM ekipman ORDER BY EkipmanID DESC";
$result = $conn->query($sql);
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-tools me-2"></i>Ekipman Listesi</h5>
        <a href="ekipman_ekle.php" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Yeni Ekipman Ekle
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ekipman Adı</th>
                        <th>Adet</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['EkipmanID']; ?></td>
                        <td><?php echo htmlspecialchars($row['EkipmanAdi']); ?></td>
                        <td><?php echo htmlspecialchars($row['Adet']); ?></td>
                        <td>
                            <a href="ekipman_duzenle.php?id=<?php echo $row['EkipmanID']; ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="ekipman_sil.php?id=<?php echo $row['EkipmanID']; ?>" 
                               onclick="return confirm('Bu ekipmanı silmek istediğinize emin misiniz?');" 
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