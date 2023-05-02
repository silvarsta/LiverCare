<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LIVERCARE</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="shortcut icon" type="image/png" href="img/icon.png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid bg-white shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
                <a href="#" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-info"><i class="fa fa-clinic-medical me-3"></i>LiverCare</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="#" class="nav-item nav-link active">Home</a>
                        <a href="loginreg.php" class="nav-item nav-link">Check up</a>
                        <a href="loginreg.php" class="nav-item nav-link">Check up List</a>
                        <a href="#article" class="nav-item nav-link">Article</a>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="login.php" class="dropdown-item">About</a>
                                <a href="login.php" class="dropdown-item">Service</a>
                                <a href="#blog" class="dropdown-item">Blog</a>
                                <br>
                                <a href="login.php" class="dropdown-item">Confussion Matriks</a>
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


    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header" style="background-image: url('./img/hero5.jpg');">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h5 class="d-inline-block text-info text-uppercase border-bottom border-5" style="border-color: rgba(256, 256, 256, .3) !important;">Welcome To LiverCare</h5>
                    <h1 class="display-1 text-white mb-md-4">Best Healthcare Solution For U</h1>
                    <div class="pt-2">
                        <a href="loginreg.php" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- About Start -->
    <div class="about" id="about">
        <div class="container-fluid py-5">
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100 rounded" src="img/hero02.jpg" style="object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="mb-4">
                            <h5 class="d-inline-block text-info text-uppercase border-bottom border-5">About Us</h5>
                            <h1 class="display-4">Best Medical Check For Yourself</h1>
                        </div>
                        <p>Selamat datang di website checkup kesehatan kami yang difokuskan pada pemeriksaan kesehatan
                            hati. Dalam kehidupan sehari-hari, seringkali kita tidak menyadari bahaya penyakit hati yang
                            dapat terjadi tanpa gejala yang jelas. Oleh karena itu, penting bagi kita untuk melakukan
                            pemeriksaan kesehatan secara berkala, terutama untuk organ hati yang memiliki peran vital
                            dalam menjaga kesehatan tubuh. Melalui website kami, Anda dapat melakukan pemeriksaan
                            kesehatan hati secara online dan mudah, sehingga Anda dapat memastikan bahwa organ hati Anda
                            dalam kondisi sehat dan prima.</p>
                        <div class="row g-3 pt-3">
                            <div class="col-sm-3 col-6">
                                <div class="bg-light text-center rounded-circle py-4">
                                    <i class="fa fa-3x fa-user-md text-info mb-3"></i>
                                    <h6 class="mb-0">Complete<small class="d-block text-primary">Information</small>
                                    </h6>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6">
                                <div class="bg-light text-center rounded-circle py-4">
                                    <i class="fa fa-3x fa-procedures text-info mb-3"></i>
                                    <h6 class="mb-0">Much<small class="d-block text-primary">Tips</small></h6>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6">
                                <div class="bg-light text-center rounded-circle py-4">
                                    <i class="fa fa-3x fa-microscope text-info mb-3"></i>
                                    <h6 class="mb-0">Accurate<small class="d-block text-primary">Testing</small></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Article Start -->
    <div class="container-fluid py-5" id="article">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-info text-uppercase border-bottom border-5">Articles</h5>
                <h1 class="display-4">Awesome Health Articels</h1>
            </div>
            <div class="owl-carousel price-carousel position-relative" style="padding: 0 45px 45px 45px;">
                <div class="bg-light rounded text-center">
                    <div class="position-relative">
                        <img class="img-fluid rounded-top" src="./img/price1.jpg" alt="">
                        <div class="position-absolute w-100 h-100 top-50 start-50 translate-middle rounded-top d-flex flex-column align-items-center justify-content-center" style="background: rgba(29, 42, 77, .8);">
                            <h3 class="text-white">Apa itu ... (alkphose, sgot, sgpt)</h3>
                        </div>
                    </div>
                    <div class="text-center py-5">
                        <p>Alkphose yaitu enzim dalam metabolisme fosfat, yang dapat diukur dalam tes darah untuk
                            mengevaluasi fungsi hati</p>
                        <p>Definisi SGOT</p>
                        <p>Definisi SGPT</p>
                        <p>...</p>
                        <a href="loginreg.php" class="btn btn-info rounded-pill py-3 px-5 my-2 text-white">More</a>
                    </div>
                </div>
                <div class="bg-light rounded text-center">
                    <div class="position-relative">
                        <img class="img-fluid rounded-top" src="./img/price2.jpg" alt="">
                        <div class="position-absolute w-100 h-100 top-50 start-50 translate-middle rounded-top d-flex flex-column align-items-center justify-content-center" style="background: rgba(29, 42, 77, .8);">
                            <h3 class="text-white">Berbagai Macam Penyakit Liver</h3>
                        </div>
                    </div>
                    <div class="text-center py-5">
                        <p>Hepatitis A, B, C, D, dan E</p>
                        <p>Sirosis Hati</p>
                        <p>Kanker Hati</p>
                        <p>Penyakit Hati Autoimun</p>
                        <a href="loginreg.php" class="btn btn-info rounded-pill py-3 px-5 my-2 text-white">More</a>
                    </div>
                </div>
                <div class="bg-light rounded text-center">
                    <div class="position-relative">
                        <img class="img-fluid rounded-top" src="./img/price3.jpg" alt="">
                        <div class="position-absolute w-100 h-100 top-50 start-50 translate-middle rounded-top d-flex flex-column align-items-center justify-content-center" style="background: rgba(29, 42, 77, .8);">
                            <h3 class="text-white">Faktor-Faktor Penyebab</h3>
                        </div>
                    </div>
                    <div class="text-center py-5">
                        <p>Konsumsi alkohol yang berlebihan</p>
                        <p>Inveksi virus</p>
                        <p>Obesitas dan Diabetes</p>
                        <p>Penggunaan obat-obatan tertentu</p>
                        <a href="loginreg.php" class="btn btn-info rounded-pill py-3 px-5 my-2 text-white">More</a>
                    </div>
                </div>
                <div class="bg-light rounded text-center">
                    <div class="position-relative">
                        <img class="img-fluid rounded-top" src="img/price4.jpg" alt="">
                        <div class="position-absolute w-100 h-100 top-50 start-50 translate-middle rounded-top d-flex flex-column align-items-center justify-content-center" style="background: rgba(29, 42, 77, .8);">
                            <h3 class="text-white">Gejala</h3>
                        </div>
                    </div>
                    <div class="text-center py-5">
                        <p>Nyeri atau rasa tidak nyaman di perut bagian kanan atas</p>
                        <p>Kuning pada kulit atau mata (jaundice)</p>
                        <p>Pendarahan yang tidak normal, seperti mudah memar</p>
                        <p>Pembengkakan di kaki atau perut</p>
                        <a href="loginreg.php" class="btn btn-info rounded-pill py-3 px-5 my-2 text-white">More</a>
                    </div>
                </div>
                <div class="bg-light rounded text-center">
                    <div class="position-relative">
                        <img class="img-fluid rounded-top" src="img/price2.jpg" alt="">
                        <div class="position-absolute w-100 h-100 top-50 start-50 translate-middle rounded-top d-flex flex-column align-items-center justify-content-center" style="background: rgba(29, 42, 77, .8);">
                            <h3 class="text-white">Cara Mencegah</h3>
                        </div>
                    </div>
                    <div class="text-center py-5">
                        <p>Hindari mengkonsumsi alkohol berlebihan</p>
                        <p>Makan makanan yang sehat</p>
                        <p>Menjalani gaya hidup sehat</p>
                        <p>Hindari penggunaan obat-obatan yang berlebihan</p>
                        <a href="loginreg.php" class="btn btn-info rounded-pill py-3 px-5 my-2 text-white">More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing Plan End -->

    <!-- Blog Start -->
    <div class="container-fluid py-5" id="blog">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <h5 class="d-inline-block text-info text-uppercase border-bottom border-5">Blog Post</h5>
                <h1 class="display-4">Medical Blog Posts</h1>
            </div>
            <div class="row g-5">
                <div class="col-xl-4 col-lg-6">
                    <div class="bg-light rounded overflow-hidden">
                        <img class="img-fluid w-100" src="img/blog1.jpg" alt="">
                        <div class="p-4">
                            <a class="h3 d-block mb-3 text-info" href="https://health.kompas.com/read/2021/12/31/213100168/5-penyebab-penyakit-liver-yang-perlu-diwaspadai?page=all">5
                                Penyebab Penyakit Liver yang Perlu Diwaspadai</a>
                            <p class="m-0">Beragam penyakit liver dapat menyebabkan munculnya jaringan parut di organ
                                liver atau hati.
                                Sebelum mengenali beberapa penyebab penyakit liver dan cara mencegah masalah kesehatan
                                ini, simak dulu apa itu penyakit liver.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="bg-light rounded overflow-hidden">
                        <img class="img-fluid w-100" src="img/blog2.jpg" alt="">
                        <div class="p-4">
                            <a class="h3 d-block mb-3 text-info" href="https://health.kompas.com/read/2022/07/27/190100268/8-penyebab-sirosis-hati-dari-alkohol-sampai-penyakit">8
                                Penyebab Sirosis Hati, dari Alkohol sampai Penyakit</a>
                            <p class="m-0">Sirosis hati adalah kondisi ketika jaringan parut menggantikan sel hati yang
                                sehat sehingga fungsi organ vital ini terganggu. Dilansir dari NHS, sirosis hati
                                terkadang juga dikenal sebagai penyakit liver stadium akhhir karena kondisi hati atau
                                liver sudah mengalami kerusakan cukup parah.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="bg-light rounded overflow-hidden">
                        <img class="img-fluid w-100" src="img/blog3.jpg" alt="">
                        <div class="p-4">
                            <a class="h3 d-block mb-3 text-info" href="https://lifestyle.kompas.com/read/2022/03/04/060000920/5-makanan-terbaik-untuk-menjaga-kesehatan-hati">5
                                Makanan Terbaik untuk Menjaga Kesehatan Hati</a>
                            <p class="m-0">Masalah medis yang paling umum terjadi pada hati kita yakni penyakit hati
                                berlemak non-alkohol (NAFLD). Namun jangan khawatir, kita bisa mencegah atau menunda
                                timbulnya NAFLD dan masalah hati lainnya dengan mendapatkan jumlah lemak sehat yang
                                tepat dalam makanan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 py-5" id="footer">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="d-inline-block text-info text-uppercase border-bottom border-5 border-secondary mb-4">Get
                        In Touch</h4>
                    <p class="mb-4">Website pembantu untuk pengecekan persentase penyakit liver</p>
                    <p class="mb-2"><i class="fa fa-envelope text-info me-3"></i>info@um.ac.id</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-info me-3"></i>(0341) 551312</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="d-inline-block text-info text-uppercase border-bottom border-5 border-secondary mb-4">
                        Quick Links</h4>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="fa fa-angle-right me-2"></i>Home</a>
                        <a class="text-light mb-2" href="#about"><i class="fa fa-angle-right me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="#service"><i class="fa fa-angle-right me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="#blog"><i class="fa fa-angle-right me-2"></i>Latest Blog</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h6 class="text-info text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-info btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-info btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-info btn-lg-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg btn-info btn-lg-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-light border-top border-secondary py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; Group 4 | All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>