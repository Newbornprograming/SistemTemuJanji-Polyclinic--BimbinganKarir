<section >
    <?php 
        $idDaftarPoli = $_GET['id'];
        require 'config/koneksi.php';
        $dataDetail = mysqli_query($mysqli,"SELECT *, DATE_FORMAT(periksa.tgl_periksa, '%d, %M %Y') as tglPeriksa FROM daftar_poli INNER JOIN pasien ON daftar_poli.id_pasien = pasien.id INNER JOIN periksa ON periksa.id_daftar_poli = daftar_poli.id WHERE daftar_poli.id = '$idDaftarPoli'");
        $getDataDetail = mysqli_fetch_assoc($dataDetail);
    ?>
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Poliklinik
                    <small class="float-right"><?php echo $getDataDetail['tglPeriksa'] ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Dokter
                  <address>
                        <?php 
                            require 'config/koneksi.php';
                            $idDokter = $_SESSION['id'];
                            $dataPoli = mysqli_query($mysqli,"SELECT poli.nama_poli, dokter.alamat, dokter.no_hp FROM poli INNER JOIN dokter ON poli.id = dokter.id_poli WHERE dokter.id = '$idDokter'");
                            $getDataDokter = mysqli_fetch_assoc($dataPoli);
                        ?>
                        <strong><?php echo $username ?></strong><br>
                        Poli <?php echo $getDataDokter['nama_poli'] ?><br>
                        <?php echo $getDataDokter['alamat'] ?><br>
                        No. HP: <?php echo $getDataDokter['no_hp'] ?><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Pasien
                  <address>
                        <strong><?php echo $getDataDetail['nama'] ?></strong><br>
                        <?php echo $getDataDetail['alamat'] ?><br>
                        No. Telp: <?php echo $getDataDetail['no_hp'] ?><br>
                        No. RM: <?php echo $getDataDetail['no_rm'] ?>
                  </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Obat</th>
                      <th>Harga</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            require 'config/koneksi.php';
                            $dataObat = mysqli_query($mysqli, "SELECT * FROM detail_periksa INNER JOIN periksa ON 
                            detail_periksa.id_periksa = periksa.id INNER JOIN daftar_poli ON periksa.id_daftar_poli = daftar_poli.id 
                            INNER JOIN obat on detail_periksa.id_obat = obat.id WHERE daftar_poli.id = '$idDaftarPoli'");
                            while ($getDataObat = mysqli_fetch_assoc($dataObat)) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $getDataObat['nama_obat'] ?></td>
                            <td>Rp. <?php echo number_format($getDataObat['harga'], 0, ',', '.') ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6 mt-3">
                  <p class="lead">Metode Pembayaran</p>
                  <img src="assets/dist/img/credit/visa.png" alt="Visa">
                  <img src="assets/dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="assets/dist/img/credit/american-express.png" alt="American Express">
                  <img src="assets/dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Terima kasih atas transaksi Anda. Silahkan melakukan pembayaran sesuai dengan jumlah yang tertera dan 
                    metode pembayaran yang dipilih. Mohon untuk melakukan pembayaran segera.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Biaya Periksa:</th>
                            <td>Rp. 
                                <?php echo number_format($getDataDetail['biaya_periksa'], 0, ',', '.') ?>
                            </td>
                        </tr>
                        <tr>
                            <?php
                                require 'config/koneksi.php';
                                $getHarga = mysqli_query($mysqli, "SELECT SUM(obat.harga) as hargaObat FROM detail_periksa INNER JOIN periksa 
                                ON detail_periksa.id_periksa = periksa.id INNER JOIN daftar_poli ON periksa.id_daftar_poli = daftar_poli.id 
                                INNER JOIN obat on detail_periksa.id_obat = obat.id WHERE daftar_poli.id = '$idDaftarPoli'");
                                $harga = mysqli_fetch_assoc($getHarga);
                            ?>
                            <th>Obat</th>
                            <td>Rp. <?php echo number_format($harga['hargaObat'], 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>Rp.
                                <?php echo number_format($harga['hargaObat'] + $getDataDetail['biaya_periksa'], 0, ',', '.') ?>
                            </td>
                        </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <!-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <a href="periksaPasien.php" class="text-white">Close</a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</section>