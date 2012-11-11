<ul>

	<?php require_once(PAGES_PATH . '/menu/AccountMenu.php');?>

	<li><a href="">Visualizar Log					</a></li>
	<li><a href="">Gerência Usuários				</a></li>
	<li><a href="">Alterar Doações					</a></li>
	<li><a href="">Intermediar Doações				</a></li>
	<li><a href="./index.php?controller=report&action=redirectSet">Cruzamento de dados(relatório)	</a></li>
	<li><a href="./index.php?controller=moderator&action=redirectManage">Gerência de conteúdo</a></li>
	<li><a href="./index.php?controller=donation&action=redirectManage">Gerênciar Doações  </a></li>
	<li><a href="./index.php?controller=donation&action=redirectCreate">Intermediar Doações	</a></li>
	<li><a href="./index.php?controller=field&action=redirectManage">Gerência Campos</a></li>
	<li><a href="./index.php?controller=public&action=redirectManage">Gerência Público</a></li>
	<!-- Fazer uma página que contenha essas opções, ou deixar o menu do dropdown(Melhor op.)  -->
	<li><a href="./index.php?controller=Moderator&action=findAll&userType=Volunteer" >
		Gerência de Voluntários
	</a>
	<li><a href="./index.php?controller=Moderator&action=findAll&userType=Entity" >
		Gerência de Entidades
	</a>
	<li><a href="./index.php?controller=Moderator&action=directDisplay&page=Search" >
		Procurar Usuários
	</a>
	<li><a href="./index.php?controller=Moderator&action=getEntitiesWaitingApproval">
			Validar Entidade
	</a>
	<li><a href="./index.php?controller=news&action=directDisplay&page=NewsForm">
		Enviar Notícias
	</a>
	<li><a href="./index.php?controller=news&action=getNews">
		Gerência de Notícias
	</a>
	<li><a href="./index.php?controller=login&action=logout">Logout</a></li>
</div>
</ul>
