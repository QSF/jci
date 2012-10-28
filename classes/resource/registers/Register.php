<?php 

/**
* Interface que nossos registers deverão implementar.
* Os Registers deverão implementar está interface visto que na classe ServiceLocator é utilizado o método create.
*/
interface Register
{
	public function create($name);
}
?>