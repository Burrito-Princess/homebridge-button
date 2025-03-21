<?php


?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="./assets/css/style.css">
</head>

<?php
include "login.php";
include "creds.php";
include "get-accessories.php";
include "get-state.php";
?>
<div id="container">
  <div id="click" onclick="foo()">
    <?php
  if ($startState == 0){
  echo "<img id='img' src='./assets/img/lamp-off.png'>";
  } else {
    echo "<img id='img' src='./assets/img/lamp-on.png'>";
  }
  ?>
  </div>
  
</div>

<script>
     function foo () {
      document.getElementById("click").onclick = "";
      $.ajax({
        url:"toggleButton.php",
        type: "POST",
     });
     if (<?=  $startState?>==  0){
      document.getElementById("img").src = "./assets/img/lamp-on.png";
     } else {
      document.getElementById("img").src = "./assets/img/lamp-off.png";
     }

     

// stop for sometime if needed
setTimeout(timeout, 1000);
 }
 
 function timeout() {
  if (<?=  $startState?>==  0){
      document.getElementById("img").src = "./assets/img/lamp-off.png";
     } else {
      document.getElementById("img").src = "./assets/img/lamp-on.png";
     }
     document.getElementById("click").onclick = foo;
}
</script>
<?php



?>
