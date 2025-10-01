<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- essentials -->
  <title><?php echo empty($title) ? "Dove Research Labs" : $title; ?></title>
  <link rel="icon" type="image/png" href="images/favicon.png" />
  <meta name="keywords" content="<?php echo $keywords; ?>" />
  <meta name="description" content="<?php echo $description; ?>" />
  <meta name="google-site-verification" content="Z838PiLgt6NHxpsjAmU59dDDiXr5kJN196SzNC9gLy0" />

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/fontawesome-all.min.css" rel="stylesheet">
  <link href="css/jquery.fancybox.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-114936873-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-114936873-1');
  </script>
</head>  

<body>
  <header>
    <div class="container">  
      <div class="row">
        <div class="col-md-4 col-lg-4 logo"> <a href="index.php"><img src="images/logo.png" alt="logo"><img class="wite-logo" src="images/foter-logo.png" alt="footer-logo"></a> </div>
        <div class="col-md-4 col-lg-5 search">
          <form action="/products-search.php" method="get">
            <input type="text" placeholder="search products" name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
        <div class="col-md-4 col-lg-3">
          <ul class="socal-icon">
            <li><a target="_blank" href="https://plus.google.com/110912522178783412282"><i class="fab fa-google-plus-g"></i></a></li>
            <li><a target="_blank" href="https://www.facebook.com/pages/Dove-Chemicals-Ltd/207859759313710"><i class="fab fa-facebook-f"></i></a></li>
            <li><a target="_blank" href="https://www.linkedin.com/company/doveresearchlab/"><i class="fab fa-linkedin-in"></i></a></li>
            <li><a target="_blank" href="https://twitter.com/doveresearchlab"><i class="fab fa-twitter"></i> </a></li>
          </ul>
          <div class="contact-no">
            <p><i class="far fa-envelope"></i><a href="mailto:drachd@gmail.com">drachd@gmail.com</a></p>
            <p><i class="fas fa-phone"></i><a href="tel:9781882821">+91 9781882821</a></p>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active"> <a class="nav-link" href="index.php">Home </a> </li>
            <li class="nav-item"> <a class="nav-link disabled" href="about-us.php">About Us </a> </li>
            <li class="nav-item"> <a class="nav-link disabled" href="services.php">Services</a> </li>
            <li class="nav-item">
              <div class="dropdown">                
                <button class="dropbtn">Products <i class="fa fa-caret-down"></i></button>              
                <div class="dropdown-content">              
                  <a class="dropdown-item" href="impurities-reference-standards.php">Impurities/Reference Standards & Working Standards</a>
                  <a class="dropdown-item" href="pesticide-reference-standards.php">Pesticide Reference Standards</a>
                  <a class="dropdown-item" href="products-all.php">All Products</a>
                </div>   
              </div>
            </li>
            <li class="nav-item">
              <div class="dropdown">
                <a href="#">
                  <button class="dropbtn">Skill Areas <i class="fa fa-caret-down"></i></button>
                </a>
                <div class="dropdown-content">
                  <a class="dropdown-item" href="chemical.php">Chemical</a>
                  <a class="dropdown-item" href="microbiology.php">Microbiology</a>
                  <a class="dropdown-item" href="industries-served.php">Industries Served</a>
                  <a class="dropdown-item" href="scope.php">Scope of Work</a>                  
                  <a class="dropdown-item" href="list-of-instruments.php">List of Instruments</a>
                </div>   
              </div>
            </li>
            <li class="nav-item"> <a class="nav-link disabled" href="accreditation.php">Accreditation</a> </li>
            <li class="nav-item"> <a class="nav-link disabled" href="quality-assurance.php">Quality Assurance</a> </li>
            <li class="nav-item"> <a class="nav-link disabled" href="career.php">Career</a> </li>
            <li class="nav-item"> <a class="nav-link disabled" href="events.php"> Events </a> </li>
            <li class="nav-item"> <a class="nav-link disabled" href="contact-us.php">Contact Us</a> </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>