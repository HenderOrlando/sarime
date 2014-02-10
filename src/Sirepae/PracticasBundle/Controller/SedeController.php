<?php

namespace Sirepae\PracticasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PracticasBundle\Entity\Sede;
use Sirepae\PracticasBundle\Form\SedeType;

/**
 * Sede controller.
 *
 * @Route("/sede")
 */
class SedeController extends Controller
{

    /**
     * Lists all Sede entities.
     *
     * @Route("/", name="sede")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePracticasBundle:Sede')->findAll();

        return array(
            'entities' => $entities,
            'active_sedes_resumen'  =>  true
        );
    }
    /**
     * Creates a new Sede entity.
     *
     * @Route("/", name="sede_create")
     * @Method("POST")
     * @Template("SirepaePracticasBundle:Sede:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Sede();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sede'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_sedes_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Sede entity.
    *
    * @param Sede $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Sede $entity)
    {
        $form = $this->createForm(new SedeType(), $entity, array(
            'action' => $this->generateUrl('sede_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Sede entity.
     *
     * @Route("/new", name="sede_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Sede();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_sedes_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Sede entity.
     *
     * @Route("/{id}", name="sede_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePracticasBundle:Sede')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sede entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_sedes_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Sede entity.
     *
     * @Route("/{id}/edit", name="sede_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePracticasBundle:Sede')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sede entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_sedes_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Sede entity.
    *
    * @param Sede $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sede $entity)
    {
        $form = $this->createForm(new SedeType(), $entity, array(
            'action' => $this->generateUrl('sede_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Sede entity.
     *
     * @Route("/{id}", name="sede_update")
     * @Method("PUT")
     * @Template("SirepaePracticasBundle:Sede:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePracticasBundle:Sede')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sede entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sede_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_sedes_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a Sede entity.
     *
     * @Route("/{id}", name="sede_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePracticasBundle:Sede')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sede entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sede'));
    }

    /**
     * Creates a form to delete a Sede entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sede_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
    
}
