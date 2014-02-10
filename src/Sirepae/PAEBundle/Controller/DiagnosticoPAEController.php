<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\DiagnosticoPAE;
use Sirepae\PAEBundle\Form\DiagnosticoPAEType;

/**
 * DiagnosticoPAE controller.
 *
 * @Route("/diagnostico_pae")
 */
class DiagnosticoPAEController extends Controller
{

    /**
     * Lists all DiagnosticoPAE entities.
     *
     * @Route("/", name="diagnostico_pae")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:DiagnosticoPAE')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new DiagnosticoPAE entity.
     *
     * @Route("/", name="diagnostico_pae_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:DiagnosticoPAE:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new DiagnosticoPAE();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('diagnostico_pae_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a DiagnosticoPAE entity.
    *
    * @param DiagnosticoPAE $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(DiagnosticoPAE $entity)
    {
        $form = $this->createForm(new DiagnosticoPAEType(), $entity, array(
            'action' => $this->generateUrl('diagnostico_pae_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new DiagnosticoPAE entity.
     *
     * @Route("/new", name="diagnostico_pae_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new DiagnosticoPAE();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a DiagnosticoPAE entity.
     *
     * @Route("/{id}", name="diagnostico_pae_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:DiagnosticoPAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DiagnosticoPAE entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing DiagnosticoPAE entity.
     *
     * @Route("/{id}/edit", name="diagnostico_pae_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:DiagnosticoPAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DiagnosticoPAE entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a DiagnosticoPAE entity.
    *
    * @param DiagnosticoPAE $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(DiagnosticoPAE $entity)
    {
        $form = $this->createForm(new DiagnosticoPAEType(), $entity, array(
            'action' => $this->generateUrl('diagnostico_pae_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing DiagnosticoPAE entity.
     *
     * @Route("/{id}", name="diagnostico_pae_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:DiagnosticoPAE:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:DiagnosticoPAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DiagnosticoPAE entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('diagnostico_pae_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a DiagnosticoPAE entity.
     *
     * @Route("/{id}", name="diagnostico_pae_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:DiagnosticoPAE')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DiagnosticoPAE entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('diagnostico_pae'));
    }

    /**
     * Creates a form to delete a DiagnosticoPAE entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('diagnostico_pae_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
