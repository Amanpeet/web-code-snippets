<?php
//check captchu
$captchu = strip_tags( $_POST['captchu'] );
$captchu_user = strip_tags( $_POST['captchu_user'] );
if ( $captchu == $captchu_user ) {

  //send mail code



} else {
  ?>
    <div class="alert alert-danger mt-4" role="alert">
      <h3> Error in Security Code. </h3>
      <h5> Please Calculate again and Input Right Code. </h5>
    </div>
  <?php
}
?>

<div class="row mb-3">
  <div class="col-md-3">
    <label class="text-black">Security Code</label>
    <?php $num1 = rand(1, 9); $num2 = rand(1, 9); $sum = $num1 + $num2; ?>
    <input type="text" class="form-control text-center" value="<?php echo $num1." + ".$num2." = ";  ?>" disabled>
    <input type="hidden" name="captchu" value="<?php echo $sum; ?>" required>
  </div>
  <div class="col-md-4">
    <label class="text-black">Input Security Code</label>
    <input type="subject" name="captchu_user" class="form-control" placeholder="calculate" required>
  </div>
</div>


