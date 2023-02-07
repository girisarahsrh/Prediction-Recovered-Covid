
<div class="content mt-3">

    <div class="animated fadeIn">
        <div class="row">

<!--             <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                 PREDICTION FOR :  <b> 29 March 2020</b>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div> -->



        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <strong class="card-title">Bobot</strong>
                </div>

                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered" style="width: 100%;">

                        <thead>
                            <tr>

                                <th>V01</th>
                                <th>V02</th>
                                <th>V03</th>
                                <th>V04</th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <?php 

                                foreach ($bobotbaru as $s) :
                                    ?>
                                    <tr>
                                        <td><?php echo $s->v01; ?></td>
                                        <td><?php echo $s->v02; ?></td>
                                        <td><?php echo $s->v03; ?></td>
                                        <td><?php echo $s->v04; ?></td>


                                        <?php                                    

                                    endforeach;
                                    ?>
                                </tr>
                            </tbody>


                        </table>     

                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered" style="width: 100%;">

                            <thead>
                                <tr>
                                    <th>V11</th>
                                    <th>V12</th>
                                    <th>V13</th>
                                    <th>V14</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <?php 

                                    foreach ($bobotbaru as $s) :
                                        ?>
                                        <tr>


                                            <td><?php echo $s->v11; ?></td>
                                            <td><?php echo $s->v12; ?></td>
                                            <td><?php echo $s->v13; ?></td>
                                            <td><?php echo $s->v14; ?></td>

                                            <?php                                    

                                        endforeach;
                                        ?>
                                    </tr>
                                </tbody>


                            </table>  

                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered" style="width: 100%;">

                                <thead>
                                    <tr>
                                        <th>V21</th>
                                        <th>V22</th>
                                        <th>V23</th>
                                        <th>V24</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <?php 

                                        foreach ($bobotbaru as $s) :
                                            ?>
                                            <tr>

                                                <td><?php echo $s->v21; ?></td>
                                                <td><?php echo $s->v22; ?></td>
                                                <td><?php echo $s->v23; ?></td>
                                                <td><?php echo $s->v24; ?></td>


                                                <?php                                    

                                            endforeach;
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>

                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered" style="width: 100%;">

                                    <thead>
                                        <tr>
                                            <th>V31</th>
                                            <th>V32</th>
                                            <th>V33</th>
                                            <th>V34</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <?php 

                                            foreach ($bobotbaru as $s) :
                                                ?>
                                                <tr>

                                                    <td><?php echo $s->v31; ?></td>
                                                    <td><?php echo $s->v32; ?></td>
                                                    <td><?php echo $s->v33; ?></td>
                                                    <td><?php echo $s->v34; ?></td>
                                                    <?php                                    

                                                endforeach;
                                                ?>
                                            </tr>
                                        </tbody>


                                    </table>  

                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered" style="width: 100%;">

                                        <thead>
                                            <tr>

                                                <th>V41</th>
                                                <th>V42</th>
                                                <th>V43</th>
                                                <th>V44</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <?php 

                                                foreach ($bobotbaru as $s) :
                                                    ?>
                                                    <tr>


                                                        <td><?php echo $s->v41; ?></td>
                                                        <td><?php echo $s->v42; ?></td>
                                                        <td><?php echo $s->v43; ?></td>
                                                        <td><?php echo $s->v44; ?></td>

                                                        <?php                                    

                                                    endforeach;
                                                    ?>
                                                </tr>
                                            </tbody>

                                        </table>

                                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered" style="width: 100%;">

                                            <thead>
                                                <tr>

                                                    <th>W0</th>
                                                    <th>W1</th>
                                                    <th>W2</th>
                                                    <th>W3</th>
                                                    <th>W4</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <?php 

                                                    foreach ($bobotbaru as $s) :
                                                        ?>
                                                        <tr>

                                                            <td><?php echo $s->w0; ?></td>
                                                            <td><?php echo $s->w1; ?></td>
                                                            <td><?php echo $s->w2; ?></td>
                                                            <td><?php echo $s->w3; ?></td>
                                                            <td><?php echo $s->w4; ?></td>

                                                            <?php                                    

                                                        endforeach;
                                                        ?>
                                                    </tr>
                                                </tbody>


                                            </table>  
                                            <div class="alert alert-dark" role="alert">
                                                MSE = <?php echo $MSE;?> || MAPE = <?php echo $MAPE;?>
                                            </div>





                                        </div>


                                    </div>

                                    <!--  ------ -->

                                    <div class="card">

                                        <div class="card-header">
                                            <strong class="card-title">BackPropagation</strong>
                                        </div>

                                        <div class="card-body">
                                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered" style="width: 100%;">

                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>Country Code</th>
                                                        <th>Date</th>
                                                        <th>Confirmed</th>
                                                        <th>Death</th>
                                                        <th>Confirmed Cases Daily</th>
                                                        <th>Death Cases Daily</th>
                                                        <th>Recovered</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <?php 
                                                        $no=1;
                                                        foreach ($databackpropagation as $s) :
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $no; ?></td>
                                                                <td><?php echo $s->kodenegara; ?></td>
                                                                <td><?php echo $s->tanggal; ?></td>
                                                                <td><?php echo $s->x1; ?></td>
                                                                <td><?php echo $s->x2; ?></td>
                                                                <td><?php echo $s->x3; ?></td>
                                                                <td><?php echo $s->x4; ?></td>
                                                                <td><?php echo $s->x5; ?></td>
                                                                <?php 
                                                                $no++;

                                                            endforeach;
                                                            ?>
                                                        </tr>
                                                    </tbody>
                                                </table>                                 
                                            </div>


                                        </div>






                                    </div>
                                </div>


                            </div>
                        </div><!-- .animated -->
                    </di>
