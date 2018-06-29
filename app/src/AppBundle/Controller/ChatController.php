<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 05.05.18
 * Time: 15:59
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
use AppBundle\Entity\ChatTab;


class ChatController extends FOSRestController
{
    /**
     * @Rest\Get("/api/chat")
     */
    public function getAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:ChatTab')->findAll();
        if ($restresult === null) {
            return new View("there are no chat exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/api/chat/{id}")
     */
    public function idAction($id)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:ChatTab')->find($id);
        if ($restresult === null) {
            return new View("there are no chat exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }



//   Chat by current autenticated user id
    /**
         * @Rest\Get("/api/chatbyCurUsr")
     */
    public function userIdAction()

    {

        $user = $this->getUser()->getId();
        $restresult = $this->getDoctrine()->getRepository('AppBundle:UserTab')->find($user);
        $chat = $restresult->getUserChat();

        if ($restresult === null) {
            return new View($chat."  hello ", Response::HTTP_NOT_FOUND);
        }
        return  $chat;
    }

//   Chat by current autenticated user Name
//    /**
//     * @Rest\Get("/api/chatbyUsrName")
//     */
//    public function userNameAction()
//
//    {
//
//
//        $user = $this->getUser()->getUsername();
//        $restresult = $this->getDoctrine()->getRepository('AppBundle:UserTab')->findOneBy(array('username'=>$user));
//        $chat = $restresult->getUserChat();
//
//        if ($restresult === null) {
//            return new View($chat."  hello ", Response::HTTP_NOT_FOUND);
//        }
//        return $chat;
//    }
//



    /**
    * @Rest\Post("/api/chat/")
    */
    public function postAction(Request $request,EntityManagerInterface $em)
    {
        $data = new ChatTab();
//        $user = $this->getUser()->getId();
        $user = new UserTab();

        $user = $em->getRepository('AppBundle:UserTab')
            ->findOneBy(['email' => 'b@mail.com']);

        $postedAt = $request->get('posted_at');
        $isGroup = $request->get('is_group');


        if(empty($postedAt) || empty($isGroup))
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->addUserToChat($user);
        $data->setPostedAt($postedAt);
        $data->setIsGroup($isGroup);;
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("Chat created Successfully", Response::HTTP_OK);
    }



    /**
     * @Rest\Delete("/api/deleteChat/{id}")
     */
    public function deleteAction($id,EntityManagerInterface $em)
    {
//        $user = $this->getUser()->getId();
//
        $user = new UserTab();
//
        $user = $em->getRepository('AppBundle:UserTab')->findOneBy(['email' => 'a@mail.com']);
        $em = $this->getDoctrine()->getManager();

//        $user = $this->getUser()->getId();
        $restresult = $this->getDoctrine()->getRepository('AppBundle:UserTab')->find($user);
        $chat = $restresult->removeChat($user);



        if (empty($chat)) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        else {
            $em->persist($chat);
            $em->flush();
        }
        return new View("Chat deleted successfully", Response::HTTP_OK);
    }



//    /**
//     * @Route("/chat/", name="user_chat")
//     */
//    public function postAction(Request $request, EntityManagerInterface $em)
//    {
//        $data = new ChatTab();
//        $form = $this->createForm(SendType::class, $data);
//        $form->handleRequest($request);
//        $user = $this->getUser()->getUserId();
//        $isGroup = (boolean)$request->get('is_group');
//        $postedAt = $request->get('posted_at');
//
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//
//
//        $data->setPostedAt(Null);
//        $data->setIsGroup($isGroup);
//        $data->setChatMessage($user);
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($data);
//        $em->flush();
//            return $this->redirectToRoute('default/index.html.twig');
//
//        }
//            return $this->render(
//                'genus/show.html.twig',
//                array('form' => $form->createView())
//            );
//    }

//
//
//    /**
//     * @Route("/register", name="user_registration")
//     */
//    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
//    {
//        // 1) Постройте форму
//        $user = new User();
//        $form = $this->createForm(UserType::class, $user);
//
//        // 2) Обработайте отправку (случится только с POST)
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            // 3) Зашифруйте пароль (вы также можете сделать это через слушатель Doctrine)
//            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
//            $user->setPassword($password);
//
//            // 4) Сохраните пользователя!
//            $em->persist($user);
//            $em->flush();
//
//            // ... выполните любую другую работу - отправку электронных писем и т.д.
//            // возможно, установите флеш-сообщение об успехе для пользователя
//            return $this->redirectToRoute('replace_with_some_route');
//        }
//
//        return $this->render(
//            'registration/register.html.twig',
//            array('form' => $form->createView())
//        );
//    }
//
//
//
//
}