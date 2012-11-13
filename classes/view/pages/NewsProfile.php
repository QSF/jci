
Notícia criada por <?php echo $news->getAuthor()->getLogin()?> - <?php echo $news->getAuthor()->getEmail() ?>, às <?php  echo $news->getDate()->format('d/m/Y H:i:s'); ?>
<h1><?php echo $news->getTitle()?></h1>

<br/>
<?php echo $news->getContent() ?>
<br/>

<br/>
Notícia Pública: <?php echo ($news->getPublic())? "Sim" : "Não";?>
