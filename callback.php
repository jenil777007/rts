<?php

    require 'autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;
    session_start();

    $oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');

    if(isset($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']) && $_REQUEST['oauth_token'] == $_SESSION['oauth_token']){

        $connection = new TwitterOAuth(
                $_SESSION['consumer_key'],
                $_SESSION['consumer_secret'],
                $_SESSION['oauth_token'],
                $_SESSION['oauth_token_secret']
            );

        $token = $connection->oauth(
                'oauth/access_token', [
                    'oauth_verifier' => $oauth_verifier
                ]
            );

        $_SESSION['access_token'] = $token;

        header('Location: ' . 'http://127.0.0.1/rts/home.php');

    }else{

        echo "Something went wrong. Token not verified.";

    }
?>