<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-header bg-gradient-primary mb-3">
            <div class="row">
                <div class="col tekstebal">
                    <strong>
                        <h5>Halaman Data Penerima</h5>
                    </strong>
                </div>
                <div class="col text-right">
                    <a href="index.php?halaman=tambahpenerima" class="btn btn-light btn-sm">
                        <i class="fas fa-user-plus"></i> Tambah Penerima
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped text-sm">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>NISP</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Pendapatan Ortu</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Pastikan $koneksi sudah tersedia dari index.php
                    $no = 1;
                    $sql = mysqli_query($koneksi, "SELECT * FROM penerima ORDER BY id_penerima DESC");
                    while ($data = mysqli_fetch_assoc($sql)) {
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td>" . htmlspecialchars($data['nisp']) . "</td>";
                        echo "<td>" . htmlspecialchars($data['nama_penerima']) . "</td>";
                        echo "<td>" . htmlspecialchars($data['kelas']) . "</td>";
                        echo "<td>" . htmlspecialchars($data['tanggal_lahir']) . "</td>";
                        echo "<td>" . htmlspecialchars($data['alamat']) . "</td>";
                        echo "<td>" . (!empty($data['status']) ? htmlspecialchars($data['status']) : "<span class='text-muted'>-</span>") . "</td>";
                        echo "<td>" . (!is_null($data['pendapatan_orang_tua']) ? 'Rp ' . number_format($data['pendapatan_orang_tua'], 0, ',', '.') : "<span class='text-muted'>-</span>") . "</td>";

                        // Ubah path direktori foto ke folder baru
                        echo "<td>";
                        if (!empty($data['foto']) && file_exists("views/penerima/fotopenerima/" . $data['foto'])) {
                            echo "<img src='views/penerima/fotopenerima/" . htmlspecialchars($data['foto']) . "' width='60' height='60' style='object-fit:cover;border-radius:8px;'>";
                        } else {
                            echo "<span class='text-muted'>Tidak ada</span>";
                        }
                        echo "</td>";

                        echo "<td>
          <a href='index.php?halaman=editpenerima&id_penerima={$data['id_penerima']}' class='btn btn-sm btn-success' title='Edit'><i class='fa fa-pencil-alt'></i></a>
          <a href='db/dbpenerima.php?proses=hapus&id_penerima={$data['id_penerima']}' class='btn btn-sm btn-danger' title='Hapus' onclick=\"return confirm('Yakin ingin menghapus data ini?')\"><i class='fa fa-trash'></i></a>
        </td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </tbody>

            </table>
        </div>

        <div class="card-footer">
            <small>Data Penerima - Aplikasi Bantuan Anak Yatim UNA</small>
        </div>
    </div>
</section>