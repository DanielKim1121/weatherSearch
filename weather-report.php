<?php
    $error = "";
        $want = "";
    if(array_key_exists('city', $_GET)){
        $error = "";
        $want = "";
        $city = preg_replace('/\s*/', '', $_GET['city']);
        $city = strtolower($city);
        $file_headers = @get_headers("https://www.weather-forecast.com/locations/". $city."/forecasts/latest");
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $error = "this search does not exist";
        }
        else{
            $forecast = file_get_contents("https://www.weather-forecast.com/locations/". $city."/forecasts/latest");
            $want1 = explode('(1&ndash;3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">', $forecast);
            $want2 = explode('</span></p></td><td colspan="9"><span class="b-forecast__table-description-title"><h2>', $want1[1]);
            $want = '<div class="p-3 mb-2 bg-success text-white">'.$want2[0].'</div>';
        }
            
        }
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Weather report</title>
      <style>
          .coverB{
              background-image: url("https://images.pexels.com/photos/15382/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260");
              height: 100vh;
              width: 100%;
              position: absolute;
          }
          form{
              top:20%;
              left: 30%;
              position: relative;
              width: 500px;
              text-align: center;
          }
          label{
              font-size: 40px;
          }
          button{
              margin-top: 20px;
          }
          #result{
              margin-top:10px;
          }
          
      </style>
  </head>
  <body>
      
      <div class="coverB">
<form>
  <div class="form-group">
    <label for="search">Which City</label>
    <input type="text" class="form-control" name="city" id="search" placeholder="Enter City for weather report!">
      <button type="submit" class="btn btn-primary">Submit</button>
      <div id="result"> <?  if($want != ""){echo $want;}else if($error != ""){
    echo '<div class="p-3 mb-2 bg-danger text-white">'.$error.'</div>';
} ?> </div>

  </div>
  
</form>
          </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
