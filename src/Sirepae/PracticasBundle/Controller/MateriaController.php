<?php

namespace Sirepae\PracticasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PracticasBundle\Entity\Materia;
use Sirepae\PracticasBundle\Form\MateriaType;

/**
 * Materia controller.
 *
 * @Route("/materia")
 */
class MateriaController extends Controller
{

    /**
     * Lists all Materia entities.
     *
     * @Route("/", name="materia")
     * @Route("/area/{id}/", name="materias_area")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();

        if(is_null($id))
            $entities = $em->getRepository('SirepaePracticasBundle:Materia')->findAll();
        else
            $entities = $em->getRepository('SirepaePracticasBundle:Materia')->findByArea($id);

        return array(
            'entities' => $entities,
            'active_materias_resumen'  =>  true
        );
    }
    /**
     * Creates a new Materia entity.
     *
     * @Route("/", name="materia_create")
     * @Route("/{id}/", name="materia_create_area")
     * @Method("POST")
     * @Template("SirepaePracticasBundle:Materia:new.html.twig")
     */
    public function createAction(Request $request, $id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Materia();
        if(!is_null($id)){
            $area = $em->getRepository('SirepaePracticasBundle:Area')->find($id);
            if($area)
                $entity->setArea($area);
        }
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('materia'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_materias_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Materia entity.
    *
    * @param Materia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Materia $entity)
    {
        $form = $this->createForm(new MateriaType(), $entity, array(
            'action' => $this->generateUrl('materia_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Materia entity.
     *
     * @Route("/new/", name="materia_new")
     * @Route("/new/{id}/", name="materia_new_area")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Materia();
        if(!is_null($id)){
            $area = $em->getRepository('SirepaePracticasBundle:Area')->find($id);
            if($area)
                $entity->setArea($area);
        }
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_materias_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Materia entity.
     *
     * @Route("/{id}/", name="materia_show")
     * @Route("/{id}/", name="materia_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePracticasBundle:Materia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Materia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_materias_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Materia entity.
     *
     * @Route("/{id}/edit/", name="materia_edit")
     * @Route("/{id_area}/edit/{id}", name="materia_edit_area")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePracticasBundle:Materia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Materia entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_materias_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Materia entity.
    *
    * @param Materia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Materia $entity)
    {
        $form = $this->createForm(new MateriaType(), $entity, array(
            'action' => $this->generateUrl('materia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Materia entity.
     *
     * @Route("/{id}/", name="materia_update")
     * @Route("/{id_area}/{id}/", name="materia_update_area")
     * @Method("PUT")
     * @Template("SirepaePracticasBundle:Materia:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePracticasBundle:Materia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Materia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('materia_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_materias_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a Materia entity.
     *
     * @Route("/{id}/", name="materia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePracticasBundle:Materia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Materia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('materia'));
    }

    /**
     * Creates a form to delete a Materia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('materia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
    
}
