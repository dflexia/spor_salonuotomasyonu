<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$sql = "SELECT * FROM egitmen ORDER BY EgitmenID DESC";
$result = $conn->query($sql);
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-user-tie me-2"></i>Antrenör Listesi</h5>
        <a href="antrenor_ekle.php" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Yeni Antrenör Ekle
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ad</th>
                        <th>Soyad</th>
                        <th>Telefon</th>
                        <th>E-posta</th>
                        <th>Uzmanlık Alanı</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['EgitmenID']; ?></td>
                        <td><?php echo htmlspecialchars($row['Ad']); ?></td>
                        <td><?php echo htmlspecialchars($row['Soyad']); ?></td>
                        <td><?php echo htmlspecialchars($row['Telefon']); ?></td>
                        <td><?php echo htmlspecialchars($row['Email']); ?></td>
                        <td><?php echo htmlspecialchars($row['UzmanlikAlani']); ?></td>
                        <td>
                            <a href="antrenor_duzenle.php?id=<?php echo $row['EgitmenID']; ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="antrenor_sil.php?id=<?php echo $row['EgitmenID']; ?>" 
                               onclick="return confirm('Bu antrenörü silmek istediğinize emin misiniz?');" 
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