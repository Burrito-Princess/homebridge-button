<?php
// include "./toggle.php"
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<button onclick="foo()">Click me!</button>
<script>
     function foo () {
      $.ajax({
        url:"toggleButton.php",
        type: "POST",
     });
 }
</script>
<?php



?>
