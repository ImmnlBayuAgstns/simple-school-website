<?php
session_start();

// Check if the user is already logged in and redirect to the appropriate page


$message = '';

// Process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $tipe = $_POST['tipe'];

    // Validate username, password, and account type against the database
    $conn = mysqli_connect('localhost', 'root', '', 'datasekolah');

    if ($conn) {
        $query = "SELECT * FROM datalogin WHERE username = '$username' AND pass = '$password' AND tipe = '$tipe'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            // Login successful
            $_SESSION['username'] = $username;
            $_SESSION['tipe'] = $tipe;
            redirect($tipe);
        } else {
            $message = 'Invalid username, password, or account type.';
        }

        mysqli_close($conn);
    } else {
        $message = 'Failed to connect to the database.';
    }
}

// Redirect function to redirect users based on account type
function redirect($tipe)
{
    switch ($tipe) {
        case 'admin':
            header('Location: admin/admin.php');
            break;
        case 'guru':
            header('Location: guru/dashboard.php');
            break;
        case 'siswa':
            header('Location: siswa/dashboard.php');
            break;
        default:
            header('Location: index.php');
            break;
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login Page</title>
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
                <input type="text" name="username" id="username" required
                    oninvalid="this.setCustomValidity('Harap Masukan Username!')" oninput="this.setCustomValidity('')">
                <span></span>
                <label>Username</label>
            </div>

            <div class="txt_field">
                <input type="password" name="pass" id="password" required
                    oninvalid="this.setCustomValidity('Harap Masukan Password!')" oninput="this.setCustomValidity('')">
                <span></span>
                <label>Password</label>
            </div>

            <div class="txt_field">
                <select style="border:none; " class="form-control" name="tipe" required
                    oninvalid="this.setCustomValidity('Harap Pilih Tipe Akun!')" oninput="this.setCustomValidity('')">
                    <option value="" selected hidden></option>
                    <option value="admin" style="color: black;">Admin</option>
                    <option value="guru" style="color: black;">Guru</option>
                    <option value="siswa" style="color: black;">Siswa</option>
                </select>
                <span></span>
                <label>Account Type</label>
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
        <div class="signup_link">

        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>