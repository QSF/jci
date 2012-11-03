<?php 

	if($user->getEstablishmentDate())
		$arrayAtributes['Data de fundação'] = $user->getEstablishmentDate()->format('d-m-Y'));
	$arrayAtributes['Site'] => $user->getSite());
	$arrayAtributes['Receber Noticias da JCI'] = if($user->getNewsletter())? "Sim" : "Não";
?> 
