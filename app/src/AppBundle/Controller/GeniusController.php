<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 23.04.18
 * Time: 22:06
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GeniusController extends Controller
{
    /**
     * @Route("/genius/{genusName}")
     */
    public function showAction($genusName){
        return new Response('Under the sea: '.$genusName);
    }

    /**
     * @Route("/genius/")
     */
    public function showMsg(){
        return new Response('Under the sea: ');
    }

    /**
     * @Route("/temp/{gname}")
     */
    public function temp($gname){

        return $this->render('genus/show.html.twig', array(
            'name' => $gname
        ));

    }

}