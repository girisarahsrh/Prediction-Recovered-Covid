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
                    <strong class="card-title">Normalitation Data</strong>
                </div>

 <!--                <a href="<?php echo site_url('CC/NormalisasiAll')?>"><button type="submit" class="btn btn-success btn-sm" >
                    <i class="fa fa-refresh"></i>  NORMALITATION
                </button></a> -->

                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Country Code</th>
                                <th>Country Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <?php 
                                $no=1;
                                foreach ($pranormalisasi as $s){ ?>
                                    <tr>
                                        <td><?php echo $s['id']; ?></td>
                                        <td><a href="<?php echo site_url('CC/Detailnormalisasi/'.$s['kodenegara'])?>"><?php echo $s['kodenegara']; ?></a></td>
                                        <td style="width: 60%"><?php echo $s['namanegara']; ?></td>
                                        <td><div style="margin-left: 20%;">
                                            <a href="<?php echo site_url('CC/Normalisasi/'.$s['kodenegara'])?>"><button type="submit" class="btn btn-success btn-sm" >
                                                <i class="fa fa-refresh"></i>  NORMALITATION
                                            </button></a></div>
                                        </td>
                                    </tr>

                                    <?php 
                                    $no++;

                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>  
                    <div class="row">
                        <div class="col">
                            <!--Tampilkan pagination-->
                            <?php echo $pagination; ?>
                        </div>
                    </div>                               
                </div>


            </div>



        </div>
    </div>


</div>
</div><!-- .animated -->
</di>
