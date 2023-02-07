<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">ForwardPropagation Data</strong>
                    </div>
                    <div class="card-body">
<!--                         <a href="<?php echo site_url('CC/Backpropagation/')?>"><button type="submit" class="btn btn-success btn-sm" >
                            <i class="fa fa-play"></i> &nbsp; Backpropagation</button></a><br> -->
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
                                        foreach ($functionprediksi as $s){ ?>
                                            <tr>
                                                <td><?php echo $s['id']; ?></td>
                                                <td><a href="<?php echo site_url('CC/Detailprocess/'.$s['kodenegara'])?>"><?php echo $s['kodenegara']; ?></a></td>
                                                <td style="width: 60%;"><?php echo $s['namanegara']; ?></td>
                                                <td style="padding-left: 4%"><div>
                                                    <a href="<?php echo site_url('CC/ProcessAlgoritma/'.$s['kodenegara'])?>"><button type="submit" class="btn btn-success btn-sm" >
                                                        <i class="fa fa-arrow-right"></i> &nbsp; Process</button></a>

                                                    </div>

                                                    

                                                </td>
                                                <?php 
                                            }?>
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
            </div><!-- .animated -->
        </di>