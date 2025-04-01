<?php
// header("Access-Control-Allow-Origin: *");
include "./creds.php";
?>
<head>
    <style>
        #img{

        }
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
</head>
<body>
    <img onclick="call(this.src)" id="img" src="./assets/img/0.png">
</body>

<script>
    function call(src){
        // console.log(src);
        if (src == "<?= $adress?>/assets/img/0.png"){
            document.getElementById("img").src = "./assets/img/1.png";
        } else {
            document.getElementById("img").src = "./assets/img/0.png";
        }
    fetch('http://localhost/remote-control/homebridge-button/api.php?key=9b61e1ff-bd22-4de8-a194-654887f4af9d', {
        method: 'get',
    }).then(function(response) {
            if (response.status >= 200 && response.status < 300) {
                return response.text()
            }
            throw new Error(response.statusText)
        })
        .then(function(response) {
            // console.log(response);
            response = JSON.parse(response);
            if (response["response"]){
            console.log(response);
            if (response["state"] == 0){
                document.getElementById("img").src = "./assets/img/0.png";
                // console.log(response["state"])
            } else {
                document.getElementById("img").src = "./assets/img/1.png";
                // console.log(response["state"])
            }
        } else {
            console.log(response["message"]);
            if (src == "<?= $adress?>/assets/img/0.png"){
                document.getElementById("img").src = "./assets/img/0.png";
            } else {
                document.getElementById("img").src = "./assets/img/1.png";
            }
        }
        })
        }
</script>