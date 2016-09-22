<?php

    session_start();
    session_destroy();
    header('Location: ' . 'https://jrtcamp.herokuapp.com/');

?>
