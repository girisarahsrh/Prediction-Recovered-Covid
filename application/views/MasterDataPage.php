<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <!---------------- DELETE ----------------->
                <?php if($this->session->flashdata('deletesuccess')){?>
                    <div class="success-alert ">
                      <h6><?php echo $this->session->flashdata('deletesuccess');?></h6>
                  </div>
              <?php } ?>

              <!---------------- INPUT ----------------->
              <?php if($this->session->flashdata('inputsuccess')){?>
                <div class="success-alert ">
                  <h6><?php echo $this->session->flashdata('inputsuccess');?></h6>
              </div>
          <?php } ?>

          <!---------------- EDIT ----------------->
          <?php if($this->session->flashdata('editsuccess')){?>
            <div class="success-alert ">
              <h6><?php echo $this->session->flashdata('editsuccess');?></h6>
          </div>
      <?php } ?>
      <div class="card">
        <div class="card-header">
            <strong class="card-title">Master Data</strong>
        </div>
        <div class="card-body">
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Country Code</th>
                        <th>Country Name</th>
                        <th>Population</th>
                        <th>Area</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <?php 

                        $no=1;
                        foreach  ($functionmasterdata as $s){ ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $s['kodenegara']; ?></td>
                                <td style="width: 40%;"><?php echo $s['namanegara']; ?></td>
                                <td><?php echo number_format($s['populasi']); ?></td>
                                <td><?php echo $s['wilayah']; ?> Km<sup>2</sup></td>
                                <td style="padding-left: 3%">
                                    <a href="<?php echo site_url('CC/DetailData/'.$s['kodenegara'])?>"><button type="submit" class="btn btn-primary btn-sm" >
                                        <i class="fa fa-dot-circle-o"></i> Detail
                                    </button></a>
                                    <a href="<?php echo site_url('CC/EditMasterData/'.$s['id'])?>"><button type="submit" class="btn btn-warning btn-sm" >
                                        <i class="fa fa-pencil"></i> Edit
                                    </button></a>  
                                    <a href="<?php echo site_url('CC/AksiHapusMaster/'.$s['id'])?>"><button type="submit" class="btn btn-danger btn-sm" >
                                        <i class="fa fa-trash"></i> Delete
                                    </button></a>
                                </td>
                                <?php 
                                $no++;
                            }?>
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