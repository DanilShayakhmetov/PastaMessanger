<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MessageTab
 *
 * @ORM\Table(name="message_tab")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MessageTabRepository")
 */
class MessageTab
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
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="posted_at", type="datetime")
     */
    private $postedAt;


    /*

     Foregin Keys for
     User Message OneToMany
     Chat Message OneToMany

     */


    /**
     * @ORM\ManyToOne(targetEntity="UserTab", inversedBy="UserMessage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $MessageUser;

    /**
     * @return mixed
     */
    public function getMessageUser()
    {
        return $this->MessageUser;
    }

    /**
     * @ORM\ManyToOne(targetEntity="ChatTab", inversedBy="ChatMessage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $MessageChat;

    /**
     * @return mixed
     */
    public function getMessageChat()
    {
        return $this->MessageChat;
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
     * Set content.
     *
     * @param string $content
     *
     * @return MessageTab
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set postedAt.
     *
     * @param \DateTime $postedAt
     *
     * @return MessageTab
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
