<script src="<?php echo base_url()."Assets"?>/vendors/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url()."Assets"?>/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url()."Assets"?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()."Assets"?>/assets/js/main.js"></script>


<script src="<?php echo base_url()."Assets"?>/vendors/chart.js/dist/Chart.min.js"></script>
<script src="<?php echo base_url()."Assets"?>/assets/js/dashboard.js"></script>
<script src="<?php echo base_url()."Assets"?>/assets/js/widgets.js"></script>
<script src="<?php echo base_url()."Assets"?>/vendors/jqvmap/dist/jquery.vmap.min.js"></script>
<script src="<?php echo base_url()."Assets"?>/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<script src="<?php echo base_url()."Assets"?>/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="<?php echo base_url()."Assets"?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()."Assets"?>/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()."Assets"?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url()."Assets"?>/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url()."Assets"?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url()."Assets"?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url()."Assets"?>/vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url()."Assets"?>/assets/js/init-scripts/data-table/datatables-init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    google.charts.load('current', {packages:['corechart', 'line']});
    google.charts.setOnLoadCallback();

    function load_monthwise_data(namanegara, title)
    {
        var temp_title = title + ' ' + namanegara;
        $.ajax({
            url:"<?php echo base_url(); ?>CC/fetch_data",
            method:"POST",
            data:{namanegara:namanegara},
            dataType:"JSON",
            success:function(data)
            {
                drawMonthwiseChart(data, temp_title);
            }
        })
    }

    function drawMonthwiseChart(chart_data, chart_main_title)
    {
        var jsonData = chart_data;
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'tanggal');
        data.addColumn('number', 'confirmed');
        data.addColumn('number', 'death');
        data.addColumn('number', 'recovered');

        $.each(jsonData, function(i, jsonData){
            var tanggal = jsonData.tanggal;
            var confirmed = parseFloat($.trim(jsonData.confirmed));
            var death = parseFloat($.trim(jsonData.death));
            var recovered = parseFloat($.trim(jsonData.recovered));
            data.addRows([[tanggal, confirmed, death, recovered]]);
        });

        var options = {
            curveType: 'line',
            title:chart_main_title,
            hAxis: {
                title: "DATE"
            },
            vAxis: {
                title: 'VALUE'
            },
            chartArea:{width:'80%',height:'85%'}
        }

        var chart = new google.visualization.LineChart(document.getElementById('chart_area'));

        chart.draw(data, options);
    }
</script>

<script>

    $(document).ready(function(){
        $('#namanegara').change(function(){
            var namanegara = $(this).val();
            if(namanegara != '')
            {
                load_monthwise_data(namanegara, 'Covid-19 Data for : ');
            }
        });
    });

</script>

<!-- ----------------------------------------------------------------------------- -->




<script type="text/javascript">
    new Chart (document.getElementById('chart_area_report'), {
        type: 'line',
        data: {
            labels: [
            <?php
            if (count($graph)>0) {
              foreach ($graph as $data) {
                echo "'" .$data->kodenegara ."',";
            }
        }
        ?>
        ],
        datasets: [{
            label: 'Actual',
            fill: false,
            borderColor: '#15253d',
            data: [
            <?php
            if (count($graph)>0) {
             foreach ($graph as $data) {
                echo $data->recovered . ", ";
            }
        }
        ?>
        ]
    },{
        label: 'Prediction',
        fill: false,
        borderColor: '#03989e',
        data: [
        <?php
        if (count($graph)>0) {
         foreach ($graph as $data) {
            echo $data->prediksi . ", ";
        }
    }
    ?>
    ]
}

]
},
options: {
    title: {
      display: true,
      text: 'Prediction vs Actual Data'
  }
}
});

</script>

<script>
    (function($) {
        "use strict";

        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#ffde59',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#15253d', '#00c4cc'],
            normalizeFunction: 'polynomial'
        });
    })(jQuery);
</script>

<script type="text/javascript">
    $(document).ready(function(){
       $('#namanegara').on('input',function(){

        var namanegara=$(this).val();
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('CC/getAutoComplete')?>",
            dataType : "JSON",
            data : {namanegara: namanegara},
            cache:false,
            success: function(data){
                $.each(data,function(kodenegara,namanegara,tanggal,kodeunik,confirmed,death,recovered){
                    $('#kodenegara').val(data.kodenegara);
                    $('#tanggalsebelum').val(data.tanggal);
                    $('#kodeunik').val(data.kodeunik);
                    $('#confirmedsebelum').val(data.confirmed);
                    $('#deathsebelum').val(data.death);
                    $('#recoveredsebelum').val(data.recovered);
                    // $('[name="tanggalprediksi"]').val(data.tanggalprediksi);

                });

            }
        });
        return false;
    });

   });
</script>

<script>
   function sumcon() {
      var valconfirmedsebelum = document.getElementById('confirmedsebelum').value;
      var valconfirmed = document.getElementById('confirmed').value;
      var resultconcasesdaily = parseInt(valconfirmed) - parseInt(valconfirmedsebelum);
      if (!isNaN(resultconcasesdaily)) {
       document.getElementById('concasesdaily').value = resultconcasesdaily;
   }
}

function sumdeath() {
  var valdeathsebelum = document.getElementById('deathsebelum').value;
  var valdeath = document.getElementById('death').value;
  var resultdeathcasesdaily = parseInt(valdeath) - parseInt(valdeathsebelum);
  if (!isNaN(resultdeathcasesdaily)) {
   document.getElementById('deathcasesdaily').value = resultdeathcasesdaily;
}
}

function sumconedit() {
  var valeditconfirmedsebelum = document.getElementById('editconfirmedsebelum').value;
  var valconfirmed = document.getElementById('confirmed').value;
  var resultconcasesdaily = parseInt(valconfirmed) - parseInt(valeditconfirmedsebelum);
  if (!isNaN(resultconcasesdaily)) {
   document.getElementById('concasesdaily').value = resultconcasesdaily;
}
}

function sumdeathedit() {
  var valeditdeathsebelum = document.getElementById('editdeathsebelum').value;
  var valdeath = document.getElementById('death').value;
  var resultdeathcasesdaily = parseInt(valdeath) - parseInt(valeditdeathsebelum);
  if (!isNaN(resultdeathcasesdaily)) {
   document.getElementById('deathcasesdaily').value = resultdeathcasesdaily;
}
}
</script>




</body>

</html>