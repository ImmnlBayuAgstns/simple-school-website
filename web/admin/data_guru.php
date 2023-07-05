<nav class="navbar navbar-expand-lg navbar-dark"
        style="background: linear-gradient(120deg,#000000,rgb(11, 61, 65),#020102,#440356);">
        <div class="container">
            <a class="navbar-brand" href="#">Teacher Page</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form method="post">
                            <a class="btn btn-danger" href="admin.php" name="logout">Back</a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<!-- crud -->
<div class="crud">
<?php

// Membuat variable
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "multiuser"; 

// mengecek koneksi database
$koneksi    = mysqli_connect($host, $user, $pass, $db);
// cek koneksi database, jika koneksi tidak ada maka akan masuk ke dalam if statement
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}

// Membuat variable kosong yang akan di isi 
$nama       = '';
$telp      = '';
$cek;
$email    = '';
$sukses     = '';
$error      = '';


// op akan digunakan untuk menangkap variable yang ada di dalam url 
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == "delete") {
    $id = $_GET['id'];
    $sql1 = "delete from crud_guru where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = 'gagal melakukan hapus data';
    }
}


// Process Update Data
// Jika var op di url bernilai edit, maka tampilkan datanya
if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "select * from crud_guru where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);

    $nama = $r1['nama'];
    if ($nama == '') {
        $error = 'Data Tidak Ditemukan!';
    } else {
        $telp = $r1['telp'];
        
        $email = $r1['email'];
    }
}

//* proses create data
// jika tombol sudah ditekan maka akan masuk kedalam if 
if (isset($_POST['simpan'])) {

    
    // Membuat variable yang di isi dari input yang memiliki atribut name di dalam form, dan ambil valuenya
    $nama       = $_POST['nama'];
    $telp      = $_POST['telp'];
    $email    = $_POST['email'];

    // Jika variable di bawah ini ada isinya, maka akan masuk kedalam if
    if ($nama && $telp && $email) {


        // Melakukan pengecekan dari tabel nama
        $q = mysqli_query($koneksi, "SELECT * FROM crud_guru WHERE nama='$nama'");
        if($q) {
            $cek = mysqli_num_rows($q);
        } else {
            $cek = false;
        }

        //* Process update data
        if ($op == 'edit') {
            $sql1   = "update crud_guru set nama = '$nama', telp='$telp', email='$email' where id = '$id'";
            $q1     = mysqli_query($koneksi, $sql1);

            if ($q1 && $cek == 0) {
                $sukses = "Data berhasil di update";
            } else {
                $error = "Data gagal di update";
            }
        }
        //* untuk Memasukkan data
        else {
            // Jika var cek isinya 0, maka akan bernilai true
            if ($cek == 0) {
                // Memasukkan data kedalam database menggunakan sql
                $sql1   = "INSERT INTO crud_guru (nama, telp, email) VALUES ('$nama', '$telp', '$email');";
                $q1 = mysqli_query($koneksi, $sql1);
                $sukses     = "Berhasil memasukkan data!";
            }
            // sebaliknya
            else {
                $error      = 'nama duplikat!';
            }
        }
    }

    // Jika input dalam form tidak di isi akan masuk kedalam else.
    else {
        $error      = 'silahkan masukan semua data!';
    }
}



?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title> -->

    <!-- My CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <style>
        .mx-auto {
            width: 800px;
        }

        .card {
            margin-top: 10px;
        }

        .header {
            margin: 25px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- Untuk memasukkan data -->
        <h1 class="header">Data Guru</h1>
        <div class="card">
            <div class="card-header text-white"
                style="background: linear-gradient(120deg,#000000,rgb(11, 61, 65),#020102,#440356);">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                // Melalukan pengecekan, jika variable error ada isinya maka akan memunculkan alert danger
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:2;url=data_guru.php"); /* 5 : detik */   
                }
                ?>
                <?php
                // Jika variable sukses ada isinya maka akan memunculkan alert success. 
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:2;url=data_guru.php");
                }
                ?>
                <form action="" method="post">
                    <!-- input nama produk -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                    </div>
                    <!-- input kode produksi -->
                    <div class="mb-3">
                        <label for="kode" class="form-label">telpon</label>
                        <input type="number" class="form-control" id="kode" name="telp" value="<?php echo $telp ?>">
                    </div>
                    
                    <!-- input tipe produk -->
                    <div class="mb-3">
                        <label for="tipe" class="form-label">email</label>
                        <input type="email" class="form-control" id="tipe" name="email" value="<?php echo $email ?>">
                    </div>
                    <button type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary"
                style="background: linear-gradient(120deg,#000000,rgb(11, 61, 65),#020102,#440356);">
                Data Guru
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">telp</th>
                            
                            <th scope="col">email</th>
                        </tr>
                    <tbody>
                        <?php
                        //* Proses Read Data

                        $sql2   = "select * from crud_guru order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urutan = 1;

                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $nama       = $r2['nama'];
                            $telp      = $r2['telp'];
                            
                            $email    = $r2['email'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urutan++ ?></th>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $telp ?></td>    
                                <td scope="row"><?php echo $email ?></td>

                                <td scope="row" class="d-flex gap-2">
                                    <a href="data_guru.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <!-- <a href="data_guru.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('anda yakin?');"><button type="button" class="btn btn-danger">Delete</button></a> -->
                                    <a href="data_guru.php?op=delete&id=<?php echo $id ?>"
                                    onclick="return confirm('anda yakin?');"><button type="button"
                                        class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>


</html>

</div>