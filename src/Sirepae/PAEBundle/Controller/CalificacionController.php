<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\Calificacion;
use Sirepae\PAEBundle\Form\CalificacionType;

/**
 * Calificacion controller.
 *
 * @Route("/calificacion")
 */
class CalificacionController extends Controller
{

    /**
     * Lists all Calificacion entities.
     *
     * @Route("/", name="calificacion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:Calificacion')->findAll();

        return array(
            'entities' => $entities,
            'active_calificaciones_resumen'  =>  true
        );
    }
    /**
     * Creates a new Calificacion entity.
     *
     * @Route("/", name="calificacion_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:Calificacion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Calificacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('calificacion'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_calificaciones_resumen'  =>  true,
            'active_calificaciones_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Calificacion entity.
    *
    * @param Calificacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Calificacion $entity)
    {
        $form = $this->createForm(new CalificacionType(), $entity, array(
            'action' => $this->generateUrl('calificacion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Calificacion entity.
     *
     * @Route("/new", name="calificacion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Calificacion();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_calificaciones_resumen'  =>  true,
            'active_calificaciones_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Calificacion entity.
     *
     * @Route("/{id}", name="calificacion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Calificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calificacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_calificaciones_resumen'  =>  true,
            'active_calificaciones_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Calificacion entity.
     *
     * @Route("/{id}/edit", name="calificacion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Calificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calificacion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_calificaciones_resumen'  =>  true,
            'active_calificaciones_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Calificacion entity.
    *
    * @param Calificacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Calificacion $entity)
    {
        $form = $this->createForm(new CalificacionType(), $entity, array(
            'action' => $this->generateUrl('calificacion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Calificacion entity.
     *
     * @Route("/{id}", name="calificacion_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:Calificacion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Calificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calificacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('calificacion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_calificaciones_resumen'  =>  true,
            'active_calificaciones_edit'  =>  true,
        );
    }
    /**
     * Deletes a Calificacion entity.
     *
     * @Route("/{id}", name="calificacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:Calificacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Calificacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('calificacion'));
    }

    /**
     * Creates a form to delete a Calificacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('calificacion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
