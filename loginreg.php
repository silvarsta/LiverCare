<?php
require 'config.php';

// REGISTER
if (isset($_POST["register"])) {
  $name = $_POST["name"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];

  // $hash_password = password_hash($password, PASSWORD_DEFAULT);
  // $hash_confirm = password_hash($confirmpassword, PASSWORD_DEFAULT);

  $duplicate = mysqli_query($connect, "SELECT * FROM userlogin WHERE username = '$username' OR email = '$email'");
  if (mysqli_num_rows($duplicate) > 0) {
    echo
    "<script> 
            alert ('Username or Email Has Already Taken');
        </script>";
  } else {
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO userlogin(name, username, email, password) 
                  VALUES('$name', '$username', '$email', '$hash_password')";
    if ($query) {

      mysqli_query($connect, $query);
      echo "<script>
                    alert('Registration Success');
                    document.location='loginreg.php';
                  </script>";
    } else {
      echo
      "<script>
                alert('Registration Failed');
            </script>";
    }
  }
}


// LOGIN
if (isset($_POST["login"])) {
  $usernameemail = $_POST['usernameemail'];
  $password = $_POST["password"];

  $cekdb = mysqli_query($connect, "SELECT * FROM userlogin where username = '$usernameemail' or email = '$usernameemail'");

  if (mysqli_num_rows($cekdb) == 1) {
    $id = mysqli_fetch_assoc(mysqli_query($connect, "SELECT id FROM userlogin WHERE username = '$usernameemail' or email = '$usernameemail'"))['id'];
    $name = mysqli_fetch_assoc(mysqli_query($connect, "SELECT name FROM userlogin WHERE username = '$usernameemail' or email = '$usernameemail'"))['name'];
    $email = mysqli_fetch_assoc(mysqli_query($connect, "SELECT email FROM userlogin WHERE username = '$usernameemail' or email = '$usernameemail'"))['email'];
    $count = mysqli_num_rows($cekdb);
    $pw = mysqli_fetch_assoc($cekdb);

    $passwordnow = $pw['password'];

    if ($count > 0) {
      if (password_verify($password, $passwordnow)) {

        session_start();
        $_SESSION['login'] = true;
        $_SESSION['username'] = $pw['username'];
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        header("location: index.php");
      } else {
        echo
        '<script>
          alert("Password Salah");
        </script>';
      }
    }
  } else {
    echo
    "<script>
      alert('Akun Tidak Ditemukan');
    </script>";
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login / Registration</title>
  <link rel="shortcut icon" type="image/png" href="img/icon.png"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <!-- REGISTER -->
  <div class="container" id="container">
    <div class="form-container register-container">
      <form action="" method="POST">

        <h1>Daftar Akun</h1>
        <input type="text" placeholder="Nama" name="name" required>
        <input type="text" placeholder="Username" name="username" required>
        <input type="email" placeholder="Email" name="email" required>
        <input type="password" placeholder="Password" name="password" required>
        <input type="password" placeholder="Konfirmasi Password" name="confirmpassword" required>
        <button type="submit" name="register">Daftar</button>
      </form>
    </div>


    <!-- LOGIN -->
    <div class="form-container login-container">
      <form action="" method="POST">
        <h1>Masuk</h1>
        <input type="username" placeholder="Username atau Email" name="usernameemail">
        <input type="password" placeholder="Password" name="password">
        <div class="content">
          <div class="checkbox">
            <input type="checkbox" name="checkbox" id="forget">
            <label>Ingat Saya</label>
          </div>
        </div>
        <button type="submit" name="login">Masuk</button>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div style="width:100%;height:0;padding-bottom:65%;position:relative;"><iframe src="https://giphy.com/embed/26n6OmfaR7wr0iXqU" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></div>
        <div class="overlay-panel overlay-left">
          <h1 class="title">Halooo</h1>
          <p>Klik disini jika sudah mempunyai akun</p>
          <button class="ghost" id="login">Masuk
            <i class="lni lni-arrow-left login"></i>
          </button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1 class="title">Buat Akun Baru</h1>
          <p>Jika belum memiliki akun, bergabunglah dengan kami dan mulailah perjalanan Anda.</p>
          <button class="ghost" id="register">Daftar Sekarang
            <i class="lni lni-arrow-right register"></i>
          </button>
        </div>
      </div>
    </div>

  </div>

  <script src="js/login.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>