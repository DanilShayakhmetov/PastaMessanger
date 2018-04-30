<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 24.04.18
 * Time: 23:58
 */

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\UserTab;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        // 1) Постройте форму
        $user = new UserTab();
        $form = $this->createForm(UserType::class, $user);

        // 2) Обработайте отправку (случится только с POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Зашифруйте пароль (вы также можете сделать это через слушатель Doctrine)
//            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $password = $user->getPlainPassword();
//            $password = $this->get('security.password_encoder')
//                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) Сохраните пользователя!
            $em->persist($user);
            $em->flush();

            // ... выполните любую другую работу - отправку электронных писем и т.д.
            // возможно, установите флеш-сообщение об успехе для пользователя
            return $this->render('genus/show.html.twig', array(
                'name' => 'Hello Barry'
            ));
        }

        return $this->render(
            'registration/registration.html.twig',
            array('form' => $form->createView())
        );
    }
}