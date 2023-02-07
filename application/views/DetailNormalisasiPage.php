
<div class="content mt-3">

    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <strong class="card-title">Detail Data Normalitation</strong> 
                    </div>

                    <div class="card-body">
                     <table id="bootstrap-data-table-export" class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Country Code</th>
                                <th>Date</th>
                                <th>Confirmed (x1)</th>
                                <th>Death (x2)</th>
                                <th>Confirmed Cases Daily (x3)</th>
                                <th>Death Cases Daily (x4)</th>
                                <th>Recovered (x5)</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <?php 
                                $no=1;
                                foreach ($Detailnormalisasi as $s) :
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $s->kodenegara; ?></td>
                                        <td><?php echo $s->tanggal; ?></td>
                                        <td ><?php echo $s->x1; ?></td>
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
</div>
