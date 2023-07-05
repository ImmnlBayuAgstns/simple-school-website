<?php
session_start();
// Process signup form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['pass'];

    // Validate username, password, and account type against the database
    $conn = mysqli_connect('localhost', 'root', '', 'datasekolah');

    if ($conn) {
        $query = "INSERT INTO datalogin (nama, username, pass, tipe) VALUES ('$nama','$username', '$password', 'siswa')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Signup successful
            $_SESSION['nama'] = $nama;
            $_SESSION['username'] = $username;
            $_SESSION['pass'] = $nama;
            header('Location: index.php'); // Replace 'another_page.php' with the desired page to redirect
            exit;
        } else {
            $message = 'Gagal Membuat Akun';
        }

        mysqli_close($conn);
    } else {
        $message = 'Gagal Terhubung Ke Database';
    }
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Sign Up Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    .pln-logo {
        position: relative;
        top: 30px;
        left: 50%;
        transform: translateX(-50%);
        width: 150px;
        height: 150px;
        background-image: url(assets/images/letrisindo.png);
        background-size: cover;
        border-radius: 10px;
        animation: motion 1s ease-in-out infinite;
    }

    @keyframes motion {
        0% {
            transform: translateX(-50%) translateY(0);
        }

        50% {
            transform: translateX(-50%) translateY(-10px);
        }

        100% {
            transform: translateX(-50%) translateY(0);
        }
    }

    .bold-text {
        font-family: 'Montserrat', sans-serif;
        font-weight: 800;
        font-size: 28px;
    }


    /* Responsive Design */
    @media only screen and (max-width: 600px) {
        .center {
            margin: 0 10px;
        }

        .pln-logo {
            top: 10px;
            width: 150px;
            height: 50px;
        }

        .bold-text {
            font-size: 24px;
        }

        form {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <div class="">
        <form action="index.php">
            <button class="btn btn-danger" name="logout">Back</button>
        </form>
    </div>
    
    <div class="center">
        <br>
        <div class="pln-logo"></div>
        <br><br>
        <div class="bold-text">
            Login
        </div>
        <form method="post">
            <?php if (isset($message)): ?>
            <p>
            <h5 style="color:red; font-size:normal;"><?php echo $message; ?></h5>
            <?php endif; ?>
            <div class="txt_field">
                <input type="text" name="nama" required
                    oninvalid="this.setCustomValidity('Harap Masukan Nama Lengkap!')"
                    oninput="this.setCustomValidity('')">
                <span></span>
                <label>Nama Lengkap</label>
            </div>

            <div class="txt_field">
                <input type="text" name="username" required
                    oninvalid="this.setCustomValidity('Harap Masukan Username!')" oninput="this.setCustomValidity('')">
                <span></span>
                <label>Username</label>
            </div>

            <div class="txt_field">
                <input type="password" name="pass" required
                    oninvalid="this.setCustomValidity('Harap Masukan Password!')" oninput="this.setCustomValidity('')">
                <span></span>
                <label>Password</label>
            </div>

            <button type="submit" name="submit">Signup</button>
        </form>
        <div class="signup_link">

        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>