<?php
// Start session
session_start();

// mengecek koneksi database
$koneksi = mysqli_connect('localhost', 'root', '', 'datasekolah');
// cek koneksi database, jika koneksi tidak ada maka akan masuk ke dalam if statement
if (!$koneksi) {
die("Tidak bisa terkoneksi ke database");
}

// Membuat variable kosong yang akan di isi
$username = '';
$password = '';
$tipe = '';
$sukses = '';
$error = '';


// op akan digunakan untuk menangkap variable yang ada di dalam url
if (isset($_GET['op'])) {
$op = $_GET['op'];
} else {
$op = "";
}

if ($op == "delete") {
$id = $_GET['id'];
$sql1 = "DELETE FROM datalogin WHERE id='$id'";
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
$sql1 = "SELECT * FROM datalogin WHERE id='$id'";
$q1 = mysqli_query($koneksi, $sql1);
$r1 = mysqli_fetch_array($q1);

$username = $r1['username'];
if ($username == '') {
$error = 'Data Tidak Ditemukan!';
} else {
$password = $r1['pass'];
$tipe = $r1['tipe'];
}
}

//* proses create data
// jika tombol sudah ditekan maka akan masuk kedalam if
if (isset($_POST['simpan'])) {
// Membuat variable yang di isi dari input yang memiliki atribut name di dalam form, dan ambil valuenya
$username = $_POST['username'];
$password = $_POST['pass'];
$tipe = $_POST['tipe'];

// Jika variable di bawah ini ada isinya, maka akan masuk kedalam if
if ($username && $password && $tipe) {


// Melakukan pengecekan dari tabel nama
$q = mysqli_query($koneksi, "SELECT * FROM datalogin WHERE username='$username'");
$cek = mysqli_num_rows($q);

//* Process update data
if ($op == 'edit') {
$sql1 = "UPDATE datalogin SET username = '$username', pass = '$password', tipe = '$tipe' WHERE id = '$id'";
$q1 = mysqli_query($koneksi, $sql1);

if ($q1 && $cek == 0) {
    $sukses = "Data berhasil di update ";
} else {
    $error = "Data gagal di update";
}
}
//* untuk Memasukkan data
else {
// Jika var cek isinya 0, maka akan bernilai true
if ($cek == 0) {
// Memasukkan data kedalam database menggunakan sql
$sql1 = "INSERT INTO datalogin (username, pass, tipe) VALUES ('$username', '$password', '$tipe')";
$q1 = mysqli_query($koneksi, $sql1);
$sukses = "Berhasil memasukkan data!";
}
// sebaliknya
else {
$error = 'Gagal memasukkan data!';
}
}
}

// Jika input dalam form tidak di isi akan masuk kedalam else.
else {
$error = 'silahkan masukan semua data!';
}
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
    .mx-auto {
        width: 800px;
    }

    .card {
        margin-top: 10px;
        border: none;
    }

    .header {
        margin: 25px;
        text-align: center;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark"
        style="background: linear-gradient(120deg,#000000,rgb(11, 61, 65),#020102,#440356);">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Page</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form action="admin.php">
                            <button class="btn btn-danger" name="logout">Back</button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="mx-auto">
        <div class="card">
            <div class="card-header text-white"
                style="background: linear-gradient(120deg,#000000,rgb(11, 61, 65),#020102,#440356);">
                Masukkan data
            </div>
            <div class=" card-body">
                <?php
                // Melalukan pengecekan, jika variable error ada isinya maka akan memunculkan alert danger
                if ($error) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
                <?php
                    header("refresh:2;url=signupadmin.php"); /* 5 : detik */
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
                    header("refresh:2;url=signupadmin.php");
                }
                ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name=" username" value="<?php echo $username ?>"
                            required oninvalid="this.setCustomValidity('Harap Masukan Username!')"
                            oninput="this.setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="pass" value="<?php echo $password ?>" required
                            oninvalid="this.setCustomValidity('Harap Masukan Password!')"
                            oninput="this.setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>Tipe Akun</label>
                        <select class="form-control" name="tipe" required
                            oninvalid="this.setCustomValidity('Harap Pilih Tipe Akun!')"
                            oninput="this.setCustomValidity('')">
                            <option value="" selected hidden></option>
                            <option value="admin" style="color: black;">Admin</option>
                            <option value="guru" style="color: black;">Guru</option>
                            <option value="siswa" style="color: black;">Siswa</option>
                        </select>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white"
                style="background: linear-gradient(120deg,#000000,rgb(11, 61, 65),#020102,#440356);">
                Data Akun
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Tipe</th>
                        </tr>
                    <tbody>
                        <?php
                        //* Proses Read Data

                        $sql2   = "SELECT * FROM datalogin ORDER BY id DESC";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urutan = 1;

                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $username    = $r2['username'];
                            $password     = $r2['pass'];
                            $tipe     = $r2['tipe'];

                        ?>
                        <tr>
                            <th scope="row"><?php echo $urutan++ ?></th>
                            <td scope="row"><?php echo $username ?></td>
                            <td scope="row"><?php echo $password ?></td>
                            <td scope="row"><?php echo $tipe?></td>
                            <td scope="row">
                                <a href="signupadmin.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                        class="btn btn-warning">Edit</button></a>
                                <a href="signupadmin.php?op=delete&id=<?php echo $id ?>"
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>