<?php 
  if(!isset($action))
    $action = 'login';
  if(!isset($nameDisplay))
    $nameDisplay = 'Email';
  if(!isset($inputType))
    $inputType = 'email';
?>

<div class="grid_12 alpha omega">
	<div class="grid_6 alpha">
		<form class="form-inline center-user-menu" action="./index.php?controller=login&action=<?php echo $action?>" method="post">
		  <input type="text" class="input" placeholder="<?php echo $nameDisplay ?>" id="inputEmail" name="<?php echo $inputType?>">
		  <input type="password" class="input-small" placeholder="Senha" id="inputPassword" name="password">
		  <button type="submit" class="btn">Logar</button>
		</form>
	</div>
	<div class="grid_6 omega">
		<ul>
		  <li class="dropdown">
		    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <h2 class="center-user-menu orange">Junte-se a nós<b class="caret orange-caret center-caret"></b></h2></a>
		    <ul class="dropdown-menu">
		      <li class="dropdown-submenu">
   					<a tabindex="-1" href="#">Seja um voluntário</a>
    				<ul class="dropdown-menu">    	  			
						  <li><a href="./index.php?controller=registration&action=redirectCreate&page=VolunteerNaturalPersonForm">Pessoa Física</a></li>
						  <li><a href="./index.php?controller=registration&action=redirectCreate&page=VolunteerLegalPersonForm">Pessoa Juridica</a></li>
    				</ul>
  				</li>		      
				  <li><a href="./index.php?controller=registration&action=redirectCreate&page=EntityForm">Entidades</a></li>
		    </ul>
		  </li>
		</ul>
	</div>
</div>