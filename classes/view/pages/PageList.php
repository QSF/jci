<h3>Lista de Páginas</h3>

<?php foreach($pages as $page){ ?>
	<div class="grid_8 alpha omega bolder">
		<div class="grid_5 alpha">
		  <a style="text-decoration: none;" href="./index.php?controller=PageManager&action=redirectUpdate&page_name=<?php echo $page->getName()?>" title="Editar">
			<i class="icon-edit"></i>
		</a>
		  <a style="text-decoration: none;" href="./index.php?controller=PageManager&action=redirectUpdate&page_name=<?php echo $page->getName()?>" title="Editar">
			<?php echo $page->getName()?>
		  </a>
		</div>

		<div class="grid_3 omega">
		&nbsp;&nbsp;
		</div>
	</div>
	<br/><hr>
	<?php } //end foreach dos usuarios?>
