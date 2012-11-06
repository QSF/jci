<h3>Lista de Notícias</h3>

<?php include HELPER_PATH."/Pagination.php";?>
<?php foreach($news as $newsElem){ ?>
	
	<a href="./index.php?controller=news&action=get&news_id=<?php echo $newsElem->getId()?>">
		<?php echo $newsElem->getTitle()?>
	</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="./index.php?controller=news&action=redirectUpdate&news_id=<?php echo $newsElem->getId()?>">
		Editar
	</a>
	&nbsp;&nbsp;
	<a href="./index.php?controller=news&action=deleteNews&news_id=<?php echo $newsElem->getId()?>">
		Deletar
	</a>
	&nbsp;
	<br/>
	<?php } //end foreach dos usuarios?>

	<?php echoPagination($pagesNum, $currentPage, $url);?>