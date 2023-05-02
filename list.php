<!-- INI HALAMAN YANG NAMPILIN DATA USER YANG UDAH CHECK UP -->

<?php
include('./koneksi.php');

session_start();
// Jika belum login, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: landing.php");
}

$id_user = $_SESSION['id'];
$user = mysqli_query($connect, "SELECT * FROM data_user WHERE id_user = $id_user");
$data = mysqli_fetch_assoc($user);

if (isset($_POST['hapus'])) {
    $id_user = $_SESSION['id'];
    $tanggal = $data['tanggal'];
    $waktu = $data['waktu'];
    $hapus = mysqli_query($connect, "DELETE FROM data_user WHERE id_user = $id_user AND tanggal = '$tanggal' AND waktu = '$waktu'");
    if ($hapus) {
        echo "<script>
                  alert('Data Berhasil Dihapus');
                  document.location='list.php';
                </script>";
    } else {
        echo "<script>
                  alert('Data Gagal Dihapus');
                  document.location='list.php';
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
    <title>Riwayat Diagnosa</title>
    <link rel="shortcut icon" type="image/png" href="img/icon.png">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid bg-white shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
                <a href="index.php" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-info"><i class="fa fa-clinic-medical me-3"></i>LiverCare</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="formdiagnosa.php" class="nav-item nav-link">Check up</a>
                        <a href="list.php" class="nav-item nav-link active">Check up List</a>
                        <a href="index.php#article" class="nav-item nav-link">Article</a>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="index.php#about" class="dropdown-item">About</a>
                                <a href="index.php#service" class="dropdown-item">Service</a>
                                <a href="#blog" class="dropdown-item">Blog</a>
                                <br>
                                <a href="confussion.php" class="dropdown-item">Confussion Matriks</a>
                                <br>
                                <a href="#footer" class="dropdown-item">Contact</a>
                                <a href="logout.php" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <div class="container">
        <br>
        <h4>
            <center>Data Diagnosa</center>
        </h4>
        <div class="table-responsive">
            <table class="my-3 table table-bordered">
                <caption>
                    Keterangan : <br>
                    0 = Tidak Beresiko Terkena Penyakit Liver <br>
                    1 = Beresiko Terkena Penyakit Liver
                </caption>
                <br>
                <thead>
                    <tr class="table-info align-middle text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal Cek</th>
                        <th>Kadar Alkphos Alkaline Phosphatase</th>
                        <th>Kadar Serum Glutamic Pyruvic Transaminase (SGPT)</th>
                        <th>Kadar Serum Glutamic Oxaloacetic Transaminase (SGOT)</th>
                        <th>K-Means</th>
                        <th>Bayes</th>
                        <th>Persentase</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <?php
                $no = 1;
                $id_user = $_SESSION['id'];
                $user = mysqli_query($connect, "SELECT * FROM data_user WHERE id_user = $id_user");
                if (mysqli_num_rows($user) > 0) {
                    while ($data = mysqli_fetch_assoc($user)) :
                ?>
                        <tbody>
                            <tr class="align-middle text-center">
                                <td><?= $no++; ?></td>
                                <td><?= $data["nama"]; ?></td>
                                <td><?= $data['tanggal']; ?></td>
                                <td><?= $data["alkphos"]; ?></td>
                                <td><?= $data["sgpt"]; ?></td>
                                <td><?= $data["sgot"]; ?></td>
                                <td><?= $data["kmeans"]; ?></td>
                                <td><?= $data["bayes"]; ?></td>
                                <td><?= $data["persentase"]; ?> % </td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="submit" value="Hapus" name="hapus" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    <?php endwhile;
                } else {
                    ?>
                    <tbody>
                        <tr class="align-middle text-center">
                            <td colspan="10">Tidak Ada Data</td>
                        </tr>
                    </tbody>
                <?php
                } ?>
            </table>

        </div>
        <!-- isi -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </div>
</body>

</html>