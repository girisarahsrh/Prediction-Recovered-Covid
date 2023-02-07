//--------------BACKPROPAGATION!!-------------------------

// //-----------------------------------
$dk=($x5-$Y)*$Y*(1-$Y);

$dkk=number_format($dk,4);
//echo"<br>dk = $dkk";
//-----------------------------------

//koreksi Bobot


$W0baru=$a*$dk;
$Nwjk11=number_format($W0baru,4);
//echo"<br><br>Bobot W0 baru= $Nwjk11";

$W1baru=$a*$dk*$Z1;
$Nwjk22=number_format($W1baru,4);
//echo"<br>Bobot W1 baru= $Nwjk22";

$W2baru=$a*$dk*$Z2;
$Nwjk33=number_format($W2baru,4);
//echo"<br>Bobot W2 baru= $Nwjk33";

$W3baru=$a*$dk*$Z3;
$Nwjk44=number_format($W3baru,4);
//echo"<br>Bobot W3 baru= $Nwjk44";

$W4baru=$a*$dk*$Z4;
$Nwjk55=number_format($W4baru,4);
//echo"<br>Bobot W4 baru= $Nwjk55";

//Perbaharui Bobot

$dkin1 = $dk * $w1;
$dkin2 = $dk * $w2;
$dkin3 = $dk * $w3;
$dkin4 = $dk * $w4;

$dk1 = $dkin1 * (1/1+(EXP(-$Z1))) * (1-(1/1+(EXP(-$Z1))));
$dk2 = $dkin2 * (1/1+(EXP(-$Z2))) * (1-(1/1+(EXP(-$Z2))));
$dk3 = $dkin3 * (1/1+(EXP(-$Z3))) * (1-(1/1+(EXP(-$Z3))));
$dk4 = $dkin4 * (1/1+(EXP(-$Z4))) * (1-(1/1+(EXP(-$Z4))));




//Tiap unit keluaran memperbaharui Bobot

$v11baru = $a * $dk1 * $x1;
$v21baru = $a * $dk1 * $x2;
$v31baru = $a * $dk1 * $x3;
$v41baru = $a * $dk1 * $x4;

$v12baru = $a * $dk2 * $x1;
$v22baru = $a * $dk2 * $x2;
$v32baru = $a * $dk2 * $x3;
$v42baru = $a * $dk2 * $x4;

$v13baru = $a * $dk3 * $x1;
$v23baru = $a * $dk3 * $x2;
$v33baru = $a * $dk3 * $x3;
$v43baru = $a * $dk3 * $x4;

$v14baru = $a * $dk4 * $x1;
$v24baru = $a * $dk4 * $x2;
$v34baru = $a * $dk4 * $x3;
$v44baru = $a * $dk4 * $x4;

$v01baru = $a * $dk1;
$v02baru = $a * $dk2;
$v03baru = $a * $dk3;
$v04baru = $a * $dk4;


//Hitung bobot awal input ke hidden

$V11hidden = $v11 + $v11baru;
$V21hidden = $v21 + $v21baru;
$V31hidden = $v31 + $v31baru;
$V41hidden = $v41 + $v41baru;

$V12hidden = $v12 + $v12baru;
$V22hidden = $v22 + $v22baru;
$V32hidden = $v32 + $v32baru;
$V42hidden = $v42 + $v42baru;

$V13hidden = $v13 + $v13baru;
$V23hidden = $v23 + $v23baru;
$V33hidden = $v33 + $v33baru;
$V43hidden = $v43 + $v43baru;

$V14hidden = $v14 + $v14baru;
$V24hidden = $v24 + $v24baru;
$V34hidden = $v34 + $v34baru;
$V44hidden = $v44 + $v44baru;

$W0hidden = $w0 + $W0baru;
$W1hidden = $w1 + $W1baru;
$W2hidden = $w2 + $W2baru;
$W3hidden = $w3 + $W3baru;
$W4hidden = $w4 + $W4baru;

//Test prediksi sehari setelahnya

//penjumlahan terbobot
$Zin1prediksi = $v01baru + ($V11hidden * $x1) + ($V21hidden * $x2) + ($V31hidden * $x3) + ($V41hidden * $x4);
$Zin2prediksi = $v02baru + ($V12hidden * $x1) + ($V22hidden * $x2) + ($V32hidden * $x3) + ($V42hidden * $x4);
$Zin3prediksi = $v03baru + ($V13hidden * $x1) + ($V23hidden * $x2) + ($V33hidden * $x3) + ($V43hidden * $x4);
$Zin4prediksi = $v04baru + ($V14hidden * $x1) + ($V24hidden * $x2) + ($V34hidden * $x3) + ($V44hidden * $x4);

//Pengaktifan

$Z1iprediksi = (1/1+(EXP(-$Zin1prediksi)));
$Z2iprediksi = (1/1+(EXP(-$Zin2prediksi)));
$Z3iprediksi = (1/1+(EXP(-$Zin3prediksi)));
$Z4iprediksi = (1/1+(EXP(-$Zin4prediksi)));

//Operasi Output

$Yin = $W0hidden + ($W1hidden * $Z1iprediksi) + ($W2hidden*$Z2iprediksi) + ($W3hidden*$Z3iprediksi) + ($W4hidden*$Z4iprediksi);
$Y = (1/1+(EXP(-$Yin)));

//output
$kiri = $Y-0.1;
$hasil = ($kiri*(2-$min)/0.8) + 2;
echo"hasil = $hasil<br>";

if($kuadraterror <= 0.003){
$q = "INSERT into hasilprediksi(kodenegara,tanggal,error,hasil,epoch) values('".$s->kodenegara."','".$s->tanggal."','".$kuadraterror."','".$hasil."','".$epoch."')";
$this->db->query($q);
