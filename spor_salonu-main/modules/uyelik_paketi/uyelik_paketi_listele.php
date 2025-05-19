<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$sql = "SELECT * FROM uyelik_paketi ORDER BY PaketID DESC";
$result = $conn->query($sql);
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-box me-2"></i>Üyelik Paketi Listesi</h5>
        <a href="uyelik_paketi_ekle.php" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Yeni Paket Ekle
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Paket Adı</th>
                        <th>Paket Açıklaması</th>
                        <th>Paket Süresi (Gün)</th>
                        <th>Fiyat (TL)</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['PaketID']; ?></td>
                        <td><?php echo htmlspecialchars($row['PaketAdi']); ?></td>
                        <td><?php echo htmlspecialchars($row['PaketAciklamasi']); ?></td>
                        <td><?php echo htmlspecialchars($row['PaketSuresi']); ?></td>
                        <td><?php echo number_format($row['Fiyat'], 2, ',', '.'); ?></td>
                        <td>
                            <a href="uyelik_paketi_duzenle.php?id=<?php echo $row['PaketID']; ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="uyelik_paketi_sil.php?id=<?php echo $row['PaketID']; ?>" 
                               onclick="return confirm('Bu paketi silmek istediğinize emin misiniz?');" 
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