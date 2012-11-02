<?php 

/**
* @Entity
* @Table(name = "moderator")
*/
class Moderator
{
	/**
     *@Id @Column(type="integer")
     *@GeneratedValue
     **/
	protected $id;

	/**
	* @Column(type = "string", unique=true,  nullable = false)
	*/
	protected $login;

	/**
	* @Column(type = "string", nullable = false)
	*/
	protected $password;

	/**
    * @Column(type="string")
    **/
    protected $email;

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

	public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getId(){
    	return $this->id;
    }

    public function setId($id){
    	$this->id = $id;
    }
}

?>