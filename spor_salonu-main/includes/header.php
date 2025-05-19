<?php
require_once __DIR__ . '/../config/database.php';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spor Salonu Yönetim Sistemi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #2c3e50;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .navbar-brand {
            color: #ecf0f1 !important;
            font-weight: bold;
        }
        .nav-link {
            color: #ecf0f1 !important;
        }
        .nav-link:hover {
            color: #3498db !important;
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            margin-bottom: 1.5rem;
        }
        .card-header {
            background-color: #2c3e50;
            color: #ecf0f1;
        }
        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        .btn-danger {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }
        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
        .table {
            background-color: white;
        }
        .table thead th {
            background-color: #2c3e50;
            color: #ecf0f1;
            border: none;
        }
        .alert {
            border-radius: 0;
            border: none;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/spor_salonu-main/index.php">
                <i class="fas fa-dumbbell me-2"></i>Spor Salonu Yönetim
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/spor_salonu-main/modules/uye/uye_listele.php">
                            <i class="fas fa-users me-1"></i>Üyeler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/spor_salonu-main/modules/antrenor/antrenor_listele.php">
                            <i class="fas fa-user-tie me-1"></i>Antrenörler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/spor_salonu-main/modules/ders/ders_listele.php">
                            <i class="fas fa-calendar-alt me-1"></i>Dersler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/spor_salonu-main/modules/ekipman/ekipman_listele.php">
                            <i class="fas fa-dumbbell me-1"></i>Ekipmanlar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/spor_salonu-main/modules/uyelik_paketi/uyelik_paketi_listele.php">
                            <i class="fas fa-box me-1"></i>Üyelik Paketleri
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">