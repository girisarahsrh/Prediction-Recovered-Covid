<form >

                    <?php
                    
                            //echo"<br>Z4= $zj44";

        // --------------------------------Hitung Semua keluaran Jaringan di Unit Keluaran-------------------------------------
                        //proses Output Layer
                        //perkalian

                    $Yin=$w0+($w1*$Z1)+($w2*$Z2)+($w3*$Z3)+($w4*$Z4);
                    $Ynett=number_format($Yin,4);
                            //echo"<br><br>Yin= $Ynett";


                        //Pengaktifan


                    $Y=1/(1+(EXP(-$Yin)));
                    $Ykk=number_format($Y,4);

                            //echo"<br>Y= $Ykk";

// --------------------------------------------------- End FeedForward-----------------------------------------------------------

// --------------------------------------------------- Start BackForward-----------------------------------------------------------

        // ---------------------------------Hitung Faktor kesalahan unit keluaran-------------------------------------------- 

                    $dk=($x5-$Y)*$Y*(1-$Y);

        // ---------------------------------Hitung Suku Perubahan Bobot--------------------------------------------
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

        // ---------------------------------Hitung Faktor Kesalahan d--------------------------------------------
                            //Perbaharui Bobot

                    $dkin1 = $dk * $w1;
                    $dkin2 = $dk * $w2;
                    $dkin3 = $dk * $w3;
                    $dkin4 = $dk * $w4;

                    $dk1 = $dkin1 * (1/1+(EXP(-$Z1))) * (1-(1/1+(EXP(-$Z1))));
                    $dk2 = $dkin2 * (1/1+(EXP(-$Z2))) * (1-(1/1+(EXP(-$Z2))));
                    $dk3 = $dkin3 * (1/1+(EXP(-$Z3))) * (1-(1/1+(EXP(-$Z3))));
                    $dk4 = $dkin4 * (1/1+(EXP(-$Z4))) * (1-(1/1+(EXP(-$Z4))));


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

                    $error=($x5-$Y);
                    $MSE=pow(($error),2);
                                //$hasillll=($Yin*($max-$min))+$min;//munculin hasil sebenarnya
                    echo "epoch = $epoch<br>";
                    echo "Error = $MSE<br>";
                                // echo"<br>V11baru= $V11hidden<br>";
                                // echo"<br>V21baru= $V21hidden<br>";
                                // echo"<br>V31baru= $V31hidden<br>";
                                // echo"<br>V41baru= $V41hidden<br>";


                                // echo"<br>V12baru= $V12hidden<br>";
                                // echo"<br>V22baru= $V22hidden<br>";
                                // echo"<br>V32baru= $V32hidden<br>";
                                // echo"<br>V42baru= $V42hidden<br>";

                                // echo"<br>V13baru= $V13hidden<br>";
                                // echo"<br>V23baru= $V23hidden<br>";
                                // echo"<br>V33baru= $V33hidden<br>";
                                // echo"<br>V43baru= $V43hidden<br>";

                                // echo"<br>V14baru= $V14hidden<br>";
                                // echo"<br>V24baru= $V24hidden<br>";
                                // echo"<br>V34baru= $V34hidden<br>";
                                // echo"<br>V44baru= $V44hidden<br>";

                                // echo"<br>W0baru= $W0hidden<br>";
                                // echo"<br>W1baru= $W1hidden<br>";
                                // echo"<br>W2baru= $W2hidden<br>";
                                // echo"<br>W3baru= $W3hidden<br>";
                                // echo"<br>W4baru= $W4hidden<br>";


                        //Test prediksi sehari setelahnya

                                //penjumlahan terbobot
                    $Zin1prediksi = $v01baru + ($V11hidden * 115) + ($V21hidden * 87) + ($V31hidden * 109) + ($V41hidden * 9);
                    $Zin2prediksi = $v02baru + ($V12hidden * 115) + ($V22hidden * 87) + ($V32hidden * 109) + ($V42hidden * 9);
                    $Zin3prediksi = $v03baru + ($V13hidden * 115) + ($V23hidden * 87) + ($V33hidden * 109) + ($V43hidden * 9);
                    $Zin4prediksi = $v04baru + ($V14hidden * 115) + ($V24hidden * 87) + ($V34hidden * 109) + ($V44hidden * 9);

                                //Pengaktifan

                    $Z1iprediksi = (1/1+(EXP(-$Zin1prediksi)));
                    $Z2iprediksi = (1/1+(EXP(-$Zin2prediksi)));
                    $Z3iprediksi = (1/1+(EXP(-$Zin3prediksi)));
                    $Z4iprediksi = (1/1+(EXP(-$Zin4prediksi)));

                    $Yinbaru = $W0hidden + ($W1hidden * $Z1iprediksi) + ($W2hidden*$Z2iprediksi) + ($W3hidden*$Z3iprediksi) + ($W4hidden*$Z4iprediksi);
                    $Ybaru = (1/1+(EXP(-$Yinbaru)));
                    $kiri = $Ybaru-0.1;
                    $hasilbaru = ($kiri*(2-$min)/0.8) + 2;
                        //$hasilbaru=($Yinbaru*($max-$min))+$min;//munculin hasil sebenarnya

                    $error=$error;
                    echo"<br>Yinbaru= $Yinbaru<br>";
                    echo"<br>HASILNYA= $hasilbaru<br>";
                    

                    //echo"<br>Yk= $hasil4<br>";




                        // //-----------------------------------
                        //     $hasillll=($Yin*($max-$min))+$min;//munculin hasil sebenarnya
                        //     $hasil4=number_format($hasillll,0);
                        //     //echo"<br>Yk= $hasil4<br>";

                        //     $e=($x5-$Y);
                        //     $ee=number_format($e,4);
                        //     $kuadraterror = (pow($e,2))/4;

                        //     //echo"<br>e= $kuadraterror<br>";
                        //     //$this->db->query('truncate table hasilprediksi');
                        //     // $q = "INSERT into hasilprediksi(kodenegara,tanggal,error,hasil,epoch) values('".$s->kodenegara."','".$s->tanggal."','".$kuadraterror."','".$Ykk."','".$epoch."')";
                        //     // $this->db->query($q);



// --------------------------------------------------- End BackForward-----------------------------------------------------------




                    ?>
                </form>