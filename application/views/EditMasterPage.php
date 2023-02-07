<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <strong>Edit</strong> Master Data
                    </div>
                    <div class="card-body card-block">
                        <?php foreach($masterdataedit as $u){ ?>
                            <form action="<?php echo base_url(); ?>CC/AksiEditMaster" method="post" class="form-horizontal">
                                <input type="text" id="hf-email" name="id" value="<?php echo $u->id ?>" class="form-control" hidden>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Country Code</label></div>
                                    <div class="col-12 col-md-9"><input type="text" id="hf-email" name="kodenegara" value="<?php echo $u->kodenegara ?>" class="form-control" maxlength="5"><span class="help-block">Please enter country code</span></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Country Name</label></div>
                                    <div class="col-12 col-md-9"><input type="text" id="hf-password" name="namanegara" value="<?php echo $u->namanegara ?>" class="form-control"><span class="help-block">Please enter country name</span></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Country Population</label></div>
                                    <div class="col-12 col-md-9"><input type="number" id="hf-password" name="populasi" value="<?php echo $u->populasi ?>" class="form-control" minlength="0"><span class="help-block">Please enter country population</span></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Country Area</label></div>
                                    <div class="col-12 col-md-9"><input type="text" id="hf-password" name="wilayah" value="<?php echo $u->wilayah ?>" class="form-control"><span class="help-block">Please enter country area</span></div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset
                                </button>

                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </di>