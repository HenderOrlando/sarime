<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\Intervencion;
use Sirepae\PAEBundle\Form\IntervencionType;

/**
 * Intervencion controller.
 *
 * @Route("/intervencion")
 */
class IntervencionController extends Controller
{

    /**
     * Lists all Intervencion entities.
     *
     * @Route("/", name="intervencion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:Intervencion')->findAll();

        return array(
            'entities' => $entities,
            'active_intervenciones_resumen'  =>  true,'active_nics_resumen'  =>  true
        );
    }
    /**
     * Creates a new Intervencion entity.
     *
     * @Route("/", name="intervencion_create")
     * @Route("/nic/{id}", name="intervencion_create_nic")
     * @Method("POST")
     * @Template("SirepaePAEBundle:Intervencion:new.html.twig")
     */
    public function createAction(Request $request, $id = null)
    {
        $entity = new Intervencion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            if (is_null($id)) {
                return $this->redirect($this->generateUrl('intervencion'));
            } else {
                return $this->redirect($this->generateUrl('nic_edit', array('id' => $id)));
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_intervenciones_resumen'  =>  true,'active_nics_resumen'  =>  true,
            'active_intervenciones_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Intervencion entity.
    *
    * @param Intervencion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Intervencion $entity, \Sirepae\PAEBundle\Entity\NIC $nic = null)
    {
        $url = $this->generateUrl('intervencion_create');
        if (!is_null($nic)) {
            $url = $this->generateUrl('intervencion_create_nic', array('id' => $nic->getId()));
        }
        $form = $this->createForm(new IntervencionType(), $entity, array(
            'action' => $url,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Intervencion entity.
     *
     * @Route("/new/", name="intervencion_new")
     * @Route("/nic/{id}/", name="add_intervencion")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = null)
    {
        $entity = new Intervencion();
        $em = $this->getDoctrine()->getManager();
        
        $nic = null;
        if(!is_null($id)){
            $nic = $em->getRepository('SirepaePAEBundle:NIC')->find($id);
            $entity->setNIC($nic);
        }
        $form   = $this->createCreateForm($entity, $nic);

        return array(
            'nic' => $nic,
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_intervenciones_resumen'  =>  true,'active_nics_resumen'  =>  true,
            'active_intervenciones_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Intervencion entity.
     *
     * @Route("/{id}", name="intervencion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Intervencion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Intervencion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_intervenciones_resumen'  =>  true,'active_nics_resumen'  =>  true,
            'active_intervenciones_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Intervencion entity.
     *
     * @Route("/{id}/edit", name="intervencion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Intervencion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Intervencion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_intervenciones_resumen'  =>  true,'active_nics_resumen'  =>  true,
            'active_intervenciones_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Intervencion entity.
    *
    * @param Intervencion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Intervencion $entity)
    {
        $form = $this->createForm(new IntervencionType(), $entity, array(
            'action' => $this->generateUrl('intervencion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Intervencion entity.
     *
     * @Route("/{id}", name="intervencion_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:Intervencion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Intervencion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Intervencion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('intervencion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_intervenciones_resumen'  =>  true,'active_nics_resumen'  =>  true,
            'active_intervenciones_edit'  =>  true,
        );
    }
    /**
     * Deletes a Intervencion entity.
     *
     * @Route("/{id}", name="intervencion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:Intervencion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Intervencion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('intervencion'));
    }

    /**
     * Creates a form to delete a Intervencion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('intervencion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
