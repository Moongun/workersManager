<?php

namespace WorkersManager\MngrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use My_Bundle\Entity\My_EntityClass;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        
        
        return $this->render('MngrBundle:Default:index.html.twig');
    }
    
}