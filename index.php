<?php
    session_start();
    require 'autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;

    $_SESSION['consumer_key'] = "334dvGxW3SfcS43Hnsho8uCx7";
    $_SESSION['consumer_secret'] = "tp0gtGtw1SSB2ompRNoAWWEYTZeJ8pp9DNpde29ulxXoS8n56A";


        $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret']);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => 'https://jrtcamp.herokuapp.com/callback.php'));
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        echo "Generated Token URL: ".$url;
       // header('Location: '. $url);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Twitter rtCampAssignment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   /*
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  */
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

  <style>
        body{
          font-family: 'Open Sans', sans-serif;
        }
    </style>

</head>
<body>

<div class="container">
  <div class="jumbotron">
  		<h1>rtCamp Twitter Assignment</h1>
  		<h3>by Jenil Calcuttawala (13BCE015)<br>Institute of Technology, Nirma University,<br>Ahmedabad.</h3>
	</div>
	<center>
	<a href="<?php echo $url; ?>"><button type="button" class="btn btn-primary">Login to your Twitter Account</button>
	</center>
</div>

</body>
</html>
