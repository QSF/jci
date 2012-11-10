<label for="stablishmentDate">Data de fundação</label>
<input type="text" value="<?php if($user->getEstablishmentDate()) echo $user->getEstablishmentDate()->format('d/m/Y') ?>" 
	id="idStablishmentDate" name="establishmentDate"/>

<label for="site"  >Site</label>
<input type="text" id="idSite" name="site" value="<?php echo $user->getSite() ?>" />

<?php if ($user->getId() != null){
	echo "<input type=\"hidden\" id=\"idSituation\" name=\"situation\" value=\"" . ($user->getSituation() ? 'true' : 'false') . "\"/>";
}
	
?>


