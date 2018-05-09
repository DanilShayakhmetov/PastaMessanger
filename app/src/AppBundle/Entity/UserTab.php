<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinColumn;//Это нужно
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use FOS\UserBundle\Model\User as BaseUser;
/**
 * UserTab
 *
 * @ORM\Table(name="user_tab")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserTabRepository")
 */
class UserTab extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="username", type="string", length=55, unique=true)
//     */
//    private $username;
//
    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255, nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     */
    protected $lastName;
//
//
//
//
//
//
//
//
//
//
//    /**
//     * @var string
//     *
//     * @ORM\Column(name="email", type="string", length=255, unique=true)
//     */
//    private $email;
//
//    /**
//     * @var string
//     *
//     * @ORM\Column(name="password", type="string", length=255)
//     */
//    private $password;
//
//    /**
//     * @var string
//     *
//     * @ORM\Column(name="plainPassword", type="string", length=255)
//     */
//    private $plainPassword;
//
//
//    /**
//     * @var boolean
//     *
//     * @ORM\Column(name="is_active", type="boolean")
//     */
//    private $isActive;
//



    /*
* Foregin keys for
*
* User Message OneToMany
* and
* User Chat ManyToMany
*/



    /**
     * @ORM\OneToMany(targetEntity="MessageTab", mappedBy="MessageUser")
     */
    private $UserMessage;

    /**
     * @return mixed
     */
    public function getUserMessage()
    {
        return $this->UserMessage;
    }


    /**
     * @ORM\ManyToMany(targetEntity="ChatTab",mappedBy="ChatUser")
     *  @ORM\JoinTable(name="User_Chat")
     */

    private $UserChat;



    public function createUserChat(ChatTab $chat)
    {
        $this->UserChat[] = $chat;
    }



//    NEW
    /**
     * @return mixed
     */
    public function getUserChat()
    {
        return $this->UserChat;
    }

//

    public function __construct()
    {
        parent::__construct();
        $this->UserMessage = new ArrayCollection();
        $this->UserChat = new ArrayCollection();

    }



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

//    /**
//     * Set username.
//     *
//     * @param string $username
//     *
//     * @return UserTab
//     */
//    public function setUsername($username)
//    {
//        $this->username = $username;
//
//        return $this;
//    }
//
//    /**
//     * Get username.
//     *
//     * @return string
//     */
//    public function getUsername()
//    {
//        return $this->username;
//    }
//
//    /**
//     * Set email.
//     *
//     * @param string $email
//     *
//     * @return UserTab
//     */
//    public function setEmail($email)
//    {
//        $this->email = $email;
//
//        return $this;
//    }
//
//    /**
//     * Get email.
//     *
//     * @return string
//     */
//    public function getEmail()
//    {
//        return $this->email;
//    }
//
    /**
     * Set firstName.
     *
     * @param string $firstName
     *
     * @return UserTab
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return UserTab
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

//    /**
//     * Set password.
//     *
//     * @param string $password
//     *
//     * @return UserTab
//     */
//    public function setPassword($password)
//    {
//        $this->password = $password;
//
//        return $this;
//    }
//
//    /**
//     * Get password.
//     *
//     * @return string
//     */
//    public function getPassword()
//    {
//        return $this->password;
//    }
//
//    /**
//     * Set plainPassword.
//     *
//     * @param string $plainPassword
//     *
//     * @return UserTab
//     */
//    public function setPlainPassword($plainPassword)
//    {
//        $this->plainPassword = $plainPassword;
//
//        return $this;
//    }
//
//    /**
//     * Get plainPassword.
//     *
//     * @return string
//     */
//    public function getPlainPassword()
//    {
//        return $this->plainPassword;
//    }
//
//
}
