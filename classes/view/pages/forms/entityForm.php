	<table width="40%">
			<tr width=70% style="text-align:right"><label for="stablishmentDate">Data de fundação</label><br/>
			<input type="text" 
	value="<?php if($user->getEstablishmentDate()) echo $user->getEstablishmentDate()->format('d-m-Y') ?>" 
	id="idStablishmentDate" name="establishmentDate"/></tr><br/>
			<tr width=70% style="text-align:right"><label for="site"  style="text-align:right">Site</label><br/>
				<input type="text" id="idSite" name="site" value="<?php echo $user->getSite() ?>" /></tr><br/>
			<tr width=100%><input type="checkbox" name="receivedNewsletter" value="yes"/>
				<?php if($user-> getNewsletter()) echo "checked=yes"?>Receber notícias da JCI por email</tr><br/>
	</table>
		
	
	
	