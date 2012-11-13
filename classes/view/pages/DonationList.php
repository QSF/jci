<h3>Lista de Doações</h3>

<?php include HELPER_PATH."/Pagination.php";?>
<?php include HELPER_PATH."/DonationHelper.php";?>

<?php listDonations($donations,$isModerator,$userId); ?>

<?php echoPagination($pagesNum, $currentPage, $url);?>

