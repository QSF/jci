<li><a href="./index.php?controller=donation&action=redirectUserDonations&user_id=<?php echo $user->getId()?>">
	Histórico de doações</a></li>

<li><a href="./index.php?controller=donation&action=redirectUserFeedBack&user_id=<?php echo $user->getId()?>">
	Histórico de doações sem feedback</a></li>
<br>

<?php
	include_once HELPER_PATH . "/PortugueseHelper.php";
	echo "<h2>" . returnStringType(get_class($user)) . "</h2>";
	$arrayAttributes['Nome'] = $user->getName();
	$arrayAttributes['E-mail'] = $user->getEmail();
	$arrayAttributes['Telefone'] = $user->getPhone();
	$arrayAttributes['Como soube da JCI?'] = $user->getHowYouKnow();
	$arrayAttributes['Público'] = arrayToCommaString($user->getPublic());
	$arrayAttributes['Área de Atuacao'] = arrayToCommaString($user->getActingArea());
	$arrayAttributes['CEP'] = $user->getCep();
	$arrayAttributes['Recebe Notícias da JCI'] = ($user->getReceiveNotification())?"Sim":"Não";
?>