<?php 
	?arrayAtributes = array();
	$arrayAtributes['CNPJ'] => $user->getCnpj());
	$arrayAtributes['Razão Social'] = $user->getNewsletter();
	$arrayAtributes['Registro Estadual'] = $user->getStateRegistration();
	$arrayAtributes['Telefone do Responsável'] = $user->getOwnerPhone();
	displayAttribute($arrayAtribute);
?>