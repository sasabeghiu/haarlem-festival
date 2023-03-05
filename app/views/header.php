<?php
//session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Haarlem Festival</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="/">Haarlem Festival</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
          </li>
          <div class="dropdown show">
            <a class="nav-link dropdown-toggle" href="/food" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Food
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/food">Food</a>
              <a class="dropdown-item" href="/food/yummy">Yummy</a>
              <a class="dropdown-item" href="">Recipes</a>
            </div>
          </div>
          <div class="dropdown show">
            <a class="nav-link dropdown-toggle dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              History
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/historyevent">Events</a>
              <a class="dropdown-item" href="/tourguide">TourGuides</a>
            </div>
          </div>
          <div class="dropdown show">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dance
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/artist/danceartists">Artists</a>
              <a class="dropdown-item" href="/venue/dancevenues">Venues</a>
              <a class="dropdown-item" href="/event/danceevents">Events</a>
            </div>
          </div>
          <div class="dropdown show">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Jazz
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/artist/jazzartists">Artists</a>
              <a class="dropdown-item" href="/venue/jazzvenues">Venues</a>
              <a class="dropdown-item" href="/event/jazzevents">Events</a>
            </div>
          </div>
          <div class="dropdown show">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Profile
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/user/profile">Edit Profile</a>
              <a class="dropdown-item" href="/login/logout">Logout</a>
            </div>

          </div>
          <div class="dropdown show">
            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              CMS
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/user/index">Users</a>

              <!-- dance and jazz -->
              <a class="dropdown-item" href="/artist/artistcms">Artists CMS</a>
              <a class="dropdown-item" href="/venue/venuecms">Venues CMS</a>
              <a class="dropdown-item" href="/event/eventcms">Events CMS</a>
                <a class="dropdown-item" href="/tourguidecms">Tour Guide CMS</a>
              <a class="dropdown-item" href="/food/manageSessions">Yummy</a>
              <a class="dropdown-item" href="/food/manageRestaurants">Restaurants</a>
              <a class="dropdown-item" href="/food/manageReservations">Reservations</a>
            </div>
          </div>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid">