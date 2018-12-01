<?php
include 'connection.php';

session_start();
$idim=$_SESSION['user_id'];
$sql="select * from doktorlar where id=".$idim;
$res=mysqli_query($link,$sql);
while ($row=mysqli_fetch_array($res)) {
    break;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KYS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/nprogress.css" rel="stylesheet">
    <link href="css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">




</head>
<body style="background: #ffffff">
    <div class="navbar nav_title" style="border: 0;">
        <a href="anasayfa.php" class="site_title"><i class="fa fa-book"></i> <span>Ana Sayfa</span></a>
    </div>
    <div class="navbar nav_title" style="border: 0;">
        <a href="#" class="site_title"><i class="fa fa-book"></i> <span>Hasta Listesi</span></a>
    </div> 
    <div class="navbar nav_title" style="border: 0, width: 100%;">
        <a href="#" class="site_title"><i class="fa fa-book"></i> <span>Ölçümler</span></a>
    </div>
    <div class="navbar nav_title" style="border: 0, width: 100%;">
        <a href="#" class="site_title"> <span></span></a>
    </div>
    
    <div class="navbar nav_title" style="border: 0, width: 100%,;">
       <div class="top_nav">  
        <ul class="nav navbar-nav navbar-right">
            <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                aria-expanded="false">
                <i class="fa fa-user fa-3x" aria-hidden="true"><br></i><?php echo $row['doktor_kulad'];?>
                <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
                <strong>
                    <?php echo "ad:".$row['doktor_adi']; ?><br>
                    <?php echo "soyad:".$row['doktor_soyadi']; ?><br>
                    <?php echo "email:".$row['doktor_email']; ?><br>
                    <?php echo "telefon:".$row['doktor_tel']; ?><br>
                </strong>                                
                <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Çıkış Yap</a></li>  
            </ul>
        </li>

        <li role="presentation" class="dropdown">
            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
            aria-expanded="false">
        </a>

    </li>
</ul>
</div>


</nav>

</div>
</div>
<br><br><br><br>
<div class="analytics-sparkle-area">
    <div class="container-fluid">
        <div class="row">
            <table class='table table-bordered'>
                <tr>
                    <td>

                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">
                               <?php
                                    //şekerin yüzdesi hesaplanacak kna şekeri tip id'si ===>> 2
                               $sql="select * from olcumler where hangiOlcum = 2 and hasta_id=".$_GET['id']." ORDER BY id DESC LIMIT 2 ";
                               $res=mysqli_query($link, $sql);
                               if(mysqli_num_rows($res)==0){
                                    $seker[0]=1;
                                    $seker[1]=1;
                                    $sekerolcumsaati[0]="";
                                    $sekerolcumsaati[1]="";
                                    $sekerAciklama[0]="";
                                    $sekerAciklama[1]="";
                                }
                               $i=0;
                               while($SEKER_row=mysqli_fetch_array($res)){
                                $seker[$i]=$SEKER_row['deger'];
                                $sekerolcumsaati[$i]=$SEKER_row['tarih'];
                                $sekerAciklama[$i]=$SEKER_row['aciklama'];
                                $i++;
                            }


                            ?>
                            <h2>Şeker Önceki Ölçüme Göre Değişimi</h2>
                            <h3><span class="counter"><?php echo $seker[0]; ?></span> <span class="tuition-fees">Şu anki şeker değeri</span></h3>
                            <h4><span >Açıklama:</span> <?php echo $sekerAciklama[0]; ?></span></h4>
                            <h5> <span class="tuition-fees">Ölçüm tarihi</span> <span><?php echo $sekerolcumsaati[0]; ?></span></h5>

                            <span class="text-success"><?php
                            $yuzde=(($seker[0]-$seker[1])/$seker[1])*100;
                            $ek="";
                            if($yuzde>0){
                                $ek=" artmış.";
                            }else{
                                $ek=" azalmış.";
                            }
                            echo "%".intval(abs($yuzde))."".$ek; ?></span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success progress-bar-striped"  role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo abs($yuzde);?>%;"></div>
                            </div>
                        </div>
                        <div>
                           <center> <form method="post" action="olcumdetay.php">
                                        <input style="visibility: hidden" type="input" name="degerler" value="<?php echo $_GET['id']."-2";?>">
                                        <center> <input type="submit" class="btn btn-default submit"  name="submit" value="Ayrıntılı görmek için tıklatınız"></center>             
                                    </form></center>
                        </div>
                    </div>
                </td>
                <td>                        
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">

                            <?php
                                    //şekerin yüzdesi hesaplanacak kna şekeri tip id'si ===>> 2
                            $sql="select * from olcumler where hangiOlcum = 1 and hasta_id=".$_GET['id']." ORDER BY id DESC LIMIT 2";
                            $res=mysqli_query($link, $sql);
                             if(mysqli_num_rows($res)==0){
                                    $kilo[0]=1;
                                    $kilo[1]=1;
                                    $kiloolcumsaati[0]="";
                                    $kiloolcumsaati[1]="";
                                    $kiloAciklama[0]="";
                                    $kiloAciklama[1]="";
                                }
                            $i=0;
                            while($KILO_row=mysqli_fetch_array($res)){
                                $kilo[$i]=$KILO_row['deger'];
                                $kiloolcumsaati[$i]=$KILO_row['tarih'];
                                $kiloAciklama[$i]=$KILO_row['aciklama'];
                                $i++;
                            }


                            ?>

                            <h2>Kilonun Önceki Ölçüme Göre Değişimi</h2>
                            <h3><span class="counter"><?php echo $kilo[0]; ?></span> <span class="tuition-fees">Şu anki kilo değeri</span></h3>
                            <h4><span class="tuition-fees">Açıklama:</span> <?php echo $kiloAciklama[0]; ?></span></h4>
                            <h5> <span class="tuition-fees">Ölçüm tarihi</span> <span><?php echo $kiloolcumsaati[0]; ?></span></h5>
                            <span class="text-danger">
                                <?php
                                $yuzde=(($kilo[0]-$kilo[1])/$kilo[1])*100;
                                $ek="";
                                if($yuzde>0){
                                    $ek=" artmış.";
                                }else{
                                    $ek=" azalmış.";
                                }
                            echo "%".intval(abs($yuzde))."".$ek; ?></span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo abs($yuzde);?>%;"></div>
                                </div>
                            </div>
 <div>
                           <center> <form method="post" action="olcumdetay.php">
                                        <input style="visibility: hidden" type="input" name="degerler" value="<?php echo $_GET['id']."-1";?>">
                                        <center> <input type="submit" class="btn btn-default submit"  name="submit" value="Ayrıntılı görmek için tıklatınız"></center>             
                                    </form></center>
                        </div>
                        </div>
                    </td>
                    <td>                      
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">

                                <?php
                                    //şekerin yüzdesi hesaplanacak kna şekeri tip id'si ===>> 2
                                $sql="select * from olcumler where hangiOlcum = 8 and hasta_id=".$_GET['id']." ORDER BY id DESC LIMIT 2";
                                $res=mysqli_query($link, $sql);
                                if(mysqli_num_rows($res)==0){
                                    $kolestrol[0]=1;
                                    $kolestrol[1]=1;
                                    $kolestrololcumsaati[0]="";
                                    $kolestrololcumsaati[1]="";
                                    $kolestrolAciklama[0]="";
                                    $kolestrolAciklama[1]="";
                                }
                                $i=0;
                                while($KOLESTROL_row=mysqli_fetch_array($res)){                        
                                    $kolestrol[$i]=$KOLESTROL_row['deger'];
                                    $kolestrololcumsaati[$i]=$KOLESTROL_row['tarih'];
                                    $kolestrolAciklama[$i]=$KOLESTROL_row['aciklama'];
                                    $i++;

                                }


                                ?>

                                <h2>Kolestrolün Önceki Ölçüme Göre Değişimi</h2>
                                <h3><span class="counter"><?php
                                if($kolestrol[0]!=1) 
                                    echo $kolestrol[0]; ?></span> <span class="tuition-fees">Şu anki kolestrol değeri</span></h3>
                                <h4><span class="tuition-fees">Açıklama:</span> <?php echo $kolestrolAciklama[0]; ?></span></h4>
                                <h5> <span class="tuition-fees">Ölçüm tarihi</span> <span><?php echo $kolestrololcumsaati[0]; ?></span></h5>
                                <span class="text-danger">
                                    <?php
                                    $yuzde=(($kolestrol[0]-$kolestrol[1])/$kolestrol[1])*100;
                                    $ek="";
                                    if($yuzde>0){
                                        $ek=" artmış.";
                                    }else{
                                        $ek=" azalmış.";
                                    }
                            echo "%".intval(abs($yuzde))."".$ek; ?></span>
                                    <div class="progress m-b-0">
                                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo abs($yuzde);?>%;"></div>
                                    </div>
                                </div> 
                                 <div>
                           <center> <form method="post" action="olcumdetay.php">
                                        <input style="visibility: hidden" type="input" name="degerler" value="<?php echo $_GET['id']."-8";?>">
                                        <center> <input type="submit" class="btn btn-default submit"  name="submit" value="Ayrıntılı görmek için tıklatınız"></center>             
                                    </form>
                                </center>
                        </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                             <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">

                                <?php
                                    //şekerin yüzdesi hesaplanacak kna şekeri tip id'si ===>> 2

                                $sql="select * from olcumler where hangiOlcum = 4 and hasta_id=".$_GET['id']." ORDER BY id DESC LIMIT 2";
                                $res=mysqli_query($link, $sql);
                               
                                if(mysqli_num_rows($res)==0){
                                    $mesafe[0]=1;
                                    $mesafe[1]=1;
                                    $mesafeolcumsaati[0]="";
                                    $mesafeolcumsaati[1]="";
                                    $mesafeAciklama[0]="";
                                    $mesafeAciklama[1]="";
                                }
                                $i=0;
                                while($MESAFE_row=mysqli_fetch_array($res)){                        
                                    $mesafe[$i]=$MESAFE_row['deger'];
                                    $mesafeolcumsaati[$i]=$MESAFE_row['tarih'];
                                    $mesafeAciklama[$i]=$MESAFE_row['aciklama'];
                                    $i++;                                    
                                }

                                ?>

                                <h2>Yürünen Mesafenin Önceki Ölçüme Göre Değişimi</h2>
                                <h3><span class="counter"><?php

                                if($mesafe[0]!=1) 
                                    echo $mesafe[0]; ?></span> <span class="tuition-fees">Şu anki yürünen mesafe değeri</span></h3>
                                <h4><span class="tuition-fees">Açıklama:</span> <?php echo $mesafeAciklama[0]; ?></span></h4>
                                <h5> <span class="tuition-fees">Ölçüm tarihi</span> <span><?php echo $mesafeolcumsaati[0]; ?></span></h5>
                                <span class="text-danger">
                                    <?php
                                      $yuzde=(($mesafe[0]-$mesafe[1])/$mesafe[1])*100;                               
                                        $ek="";
                                    if($yuzde>0){
                                        $ek=" artmış.";
                                    }else{
                                        $ek=" azalmış.";
                                    }
                            echo "%".intval(abs($yuzde))."".$ek; ?></span>
                                    <div class="progress m-b-0">
                                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo abs($yuzde);?>%;"></div>
                                    </div>
                                </div> 
                                 <div>
                                    <form method="post" action="olcumdetay.php">
                                        <input style="visibility: hidden" type="input" name="degerler" value="<?php echo $_GET['id']."-4";?>">
                                        <center> <input type="submit" class="btn btn-default submit"  name="submit" value="Ayrıntılı görmek için tıklatınız"></center>             
                                    </form>
                           
                        </div>
                            </div>
                        </td>
                        <td>
                             <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">

                                <?php
                                    //şekerin yüzdesi hesaplanacak kna şekeri tip id'si ===>> 2

                                $sql="select * from olcumler where hangiOlcum = 5 and hasta_id=".$_GET['id']." ORDER BY id DESC LIMIT 2";
                                $res=mysqli_query($link, $sql);
                               
                                if(mysqli_num_rows($res)==0){
                                    $nabiz[0]=1;
                                    $nabiz[1]=1;
                                    $nabizolcumsaati[0]="";
                                    $nabizolcumsaati[1]="";
                                    $nabizAciklama[0]="";
                                    $nabizAciklama[1]="";
                                }
                                $i=0;
                                while($NABİZ_row=mysqli_fetch_array($res)){                        
                                    $nabiz[$i]=$NABİZ_row['deger'];
                                    $nabizolcumsaati[$i]=$NABİZ_row['tarih'];
                                    $nabizAciklama[$i]=$NABİZ_row['aciklama'];
                                    $i++;                                    
                                }

                                ?>

                                <h2>Nabzın Önceki Ölçüme Göre Değişimi</h2>
                                <h3><span class="counter"><?php

                                if($nabiz[0]!=1) 
                                    echo $nabiz[0]; ?></span> <span class="tuition-fees">Şu anki nabız değeri</span></h3>
                                <h4><span class="tuition-fees">Açıklama:</span> <?php echo $nabizAciklama[0]; ?></span></h4>
                                <h5> <span class="tuition-fees">Ölçüm tarihi</span> <span><?php echo $nabizolcumsaati[0]; ?></span></h5>
                                <span class="text-danger">
                                    <?php
                                      $yuzde=(($nabiz[0]-$nabiz[1])/$nabiz[1])*100;                               
                                        $ek="";
                                    if($yuzde>0){
                                        $ek=" artmış.";
                                    }else{
                                        $ek=" azalmış.";
                                    }
                            echo "%".intval(abs($yuzde))."".$ek; ?></span>
                                    <div class="progress m-b-0">
                                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo abs($yuzde);?>%;"></div>
                                    </div>
                                </div> 
                                 <div>
                           <center> <form method="post" action="olcumdetay.php">
                                        <input style="visibility: hidden" type="input" name="degerler" value="<?php echo $_GET['id']."-5";?>">
                                        <center> <input type="submit" class="btn btn-default submit"  name="submit" value="Ayrıntılı görmek için tıklatınız"></center>             
                                    </form></center>
                        </div>
                            </div>
                        </td>
                        <td>
                             <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">

                                <?php
                                    //şekerin yüzdesi hesaplanacak kna şekeri tip id'si ===>> 2

                                $sql="select * from olcumler where hangiOlcum = 3 and hasta_id=".$_GET['id']." ORDER BY id DESC LIMIT 2";
                                $res=mysqli_query($link, $sql);
                               
                                if(mysqli_num_rows($res)==0){
                                    $kanbasinci[0]=1;
                                    $kanbasinci[1]=1;
                                    $kanbasinciolcumsaati[0]="";
                                    $kanbasinciolcumsaati[1]="";
                                    $kanbasinciAciklama[0]="";
                                    $kanbasinciAciklama[1]="";
                                }
                                $i=0;
                                while($KANBASINCI_row=mysqli_fetch_array($res)){                        
                                    $kanbasinci[$i]=$KANBASINCI_row['deger'];
                                    $kanbasinciolcumsaati[$i]=$KANBASINCI_row['tarih'];
                                    $kanbasinciAciklama[$i]=$KANBASINCI_row['aciklama'];
                                    $i++;                                    
                                }

                                ?>

                                <h2>Kan Basıncının Önceki Ölçüme Göre Değişimi</h2>
                                <h3><span class="counter"><?php

                                if($kanbasinci[0]!=1) 
                                    echo $kanbasinci[0]; ?></span> <span class="tuition-fees">Şu anki kan basıncı değeri</span></h3>
                                <h4><span class="tuition-fees">Açıklama:</span> <?php echo $kanbasinciAciklama[0]; ?></span></h4>
                                <h5> <span class="tuition-fees">Ölçüm tarihi</span> <span><?php echo $kanbasinciolcumsaati[0]; ?></span></h5>
                                <span class="text-danger">
                                    <?php
                                      $yuzde=(($kanbasinci[0]-$kanbasinci[1])/$kanbasinci[1])*100;                               
                                        $ek="";
                                    if($yuzde>0){
                                        $ek=" artmış.";
                                    }else{
                                        $ek=" azalmış.";
                                    }
                            echo "%".intval(abs($yuzde))."".$ek; ?></span>
                                    <div class="progress m-b-0">
                                        <div  class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo abs($yuzde);?>%;"></div>
                                    </div>
                                </div> 
                                 <div>
                           <center> <form method="post" action="olcumdetay.php">
                                        <input style="visibility: hidden" type="input" name="degerler" value="<?php echo $_GET['id']."-3";?>">
                                        <center> <input type="submit" class="btn btn-default submit"  name="submit" value="Ayrıntılı görmek için tıklatınız"></center>             
                                    </form></center>
                        </div>
                            </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">

                                <?php
                                    //şekerin yüzdesi hesaplanacak kna şekeri tip id'si ===>> 2

                                $sql="select * from olcumler where hangiOlcum = 6 and hasta_id=".$_GET['id']." ORDER BY id DESC LIMIT 2";
                                $res=mysqli_query($link, $sql);
                               
                                if(mysqli_num_rows($res)==0){
                                    $tuketilenkalori[0]=1;
                                    $tuketilenkalori[1]=1;
                                    $tuketilenkaloriolcumsaati[0]="";
                                    $tuketilenkaloriolcumsaati[1]="";
                                    $tuketilenkaloriAciklama[0]="";
                                    $tuketilenkaloriAciklama[1]="";
                                }
                                $i=0;
                                while($TUKETILENKALORI_row=mysqli_fetch_array($res)){                        
                                    $tuketilenkalori[$i]=$TUKETILENKALORI_row['deger'];
                                    $tuketilenkaloriolcumsaati[$i]=$TUKETILENKALORI_row['tarih'];
                                    $tuketilenkaloriAciklama[$i]=$TUKETILENKALORI_row['aciklama'];
                                    $i++;                                    
                                }

                                ?>

                                <h2>Tüketülen Kalorinin Önceki Ölçüme Göre Değişimi</h2>
                                <h3><span class="counter"><?php

                                if($kanbasinci[0]!=1) 
                                    echo $tuketilenkalori[0]; ?></span> <span class="tuition-fees">Şu anki tüketilen kalori değeri</span></h3>
                                <h4><span class="tuition-fees">Açıklama:</span> <?php echo $tuketilenkaloriAciklama[0]; ?></span></h4>
                                <h5> <span class="tuition-fees">Ölçüm tarihi</span> <span><?php echo $tuketilenkaloriolcumsaati[0]; ?></span></h5>
                                <span class="text-danger">
                                    <?php
                                      $yuzde=(($tuketilenkalori[0]-$tuketilenkalori[1])/$tuketilenkalori[1])*100;                               
                                        $ek="";
                                    if($yuzde>0){
                                        $ek=" artmış.";
                                    }else{
                                        $ek=" azalmış.";
                                    }
                            echo "%".intval(abs($yuzde))."".$ek; ?></span>
                                    <div class="progress m-b-0">
                                        <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo abs($yuzde);?>%;"></div>
                                    </div>
                                </div> 
                                 <div>
                           <center> <form method="post" action="olcumdetay.php">
                                        <input style="visibility: hidden" type="input" name="degerler" value="<?php echo $_GET['id']."-6";?>">
                                        <center> <input type="submit" class="btn btn-default submit"  name="submit" value="Ayrıntılı görmek için tıklatınız"></center>             
                                    </form></center>
                        </div>
                            </div>
                    </td>
                    <td>
                         <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">

                                <?php
                                    //şekerin yüzdesi hesaplanacak kna şekeri tip id'si ===>> 2

                                $sql="select * from olcumler where hangiOlcum = 7 and hasta_id=".$_GET['id']." ORDER BY id DESC LIMIT 2";
                                $res=mysqli_query($link, $sql);
                               
                                if(mysqli_num_rows($res)==0){
                                    $harcanankalori[0]=1;
                                    $harcanankalori[1]=1;
                                    $harcanankaloriolcumsaati[0]="";
                                    $harcanankaloriolcumsaati[1]="";
                                    $harcanankaloriAciklama[0]="";
                                    $harcanankaloriAciklama[1]="";
                                }
                                $i=0;
                                while($HARCANANKALORI_row=mysqli_fetch_array($res)){                        
                                    $harcanankalori[$i]=$HARCANANKALORI_row['deger'];
                                    $harcanankaloriolcumsaati[$i]=$HARCANANKALORI_row['tarih'];
                                    $harcanankaloriAciklama[$i]=$HARCANANKALORI_row['aciklama'];
                                    $i++;                                    
                                }

                                ?>

                                <h2>Harcanan Kalorinin Önceki Ölçüme Göre Değişimi</h2>
                                <h3><span class="counter"><?php

                                if($kanbasinci[0]!=1) 
                                    echo $harcanankalori[0]; ?></span> <span class="tuition-fees">Şu anki harcanan kalori değeri</span></h3>
                                <h4><span class="tuition-fees">Açıklama:</span> <?php echo $tuketilenkaloriAciklama[0]; ?></span></h4>
                                <h5> <span class="tuition-fees">Ölçüm tarihi</span> <span><?php echo $tuketilenkaloriolcumsaati[0]; ?></span></h5>
                                <span class="text-danger">
                                    <?php
                                      $yuzde=(($harcanankalori[0]-$harcanankalori[1])/$harcanankalori[1])*100;                               
                                        $ek="";
                                    if($yuzde>0){
                                        $ek=" artmış.";
                                    }else{
                                        $ek=" azalmış.";
                                    }
                            echo "%".intval(abs($yuzde))."".$ek; ?></span>
                                    <div class="progress m-b-0">
                                        <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo abs($yuzde);?>%;"></div>
                                    </div>
                                </div> 
                                 <div>
                           <center><form method="post" action="olcumdetay.php">
                                        <input style="visibility: hidden" type="input" name="degerler" value="<?php echo $_GET['id']."-7";?>">
                                        <center> <input type="submit" class="btn btn-default submit"  name="submit" value="Ayrıntılı görmek için tıklatınız"></center>             
                                    </form></center>
                        </div>
                            </div>
                    </td>
                    <td>
                         <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">

                                <?php
                                    //şekerin yüzdesi hesaplanacak kna şekeri tip id'si ===>> 2

                                $sql="select * from olcumler where hangiOlcum = 9 and hasta_id=".$_GET['id']." ORDER BY id DESC LIMIT 2";
                                $res=mysqli_query($link, $sql);
                               
                                if(mysqli_num_rows($res)==0){
                                    $vucutsicakligi[0]=1;
                                    $vucutsicakligi[1]=1;
                                    $vucutsicakligiolcumsaati[0]="";
                                    $vucutsicakligiolcumsaati[1]="";
                                    $vucutsicakligiAciklama[0]="";
                                    $vucutsicakligiAciklama[1]="";
                                }
                                $i=0;
                                while($VUCUTSICAKLIGI_row=mysqli_fetch_array($res)){                        
                                    $vucutsicakligi[$i]=$VUCUTSICAKLIGI_row['deger'];
                                    $vucutsicakligiolcumsaati[$i]=$VUCUTSICAKLIGI_row['tarih'];
                                    $vucutsicakligiAciklama[$i]=$VUCUTSICAKLIGI_row['aciklama'];
                                    $i++;                                    
                                }

                                ?>

                                <h2>Vucut Sıcaklığı Önceki Ölçüme Göre Değişimi</h2>
                                <h3><span class="counter"><?php

                                if($kanbasinci[0]!=1) 
                                    echo $kanbasinci[0]; ?></span> <span class="tuition-fees">Şu anki Vucut Sıcaklığı değeri</span></h3>
                                <h4><span class="tuition-fees">Açıklama:</span> <?php echo $vucutsicakligiolcumsaati[0]; ?></span></h4>
                                <h5> <span class="tuition-fees">Ölçüm tarihi</span> <span><?php echo $vucutsicakligiolcumsaati[0]; ?></span></h5>
                                <span class="text-danger">
                                    <?php
                                      $yuzde=(($vucutsicakligi[0]-$vucutsicakligi[1])/$vucutsicakligi[1])*100;                               
                                        $ek="";
                                    if($yuzde>0){
                                        $ek=" artmış.";
                                    }else{
                                        $ek=" azalmış.";
                                    }
                            echo "%".intval(abs($yuzde))."".$ek; ?></span>
                                    <div class="progress m-b-0">
                                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo abs($yuzde);?>%;"></div>
                                    </div>
                                </div> 
                                 <div>
                           <center><form method="post" action="olcumdetay.php">
                                        <input style="visibility: hidden" type="input" name="degerler" value="<?php echo $_GET['id']."-9";?>">
                                        <center> <input type="submit" class="btn btn-default submit"  name="submit" value="Ayrıntılı görmek için tıklatınız"></center>             
                                    </form></center>
                        </div>
                            </div>
                    </td>
                </tr>
            </table>            
                            
        </div>
    </div>
</div>
</div>

<div class="product-sales-area mg-tb-30">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                    <h3 class="box-title">Total Visit</h3>
                    <ul class="list-inline two-part-sp">
                        <li>
                            <div id="sparklinedash"></div>
                        </li>
                        <li class="text-right sp-cn-r"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter text-success">1500</span></li>
                    </ul>
                </div>
                <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n">
                    <h3 class="box-title">Page Views</h3>
                    <ul class="list-inline two-part-sp">
                        <li>
                            <div id="sparklinedash2"></div>
                        </li>
                        <li class="text-right graph-two-ctn"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter text-purple">3000</span></li>
                    </ul>
                </div>
                <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n">
                    <h3 class="box-title">Unique Visitor</h3>
                    <ul class="list-inline two-part-sp">
                        <li>
                            <div id="sparklinedash3"></div>
                        </li>
                        <li class="text-right graph-three-ctn"><i class="fa fa-level-up" aria-hidden="true"></i> <span class="counter text-info">5000</span></li>
                    </ul>
                </div>
                <div class="white-box analytics-info-cs table-dis-n-pro tb-sm-res-d-n dk-res-t-d-n">
                    <h3 class="box-title">Bounce Rate</h3>
                    <ul class="list-inline two-part-sp">
                        <li>
                            <div id="sparklinedash4"></div>
                        </li>
                        <li class="text-right graph-four-ctn"><i class="fa fa-level-down" aria-hidden="true"></i> <span class="text-danger"><span class="counter">18</span>%</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-sales-area mg-tb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="product-sales-chart">
                    <div class="portlet-title">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="caption pro-sl-hd">
                                    <span class="caption-subject"><b>Adminsion Statistic</b></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="actions graph-rp actions-graph-rp">
                                    <a href="#" class="btn btn-dark btn-circle active tip-top" data-toggle="tooltip" title="Refresh">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" class="btn btn-blue-grey btn-circle active tip-top" data-toggle="tooltip" title="Delete">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-inline cus-product-sl-rp">
                        <li>
                            <h5><i class="fa fa-circle" style="color: #006DF0;"></i>Python</h5>
                        </li>
                        <li>
                            <h5><i class="fa fa-circle" style="color: #933EC5;"></i>PHP</h5>
                        </li>
                        <li>
                            <h5><i class="fa fa-circle" style="color: #65b12d;"></i>Java</h5>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="analysis-progrebar res-mg-t-30 mg-ub-10 res-mg-b-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                    <div class="analysis-progrebar-content">
                        <h5>Usage</h5>
                        <h2 class="storage-right"><span class="counter">90</span>%</h2>
                        <div class="progress progress-mini ug-1">
                            <div style="width: 68%;" class="progress-bar"></div>
                        </div>
                        <div class="m-t-sm small">
                            <p>Server down since 1:32 pm.</p>
                        </div>
                    </div>
                </div>
                <div class="analysis-progrebar reso-mg-b-30 res-mg-b-30 mg-ub-10 tb-sm-res-d-n dk-res-t-d-n">
                    <div class="analysis-progrebar-content">
                        <h5>Memory</h5>
                        <h2 class="storage-right"><span class="counter">70</span>%</h2>
                        <div class="progress progress-mini ug-2">
                            <div style="width: 78%;" class="progress-bar"></div>
                        </div>
                        <div class="m-t-sm small">
                            <p>Server down since 12:32 pm.</p>
                        </div>
                    </div>
                </div>
                <div class="analysis-progrebar reso-mg-b-30 res-mg-b-30 res-mg-t-30 mg-ub-10 tb-sm-res-d-n dk-res-t-d-n">
                    <div class="analysis-progrebar-content">
                        <h5>Data</h5>
                        <h2 class="storage-right"><span class="counter">50</span>%</h2>
                        <div class="progress progress-mini ug-3">
                            <div style="width: 38%;" class="progress-bar progress-bar-danger"></div>
                        </div>
                        <div class="m-t-sm small">
                            <p>Server down since 8:32 pm.</p>
                        </div>
                    </div>
                </div>
                <div class="analysis-progrebar res-mg-t-30 table-dis-n-pro tb-sm-res-d-n dk-res-t-d-n">
                    <div class="analysis-progrebar-content">
                        <h5>Space</h5>
                        <h2 class="storage-right"><span class="counter">40</span>%</h2>
                        <div class="progress progress-mini ug-4">
                            <div style="width: 28%;" class="progress-bar progress-bar-danger"></div>
                        </div>
                        <div class="m-t-sm small">
                            <p>Server down since 5:32 pm.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="courses-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">Browser Status</h3>
                    <ul class="basic-list">
                        <li>Google Chrome <span class="pull-right label-danger label-1 label">95.8%</span></li>
                        <li>Mozila Firefox <span class="pull-right label-purple label-2 label">85.8%</span></li>
                        <li>Apple Safari <span class="pull-right label-success label-3 label">23.8%</span></li>
                        <li>Internet Explorer <span class="pull-right label-info label-4 label">55.8%</span></li>
                        <li>Opera mini <span class="pull-right label-warning label-5 label">28.8%</span></li>
                        <li>Mozila Firefox <span class="pull-right label-purple label-6 label">26.8%</span></li>
                        <li>Safari <span class="pull-right label-purple label-7 label">31.8%</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="white-box res-mg-t-30 table-mg-t-pro-n">
                    <h3 class="box-title">Visits from countries</h3>
                    <ul class="country-state">
                        <li>
                            <h2><span class="counter">1250</span></h2> <small>From Australia</small>
                            <div class="pull-right">75% <i class="fa fa-level-up text-danger ctn-ic-1"></i></div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger ctn-vs-1" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:75%;"> <span class="sr-only">75% Complete</span></div>
                            </div>
                        </li>
                        <li>
                            <h2><span class="counter">1050</span></h2> <small>From USA</small>
                            <div class="pull-right">48% <i class="fa fa-level-up text-success ctn-ic-2"></i></div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-info ctn-vs-2" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:48%;"> <span class="sr-only">48% Complete</span></div>
                            </div>
                        </li>
                        <li>
                            <h2><span class="counter">6350</span></h2> <small>From Canada</small>
                            <div class="pull-right">55% <i class="fa fa-level-up text-success ctn-ic-3"></i></div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success ctn-vs-3" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:55%;"> <span class="sr-only">55% Complete</span></div>
                            </div>
                        </li>
                        <li>
                            <h2><span class="counter">950</span></h2> <small>From India</small>
                            <div class="pull-right">33% <i class="fa fa-level-down text-success ctn-ic-4"></i></div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success ctn-vs-4" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:33%;"> <span class="sr-only">33% Complete</span></div>
                            </div>
                        </li>
                        <li>
                            <h2><span class="counter">3250</span></h2> <small>From Bangladesh</small>
                            <div class="pull-right">60% <i class="fa fa-level-up text-success ctn-ic-5"></i></div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-inverse ctn-vs-5" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:60%;"> <span class="sr-only">60% Complete</span></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="footer-copyright-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-copy-right">
                    <p>Copyright © 2018. All rights reserved. Template by <a href="https://colorlib.com/wp/templates/">Colorlib</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

    <!-- jquery
        ============================================ -->
        <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
        ============================================ -->
        <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
        ============================================ -->
        <script src="js/wow.min.js"></script>
    <!-- price-slider JS
        ============================================ -->
        <script src="js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
        ============================================ -->
        <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
        ============================================ -->
        <script src="js/owl.carousel.min.js"></script>
    <!-- sticky JS
        ============================================ -->
        <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
        ============================================ -->
        <script src="js/jquery.scrollUp.min.js"></script>
    <!-- counterup JS
        ============================================ -->
        <script src="js/counterup/jquery.counterup.min.js"></script>
        <script src="js/counterup/waypoints.min.js"></script>
        <script src="js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
        ============================================ -->
        <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
        ============================================ -->
        <script src="js/metisMenu/metisMenu.min.js"></script>
        <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- morrisjs JS
        ============================================ -->
        <script src="js/morrisjs/raphael-min.js"></script>
        <script src="js/morrisjs/morris.js"></script>
        <script src="js/morrisjs/morris-active.js"></script>
    <!-- morrisjs JS
        ============================================ -->
        <script src="js/sparkline/jquery.sparkline.min.js"></script>
        <script src="js/sparkline/jquery.charts-sparkline.js"></script>
        <script src="js/sparkline/sparkline-active.js"></script>
    <!-- calendar JS
        ============================================ -->
        <script src="js/calendar/moment.min.js"></script>
        <script src="js/calendar/fullcalendar.min.js"></script>
        <script src="js/calendar/fullcalendar-active.js"></script>
    <!-- plugins JS
        ============================================ -->
        <script src="js/plugins.js"></script>
    <!-- main JS
        ============================================ -->
        <script src="js/main.js"></script>
    <!-- tawk chat JS
        ============================================ -->
        <script src="js/tawk-chat.js"></script>
    </body>
    </html>