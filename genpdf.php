
<?php

    require 'autoload.php';
    use Abraham\TwitterOAuth\TwitterOAuth;
    session_start();

        $count = 10;

        if(isset($_SESSION['access_token'])){

                $access_token = $_SESSION['access_token'];
                $connection = new TwitterOAuth($_SESSION['consumer_key'], $_SESSION['consumer_secret'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
                $user = $connection->get("account/verify_credentials");
        }
        $tweets = $connection->get('statuses/user_timeline', ['count' => $count , 'exclude_replies' => true]);


    require('fpdf.php');
    $pdf = new FPDF('P','mm','A4');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->SetX(40);
    $pdf->SetY(0);
    $pdf->Cell(0,80, $user->name ."'s latest 10 tweets",0,0,'C');
    $pdf->Ln(30);
    $pdf->SetFont('Times','',12);

    for($i=0;$i<10;$i++){
        $pdf->Cell(0,80, $tweets[$i]-> text );
        $pdf->Ln(20);
    }

    $pdf->SetY(-15);
    $pdf->SetFont('Arial','I',8);
    $pdf->Cell(0,10,'Page '.$pdf->PageNo().'/{nb}',0,0,'C');


    $pdf->Output();
?>