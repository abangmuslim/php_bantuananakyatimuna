<?php
include "../koneksi.php";
header('Content-Type: application/json; charset=utf-8');

$search = isset($_GET['term']) ? $_GET['term'] : '';
$sql = "SELECT id_bantuan, nama_bantuan, nominal 
        FROM bantuan 
        WHERE nama_bantuan LIKE ? 
        ORDER BY nama_bantuan ASC LIMIT 20";
$stmt = $koneksi->prepare($sql);
$like = "%$search%";
$stmt->bind_param("s", $like);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'id' => $row['id_bantuan'],
        'text' => $row['nama_bantuan'],
        'nominal' => $row['nominal']
    ];
}

echo json_encode($data);
$stmt->close();
$koneksi->close();
