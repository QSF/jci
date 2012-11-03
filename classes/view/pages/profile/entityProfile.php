	<label for="stablishmentDate">Data de fundação</label>
<?php 

	if($user->getEstablishmentDate())
		$arrayAtributes['Data de fundação'] = $user->getEstablishmentDate()->format('d-m-Y'));
	$arrayAtributes['Site'] => $user->getSite());
	$arrayAtributes['Receber Noticias da JCI'] = $user->getNewsletter();
	displayAttribute($arrayAtribute);
?> 
