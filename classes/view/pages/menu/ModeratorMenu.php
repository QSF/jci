<ul>
	<?php require_once(PAGES_PATH . '/menu/AccountMenu.php');?>

  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Gerência de Usuários <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li><a href="./index.php?controller=Moderator&action=findAll&userType=Volunteer">Voluntários</a></li>
      <li><a href="./index.php?controller=Moderator&action=findAll&userType=Entity">Entidades</a></li>
      <li><a href="./index.php?controller=Moderator&action=directDisplay&page=Search">Procurar Usuários</a></li>
      <li><a href="./index.php?controller=Moderator&action=getEntitiesWaitingApproval">Validar Entidade</a></li>
    </ul>
  </li>

  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Gerência de Conteúdo <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li><a href="./index.php?controller=public&action=redirectManage">Público Alvo</a></li>
      <li><a href="./index.php?controller=field&action=redirectManage">Campos</a></li>
      <li><a href="#">Páginas</a></li>
    </ul>
  </li>

  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Doações <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li><a href="./index.php?controller=donation&action=redirectManage">Gerênciar Doações</a></li>
      <li><a href="./index.php?controller=donation&action=redirectCreate">Intermediar Doações	</a></li>
      <li><a href="./index.php?controller=report&action=redirectSet">Cruzamento de dados(relatório)	</a></li>
    </ul>
  </li>

  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Gerência de Notícias <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li><a href="./index.php?controller=news&action=directDisplay&page=NewsForm">Enviar Notícias</a>
      <li><a href="./index.php?controller=news&action=getNews">Listar Notícias</a>
    </ul>
  </li>
	<li><a href="./index.php?controller=login&action=logout">Logout</a></li>
</ul>

<!-- 
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Dropdown <b class="caret"></b> 
            </a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li> -->