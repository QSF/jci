<?php 

	if($user->getEstablishmentDate())
		$arrayAttributes['Data de fundação'] = $user->getEstablishmentDate()->format('d-m-Y');
	$arrayAttributes['Site'] = $user->getSite();
?> 
