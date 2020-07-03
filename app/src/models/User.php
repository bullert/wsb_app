<?php
class User
{
	private $id;

	private $login;

	private $email;
	
	public function __construct($id, $login, $email)
	{
		$this->id = $id;
		$this->login = $login;
		$this->email = $email;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setLogin($login)
	{
		$this->login = $login;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}
}
?>
