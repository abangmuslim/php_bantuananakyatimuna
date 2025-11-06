<?php
// views/transaksi/cetakstruk.php

include "../../koneksi.php";

// Ambil id_transaksi dari query string
$id_transaksi = isset($_GET['id_transaksi']) ? intval($_GET['id_transaksi']) : 0;

if ($id_transaksi <= 0) {
    echo "Transaksi tidak ditemukan.";
    exit();
}

// Ambil data transaksi lengkap termasuk kelas penerima
$sql = "
SELECT t.*, p.nama_penerima, p.kelas, b.nama_bantuan, b.nominal, a.nama_admin
FROM transaksi t
JOIN penerima p ON t.id_penerima = p.id_penerima
JOIN bantuan b ON t.id_bantuan = b.id_bantuan
JOIN admin a ON t.id_admin = a.id_admin
WHERE t.id_transaksi = '$id_transaksi'
";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Transaksi tidak ditemukan.";
    exit();
}

// Path foto bukti
$fotoBukti = !empty($data['foto']) ? "../../views/transaksi/fototransaksi/" . $data['foto'] : "";

// Tempat & tanggal
$lokasi = "Karang Baru, " . date('d-m-Y');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi #<?= $data['id_transaksi']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .struk {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #333;
        }

        .struk h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .struk table {
            width: 100%;
            border-collapse: collapse;
        }

        .struk table td {
            padding: 5px;
            vertical-align: top;
        }

        .struk table td.label {
            font-weight: bold;
            width: 40%;
        }

        .foto-bukti {
            margin-top: 15px;
            text-align: center;
        }

        .foto-bukti img {
            max-width: 100%;
            max-height: 250px;
            object-fit: contain;
            border: 1px solid #ccc;
            padding: 5px;
        }

        .print-button {
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .print-button button {
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
        }

        .tanda-tangan {
            margin-top: 40px;
            text-align: center;
        }

        .tanda-tangan p {
            margin: 5px 0;
        }

        @media print {
            .print-button {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="struk">
        <div class="print-button">
            <button onclick="window.print();">Cetak Struk</button>
            <button onclick="window.close();">Keluar</button>
        </div>

        <h2>Struk Transaksi Bantuan</h2>

        <table>
            <tr>
                <td class="label">ID Transaksi</td>
                <td>: <?= $data['id_transaksi']; ?></td>
            </tr>
            <tr>
                <td class="label">Nama Penerima</td>
                <td>: <?= htmlspecialchars($data['nama_penerima']); ?></td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td>: <?= htmlspecialchars($data['kelas']); ?></td>
            </tr>
            <tr>
                <td class="label">Bantuan</td>
                <td>: <?= htmlspecialchars($data['nama_bantuan']); ?></td>
            </tr>
            <tr>
                <td class="label">Nominal</td>
                <td>: Rp <?= number_format($data['nominal'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td class="label">Admin</td>
                <td>: <?= htmlspecialchars($data['nama_admin']); ?></td>
            </tr>
            <tr>
                <td class="label">Tanggal Pembayaran</td>
                <td>: <?= htmlspecialchars($data['tanggal_pembayaran']); ?></td>
            </tr>
        </table>

        <?php if (!empty($fotoBukti)) : ?>
            <div class="foto-bukti">
                <p>Bukti Pembayaran:</p>
                <img src="<?= htmlspecialchars($fotoBukti); ?>" alt="Bukti Transaksi">
            </div>
        <?php endif; ?>

        <div class="tanda-tangan">
            <p><?= $lokasi; ?></p>
            <p>Penerima,</p>
            <br><br>
            <p><b><?= htmlspecialchars($data['nama_penerima']); ?></b></p>
        </div>

        <p style="text-align:center; margin-top:20px;">-- Terima Kasih --</p>
    </div>

</body>

</html>
