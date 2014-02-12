<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\Actividad;
use Sirepae\PAEBundle\Form\ActividadType;

/**
 * Actividad controller.
 *
 * @Route("/actividad")
 */
class ActividadController extends Controller
{

    /**
     * Lists all Actividad entities.
     *
     * @Route("/", name="actividad")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:Actividad')->findAll();

        return array(
            'entities' => $entities,
            'active_actividades_resumen'  =>  true,'active_nics_resumen'  =>  true
        );
    }
    /**
     * Creates a new Actividad entity.
     *
     * @Route("/", name="actividad_create")
     * @Route("/nic/{id}/", name="actividad_create_nic")
     * @Route("/intervencion/{id_intervencion}/", name="actividad_create_intervencion")
     * @Method("POST")
     * @Template("SirepaePAEBundle:Actividad:new.html.twig")
     */
    public function createAction(Request $request, $id = null, $id_intervencion = null)
    {
        $entity = new Actividad();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            if (!is_null($id)) {
                return $this->redirect($this->generateUrl('nic_edit', array('id' => $id)));
            } elseif (!is_null($id_intervencion)) {
                return $this->redirect($this->generateUrl('intervencion_edit', array('id' => $id_intervencion)));
            } else {
                return $this->redirect($this->generateUrl('actividad'));
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_actividades_resumen'  =>  true,'active_nics_resumen'  =>  true,
            'active_actividades_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Actividad entity.
    *
    * @param Actividad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Actividad $entity, \Sirepae\PAEBundle\Entity\NIC $nic = null, \Sirepae\PAEBundle\Entity\Intervencion $int = null)
    {
        $url = $this->generateUrl('actividad_create');
        if (!is_null($nic)) {
            $url = $this->generateUrl('actividad_create_nic', array('id' => $nic->getId()));
        }elseif(!is_null($int)){
            $url = $this->generateUrl('actividad_create_intervencion', array('id_intervencion' => $int->getId()));
        }
        $form = $this->createForm(new ActividadType($nic), $entity, array(
            'action' => $url,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Actividad entity.
     *
     * @Route("/new/", name="actividad_new")
     * @Route("/new/nic/{id}/", name="add_actividad")
     * @Route("/new/intervencion/{id_intervencion}/", name="add_actividad_intervencion")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id=null, $id_intervencion = null)
    {
        $entity = new Actividad();
        $em = $this->getDoctrine()->getManager();
        $nic = null;
        if(!is_null($id)){
            $nic = $em->getRepository('SirepaePAEBundle:NIC')->find($id);
        }
        $int = null;
        if(!is_null($id_intervencion)){
            $int = $em->getRepository('SirepaePAEBundle:Intervencion')->find($id_intervencion);
            $entity->setIntervencion($int);
        }
        $form   = $this->createCreateForm($entity, $nic, $int);
        
        return array(
            'nic' => $nic,
            'int' => $int,
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_actividades_resumen'  =>  true,'active_nics_resumen'  =>  true,
            'active_actividades_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Actividad entity.
     *
     * @Route("/{id}", name="actividad_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Actividad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Actividad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_actividades_resumen'  =>  true,'active_nics_resumen'  =>  true,
            'active_actividades_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Actividad entity.
     *
     * @Route("/{id}/edit", name="actividad_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Actividad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Actividad entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_actividades_resumen'  =>  true,'active_nics_resumen'  =>  true,
            'active_actividades_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Actividad entity.
    *
    * @param Actividad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Actividad $entity)
    {
        $form = $this->createForm(new ActividadType(), $entity, array(
            'action' => $this->generateUrl('actividad_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Actividad entity.
     *
     * @Route("/{id}", name="actividad_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:Actividad:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Actividad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Actividad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('actividad_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_actividades_resumen'  =>  true,'active_nics_resumen'  =>  true,
            'active_actividades_edit'  =>  true,
        );
    }
    /**
     * Deletes a Actividad entity.
     *
     * @Route("/{id}", name="actividad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:Actividad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Actividad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('actividad'));
    }

    /**
     * Creates a form to delete a Actividad entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('actividad_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
