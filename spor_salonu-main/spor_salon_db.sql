-- Veritabanı oluşturma
CREATE DATABASE IF NOT EXISTS spor_salon_db;
USE spor_salon_db;

-- Üyelik Paketi Tablosu
CREATE TABLE IF NOT EXISTS uyelik_paketi (
    PaketID INT AUTO_INCREMENT PRIMARY KEY,
    PaketAdi VARCHAR(100) NOT NULL,
    PaketAciklamasi TEXT,
    PaketSuresi INT NOT NULL,
    Fiyat DECIMAL(10,2) NOT NULL
);

-- Üye Tablosu
CREATE TABLE IF NOT EXISTS uye (
    UyeID INT AUTO_INCREMENT PRIMARY KEY,
    Ad VARCHAR(50) NOT NULL,
    Soyad VARCHAR(50) NOT NULL,
    Telefon VARCHAR(20) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Adres TEXT NOT NULL,
    UyelikBaslangic DATE NOT NULL,
    UyelikBitis DATE NOT NULL,
    PaketID INT,
    FOREIGN KEY (PaketID) REFERENCES uyelik_paketi(PaketID)
);

-- Eğitmen Tablosu
CREATE TABLE IF NOT EXISTS egitmen (
    EgitmenID INT AUTO_INCREMENT PRIMARY KEY,
    Ad VARCHAR(50) NOT NULL,
    Soyad VARCHAR(50) NOT NULL,
    Telefon VARCHAR(20) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    UzmanlikAlani VARCHAR(100) NOT NULL
);

-- Ders Tablosu
CREATE TABLE IF NOT EXISTS ders (
    DersID INT AUTO_INCREMENT PRIMARY KEY,
    DersAdi VARCHAR(100) NOT NULL,
    DersSuresi INT NOT NULL,
    DersSaati TIME NOT NULL,
    DersKapasitesi INT NOT NULL
);

-- Ders Programı Tablosu
CREATE TABLE IF NOT EXISTS ders_programi (
    ProgramID INT AUTO_INCREMENT PRIMARY KEY,
    DersID INT NOT NULL,
    EgitmenID INT NOT NULL,
    Gun VARCHAR(20) NOT NULL,
    Saat TIME NOT NULL,
    FOREIGN KEY (DersID) REFERENCES ders(DersID),
    FOREIGN KEY (EgitmenID) REFERENCES egitmen(EgitmenID)
);

-- Ekipman Tablosu
CREATE TABLE IF NOT EXISTS ekipman (
    EkipmanID INT AUTO_INCREMENT PRIMARY KEY,
    EkipmanAdi VARCHAR(100) NOT NULL,
    Adet INT NOT NULL
);

-- Üye Ders Kayıt Tablosu
CREATE TABLE IF NOT EXISTS uye_ders (
    KayitID INT AUTO_INCREMENT PRIMARY KEY,
    UyeID INT NOT NULL,
    ProgramID INT NOT NULL,
    FOREIGN KEY (UyeID) REFERENCES uye(UyeID),
    FOREIGN KEY (ProgramID) REFERENCES ders_programi(ProgramID)
); 