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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $em = $this ->getDoctrine()->getManager();
        $repoEmployee = $this ->getDoctrine()->getRepository('MngrBundle:Employee');
        $repoShedule = $this ->getDoctrine()->getRepository('MngrBundle:Shedule');
        
        //formularz do stworzenia nowego pracownika
        $newEmployee = new Employee();
        $formEmp = $this->createForm('WorkersManager\MngrBundle\Form\EmployeeType', $newEmployee);
        $formEmp->handleRequest($request);
        
            if ($formEmp->isSubmitted() && $formEmp->isValid()) {
            $em->persist($newEmployee);
            $em->flush($newEmployee);
            }
        
        $employees = $repoEmployee->findAll();
        
        //formularz do znajdywania pracownika pracownika
        
        
        // generowanie odpowiedniej ilosci kolumn zgodnie z iloscia dni danego miesiaca
        $CurrMonthYear = date("m / Y");
        $daysInMonth = date('t');
        $lastDayPrevMonth = date('t-m-y', strtotime(date('Y-m')." -1 month"));
        $firstDayNextMonth = date('d-m-y', strtotime(date('Y-m')." +1 month"));
        
        //formularz do planu
        $year = date("y");
        $month = date("m");
        $newShedule = new Shedule();
        $formSh = $this->createFormBuilder($newShedule)
//                ->setAction($this->generateUrl('shedule_new'))  <---przekierowało do odpowiedniego kontrolera
                ->add('year', HiddenType::class, array(
                    'data' =>$year
                ))
                ->add('month', HiddenType::class, array(
                    'data' =>$month
                ))
                ->add('fromDay')
                ->add('toDay')
                ->add('hours')
                ->add('employee')
                ->add('save','submit', array('label'=>'stwórz'))
                ->getForm();
        
        return $this->render('MngrBundle:Default:index.html.twig', 
                    array('employees'=>$employees,
                          'currDate'=>$CurrMonthYear,
//                          'year'=>$year,
//                          'month'=>$month,
                          'daysInMonth'=>$daysInMonth,
                          'prevMonth'=>$lastDayPrevMonth,
                          'nextMonth'=>$firstDayNextMonth,
                          'formSh'=>$formSh->createView(),
                          'formEmp'=> $formEmp->createView()));
    }

}