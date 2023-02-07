<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <strong>Input</strong> Master Data
                    </div>
                    <div class="card-body card-block">
                        <form action="<?php echo base_url(); ?>CC/AksiInputMaster" method="post" class="form-horizontal">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="hf-email" class=" form-control-label">Country Code</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="hf-email" name="kodenegara" placeholder="Enter Country Code..." class="form-control"><span class="help-block">Please enter country code</span></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Country Name</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="hf-password" name="namanegara" placeholder="Enter Country Name..." class="form-control"><span class="help-block">Please enter country name</span></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Country Population</label></div>
                                <div class="col-12 col-md-9"><input type="number" id="hf-password" name="populasi" placeholder="Enter Country Population..." class="form-control" min="0"><span class="help-block">Please enter country population</span></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Country Area</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="hf-password" name="wilayah" placeholder="Enter Country Area..." class="form-control"><span class="help-block">Please enter country area</span></div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>

                        </form>
                    </div>
                </div>

                
            </div>
        </div><!-- .animated -->
    </di>