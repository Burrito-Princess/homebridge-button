<?php
// include "./toggle.php"
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="./assets/css/style.css">
</head>

<div id="container">
  <button id="button" onclick="foo()">Click me!</button>
</div>

<script>
     function foo () {
      $.ajax({
        url:"toggleButton.php",
        type: "POST",
     });
     document.getElementById("button").style.backgroundColor = "green";
     

// stop for sometime if needed
setTimeout(myFunction, 1000);
 }
 
 function myFunction() {
  document.getElementById("button").style.backgroundColor = "white";
}
</script>
<?php



?>
