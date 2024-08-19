<?php
// Pastikan hanya memulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$data_id = $_SESSION["ses_id"];
$sql = $koneksi->query("SELECT * FROM tb_pengguna WHERE id_pengguna=$data_id");
while ($data = $sql->fetch_assoc()) {
    $status = $data['status'];
}
?>

<?php if($status == 1){ ?>
  <div class="row">
    <tbody>
      <?php
      $sql = $koneksi->query("select * from tb_calon");
      while ($data= $sql->fetch_assoc()) {
      ?>
      <!-- Profile Image -->
      <div class="col-md-4">
        <div class="product_data">
          <div class="card card-primary card-outline">
            <div class="card-body">
              <h4 class="profile-username text-center">
                <?php echo $data['id_calon']; ?>
              </h4>
              <div class="text-center">
                <img src="foto/<?php echo $data['foto_calon']; ?>" width="235px" />
              </div>

              <h3 class="profile-username text-center">
                <?php echo $data['nama_calon']; ?>
              </h3>

              <center>
                <!--Button Start-->
                  <div class="row">
                      <div class="input-group mb-3">
                        <button class="input-group-text increment-btn <?php echo $data['id_calon'] ?>">+</button>
                        <input type="text" class="form-control bg-white input-qty text-center" value="0">
                        <button class="input-group-text decrement-btn <?php echo $data['id_calon'] ?>">-</button>
                      </div>
                  </div>
                <!--Button End-->
                <a href="?page=view&kode=<?php echo $data['id_calon']; ?>" class="btn btn-success btn-sm">
                  <i class="fa fa-file"></i> Detail
                </a>
                <a href="?page=PsSQBBK&kode=<?php echo $data['id_calon']; ?>" class="btn btn-primary">
                  <i class="fa fa-edit"></i> Pilih
                </a>
              </center>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card -->
      <?php
      }
      ?>
    </tbody>
  </div>

<?php } elseif ($status == 0) { ?>

  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fas fa-info"></i>Info</h4>
    <h3>Anda sudah menggunakan Hak Suara dengan baik, Terimakasih.</h3>
  </div>

<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('.increment-btn').click(function(e){
        e.preventDefault();
        var $input = $(this).closest('.product_data').find('.input-qty');
        var value = parseInt($input.val(), 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10) {
            value++;
            $input.val(value);
        }
    });

    $('.decrement-btn').click(function(e){
        e.preventDefault();
        var $input = $(this).closest('.product_data').find('.input-qty');
        var value = parseInt($input.val(), 10);
        value = isNaN(value) ? 0 : value;
        if(value > 0) {
            value--;
            $input.val(value);
        }
    });
});
</script>
