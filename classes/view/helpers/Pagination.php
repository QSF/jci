<?php

	function echoPagination($pagesNum, $currentPage, $url){
		if($pagesNum > 1){ //Area da Paginação ?>
		<?php $url= $url."&page=";?>
		<?php if($currentPage != 0) { //Verificando se nao é a primeira página. Caso for, não mostra o link anterior?>
		<a href="<?php echo $url.($currentPage-1) ?>">
			Anterior &nbsp;
		</a>
		<?php } ?>
			
		<?php for($i = 0; $i < $pagesNum; $i++) { ?>
			<a href="<?php echo $url.$i ?>">
				<?php echo $i+1 ?>&nbsp;
			</a>
		<?php } ?>
		
		<?php if($currentPage < $pagesNum - 1) { ?>
			<a href="<?php echo $url.($currentPage + 1)?>">
				&nbsp; Próxima
			</a>
		<?php } // end if do proximo ?>

	<?php } //end if da paginação ?>

<?php } // end função?>	