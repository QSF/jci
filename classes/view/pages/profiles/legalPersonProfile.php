<?php 
	$arrayAttributes['CNPJ'] = $user->getCnpj();
	$arrayAttributes['Razão Social'] = $user->getCompanyName();
	$arrayAtributes['Registro Estadual'] = $user->getStateRegistration(); 
	$arrayAtributes['Telefone do Responsável'] = $user->getOwnerPhone();	
?>