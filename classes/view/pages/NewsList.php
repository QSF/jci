<h3>Lista de Notícias</h3>

<?php include HELPER_PATH."/Pagination.php";?>
    <?php foreach($news as $newsElem){ ?>
        <div class="grid_8 news">
          <a style="text-decoration: none;" href="./index.php?controller=news&action=redirectUpdate&news_id=<?php echo $newsElem->getId()?>">    <i class="icon-edit"></i><!-- <button class="btn btn-primary">Editar</button> --> </a>
          <a style="text-decoration: none;" href="./index.php?controller=news&action=deleteNews&news_id=<?php echo $newsElem->getId()?>">  <i class="icon-remove"></i><!-- <button class="btn btn-primary">Deletar</button> -->  </a>
          <a style="text-decoration: none;" href="./index.php?controller=news&action=get&news_id=<?php echo $newsElem->getId()?>"><?php echo $newsElem->getTitle()?></a>
        </div>
        <br/><hr>
<?php } //end foreach dos usuarios?>

<?php echoPagination($pagesNum, $currentPage, $url);?>



