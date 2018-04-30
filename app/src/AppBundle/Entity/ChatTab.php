<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Ldap\Adapter\ExtLdap\Collection;

/**
 * ChatTab
 *
 * @ORM\Table(name="chat_tab")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChatTabRepository")
 */
class ChatTab
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_group", type="boolean")
     */
    private $isGroup;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="posted_at", type="datetime")
     */
    private $postedAt;

    /*Foregin key's for User and message

    User Chat ManyToMany
    And
    Message Chat  ManyToOne

    */

    /**
     * @ORM\OneToMany(targetEntity="MessageTab", mappedBy="MessageChat")
     */

    private $ChatMessage;


    /**
    * @ManyToMany(targetEntity="UserTab")
    */
    private $ChatUser;


    public function __construct()
    {
        $this->ChatMessage = new ArrayCollection();
        $this->ChatUser = new ArrayCollection();
    }


    public function getMessage()
    {
        return $this->ChatMessage;
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

    /**
     * Set isGroup.
     *
     * @param bool $isGroup
     *
     * @return ChatTab
     */
    public function setIsGroup($isGroup)
    {
        $this->isGroup = $isGroup;

        return $this;
    }

    /**
     * Get isGroup.
     *
     * @return bool
     */
    public function getIsGroup()
    {
        return $this->isGroup;
    }

    /**
     * Set postedAt.
     *
     * @param \DateTime $postedAt
     *
     * @return ChatTab
     */
    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    /**
     * Get postedAt.
     *
     * @return \DateTime
     */
    public function getPostedAt()
    {
        return $this->postedAt;
    }
}
