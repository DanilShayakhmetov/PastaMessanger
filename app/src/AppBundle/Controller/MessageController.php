<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 10.05.18
 * Time: 1:34
 */

namespace AppBundle\Controller;


use AppBundle\Entity\UserTab;
use AppBundle\Form\SendType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\MessageTab;
use AppBundle\Entity\ChatTab;


class MessageController extends FOSRestController
{


    /**
     * @Rest\Get("/api/message")
     */
    public function getAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:MessageTab')->findAll();
        if ($restresult === null) {
            return new View("there are no message exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/api/message/{id}")
     */
    public function idAction($id)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:MessageTab')->find($id);
        if ($restresult === null) {
            return new View("there are no chat exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }



//   Chat by current autenticated user id
    /**
     * @Rest\Get("/api/messagebyChat/{id}")
     */
    public function userIdAction($id)

    {

        $user = $this->getUser()->getId();
        $restresult = $this->getDoctrine()->getRepository('AppBundle:ChatTab')->find($id);
        $message = $restresult->getChatMessage();

        if ($restresult === null) {
            return new View($message."  hello ", Response::HTTP_NOT_FOUND);
        }
        return  $message;
    }




}