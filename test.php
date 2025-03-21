<?php
header("Access-Control-Allow-Origin: *");
?>

<script>
    fetch('http://localhost/homebridge-button/api.php?api=true', {
        method: 'get',
        // may be some code of fetching comes here
    }).then(function(response) {
            if (response.status >= 200 && response.status < 300) {
                return response.text()
            }
            throw new Error(response.statusText)
        })
        .then(function(response) {
            console.log(JSON.parse(response));
        })
</script>