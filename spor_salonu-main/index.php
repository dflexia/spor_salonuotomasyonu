<?php
require_once 'includes/header.php';
?>
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h2 class="card-title mb-3"><i class="fas fa-dumbbell me-2"></i>Hoşgeldiniz!</h2>
                    <p class="card-text lead">Bu sistem ile spor salonunuzun üyelerini, antrenörlerini, derslerini ve ekipmanlarını kolayca yönetebilirsiniz.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users me-2"></i>Üye Yönetimi</h5>
                    <p class="card-text">Üyeleri görüntüleyin, ekleyin, düzenleyin ve silin.</p>
                    <a href="modules/uye/uye_listele.php" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-1"></i>Üyelere Git
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-tie me-2"></i>Antrenör Yönetimi</h5>
                    <p class="card-text">Antrenörleri görüntüleyin, ekleyin, düzenleyin ve silin.</p>
                    <a href="modules/antrenor/antrenor_listele.php" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-1"></i>Antrenörlere Git
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-dumbbell me-2"></i>Ders Yönetimi</h5>
                    <p class="card-text">Dersleri görüntüleyin, ekleyin, düzenleyin ve silin.</p>
                    <a href="modules/ders/ders_listele.php" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-1"></i>Derslere Git
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-tools me-2"></i>Ekipman Yönetimi</h5>
                    <p class="card-text">Ekipmanları görüntüleyin, ekleyin, düzenleyin ve silin.</p>
                    <a href="modules/ekipman/ekipman_listele.php" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-1"></i>Ekipmanlara Git
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-box me-2"></i>Üyelik Paketi Yönetimi</h5>
                    <p class="card-text">Üyelik paketlerini görüntüleyin, ekleyin, düzenleyin ve silin.</p>
                    <a href="modules/uyelik_paketi/uyelik_paketi_listele.php" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-1"></i>Paketlere Git
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
