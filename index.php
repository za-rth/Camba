<?php

require 'config.php';
require_once 'functions/login.php';
require_once 'functions/signUp.php';
include 'resources/bootstrap&googleFonts.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>CAMBA</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>

  <style>
    .image-container {
      position: relative;
      border: 4px solid #A021EF;
      border-radius: 0px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      max-width: 600px;
      margin: 20px auto;
    }

    .overlay-image {
      position: absolute;
      bottom: 10px;
      right: 10px;
      width: 80px;
      height: 80px;
      border: 0px;
      border-radius: 0;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }

    .caption {
      position: absolute;
      bottom: 10px;
      right: 100px;
      color: white;
      font-family: 'Roboto Mono';
      font-weight: 'light';
      text-align: right;
      text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
    }

    @keyframes slide {
      form {
        transform: translateX(0);
      }

      to {
        transform: translateX(-100%);
      }
    }

    .img-gall {
      background-color: #E8CAFB;
      border-radius: 5px;
      ;
      color: white;
      padding: 20px;
      width: 100%;
      margin: auto;
      width: 1355px;
      height: 400px;
      flex-shrink: 0;

      filter: drop-shadow(7px 10px 4px rgba(0, 0, 0, 0.25));
      overflow: hidden;
      /* Enable horizontal scrolling */
      width: 80%;
      /* Adjust the width as needed */
      white-space: nowrap;
    }

    .img-gall .img-container img {

      flex-wrap: wrap;
      width: 15%;
      padding: auto;

    }

    .img-container {
      display: inline-block;

      animation: 10s slide infinite linear;
    }
  </style>

  <body>
    <header class="contaier navbar navbar-expand-lg navbar-light bg-light"
      style="font-family: 'Roboto Mono', monospace; font-weight: 100;">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="images/CAMBa.png" width="125">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0"> </ul>
          <form class="d-flex">
            <ul class="nav-item">
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal2"
                style="border-color:#A021EF; background:#A021EF; color: #FFFFFF;">
                Sign Up</button>
            </ul>
            <ul class="nav-item">
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal"
                style="border-color:#A021EF; color: #A021EF;">
                Login
              </button>
            </ul>
          </form>
        </div>
      </div>
    </header>

    <main>
      <div class="container">
        <div class="row">
          <!---1st Half-->
          <div class="col-md-6 mt-5 left-content">
            <div class="mt-5" style="font-family: 'Roboto Mono', monospace; font-weight: 100;">
              <br>
              <div class="mt-5">
                <h1>Art Social.</h1>
              </div>

              <p style="font-size: 15px;font-weight:1000">Whether art is your passion or profession, you’ve come to the
                right place.</p>
            </div>

            <br>
            <div class="d-flex " style="font-weight: 100;">
              <button class="btn" style="border-color:#A021EF ; background:#A021EF; color: #FFFFFF; "><a
                  class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal2">Get A Free
                  Account</a></button>
              <button class="btn" style=" background:#FFFFFF; color: #A021EF; "><a class="nav-link" href="">Learn
                  More..</a></button>
            </div>
          </div>

          <div class="col-md-6 mt-5">
            <!---2nd Half-->
            <div class="image-container">
              <!-- Main Image -->
              <img src="images/a1.jpg" width="100%">
              <div class="caption" style="">
                Arouse A Rose <br>
                by Roxanne Normandia Yanne <br>
                <a href="#" class="text-warning text-decoration-none">View Profile</a>
              </div>
              <img src="images/a.jpg" width="40" alt="Overlay Image" class="overlay-image">
            </div>
          </div>
        </div>
        <br>
        <br>
    </main>


    <!--IMAGE GALLERY-->
    <div class="img-gall container container-fluid ">
      <div class="container row" style="text-align:center">
        <h1 style="color:#000000; font-family: Times New Roman">THE ART NETWORK</h1>
      </div>
      <div class="img-container" class="looping-image">
        <img src="images/a4.jpg">
        <img src="images/B2.jpg">
        <img src="images/B4.jpg" style=" width:18%;">
        <img src="images/a8.jpg" style=" width:18%;">
        <img src="images/B3.jpg">
        <img src="images/B1.jpg">
      </div>
      <div class="img-container" class="looping-image">
        <img src="images/a4.jpg">
        <img src="images/B2.jpg">
        <img src="images/B4.jpg" style=" width:18%;">
        <img src="images/a8.jpg" style=" width:18%;">
        <img src="images/B3.jpg">
        <img src="images/B1.jpg">
      </div>
    </div>

    <footer>
      <div class="footer container-fluid">
        <div class="row wh-100 mt-5 mr-5">
          <!-- Left Section: Text Content -->
          <div class="container col-md-6" style="font-family: 'Roboto Mono', monospace; font-weight: 1000;">
            <h1 style="">Join in, It’s free.</h1>
            <h5>An Open Art Buying Platform</h5>
            <p style="font-weight: 100;">For Art lovers, collectors, companies, Filipino artists, companies, and anyone
              who is involved in the world in some way.</p>
            <p style="font-weight: 100;">Create your free profile and company page, start or join a group, make
              connections, get followers, post on your wall and much more.</p>
            <h5>Media Channel</h5>
            <p style="font-weight: 100;">Not in the market for buying or selling art? CAMBa is free for anyone who is
              interested in artworks and connecting with other enthusiasts.</p>
          </div>

          <!-- Right Section: Buttons and Links -->
          <div class="col-md-5 d-flex flex-column align-items-center justify-content-center">

            <div class="d-grid gap-2 col-6 mx-auto">
              <button class="btn " style="border-color:#A021EF; background:#A021EF; color: #FFFFFF; "><a
                  class="nav-link" href="">ABOUT</a></button>
              <button class="btn btn-block " style="border-color:#A021EF; background:#A021EF; color: #FFFFFF; "><a
                  class="nav-link" href="">TERM | CONDITION | PRIVACY</a></button>
            </div>

          </div>
        </div>
      </div>
      </div>
    </footer>

    <!--Login Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Member Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="">
              <input class="p-2 mb-2 container rounded-2" name="email" type="text" style="border-color:#A021EF;"
                placeholder="EMAIL"> <br>
              <input class="p-2 container rounded-2" type="password" name="password" style="border-color:#A021EF;"
                placeholder="PASSWORD">
              <br><br>
              <input type="submit" name="login" class="btn"
                style="border-color:#A021EF; background:#FFFFFF; color: #A021EF;" name="login" value="Login">
            </form>



          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>

    <!--Sign Up Modal2-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">


            <form method="post">

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="firstName" class="form-label">First Name:</label>
                  <input type="text" class="form-control" id="firstName" name="firstname" required>
                </div>
                <div class="col-md-6">
                  <label for="lastName" class="form-label">Last Name:</label>
                  <input type="text" class="form-control" id="lastName" name="lastname" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="birthDate" class="form-label">Birth Date:</label>
                <input type="date" class="form-control" id="birthDate" name="birthDate" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Gender:</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" required>
                  <label class="form-check-label" for="genderMale">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female" required>
                  <label class="form-check-label" for="genderFemale">Female</label>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="nationality" class="form-label">Nationality:</label>
                  <input type="text" class="form-control" id="nationality" name="nationality" required>
                </div>
                <div class="col-md-6">
                  <label for="country" class="form-label">Country:</label>
                  <input type="text" class="form-control" id="country" name="country" required>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="state" class="form-label">State:</label>
                  <input type="text" class="form-control" id="state" name="state" required>
                </div>
                <div class="col-md-6">
                  <label for="zipCode" class="form-label">ZIP Code:</label>
                  <input type="text" class="form-control" id="zipCode" name="zipCode" required>
                </div>
              </div>

              <div class="mb-3">
                <label for="userType" class="form-label">User Type:</label>
                <input type="text" class="form-control" id="usertype" name="usertype" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>

              <div class="mb-3">
                <label for="passwordKey" class="form-label">Password:</label>
                <input type="password" class="form-control" id="passwordKey" name="passwordKey" required>
              </div>

              <button type="submit" name="signup" style="background-color: #A021EF; " class="btn text-white  w-100">Sign Up</button>

            </form>

          </div>
          <div class="modal-footer">

           
          </div>
        </div>
      </div>
    </div>
  </body>


</html>