<?php

namespace WorkersManager\MngrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use My_Bundle\Entity\My_EntityClass;
use WorkersManager\MngrBundle\Entity\Employee;
use WorkersManager\MngrBundle\Entity\Shedule;
use WorkersManager\MngrBundle\Controller\EmployeeController;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $em = $this ->getDoctrine()->getManager();
        $repoEmployee = $this ->getDoctrine()->getRepository('MngrBundle:Employee');
        $repoSchedule = $this ->getDoctrine()->getRepository('MngrBundle:Shedule');
        
        $newEmployee = new Employee();
        $formEmp = $this->createForm('WorkersManager\MngrBundle\Form\EmployeeType', $newEmployee);
        $formEmp->handleRequest($request);
        
            if ($formEmp->isSubmitted() && $formEmp->isValid()) {
            $em->persist($newEmployee);
            $em->flush($newEmployee);
            }
        
        $employees = $repoEmployee->findAll();
        
        $newShedule = new Shedule();
        $form = $this->createFormBuilder($newShedule)
                ->setAction($this->generateUrl('shedule_new'))
                ->add('save','submit', array('label'=>'x'))
                ->getForm();
        
        return $this->render('MngrBundle:Default:index.html.twig', 
                    array('employees'=>$employees,
                          'form'=>$form->createView(),
                          'formEmp'=> $formEmp->createView()));
    }
    
}