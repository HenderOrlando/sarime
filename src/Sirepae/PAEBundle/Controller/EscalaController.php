<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\Escala;
use Sirepae\PAEBundle\Form\EscalaType;

/**
 * Escala controller.
 *
 * @Route("/escala")
 */
class EscalaController extends Controller
{

    /**
     * Lists all Escala entities.
     *
     * @Route("/", name="escala")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:Escala')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Escala entity.
     *
     * @Route("/", name="escala_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:Escala:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Escala();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('escala_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Escala entity.
    *
    * @param Escala $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Escala $entity)
    {
        $form = $this->createForm(new EscalaType(), $entity, array(
            'action' => $this->generateUrl('escala_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Escala entity.
     *
     * @Route("/new", name="escala_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Escala();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Escala entity.
     *
     * @Route("/{id}", name="escala_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Escala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Escala entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Escala entity.
     *
     * @Route("/{id}/edit", name="escala_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Escala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Escala entity.');
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
    * Creates a form to edit a Escala entity.
    *
    * @param Escala $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Escala $entity)
    {
        $form = $this->createForm(new EscalaType(), $entity, array(
            'action' => $this->generateUrl('escala_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Escala entity.
     *
     * @Route("/{id}", name="escala_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:Escala:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Escala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Escala entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('escala_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Escala entity.
     *
     * @Route("/{id}", name="escala_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:Escala')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Escala entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('escala'));
    }

    /**
     * Creates a form to delete a Escala entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('escala_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
