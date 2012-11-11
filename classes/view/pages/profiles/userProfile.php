<?php 
	$arrayAttributes['Receber Noticias da JCI'] = ($user->getReceiveNotification())? "Sim" : "Não";
	$arrayAttributes['Nome'] = $user->getName();
	$arrayAttributes['E-mail'] = $user->getEmail();
	$arrayAttributes['Telefone'] = $user->getPhone();
	$arrayAttributes['Como soube da JCI?'] = $user->getHowYouKnow();
	$arrayAttributes['Público'] = $user->getPublic();
	$arrayAttributes['Área de Atuacao'] = $user->getActingArea();
	$arrayAttributes['CEP'] = $user->getCep();
?>