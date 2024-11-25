<?php
include 'resources/bootstrap&googleFonts.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CAMBA</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header class="contaier navbar navbar-expand-lg navbar-light bg-light "
    style="font-family: 'Roboto Mono', monospace; font-weight: 100;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="images/CAMBa.png" width="125">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    </div>
  </header>
  <br>

  <!--search bar-->
  <div class="container">
    <nav class="navbar-expand-lg rounded p-3 mb-3">
      <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">

      </form>
    </nav>
  </div>

  <main>
    <div class="row m-2" style="width:auto; ">
      <div class="col-sm- m-2 " style="width:400px; background:#E8CAFB;text-align:left;">
        Left side of three columns
        <div class="pt-3 mx-auto">
          <img src="$" width="100" height="100">
        </div>
      </div>
      <div class="col m-2 vh-100" style="width:auto;  background:#A021EF; text-align:center;">
        Middle of three columns
        <div>

        </div>
      </div>
      <div class="col-sm-5 m-2 vh-100" style="width: 300;  background:#A569BC;text-align:right;">
        Right Side of three columns
      </div>
    </div>
  </main>

  <footer>
    <div class="container " style="align-items justify-content-center width: auto; text-align:center;">
      <p>&copy; 2023 Your Website</p>
    </div>

  </footer>
</body>

</html>