<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\Clase;
use Sirepae\PAEBundle\Form\ClaseType;

/**
 * Clase controller.
 *
 * @Route("/clase")
 */
class ClaseController extends Controller
{

    /**
     * Lists all Clase entities.
     *
     * @Route("/", name="clase")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:Clase')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Clase entity.
     *
     * @Route("/", name="clase_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:Clase:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Clase();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('clase_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Clase entity.
    *
    * @param Clase $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Clase $entity)
    {
        $form = $this->createForm(new ClaseType(), $entity, array(
            'action' => $this->generateUrl('clase_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Clase entity.
     *
     * @Route("/new", name="clase_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Clase();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Clase entity.
     *
     * @Route("/{id}", name="clase_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Clase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clase entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Clase entity.
     *
     * @Route("/{id}/edit", name="clase_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Clase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clase entity.');
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
    * Creates a form to edit a Clase entity.
    *
    * @param Clase $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Clase $entity)
    {
        $form = $this->createForm(new ClaseType(), $entity, array(
            'action' => $this->generateUrl('clase_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Clase entity.
     *
     * @Route("/{id}", name="clase_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:Clase:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Clase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clase entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('clase_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Clase entity.
     *
     * @Route("/{id}", name="clase_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:Clase')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Clase entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('clase'));
    }

    /**
     * Creates a form to delete a Clase entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clase_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
