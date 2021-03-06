<?php

    require 'autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;
    session_start();

    if(isset($_SESSION['access_token'])){

            $access_token = $_SESSION['access_token'];
            $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
            $user = $connection->get("account/verify_credentials");

            $user_dp = $user->profile_image_url;
            $user_cover = $user->profile_banner_url;
            $user_name = $user->name;
            $user_id = $user->screen_name;
            $user_followers_count = $user->followers_count;
            $user_friends_count = $user->friends_count;
            $user_tweets_count = $user->statuses_count;

            $count = 10;
            if($user->statuses_count < 10){
                $count = $user->statuses_count;
            }

            $tweets = $connection->get('statuses/user_timeline', ['count' => $count , 'exclude_replies' => true]);
            //echo "<pre>";
            //print_r($tweets);
            //echo "<pre>";

            $followers_ids = $connection->get('followers/list', ['count' => $count ]);
            //echo "<pre>";
            //print_r($followers_ids);
            //echo "<pre>";

     }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!--
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  -->
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
              height: 527px;
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
      <li><a href="http://about.me/jenil777007">About Me</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
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

    <div class="carousel-inner" role="listbox">
        <?php for($i=0;$i<10;$i++){ ?>

                <div class="item <?php echo ($i == 0) ? 'active' : ''; ?>">
                    <div class="row">
                        <div class="col-sm-2">
                            <img src="<?php echo $user_dp; ?>" class="img-rounded" alt="User Profile Pic" width="50" height="50" style="margin-top: 5px; margin-bottom: 5px; border: 1px solid black;">
                        </div>
                        <div class="col-sm-2">
                            <label> <?php echo $user_name; ?> </label>
                        </div>
                        <div class="col-sm-2">
                            <label>@<?php echo $user_id; ?> </label>
                        </div>
                        <div class="col-sm-4">
                            <label> <?php echo $tweets[$i]-> created_at; ?> </label><br><br>
                        </div>
                    </div><br><br>
                    <?php echo $tweets[$i]-> text; ?>

                </div>

            <?php } ?>
    </div>
<!--
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>-->
    </div>

    <div class="col-sm-3 d2">
        <center><label>Followers</label></center>

        <?php for($i=0;$i<10;$i++){

        ?>
        <div class="subd">
            <img src="<?php echo $followers_ids-> users[$i]-> profile_image_url; ?>" class="col-sm-3 img-circle insubd" style="height:30px; width:10px;"></img>
            <label class="col-sm-9 insubd"><?php echo $followers_ids-> users[$i]-> screen_name; ?></label>
        </div>

        <?php } ?>

      </div>

    <button type="button" class="btn btn-primary"><a href="genpdf.php">Generate PDF of tweets</a></button>
</div>

</body>
</html>
