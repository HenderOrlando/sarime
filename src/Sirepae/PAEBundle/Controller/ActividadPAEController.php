<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\ActividadPAE;
use Sirepae\PAEBundle\Form\ActividadPAEType;

/**
 * ActividadPAE controller.
 *
 * @Route("/actividad_pae")
 */
class ActividadPAEController extends Controller
{

    /**
     * Lists all ActividadPAE entities.
     *
     * @Route("/", name="actividad_pae")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:ActividadPAE')->findAll();

        return array(
            'entities' => $entities,
            'active_actividades_pae_resumen'  =>  true
        );
    }
    /**
     * Creates a new ActividadPAE entity.
     *
     * @Route("/", name="actividad_pae_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:ActividadPAE:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ActividadPAE();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('actividad_pae'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_actividades_pae_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a ActividadPAE entity.
    *
    * @param ActividadPAE $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ActividadPAE $entity)
    {
        $form = $this->createForm(new ActividadPAEType(), $entity, array(
            'action' => $this->generateUrl('actividad_pae_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new ActividadPAE entity.
     *
     * @Route("/new", name="actividad_pae_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ActividadPAE();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_actividades_pae_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a ActividadPAE entity.
     *
     * @Route("/{id}", name="actividad_pae_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:ActividadPAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActividadPAE entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_actividades_pae_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing ActividadPAE entity.
     *
     * @Route("/{id}/edit", name="actividad_pae_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:ActividadPAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActividadPAE entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_actividades_pae_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a ActividadPAE entity.
    *
    * @param ActividadPAE $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ActividadPAE $entity)
    {
        $form = $this->createForm(new ActividadPAEType(), $entity, array(
            'action' => $this->generateUrl('actividad_pae_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing ActividadPAE entity.
     *
     * @Route("/{id}", name="actividad_pae_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:ActividadPAE:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:ActividadPAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ActividadPAE entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('actividad_pae_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_actividades_pae_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a ActividadPAE entity.
     *
     * @Route("/{id}", name="actividad_pae_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:ActividadPAE')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ActividadPAE entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('actividad_pae'));
    }

    /**
     * Creates a form to delete a ActividadPAE entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('actividad_pae_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
