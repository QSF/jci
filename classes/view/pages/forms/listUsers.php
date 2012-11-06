<?php
function listUsers($users,$user,$name){	?>
	<ul>
	<?php 
		foreach ($users as $var){
		$checked = "";
		if( ($user != null) && ($user->getId() == $var->getId()) ){
			$checked = "checked=\"checked\"";
		}?>
			<li><label class="radio">
			<input type="radio" name="<?php echo $name ?>" value="<?php echo $var->getID()?>" 
				<?php echo $checked; ?> > <?php echo $var->getName(); ?>
			</label>
			
  <?php }?>
	
	</ul> 
<?php 
} 
?>