<?php
// db/ajax_penerima.php
include "../koneksi.php";

// Tangkap query pencarian dari Select2
$search = $_GET['q'] ?? '';
$search = mysqli_real_escape_string($koneksi, $search);

// Ambil maksimal 50 hasil untuk performa
$sql = "SELECT id_penerima, nama_penerima, kelas, pendapatan_orang_tua 
        FROM penerima 
        WHERE nama_penerima LIKE '%$search%' 
        ORDER BY nama_penerima ASC 
        LIMIT 50";

$result = mysqli_query($koneksi, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'id' => $row['id_penerima'],
        'text' => $row['nama_penerima'] . " | Kelas: " . ($row['kelas'] ?? '-') . " | Penghasilan: Rp " . number_format($row['pendapatan_orang_tua'] ?? 0,0,',','.'),
        'nama_penerima' => $row['nama_penerima'],
        'kelas' => $row['kelas'],
        'pendapatan_orang_tua' => $row['pendapatan_orang_tua']
    ];
}

// Kembalikan dalam format JSON untuk Select2
header('Content-Type: application/json');
echo json_encode(['results' => $data]);
