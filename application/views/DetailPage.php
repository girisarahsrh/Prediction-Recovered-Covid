
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

        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-user text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Total Confirmed</div>
                            <div class="stat-digit count"><?php echo $confirmed;?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-face-smile text-primary border-primary"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Total Recovered</div>
                            <div class="stat-digit count"><?php echo $recovered;?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="ti-face-sad text-danger border-danger"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Death</div>
                            <div class="stat-digit count"><?php echo $death;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <strong class="card-title">Detail Data</strong> 
            </div>

            <div class="card-body">
               <table id="bootstrap-data-table-export" class="table table-striped table-bordered">

                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Country Code</th>
                        <th>Country Name</th>
                        <th>Date</th>
                        <th>Confirmed</th>
                        <th>Recovered</th>
                        <th>Death</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <?php 
                        $no=1;
                        foreach ($functiondetailnegara as $s) :
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $s->kodenegara; ?></td>
                                <td><?php echo $s->namanegara; ?></td>
                                <td><?php echo $s->tanggal; ?></td>
                                <td ><?php echo $s->confirmed; ?></td>
                                <td><?php echo $s->recovered; ?></td>
                                <td><?php echo $s->death; ?></td>
                                <td style="padding-left: 3%">
                                    <a href="<?php echo site_url('CC/EditForecast/'.$s->kodeunik)?>"><button type="submit" class="btn btn-success btn-sm" >
                                        <i class="fa fa-pencil"></i> EDIT
                                    </button></a>
                                    <a href="<?php echo site_url('CC/EditForecast/'.$s->kodeunik)?>"><button type="submit" class="btn btn-danger btn-sm" >
                                        <i class="fa fa-trash"></i> DELETE
                                    </button></a>
                                </td>
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
</div>
