<?php public function TestingAll($kodenegara=''){

		$datanormalisasi = $this->db->query("SELECT * from datagrafik WHERE kodenegara = '$kodenegara'");
		$cek = $this->db->query("SELECT kodenegara from normalisasi WHERE kodenegara = '$kodenegara'");
		$data['confirmed'] = $this->MData->countconkode($kodenegara);
		$min = 0;
		$q = "";

		    // ---------------------------------Unit Masukan Normalisasi--------------------------------------------
		if(count($cek->result())==0)

		{
			foreach ($datanormalisasi->result() as $s) 
			{
				$x1=(0.8*($s->confirmed-$min)/($data['confirmed']-$min))+0.1;

				$x2=(0.8*($s->death-$min)/($data['confirmed']-$min))+0.1;

				$x3=(0.8*($s->concasesdaily-$min)/($data['confirmed']-$min))+0.1;

				$x4=(0.8*($s->deathcasesdaily-$min)/($data['confirmed']-$min))+0.1;

				$x5=(0.8*($s->recovered-$min)/($data['confirmed']-$min))+0.1;

				$q = "INSERT into normalisasi(kodenegara,tanggal,x1,x2,x3,x4,x5) values('".$s->kodenegara."','".$s->tanggal."','".$x1."','".$x2."','".$x3."','".$x4."','".$x5."')";
				$this->db->query($q);
			}
		}

		}else

		{
			foreach ($datanormalisasi->result() as $s) 
			{
				$x1=(0.8*($s->confirmed-$min)/($data['confirmed']-$min))+0.1;

				$x2=(0.8*($s->death-$min)/($data['confirmed']-$min))+0.1;

				$x3=(0.8*($s->concasesdaily-$min)/($data['confirmed']-$min))+0.1;

				$x4=(0.8*($s->deathcasesdaily-$min)/($data['confirmed']-$min))+0.1;

				$x5=(0.8*($s->recovered-$min)/($data['confirmed']-$min))+0.1;

				$q = "UPDATE normalisasi SET x1='".$x1."',x2='".$x2."',x3='".$x3."',x4='".$x4."',x5='".$x5."' WHERE kodenegara='$s->kodenegara' and tanggal ='$s->tanggal'";
				$this->db->query($q);
			}
		}

		$v01=rand(-1,1) / 10;
		$v02=rand(-1,1) / 10;
		$v03=rand(-1,1) / 10;
		$v04=rand(-1,1) / 10;


		$v11=rand(-1,1) / 10;
		$v12=rand(-1,1) / 10;
		$v13=rand(-1,1) / 10;
		$v14=rand(-1,1) / 10;


		$v21=rand(-1,1) / 10;
		$v22=rand(-1,1) / 10;
		$v23=rand(-1,1) / 10;
		$v24=rand(-1,1) / 10;


		$v31=rand(-1,1) / 10;
		$v32=rand(-1,1) / 10;
		$v33=rand(-1,1) / 10;
		$v34=rand(-1,1) / 10;


		$v41=rand(-1,1) / 10;
		$v42=rand(-1,1) / 10;
		$v43=rand(-1,1) / 10;
		$v44=rand(-1,1) / 10;


		$w0=rand(-1,1) / 10;
		$w1=rand(-1,1) / 10;
		$w2=rand(-1,1) / 10;
		$w3=rand(-1,1) / 10;
		$w4=rand(-1,1) / 10;



		



// ------------------------------------ Start FeedForward---------------------------------------
		$dataZ = $this->db->query("SELECT * from normalisasi WHERE kodenegara = '$kodenegara' and tanggal <= '2020-03-12' and x1 >'0' and x2 >'0' and x3 >'0' and x4 >'0'and x5 >'0'");
		$cek = $this->db->query("SELECT * from bobotbaru where kodenegara ='$kodenegara'");
		$data['recovered'] = $this->MData->hasilre($kodenegara);
		$recoveredx5=$data['recovered'];
		foreach ($dataZ->result_array() as $s) 
		{
			$x1=$s['x1'];
			$x2=$s['x2'];
			$x3=$s['x3'];
			$x4=$s['x4'];
			$x5=$s['x5'];
		}

		$a=0.9;
		for ($x=0; $x<10000; $x++) {      
			for ($y=0; $y < 4; $y++) {  

        // ---------------------------------Unit Masukan Menerima Sinyal-------------------------------------------- 

				$Zin1[$y]   =$v01 + ($v11*$x1) + ($v21*$x2) + ($v31*$x3) + ($v41*$x4);

                            //-----------------------------------

				$Zin2[$y]   =$v02 + ($v12*$x1) + ($v22*$x2) + ($v32*$x3) + ($v42*$x4);

                            //-----------------------------------

				$Zin3[$y]   =$v03 + ($v13*$x1) + ($v23*$x2) + ($v33*$x3) + ($v43*$x4);

                            //-----------------------------------

				$Zin4[$y]   =$v04 + ($v14*$x1) + ($v24*$x2) + ($v34*$x3) + ($v44*$x4);




         // ---------------------------------Hitung Keluaran di Unit Tersembunyi--------------------------------------- 

                            //proses Pengaktifan

				$Z1[$y]=1/(1+(EXP($Zin1[$y])*(-1)));
		                     //-----------------------------------
				$Z2[$y]=1/(1+(EXP($Zin2[$y])*(-1)));	
                            //-----------------------------------
				$Z3[$y]=1/(1+(EXP($Zin3[$y])*(-1)));
                            //-----------------------------------
				$Z4[$y]=1/(1+(EXP($Zin4[$y])*(-1)));
							 //-----------------------------------

				$Yin[$y]=$w0+($w1*$Z1[$y])+($w2*$Z2[$y])+($w3*$Z3[$y])+($w4*$Z4[$y]);


                        	//Pengaktifan

				$Y[$y]=1/(1+(EXP($Yin[$y])*(-1)));
				$MSE[$y]=pow(($Y[$y]-$x5),2)/87;
				//$err[$y] = ($s->x5-$Y)*$Y*(1$out[$y]); 
//---------------------------------------- End FeedForward---------------------------------------------

// ---------------------------------------- Start BackForward------------------------------------------------
			//Error

				$dk[$y]=($x5-$Y[$y])*$Y[$y]*(1-$Y[$y]);

		 // ---------------------------------Hitung Suku Perubahan Bobot--------------------------------------------
				$W0baru=$a*$dk[$y];
				$W1baru=$a*$dk[$y]*$Z1[$y];
				$W2baru=$a*$dk[$y]*$Z2[$y];
				$W3baru=$a*$dk[$y]*$Z3[$y];
				$W4baru=$a*$dk[$y]*$Z4[$y];


			//Perbaharui Bobot

				$dkin1 = $dk[$y] * $w1;
				$dkin2 = $dk[$y] * $w2;
				$dkin3 = $dk[$y] * $w3;
				$dkin4 = $dk[$y] * $w4;


				$dk1 = $dkin1 * (1/1+(EXP(-$Z1[$y]))) * (1-(1/1+(EXP(-$Z1[$y]))));
				$dk2 = $dkin2 * (1/1+(EXP(-$Z2[$y]))) * (1-(1/1+(EXP(-$Z2[$y]))));
				$dk3 = $dkin3 * (1/1+(EXP(-$Z3[$y]))) * (1-(1/1+(EXP(-$Z3[$y]))));
				$dk4 = $dkin4 * (1/1+(EXP(-$Z4[$y]))) * (1-(1/1+(EXP(-$Z4[$y]))));



             //Hitung suku perubahan bobot V (yang akan dipakai nanti untuk merubah bobot  V)

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



			// ---------------------------------Perubahan Bobot--------------------------------------------
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


				//Rumus Error


			}
			$hasilmse[$x] = (array_sum($MSE))/10; 
				// $MSE1=pow(($MAD),2);
				// $MSE=$MSE1/87;
				//$MAPE = (($MAD)/87)*100;
			

			
		}

		$totalmse = (array_sum($hasilmse))/$x;



		if(isset($cek))

		{
			$this->db->query("DELETE from bobotbaru where kodenegara ='$kodenegara'");
			$q = "INSERT into bobotbaru(kodenegara,v01,v02,v03,v04,v11,v12,v13,v14,v21,v22,v23,v24,v31,v32,v33,v34,v41,v42,v43,v44,w0,w1,w2,w3,w4,mse,epoch) values('".$kodenegara."','".$v01baru."','".$v02baru."','".$v03baru."','".$v04baru."','".$V11hidden."','".$V12hidden."','".$V13hidden."','".$V14hidden."','".$V21hidden."','".$V22hidden."','".$V23hidden."','".$V24hidden."','".$V31hidden."','".$V32hidden."','".$V33hidden."','".$V34hidden."','".$V41hidden."','".$V42hidden."','".$V43hidden."','".$V44hidden."','".$W0hidden."','".$W1hidden."','".$W2hidden."','".$W3hidden."','".$W4hidden."','".$totalmse."','".$x."')";
			$this->db->query($q);



		}else

		{
			$q = "INSERT into bobotbaru(kodenegara,v01,v02,v03,v04,v11,v12,v13,v14,v21,v22,v23,v24,v31,v32,v33,v34,v41,v42,v43,v44,w0,w1,w2,w3,w4,mse,epoch) values('".$kodenegara."','".$v01baru."','".$v02baru."','".$v03baru."','".$v04baru."','".$V11hidden."','".$V12hidden."','".$V13hidden."','".$V14hidden."','".$V21hidden."','".$V22hidden."','".$V23hidden."','".$V24hidden."','".$V31hidden."','".$V32hidden."','".$V33hidden."','".$V34hidden."','".$V41hidden."','".$V42hidden."','".$V43hidden."','".$V44hidden."','".$W0hidden."','".$W1hidden."','".$W2hidden."','".$W3hidden."','".$W4hidden."','".$totalmse."','".$x."')";
			$this->db->query($q);


		}

		$this->db->where('kodenegara',$kodenegara);
		$this->db->where('tanggal','2020-04-16');
		$dataAkhir = $this->db->get("normalisasi");

		$cekfinal = $this->db->query("SELECT * from final where kodenegara = '$kodenegara'");

		$this->db->where('kodenegara',$kodenegara);
		$databobot = $this->db->get('bobotbaru');
		$v01=$v01baru;
		$v02=$v02baru;
		$v03=$v03baru;
		$v04=$v04baru;


		$v11=$V11hidden;
		$v12=$V12hidden;
		$v13=$V13hidden;
		$v14=$V14hidden;


		$v21=$V21hidden;
		$v22=$V22hidden;
		$v23=$V23hidden;
		$v24=$V24hidden;


		$v31=$V31hidden;
		$v32=$V32hidden;
		$v33=$V33hidden;
		$v34=$V34hidden;


		$v41=$V41hidden;
		$v42=$V42hidden;
		$v43=$V43hidden;
		$v44=$V44hidden;


		foreach($databobot->result_array() as $b)
		{
			$v01 =$b['v01'];
			$v02 =$b['v02'];
			$v03 =$b['v03'];
			$v04 =$b['v04'];

			$v11 =$b['v11'];
			$v12 =$b['v12'];
			$v13 =$b['v13'];
			$v14 =$b['v14'];

			$v21 =$b['v21'];
			$v22 =$b['v22'];
			$v23 =$b['v23'];
			$v24 =$b['v24'];

			$v31 =$b['v31'];
			$v32 =$b['v32'];
			$v33 =$b['v33'];
			$v34 =$b['v34'];

			$v41 =$b['v41'];
			$v42 =$b['v42'];
			$v43 =$b['v43'];
			$v44 =$b['v44'];

			$w0 =$b['w0'];
			$w1 =$b['w1'];
			$w2 =$b['w2'];
			$w3 =$b['w3'];
			$w4 =$b['w4'];
		}
		$data['x5'] = $this->MData->hasilre($kodenegara);
		$datarecoveredprediksi =$data['x5'];

		$data['maxre'] = $this->MData->maxrecovered($kodenegara);
		$maxre =$data['maxre'];
		$q='';


		foreach ($dataAkhir->result() as $s) 
		{
			$Zin1prediksi = $v01 + ($v11 * $s->x1) + ($v21 * $s->x2) + ($v31 * $s->x3) + ($v41 * $s->x4);
			$Zin2prediksi = $v02 + ($v12 * $s->x1) + ($v22 * $s->x2) + ($v32 * $s->x3) + ($v42 * $s->x4);
			$Zin3prediksi = $v03 + ($v13 * $s->x1) + ($v23 * $s->x2) + ($v33 * $s->x3) + ($v43 * $s->x4);
			$Zin4prediksi = $v04 + ($v14 * $s->x1) + ($v24 * $s->x2) + ($v34 * $s->x3) + ($v44 * $s->x4);



                                //Pengaktifan

			$Z1iprediksi = (1/1+(EXP(-$Zin1prediksi)));
			$Z2iprediksi = (1/1+(EXP(-$Zin2prediksi)));
			$Z3iprediksi = (1/1+(EXP(-$Zin3prediksi)));
			$Z4iprediksi = (1/1+(EXP(-$Zin4prediksi)));


			$Yinbaru = $w0 + ($w1 * $Z1iprediksi) + ($w2 * $Z2iprediksi) + ($w3 * $Z3iprediksi) + ($w4 * $Z4iprediksi);
			$Ybaru = (1/1+(EXP(-$Yinbaru)));
			$kiri = $Ybaru-0.1;
			$hasilbaru = ($kiri*($maxre-0)/0.8) + 0;
				//$hasilbaru=($Ybaru*($datamaxre-0))+0;
			if($hasilbaru<=0){
				$selisih=$datarecoveredprediksi;
			}else{
				$selisih = $hasilbaru - $datarecoveredprediksi;
			}
			
			$MAD=($datarecoveredprediksi-$Yinbaru);
			$MAPE = (($MAD)/87);
			$AKURASI = 100 - $MAPE;
		}
		$selisihperbandingan=$selisih;
		if(isset($cekfinal))

		{
			$this->db->query("DELETE from final where kodenegara ='$kodenegara'");

			$q = "INSERT into final(kodenegara,tanggal,prediksi,selisih,mad,mape,akurasi) values('".$s->kodenegara."','".$s->tanggal."','".$hasilbaru."','".$selisih."','".$MAD."','".$MAPE."','".$AKURASI."')";
			$this->db->query($q);
		}else{
			$q = "INSERT into final(kodenegara,tanggal,prediksi,selisih,mad,mape,akurasi) values('".$s->kodenegara."','".$s->tanggal."','".$hasilbaru."','".$selisih."','".$MAD."','".$MAPE."','".$AKURASI."')";
			$this->db->query($q);
		}
?>