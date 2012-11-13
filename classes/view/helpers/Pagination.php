<?php

	function echoPagination($pagesNum, $currentPage, $url){
		echo "<div class=\"pagination\">";
		if($pagesNum > 1){ //Area da Paginação ?>
		<ul>
		<?php $url= $url."&page=";?>
		<?php if($currentPage != 0) { //Verificando se nao é a primeira página. Caso for, não mostra o link anterior?>
		<li>
		<a href="<?php echo $url.($currentPage-1) ?>">
			<<
		</a>
		</li>
		<?php } ?>	
		<?php for($i = 0; $i < $pagesNum; $i++) { ?>
			<li
			<?php if($currentPage == $i) echo "class=\"active\"";?> >
			<a href="<?php echo $url.$i ?>">
				<?php echo $i+1 ?>
			</a>
			</li>
		<?php } ?>
		
		<?php if($currentPage < $pagesNum - 1) { ?>
			<li>
			<a href="<?php echo $url.($currentPage + 1)?>">
				>>
			</a>
			</li>
		<?php } // end if do proximo ?>

		<?php } //end if da paginação ?>
		</ul>
		</div>
	<?php } // end da função?>	