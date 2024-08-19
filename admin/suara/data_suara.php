<?php
$koneksi = new mysqli ("localhost","root","","db_vote");

$xValues = array();
$yValues = array();

$sql = $koneksi->query("select * from tb_calon");
while ($row = $sql->fetch_assoc()) {
  $xValues[] = $row['nama_calon'];
  $id_calon = $row['id_calon'];
  $sql_hitung = "SELECT COUNT(id_vote) from tb_vote  where id_calon='$id_calon'";
  $q_hit= mysqli_query($koneksi, $sql_hitung);
  while($row_hit = mysqli_fetch_array($q_hit)) {
    $yValues[] = $row_hit[0];
  }
}
?>

<html>
  <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
  </head>
  <body>
    <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>
    <script>
      var chart;
      var xValues = <?php echo json_encode($xValues); ?>;
      var yValues = <?php echo json_encode($yValues); ?>;
      var barColors = ["blue"];
      chart = new Chart("myChart", {  
        type: "bar",
        data: {
          labels: xValues,
          datasets: [{
            backgroundColor: barColors,
            data: yValues
          }]
        },
        options: {
          legend: {display: false},
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }],
          }
        }
      });
    </script>
  </body>
</html>