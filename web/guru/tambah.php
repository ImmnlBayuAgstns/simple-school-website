<?php
// Start session
session_start();

// Check if the user is already logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page
    header("Location: ../index.php");
    exit();
}

// Check if the logout form is submitted
if (isset($_POST['logout'])) {
    // Destroy session and redirect to login page
    session_destroy();
    header("Location: ../index.php");
    exit();
}

// mengecek koneksi database
$koneksi = mysqli_connect('localhost', 'root', '', 'datasekolah');
// cek koneksi database, jika koneksi tidak ada maka akan masuk ke dalam if statement
if (!$koneksi) {
die("Tidak bisa terkoneksi ke database");
}

// Membuat variable kosong yang akan di isi
$nama = '';
$kelas = '';
$jurusan = '';
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
$sql1 = "DELETE FROM absen WHERE id='$id'";
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
$sql1 = "SELECT * FROM absen WHERE id='$id'";
$q1 = mysqli_query($koneksi, $sql1);
$r1 = mysqli_fetch_array($q1);

$nama = $r1['nama'];
if ($nama == '') {
$error = 'Data Tidak Ditemukan!';
} else {
$kelas = $r1['kelas'];
$jurusan = $r1['jurusan'];
}
}

//* proses create data
// jika tombol sudah ditekan maka akan masuk kedalam if
if (isset($_POST['simpan'])) {
// Membuat variable yang di isi dari input yang memiliki atribut name di dalam form, dan ambil valuenya
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];

// Jika variable di bawah ini ada isinya, maka akan masuk kedalam if
if ($nama && $kelas && $jurusan) {


// Melakukan pengecekan dari tabel nama
$q = mysqli_query($koneksi, "SELECT * FROM absen WHERE nama='$nama'");
$cek = mysqli_num_rows($q);

//* Process update data
if ($op == 'edit') {
$sql1 = "UPDATE absen SET nama = '$nama', kelas = '$kelas', jurusan = '$jurusan' WHERE id = '$id'";
$q1 = mysqli_query($koneksi, $sql1);

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
$sql1 = "INSERT INTO absen (nama, kelas, jurusan) VALUES ('$nama', '$kelas', '$jurusan')";
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
            <a class="navbar-brand" href="#">Teacher Page</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto p-4 p-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        ABSEN SISWA
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="xrpl.php">X RPL</a></li>
                        <li><a class="dropdown-item" href="xtkj.php">X TKJ</a></li>
                        <li><a class="dropdown-item" href="xmm.php">X MM</a></li>
                        <li><a class="dropdown-item" href="xirpl.php">XI RPL</a></li>
                        <li><a class="dropdown-item" href="xitkj.php">XI TKJ</a></li>
                        <li><a class="dropdown-item" href="ximm.php">XI MM</a></li> 
                        <li><a class="dropdown-item" href="xiirpl.php">XII RPL</a></li>
                        <li><a class="dropdown-item" href="xiitkj.php">XII TKJ</a></li>
                        <li><a class="dropdown-item" href="xiimm.php">XII MM</a></li>
                    </ul>
                </li>
            </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form method="post">
                            <a class="btn btn-danger" href="dashboard.php">Back</a>
                        </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="mx-auto">
        <!-- Untuk memasukkan data -->
        <div class="card">
            <div class="card-header text-white"
                style="background: linear-gradient(120deg,#000000,rgb(11, 61, 65),#020102,#440356);">
                Input Data Absen
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
                    header("refresh:2;url=tambah.php"); /* 5 : detik */
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
                    header("refresh:2;url=tambah.php");
                }
                ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" required
                            oninvalid="this.setCustomValidity('Harap Masukan Nama Lengkap!')"
                            oninput="this.setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label>Kelas</label>
                        <select class="form-control" name="kelas" required
                            oninvalid="this.setCustomValidity('Harap Pilih Kelas!')"
                            oninput="this.setCustomValidity('')">
                            <option value="" selected hidden>Pilih Kelas</option>
                            <option value="10" style="color: black;">10</option>
                            <option value="11" style="color: black;">11</option>
                            <option value="12" style="color: black;">12</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>jurusan</label>
                        <select class="form-control" name="jurusan" required
                            oninvalid="this.setCustomValidity('Harap Pilih Jurusan Akun!')"
                            oninput="this.setCustomValidity('')">
                            <option value="" selected hidden>Pilih Jurusan</option>
                            <option value="rpl" style="color: black;">RPL</option>
                            <option value="tkj" style="color: black;">TKJ</option>
                            <option value="mm" style="color: black;">MM</option>
                        </select>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>