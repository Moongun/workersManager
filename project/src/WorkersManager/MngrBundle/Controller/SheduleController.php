<?php

namespace WorkersManager\MngrBundle\Controller;

use WorkersManager\MngrBundle\Entity\Shedule;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Shedule controller.
 *
 * @Route("shedule")
 */
class SheduleController extends Controller
{
    /**
     * Lists all shedule entities.
     *
     * @Route("/", name="shedule_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $shedules = $em->getRepository('MngrBundle:Shedule')->findAll();

        return $this->render('shedule/index.html.twig', array(
            'shedules' => $shedules,
        ));
    }

    /**
     * Creates a new shedule entity.
     *
     * @Route("/new", name="shedule_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $shedule = new Shedule();
        $form = $this->createForm('WorkersManager\MngrBundle\Form\SheduleType', $shedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shedule);
            $em->flush($shedule);

            return $this->redirectToRoute('shedule_show', array('id' => $shedule->getId()));
        }

        return $this->render('shedule/new.html.twig', array(
            'shedule' => $shedule,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a shedule entity.
     *
     * @Route("/{id}", name="shedule_show")
     * @Method("GET")
     */
    public function showAction(Shedule $shedule)
    {
        $deleteForm = $this->createDeleteForm($shedule);

        return $this->render('shedule/show.html.twig', array(
            'shedule' => $shedule,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing shedule entity.
     *
     * @Route("/{id}/edit", name="shedule_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Shedule $shedule)
    {
        $deleteForm = $this->createDeleteForm($shedule);
        $editForm = $this->createForm('WorkersManager\MngrBundle\Form\SheduleType', $shedule);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shedule_edit', array('id' => $shedule->getId()));
        }

        return $this->render('shedule/edit.html.twig', array(
            'shedule' => $shedule,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a shedule entity.
     *
     * @Route("/{id}", name="shedule_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Shedule $shedule)
    {
        $form = $this->createDeleteForm($shedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($shedule);
            $em->flush($shedule);
        }

        return $this->redirectToRoute('shedule_index');
    }

    /**
     * Creates a form to delete a shedule entity.
     *
     * @param Shedule $shedule The shedule entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Shedule $shedule)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('shedule_delete', array('id' => $shedule->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
