<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
* @ORM\Entity
* @UniqueEntity(fields="email", message="Email already taken")
* @UniqueEntity(fields="username", message="Username already taken")
*/
class UserTab
{
/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/
private $id;

/**
* @ORM\Column(type="string", length=255, unique=true)
* @Assert\NotBlank()
* @Assert\Email()
*/
private $email;

/**
* @ORM\Column(type="string", length=255, unique=true)
* @Assert\NotBlank()
*/
private $username;

/**
* @Assert\NotBlank()
* @Assert\Length(max=4096)
*/
private $plainPassword;

/**
* Длина ниже зависит от "алгоритма", используемого для шифрования
* пароля, но это также хорошо работает с bcrypt.
*
* @ORM\Column(type="string", length=64)
*/
private $password;

// другие свойства и методы

public function getEmail()
{
return $this->email;
}

public function setEmail($email)
{
$this->email = $email;
}

public function getUsername()
{
return $this->username;
}

public function setUsername($username)
{
$this->username = $username;
}

public function getPlainPassword()
{
return $this->plainPassword;
}

public function setPlainPassword($password)
{
$this->plainPassword = $password;
}

public function getPassword()
{
return $this->password;
}

public function setPassword($password)
{
$this->password = $password;
}

public function getSalt()
{
// Алгоритм bcrypt не требует отдельной "соли".
// Вам *может* понадобиться настоящая соль, если вы выберете другой кодер.
return null;
}

// другие методы, включая методы безопасности как getRoles()
}
