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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="">
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
                            <a class="btn btn-primary " href="tambah.php">Tambah Absen</a>
                            <a class="btn btn-danger" href="dashboard.php" name="logout">Back</a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="mx-auto">
        <!-- Untuk memasukkan data -->
        <div class="card">
        

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white"
                style="background: linear-gradient(120deg,#000000,rgb(11, 61, 65),#020102,#440356);">
                Data Absen
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Jurusan</th>
                        </tr>
                    <tbody>
                    <?php
                            // Proses Read Data
                            $sql2 = "SELECT * FROM absen WHERE kelas = '11' AND jurusan = 'tkj' ORDER BY id DESC";
                            $q2 = mysqli_query($koneksi, $sql2);
                            $urutan = 1;

                            while ($r2 = mysqli_fetch_array($q2)) {
                                $id = $r2['id'];
                                $nama = $r2['nama'];
                                $kelas = $r2['kelas'];
                                $jurusan = $r2['jurusan'];
                            ?>
                        <tr>
                            <th scope="row"><?php echo $urutan++ ?></th>
                            <td scope="row"><?php echo $nama ?></td>
                            <td scope="row"><?php echo $kelas ?></td>
                            <td scope="row"><?php echo $jurusan?></td>
                            <td scope="row">
                                <a href="tambah.php?op=edit&id=<?php echo $id ?>"><button type="button"
                                        class="btn btn-warning">Edit</button></a>
                                <!-- <a href="tambah.php?op=delete&id=<?php echo $id ?>"
                                    onclick="return confirm('anda yakin?');"><button type="button"
                                        class="btn btn-danger">Delete</button></a> -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>