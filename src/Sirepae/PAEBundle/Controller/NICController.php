<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\NIC;
use Sirepae\PAEBundle\Form\NICType;

/**
 * NIC controller.
 *
 * @Route("/nic")
 */
class NICController extends Controller
{

    /**
     * Lists all NIC entities.
     *
     * @Route("/", name="nic")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:NIC')->findAll();

        return array(
            'entities' => $entities,
            'active_nics_resumen'  =>  true
        );
    }
    /**
     * Creates a new NIC entity.
     *
     * @Route("/", name="nic_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:NIC:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new NIC();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nic'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_nics_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a NIC entity.
    *
    * @param NIC $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(NIC $entity)
    {
        $form = $this->createForm(new NICType(), $entity, array(
            'action' => $this->generateUrl('nic_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new NIC entity.
     *
     * @Route("/new", name="nic_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new NIC();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_nics_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a NIC entity.
     *
     * @Route("/{id}", name="nic_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:NIC')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NIC entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_nics_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing NIC entity.
     *
     * @Route("/{id}/edit", name="nic_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:NIC')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NIC entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_nics_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a NIC entity.
    *
    * @param NIC $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(NIC $entity)
    {
        $form = $this->createForm(new NICType(), $entity, array(
            'action' => $this->generateUrl('nic_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing NIC entity.
     *
     * @Route("/{id}", name="nic_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:NIC:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:NIC')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NIC entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('nic_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_nics_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a NIC entity.
     *
     * @Route("/{id}", name="nic_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:NIC')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NIC entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nic'));
    }

    /**
     * Creates a form to delete a NIC entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nic_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
