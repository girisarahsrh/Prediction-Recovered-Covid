

<div class="content mt-3">

 <div class="col-xl-4 col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="stat-widget-one">
                <div class="stat-icon dib"><i class="ti-user text-success border-success"></i></div>
                <div class="stat-content dib">
                    <div class="stat-text">Total Confirmed</div>
                    <div class="stat-digit count"><?php echo $countcon;?></div>
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
                    <div class="stat-digit count"><?php echo $countrecovered;?></div>
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
                    <div class="stat-text">Total Death</div>
                    <div class="stat-digit count"><?php echo $countde;?></div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-xl-11" style="margin-left: 5%">
    <div class="card" >
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="card-title mb-0">Graph</h4>
                    <div class="small text-muted">22 January 2020 - 21 Juni 2020</div>
                </div>
                <!--/.col-->
                <div class="col-sm-8 hidden-sm-down">
                    <div class="row form-group">

                </div>
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="col-md-12">
                        <select name="namanegara" id="namanegara" class="form-control">
                            <option value="">SELECT DATA</option>
                            <?php
                            foreach($namanegara_list->result_array() as $row)
                            {
                                echo '<option value="'.$row["namanegara"].'">'.$row["namanegara"].'</option>';
                            }
                            ?>

                        </select>


                    </div>
                </div>
            </div>
            <!--/.col-->


        </div>
        <!--/.row-->
        <div class="chart-wrapper px-3">
            <div id="chart_area" style="width: 100%; height: 500px;">
                <div id="vmap" style="height: 500px;"></div>
                

            </div>
        </div>

    </div>

</div>
</div>

</div>


</div> <!-- .content -->
</div><!-- /#right-panel -->

    <!-- Right Panel -->