

<div class="content mt-3">
    <div class="container">
        <canvas id="chart_area_report" style="width: 100%; height: 620px;"></canvas>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Report Data</strong> 
                    
                </div>


                <div class="card-body">
                    <a href="<?php echo base_url(); ?>CC/ExportReport"><button type="button" class="btn btn-link"><i class="fa fa-print"></i>&nbsp; Export</button></a>
                    <!-- <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Filter..." ng-model="filter_data"><br>
                    </div> -->
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Country Code</th>
                                <th>Country Name</th>
                                <th>Date</th>
                                <th>Confirmed</th>
                                <th>Death</th>
                                <th>Recovered</th>
                                <th>Prediction</th>
                                <th>Selisih</th>
                                <th>Accuracy</th>
                                <th></th>
<!--                                 <th>Traning</th>
                                <th>Testing</th>
                                <th>Output</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total = array(
                                'accuracy' => 0);
                            $no=1;
                            $i= 0;
                            foreach ($datahasil as $s) {?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $s['kodenegara']; ?></td>
                                    <td><?php echo $s['namanegara']; ?></td>
                                    <td><?php echo $s['tanggal']; ?></td>
                                    <td><?php echo number_format($s['confirmed'],0); ?></td>
                                    <td><?php echo number_format($s['death'],0); ?></td>
                                    <td><?php echo number_format($s['recovered'],0); ?></td>
                                    <td><?php echo number_format($s['prediksi'],0); ?></td>
                                    <td><?php echo number_format($s['selisih'],0); ?></td>
                                    <td><?php

                                    $a = $s['recovered']-$s['prediksi'];
                                    $b = $s['recovered'] - $a;

                                    if($s['recovered'] == 0) {
                                        $x = abs((($s['recovered'] - $s['prediksi'])/1)) * 100;

                                    }if($s['recovered'] == number_format($s['prediksi'])){
                                        $x = 0;
                                    }else{
                                        $x = abs(($s['recovered']-$s['prediksi'])/$s['recovered']) * 100;
                                    }
                                    $accuracy = 100 - $x;

                                    if ($accuracy >= 99.9999){
                                        echo number_format($accuracy,0);
                                    }else{
                                        echo number_format($accuracy,4);
                                    }


                                    ?>%</td>
                                    <td><a href="<?php echo site_url('CC/AllAlgoritma/'.$s['kodenegara'])?>"><button type="submit" class="btn btn-success btn-sm" >
                                        <i class="fa fa-refresh"></i></button></a></td>
<!--                                             <td><?php echo $s['training']; ?></td>
                                            <td><?php echo $s['testing']; ?></td>
                                            <td><?php echo $s['ybaru']?></td> -->
                                            

                                            <?php 
                                            $total['accuracy'] = $total['accuracy']+$accuracy;
                                            $no++;
                                            $i++;
                                        }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td colspan="9" style="text-align: center;"><b>AVERAGE</b></td>
                                        <td><b><?php echo number_format($total['accuracy']/$i,1); ?>%</b></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col">
                                    <!--Tampilkan pagination-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </di>

