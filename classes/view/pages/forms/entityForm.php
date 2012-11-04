	<table width="40%">
		<tr>
			<td width=70%><label for="stablishmentDate">Data de fundação</label>
</td>
			<td width=50%><input type="text" 
	value="<?php if($user->getEstablishmentDate()) echo $user->getEstablishmentDate()->format('d-m-Y') ?>" 
	id="idStablishmentDate" name="establishmentDate"/><br/>
</td>
		</tr>
		<tr>
			<td width=70%><label for="site">Site</label></td>
			<td width=50%><input type="text" id="idSite" name="site" value="<?php echo $user->getSite() ?>" /><br/>
</td>
		</tr>
		<tr>
			<td width=70%><input type="checkbox" name="receivedNewsletter" value="yes"
	</td>
			<td width=50%><?php if($user-> getNewsletter()) echo "checked=yes"?>
	Receber notícias da JCI por email<br/></td>
		</tr>
	</table>
		
	
	
	