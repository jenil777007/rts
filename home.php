<?php

    require 'autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;
    session_start();

    if(isset($_SESSION['access_token'])){

            $access_token = $_SESSION['access_token'];
            $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
            $user = $connection->get("account/verify_credentials");

            $count = 10;
            if($user->statuses_count < 10){
                $count = $user->statuses_count;
            }

            $tweets = $connection->get('statuses/user_timeline', ['count' => $count, 'screen_name' => 'Ahmedabadblog1' , 'exclude_replies' => true]);


            $user_dp = $user->profile_image_url;
            $user_cover = $user->profile_banner_url;
            $user_name = $user->name;
            $user_id = $user->screen_name;
            $user_followers_count = $user->followers_count;
            $user_friends_count = $user->friends_count;
            $user_tweets_count = $user->statuses_count;

            $cursor = -1;

            while($cursor != 0){
                   $ids = $connection->get("followers/ids", array("screen_name" => $user_id, "cursor" => $cursor));
                   $cursor = $ids->next_cursor;
            }
     }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.min.js"></script>
  /*
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  */
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

  <style>
      a{
        color: white;
      }
      body{
        font-family: 'Open Sans', sans-serif;
      }
      img{
        border: 1px solid black;
      }
      .d1{
        background-color: #e0e0eb;
        height: 300px;
        width: 250px;
        border: 1px solid black;
        border-radius: 10px;
      }
      .c1{
        height: 200px;
        //width: 750px;
        border: 1px solid black;
        border-radius: 10px;
        margin-left: 10px;
        margin-right: 10px;
      }
      .d2{
              background-color: #e0e0eb;
              height: 500px;
              width: 250px;
              border: 1px solid black;
              border-radius: 10px;
            }
      .subd{
        height: 50px;
        border: 1px solid black;
        border-left: transparent;
        border-right: transparent;
       }
       .insubd{
                 margin-top: 12.5px;
              }
  </style>
</head>
<body>

<nav class="navbar navbar-dark bg-primary" style="border: 1px solid black;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">jrtCamp</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li> 
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">

    <div class="row">

    <div class="col-sm-3 d1">
        <center>
        <img src="<?php echo $user_dp; ?>" class="img-circle" alt="User Profile Pic" width="150" height="150" style="margin-top: 10px; margin-bottom: 15px; border: 1px solid black;"><br>

        <label><?php echo $user_name; ?> </label><br>
        <label>@<?php echo $user_id; ?> </label><br>
        <label>TWEETS <?php echo $user_tweets_count; ?>   |</label>
        <label>FOLLOWING <?php echo $user_friends_count; ?>   |</label>
        <label>FOLLOWERS <?php echo $user_followers_count; ?>   </label><br>

        </center>
  </div>

  <div id="myCarousel" class="col-sm-6 slide c1" data-ride="carousel">

    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
      <li data-target="#myCarousel" data-slide-to="5"></li>
      <li data-target="#myCarousel" data-slide-to="6"></li>
      <li data-target="#myCarousel" data-slide-to="7"></li>
      <li data-target="#myCarousel" data-slide-to="8"></li>
      <li data-target="#myCarousel" data-slide-to="9"></li>
    </ol>

    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="" alt="Chania">
      </div>

      <div class="item">
        <img src="" alt="Chania">
      </div>

      <div class="item">
        <img src="" alt="Flower">
      </div>

      <div class="item">
        <img src="" alt="Flower">
      </div>
    </div>

    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    </div>

    <div class="col-sm-3 d2">
        <label>Followers</label>
        <div class="subd">
            <img class="col-sm-3 img-circle insubd" style="height:30px; width:10px;"></img>
            <label class="col-sm-9 insubd">user</label>
        </div>
        <div class="subd">
            <img class="col-sm-3 img-circle insubd" style="height:30px; width:10px;"></img>
            <label class="col-sm-9 insubd">user</label>
        </div>
        <div class="subd">
            <img class="col-sm-3 img-circle insubd" style="height:30px; width:10px;"></img>
            <label class="col-sm-9 insubd">user</label>
        </div>
        <div class="subd">
            <img class="col-sm-3 img-circle insubd" style="height:30px; width:10px;"></img>
            <label class="col-sm-9 insubd">user</label>
        </div>
        <div class="subd">
            <img class="col-sm-3 img-circle insubd" style="height:30px; width:10px;"></img>
            <label class="col-sm-9 insubd">user</label>
        </div>
        <div class="subd">
            <img class="col-sm-3 img-circle insubd" style="height:30px; width:10px;"></img>
            <label class="col-sm-9 insubd">user</label>
        </div>
        <div class="subd">
            <img class="col-sm-3 img-circle insubd" style="height:30px; width:10px;"></img>
            <label class="col-sm-9 insubd">user</label>
        </div>
        <div class="subd">
            <img class="col-sm-3 img-circle insubd" style="height:30px; width:10px;"></img>
            <label class="col-sm-9 insubd">user</label>
        </div>
        <div class="subd">
            <img class="col-sm-3 img-circle insubd" style="height:30px; width:10px;"></img>
            <label class="col-sm-9 insubd">user</label>
        </div>
        <div class="subd">
            <img class="col-sm-3 img-circle insubd" style="height:30px; width:10px;"></img>
            <label class="col-sm-9 insubd">user</label>
        </div>
      </div>

</div>

</body>
</html>
