<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Profile Dokter</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="assets/dist/img/avatar4.png"
                       alt="User profile picture">
                </div>
                <?php 
                    require 'config/koneksi.php';
                    $dataDokter = mysqli_query($mysqli, "SELECT dokter.nama, poli.nama_poli, dokter.alamat, dokter.no_hp FROM dokter INNER JOIN poli ON dokter.id_poli = poli.id WHERE dokter.id = '$id_dokter'");
                    $getData = mysqli_fetch_assoc($dataDokter);
                ?>
                    <h3 class="profile-username text-center"><b><?php echo $getData['nama'] ?></b></h3>
                    <p class="text-muted text-center"><b>Poli <?php echo $getData['nama_poli'] ?></b></p>
                    <div class="card-body">
                        <strong><i class="fas fa-map-marker-alt"></i> Alamat</strong>
                        <p class="text-muted"><?php echo $getData['alamat'] ?></p>
                        <hr>
                        <strong><i class="fas fa-phone mr-1"></i> Telepon</strong>
                        <p class="text-muted"><?php echo $getData['no_hp'] ?></p>
                    </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-success">
              <div class="card-header p-2 ">
                    <h3 class="card-title mx-2">Edit Profile</h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">

                    <!-- Post -->
                    <div class="tab-pane" id="settings">
                    <form action="pages/profile/editProfile.php" method="post">
                      <input type="hidden" value="<?php echo $id_dokter ?>" name="idDokter">
                      <div class="form-group row">
                        <label for="nama font-weight-bold" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama"
                            value="<?php echo $getData['nama'] ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="no_hp font-weight-bold" class="col-sm-2 col-form-label">No. HP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="no_hp"
                            value="<?php echo $getData['no_hp'] ?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="alamat font-weight-bold" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" id="alamat" name="alamat"
                            required><?php echo $getData['alamat'] ?></textarea>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>