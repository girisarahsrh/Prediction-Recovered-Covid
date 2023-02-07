<?php
$lr = 0.9; 

$a = rand(-1,1) / 10; 
$b = rand(-1,1) / 10; 
$c = rand(-1,1) / 10; 
$d = rand(-1,1) / 10; 
$e = rand(-1,1) / 10; 
$f = rand(-1,1) / 10; 
$g = rand(-1,1) / 10; 
$h = rand(-1,1) / 10; 
$i = rand(-1,1) / 10; 
$j = rand(-1,1) / 10; 
$k = rand(-1,1) / 10; 
$l = rand(-1,1) / 10; 
$m = rand(-1,1) / 10; 

$input = array(
   array(0.21,0.3),
   array(0.85,0.42),
   array(0.74,0.58),
   array(0.1,0.22),
   array(0.42,0.26),
   array(0.14,0.58),
   array(0.52,0.34),
   array(0.15,0.46),
   array(0.41,0.74),
   array(0.1,0.66)); 

$output = array(0,1,1,0,0,0,0,0,1,0); 


for ($x=0; $x<180; $x++) {      
   for ($y=0; $y < 10; $y++) {  

      $nh1[$y]= $a + ($b*$input[$y][1]) + ($c*$input[$y][0]);          
      $nh2[$y]= $d + ($e*$input[$y][1]) + ($f*$input[$y][0]);          
      $nh3[$y]= $g + ($h*$input[$y][1]) + ($i*$input[$y][0]);  

      $oh1[$y]= 1 / (1+exp($nh1[$y]*(-1)));          
      $oh2[$y]= 1 / (1+exp($nh2[$y]*(-1)));          
      $oh3[$y]= 1 / (1+exp($nh3[$y]*(-1))); 

      $no[$y]= $j + ($oh1[$y]*$k) + ($oh2[$y]*$l) + ($oh3[$y]*$m); 

      $out[$y] = 1 / (1+exp($no[$y]*(-1))); 

      $mse[$y] = pow(($out[$y]-$output[$y]),2); 

      $err[$y] = ($output[$y]-$out[$y])*$out[$y]*(1$out[$y]); 

      $uj = $j + $lr*$err[$y];          
      $uk = $k + $lr*$err[$y]*$oh1[$y];          
      $ul = $l + $lr*$err[$y]*$oh2[$y];          
      $um = $m + $lr*$err[$y]*$oh3[$y]; 

      $enh1 = $err[$y]*$k;          
      $enh2 = $err[$y]*$l;          
      $enh3 = $err[$y]*$m; 

      $eh1 = $enh1*$oh1[$y]*(1-$oh1[$y]);          
      $eh2 = $enh2*$oh2[$y]*(1-$oh2[$y]);          
      $eh3 = $enh3*$oh3[$y]*(1-$oh3[$y]); 

      $ua = $a + $lr*$eh1;          
      $ub = $b + $lr*$eh1*$input[$y][1];         
      $uc = $c + $lr*$eh1*$input[$y][0];          
      $ud = $d + $lr*$eh2;          
      $ue = $e + $lr*$eh2*$input[$y][1];          
      $uf = $f + $lr*$eh2*$input[$y][0];         
      $ug = $g + $lr*$eh3;          
      $uh = $h + $lr*$eh3*$input[$y][1];          
      $ui = $i + $lr*$eh3*$input[$y][0]; 

      $a = $ua;          
      $b = $ub;          
      $c = $uc;          
      $d = $ud; 


      $e = $ue;          
      $f = $uf;          
      $g = $ug;          
      $h = $uh;          
      $i = $ui;          
      $j = $uj;          
      $k = $uk;          
      $l = $ul;          
      $m = $um;      
   }      
   $hasilmse[$x] = (array_sum($mse))/10; 
} 

$totalmse = (array_sum($hasilmse))/$x; 

//TESTING DATA

$bulan = date("m"); 

$a = 1.2817164322232; 
$b = -2.0161081024844; 
$c = -2.4820055708634; 
$d = 0.39234709422736; 
$e = -1.4500143409141; 
$f = -1.8379153691184; 
$g = 3.2170084420988; 
$h = -3.7499228156667; 
$i = -3.788658534876; 
$j = 3.5249716409331; 
$k = -3.2197327590555; 
$l = -2.0392787777114; 
$m = -5.9333871155382; 

if($bulan==1){    
   $nilaiBulan = 8; 
} 
if($bulan==11 || $bulan == 2)
{    
   $nilaiBulan = 2; 
} 


if($bulan==3 || $bulan == 4){
  $nilaiBulan = 4; 
} 
if($bulan == 5)
{    
   $nilaiBulan = 15; 
} 
if($bulan==6)
{    
   $nilaiBulan = 25; 
} 
if($bulan==7)
{ 
   $nilaiBulan = 32; 
} 
if($bulan==8){
  $nilaiBulan = 35; 
} if($bulan==9)
{ 
  $nilaiBulan = 29;
}
if($bulan==10)
{    
   $nilaiBulan = 26; 
} 
if($bulan==12)
{    
   $nilaiBulan = 3; 
} 

$nilaiBln = (((0.8*$nilaiBulan)-(0.8*2))/(35-2))+0.1; 
$nilaiSkor = (((0.8*$skor)-(0.8*0))/(100-0))+0.1;                                  
$nh1 = $a + $nilaiSkor*$b + $nilaiBln*$c; 
$nh2 = $d + $nilaiSkor*$d + $nilaiBln*$f; 
$nh3 = $g + $h*$nilaiSkor + $i*$nilaiBln; 

$oh1 = 1 / (1+exp($nh1*(-1))); 
$oh2 = 1 / (1+exp($nh2*(-1))); 
$oh3 = 1 / (1+exp($nh3*(-1))); 

$no= $j + ($oh1*$k) + ($oh2*$l) + ($oh3*$m); 
$out = 1 / (1+exp($no*(-1))); 

$hargaLama = $row->hargaKamar; 
$max = $hargaLama + (0.05*$hargaLama); 
$min = $hargaLama - (0.025*$hargaLama);                                  
$hargaBaru = ((($max-$min)*($out-0.1))/0.8)+$min; 

?>