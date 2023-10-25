<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "crud1";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$NIM            = "";
$NAMA           = "";
$ALAMAT         = "";
$EMAIL          = "";
$JENIS_KELAMIN  = "";
$NO_HP          = "";
$sukses         = "";
$error          = "";


if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from mhs where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id             = $_GET['id'];
    $sql1           = "select * from mhs where id = '$id'";
    $q1             = mysqli_query($koneksi, $sql1);
    $r1             = mysqli_fetch_array($q1);
    $NIM            = $r1['NIM'];
    $NAMA           = $r1['NAMA'];
    $ALAMAT         = $r1['ALAMAT'];
    $EMAIL          = $r1['EMAIL'];
    $JENIS_KELAMIN  = $r1['JENIS_KELAMIN'];
    $NO_HP          = $r1['NO_HP'];


    if ($NIM == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $NIM            = $_POST['NIM'];
    $NAMA           = $_POST['NAMA'];
    $ALAMAT         = $_POST['ALAMAT'];
    $EMAIL          = $_POST['EMAIL'];
    $JENIS_KELAMIN  = $_POST['JENIS_KELAMIN'];
    $NO_HP          = $_POST['NO_HP'];



    if ($NIM && $NAMA && $ALAMAT && $EMAIL && $JENIS_KELAMIN && $NO_HP) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update mhs set NIM = '$NIM',NAMA='$NAMA',ALAMAT = '$ALAMAT',EMAIL='$EMAIL', JENIS_KELAMIN = '$JENIS_KELAMIN', NO_HP = '$NO_HP' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into mhs(NIM,NAMA,ALAMAT,EMAIL,JENIS_KELAMIN, NO_HP) values ('$NIM','$NAMA','$ALAMAT','$EMAIL','$JENIS_KELAMIN','$NO_HP')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 1400px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">KELOMPOK PDIP</span>
    </nav>
    <style>
body {
  background-image: url('');
  background-repeat: repeat;
  
}
</style>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:2;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:2;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="NIM" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="NIM" name="NIM" value="<?php echo $NIM ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="NAMA" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="NAMA" name="NAMA" value="<?php echo $NAMA ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ALAMAT" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ALAMAT" name="ALAMAT" value="<?php echo $ALAMAT ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="EMAIL" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="EMAIL" class="form-control" id="EMAIL" name="EMAIL" value="<?php echo $EMAIL ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="NO_HP" class="col-sm-2 col-form-label">Nomor HP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="NO_HP" name="NO_HP" value="<?php echo $NIM ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="JENIS_KELAMIN" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="JENIS_KELAMIN" id="JENIS_KELAMIN">
                                <option value="">- Pilih Kelamin -</option>
                                <option value="Laki-Laki" <?php if ($JENIS_KELAMIN == "Laki-Laki") echo "selected" ?>>Laki-Laki</option>
                                <option value="Perempuan" <?php if ($JENIS_KELAMIN == "Perempuan") echo "selected" ?>>Perempuan</option>
                            </select>
                        </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
        
        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Mahasiswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">Nomor HP</th>
                            <th scope="col">Jenis Kelamin</th>
                            
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from mhs order by id desc ";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id             = $r2['id'];
                            $NIM            = $r2['NIM'];
                            $NAMA           = $r2['NAMA'];
                            $ALAMAT         = $r2['ALAMAT'];
                            $EMAIL          = $r2['EMAIL'];
                            $NO_HP          = $r2['NO_HP'];
                            $JENIS_KELAMIN  = $r2['JENIS_KELAMIN'];
                            


                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $NIM ?></td>
                                <td scope="row"><?php echo $NAMA ?></td>
                                <td scope="row"><?php echo $ALAMAT ?></td>
                                <td scope="row"><?php echo $EMAIL ?></td>
                                <td scope="row"><?php echo $NO_HP ?></td>
                                <td scope="row"><?php echo $JENIS_KELAMIN ?></td>
                                
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>

</html>