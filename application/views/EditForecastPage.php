<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">


                <div class="card">
                    <div class="card-header">
                        <strong>Input</strong> Forecast Perday
                    </div>
                    <div class="card-body card-block">
                        <?php foreach($forecastedit as $u){ ?>
                            <form action="<?php echo base_url("CC/AksiEditForecast");?>" method="post" class="form-horizontal" >

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Country Name</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="namanegara" id="namanegara" class="form-control">
                                            <option value="<?=$u->namanegara;?>"><?php echo $u->namanegara ?></option>

                                        </select>
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Unique Code</label></div>
                                    <div class="col-12 col-md-2"><input type="text" id="kodeunik" name="kodeunik" placeholder="Automatic..." class="form-control"  value="<?php echo $u->kodeunik ?>" readonly=""></div>
                                </div>



                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Country Code</label></div>
                                    <div class="col-12 col-md-2"><input type="text" id="kodenegara" name="kodenegara" class="form-control" readonly=""value="<?php echo $u->kodenegara ?>"></div>
                                </div>


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Date</label></div>
                                    <div class="col-12 col-md-2"><input type="date" id="tanggal" name="tanggal" placeholder="Enter Date..." min="<?php echo $u->tanggal ?>" class="form-control" value="<?php echo $u->tanggal ?>" readonly=""></div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Confirmed</label></div>

                                    <div class="col-12 col-md-2"><input type="number" id="confirmed" name="confirmed" onkeyup="sumconedit();"  placeholder="Enter value confirmed..." class="form-control" min="0"value="<?php echo $u->confirmed ?>"><span class="help-block">Please enter value confirmed</span></div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Death</label></div>


                                    <div class="col-12 col-md-2"><input type="number" id="death" name="death" placeholder="Enter value death..." onkeyup="sumdeathedit();" class="form-control" min="0" value="<?php echo $u->death ?>"><span class="help-block" >Please enter value death</span></div>

                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Confirmed Cases Daily</label></div>
                                    <div class="col-12 col-md-2"><input type="number" id="concasesdaily" name="concasesdaily" placeholder="Enter value confirmed Cases Daily..." readonly=""class="form-control"></div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Death Cases Daily</label></div>
                                    <div class="col-12 col-md-2"><input type="number" id="deathcasesdaily" name="deathcasesdaily" placeholder="Enter value death cases daily..." readonly="" class="form-control"></div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Recovered</label></div>
                                    <div class="col-12 col-md-2"><input type="number" id="hf-password" name="recovered" placeholder="Enter value recovered..." class="form-control" min="0" value="<?php echo $u->recovered ?>"><span class="help-block" >Please enter value recovered</span></div>
                                </div>

                            <?php } ?>

                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>

                            <?php foreach($yesterday as $u){ ?>
                                <div class="row form-group" hidden="">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Recovered</label></div>
                                    <div class="col-12 col-md-2"><input type="number" id="editconfirmedsebelum" name="editconfirmedsebelum" placeholder="Enter value recovered..." class="form-control" min="0" value="<?php echo $u->confirmed ?>" onkeyup="sumconedit();"><span class="help-block" >Please enter value recovered</span></div>
                                </div>

                                <div class="row form-group" hidden="">
                                    <div class="col col-md-3"><label for="hf-password" class=" form-control-label">Recovered</label></div>
                                    <div class="col-12 col-md-2"><input type="number" id="editdeathsebelum" name="editdeathsebelum" placeholder="Enter value recovered..." class="form-control" min="0" value="<?php echo $u->death ?>" onkeyup="sumdeathedit();"><span class="help-block" >Please enter value recovered</span></div>
                                </div>
                            <?php } ?>


                        </form>
                        





                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </di>