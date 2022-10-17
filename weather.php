<?php

$response = "";

if($_POST) {
    $cityName = $_POST['cityName'];
    $cityName = ucfirst($cityName);
    if(!$cityName) {
        $response .= "A city is required.<br>";
    }

    if ($response != "") {
        $response = "<div class='alert alert-danger' role='alert'><strong>Please enter the name of the city</strong></div>";
    } else {
        $html = file_get_contents("https://www.weather-forecast.com/locations/".$cityName."/forecasts/latest");
        $a=preg_match_all("/\<span class\=\"phrase\"\>(.*?)\<\/span\>/",$html,$b);
        // echo $a;
        // print_r($b[1]);
        $response = "<div class='alert alert-success' role='alert'><strong>".$b[1][0]."</strong></div>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body
        {
            background-image: url("jpeg/pexels-tahir-shaw-186980.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .background
        {
            width: 100%;
        }

        #container
        {
            width: 100%;
            height: 500px;
            display: block;
            margin-top: 240px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        .title
        {
            color: white;
        }

        .mb-3
        {
            font-size: 20px;
            font-weight: bold;
            width: 25%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .alert
        {
            width: 25%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div id="container">
        <div class="title">
            <h1>What's the weather?</h1>
            <p style="font-size: 20px;">Enter the name of a city.</p><br><br>
        </div>
        <form id="form" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" name="cityName" id="cityName" placeholder="Enter the city name" style="text-align: center;"><br>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
        </form><br>
        <div id="response"><? echo $response ?></div>
    </div>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>