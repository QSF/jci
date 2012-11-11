<?php if(!isset($feedBack)){
		$feedBack = '';}?>

<?php include HELPER_PATH."/DonationHelper.php";?>

<?php printSingleDonation($donation); ?>

<form action="./index.php?controller=donation&action=doFeedBack" method="post">

<p>Digite o feed back desta doação:</p>
<textarea class="input-block-level" cols="100" rows="5" name="feedBack" ><?php echo $feedBack; ?></textarea>

<input type="hidden" name="id_donation" value="<?php echo $donation->getId();?>">

<input type="submit" class="btn" value="Realizar feedback" >
</form>