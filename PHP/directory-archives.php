<!DOCTYPE html>
<html class='no-js' lang='en'>

<head>
  <meta charset='utf-8' />
  <meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
  <title>Intiger Archives</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html,
    body {
      height: 100%;
    }

    body {
      font-family: 'Montserrat', "Arial", sans-serif;
      font-size: 16px;
      line-height: 1.8;
      background: #fafafa;
      padding: 30px;
    }

    h1, h2, h3, h4, h5, h6 {
      color: #111;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    a {
      color: dodgerblue;
      font-weight: 600;
      font-size: 14px;
    }

    ul{
      padding-left: 15px;
      margin-top: 15px;
    }
  </style>
</head>

<body>

  <!-- Home Page -->
  <section class="content">
    <h3>Intiger Archives</h3>
    <h5>The website is under construction. Check back later!</h5>

    <?php
      $dir = opendir('/home/careerpointchd/public_html/');
      echo '<ul>';
      while ($read = readdir($dir)) {
        if ($read != '.' && $read != '..' && is_dir($read) ) {
          echo '<li><a href="/' . $read . '">' . $read . '</a></li>';
        }
      }
      echo '</ul>';
      closedir($dir);
    ?>

  </section>

</body>
</html>
