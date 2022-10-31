<?php
include('header.php');
include ('nav-bar.php');
?>
<header>
    <link href="<?php echo CSS_PATH . "creditCard.css" ?>" rel="stylesheet">
</header>

<div class="container">
<form action="<?php echo  FRONT_ROOT . "CreditCard\Add "?>" method="get">
  <div class="card">
  <button type="submit" class="proceed"><svg class="sendicon" width="24" height="24" viewBox="0 0 24 24">
  <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
</svg></button>
  <img src="<?php echo FRONT_ROOT.IMG_PATH."logoVisa.png" ?>" class="logo-card">
 <label>Card number:</label>
 <input id="user" type="text" class="input cardnumber"  placeholder="1234 5678 9101 1121">
 <label>Name:</label>
 <input class="input name"  placeholder="Edgar Pérez">
 <label class="toleft">CCV:</label>
 <input class="input toleft ccv" placeholder="321">
  </div>
  <div class="receipt">
    <div class="col"><p>Total Cost:</p>
    <h2 class="cost"><?php echo $booking->getKeeper()->getRemuneration()?></h2><br>
    <p>Keeper Name:</p>
    <h2 class="seller"><?php echo $booking->getKeeper()->getUser()->getName()?><br><?php echo $booking->getKeeper()->getUser()->getLastname()?></h2>
    </div>
    <div class="col">
      <p>Pet Service:</p>
      <h3 class="bought-items"><?php echo $booking->getKeeper()->getRemuneration()/2?> (50% advance)</h3>
      <p class="bought-items description">Pet Name: <?php echo $booking->getPet()->getPetName()?></p>
      <p class="bought-items price">Pet Breed: <?php echo $booking->getPet()->getPetBreed()?></p><br>
      <h3 class="bought-items">Reservation date</h3>
      <p class="bought-items description">From <?php echo $booking->getStartDate()?></p>
      <p class="bought-items price">To <?php echo $booking->getEndDate()?></p><br>
    </div>
    <p class="comprobe">This information will be sended to your email</p>
  </div>
</div>