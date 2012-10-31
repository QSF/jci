	<label for="stablishmentDate">Data de fundação</label>
	<input type="text" 
	value="<?php if($user->getEstablishmentDate()) echo $user->getEstablishmentDate()->format('d-m-Y') ?>" 
	id="idStablishmentDate" name="establishmentDate"/><br/>

	<label for="site">Site</label>
	<input type="text" id="idSite" name="site" value="<?php echo $user->getSite() ?>" /><br/>

	<input type="checkbox" name="receivedNewsletter" value="yes"
	<?php if($user-> getNewsletter()) echo "checked=yes"?>/>
	Receber notícias da JCI por email<br/>