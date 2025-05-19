<?php
require_once '../../includes/header.php';
require_once '../../config/database.php';

$sql = "SELECT u.*, p.PaketAdi 
        FROM uye u 
        LEFT JOIN uyelik_paketi p ON u.PaketID = p.PaketID 
        ORDER BY u.UyeID DESC";
$result = $conn->query($sql);
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-users me-2"></i>Üye Listesi</h5>
        <a href="uye_ekle.php" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Yeni Üye Ekle
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
                        <th>Üyelik Paketi</th>
                        <th>Üyelik Başlangıç</th>
                        <th>Üyelik Bitiş</th>
                        <th>Adres</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['UyeID']; ?></td>
                        <td><?php echo htmlspecialchars($row['Ad']); ?></td>
                        <td><?php echo htmlspecialchars($row['Soyad']); ?></td>
                        <td><?php echo htmlspecialchars($row['Telefon']); ?></td>
                        <td><?php echo htmlspecialchars($row['Email']); ?></td>
                        <td><?php echo htmlspecialchars($row['PaketAdi']); ?></td>
                        <td><?php echo date('d.m.Y', strtotime($row['UyelikBaslangic'])); ?></td>
                        <td><?php echo date('d.m.Y', strtotime($row['UyelikBitis'])); ?></td>
                        <td><?php echo htmlspecialchars($row['Adres']); ?></td>
                        <td>
                            <a href="uye_duzenle.php?id=<?php echo $row['UyeID']; ?>" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="uye_sil.php?id=<?php echo $row['UyeID']; ?>" 
                               onclick="return confirm('Bu üyeyi silmek istediğinize emin misiniz?');" 
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
