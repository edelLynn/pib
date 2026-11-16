CREATE DATABASE IF NOT EXISTS kompos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kompos;

CREATE TABLE IF NOT EXISTS batches (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    owner CHAR(32) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    mulai_tanggal DATE NOT NULL,
    terakhir_dibalik DATE NULL,
    terakhir_dicek DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (owner)
);
