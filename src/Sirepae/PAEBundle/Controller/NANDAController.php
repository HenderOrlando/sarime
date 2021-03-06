<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\NANDA;
use Sirepae\PAEBundle\Form\NANDAType;

/**
 * NANDA controller.
 *
 * @Route("/nanda")
 */
class NANDAController extends Controller
{

    /**
     * Lists all NANDA entities.
     *
     * @Route("/", name="nanda")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:NANDA')->findAll();

        return array(
            'entities' => $entities,
            'active_nandas_resumen'  =>  true
        );
    }
    /**
     * Creates a new NANDA entity.
     *
     * @Route("/", name="nanda_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:NANDA:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new NANDA();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nanda'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_nandas_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a NANDA entity.
    *
    * @param NANDA $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(NANDA $entity)
    {
        $form = $this->createForm(new NANDAType(), $entity, array(
            'action' => $this->generateUrl('nanda_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new NANDA entity.
     *
     * @Route("/new", name="nanda_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new NANDA();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_nandas_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a NANDA entity.
     *
     * @Route("/{id}", name="nanda_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:NANDA')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NANDA entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_nandas_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing NANDA entity.
     *
     * @Route("/{id}/edit", name="nanda_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:NANDA')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NANDA entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_nandas_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a NANDA entity.
    *
    * @param NANDA $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(NANDA $entity)
    {
        $form = $this->createForm(new NANDAType(), $entity, array(
            'action' => $this->generateUrl('nanda_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing NANDA entity.
     *
     * @Route("/{id}", name="nanda_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:NANDA:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:NANDA')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NANDA entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('nanda_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_nandas_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a NANDA entity.
     *
     * @Route("/{id}", name="nanda_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:NANDA')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NANDA entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nanda'));
    }

    /**
     * Creates a form to delete a NANDA entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nanda_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
