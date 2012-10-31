<?php 

/**
* @Entity
* @Table(name = "moderator")
*/
class Moderator
{
	/**
	*	@Id
	*	@Column(type = "string", nullable = false)
	*/
	protected $login;

	/**
	*	@Column(type = "string", nullable = false)
	*/
	protected $password;

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}
}

?>