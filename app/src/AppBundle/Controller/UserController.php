<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 24.04.18
 * Time: 23:08
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\UserTab;

class UserController extends FOSRestController
{
    /**
    * @Rest\Get("/user")
    */
    public function getAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:UserTab')->findAll();
        if ($restresult === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/user/{id}")
     */
    public function idAction($id)
    {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:UserTab')->find($id);
        if ($singleresult === null) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/user/")
     */
    public function postAction(Request $request)
    {
        $data = new UserTab();
        $username = $request->get('username');
        $email = $request->get('email');
        $firstname = $request->get('firstName');
        $lastname = $request->get('lastName');
        $password = $request->get('password');
        $plainPassword = $request->get('plainPassword');
        $postedAt = $request->get('postedAt');
        if(empty($username) || empty($email))
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setUsername($username);
        $data->setEmail($email);
        $data->setFirstName($firstname);
        $data->setLastName($lastname);
        $data->setPassword($password);
        $data->setPlainPassword($plainPassword);
        $data->setPostedAt($postedAt);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("User Added Successfully", Response::HTTP_OK);
    }



    /**
    * @Rest\Put("/user/{id}")
    */
    public function updateAction($id,Request $request)
    {
        $data = new UserTab();
        $username = $request->get('username');
        $email = $request->get('email');
        $firstname = $request->get('firstName');
        $lastname = $request->get('lastName');
        $password = $request->get('password');

        $sn = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository('AppBundle:UserTab')->find($id);
        if (empty($user)) {
            return new View("User not found", Response::HTTP_NOT_FOUND);
        }
        elseif(!empty($username) && !empty($email)){
            $user->setUsername($username);
            $user->setEmail($email);
            $sn->flush();
            return new View("User Updated Successfully", Response::HTTP_OK);
        }
        elseif(empty($username) && !empty($email)){
            $user->setEmail($email);
            $sn->flush();
            return new View("role Updated Successfully", Response::HTTP_OK);
        }
        elseif(!empty($username) && empty($email)){
            $user->setUsername($username);
            $sn->flush();
            return new View("User Name Updated Successfully", Response::HTTP_OK);
        }
        else return new View("User name or role cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
    }





}