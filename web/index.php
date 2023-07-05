<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .jumbo-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .letLogo {
        position: relative;
        top: 30px;
        left: 50%;
        transform: translateX(-50%);
        width: 150px;
        height: 150px;
        background-image: url(assets/images/letrisindo.png);
        background-size: cover;
        border-radius: 10px;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark"
            style="background: linear-gradient(120deg,#000000,rgb(11, 61, 65),#020102,#440356);
">
        <a class="navbar-brand" href="#">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
            </ul>
            <span class="navbar-text">
            </span>
        </div>
    </div>
        <div class="me-2 text-right d-flex">
            <a href="login.php" class="btn d-flex btn-lg text-white mr-3 bg-primary">Login</a>
            <a href="signup.php" class="btn  btn-lg text-black bg-light">Sign up</a>
        </div>
    </nav>
    <div style="background-image: url('assets/images/LOGOLETRIS.jpg'); 
        width: 100%; 
        height: 100vh; 
        background-size: cover;">

        <div class="letLogo"></div>

        <div class=""> 
            <div class="container text-center text-black jumbo-text">
            <h1>SELAMAT DATANG DI HALAMAN UTAMA</h1>
            <p class="text-white">SILAHKAN LOGIN JIKA SUDAH MEMILIKI AKUN</p>
            <p class="text-white">Signup Jika Belum Memiliki Akun</p>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bo/botstrapcdn.comootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>