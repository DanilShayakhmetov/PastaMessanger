<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 05.05.18
 * Time: 18:10
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Users;


class TestController extends FOSRestController

{
    /**
    * @Rest\Get("/users")
    */
    public function getAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:Users')->findAll();
        if ($restresult === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }


}