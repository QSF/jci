<h3>Lista de Doações</h3>

<?php include HELPER_PATH."/Pagination.php";?>
<?php include HELPER_PATH."/DonationHelper.php";?>

<?php if (!isset($userId)){
	$userId = -1;//não haverá ngm com o id -1
} ?>

<?php echoPagination($pagesNum, $currentPage, $url);?>

<?php listDonations($donations,$isModerator,$userId); ?>

<?php echoPagination($pagesNum, $currentPage, $url);?>

