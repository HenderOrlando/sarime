<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\NOC;
use Sirepae\PAEBundle\Form\NOCType;

/**
 * NOC controller.
 *
 * @Route("/noc")
 */
class NOCController extends Controller
{

    /**
     * Lists all NOC entities.
     *
     * @Route("/", name="noc")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:NOC')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new NOC entity.
     *
     * @Route("/", name="noc_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:NOC:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new NOC();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('noc_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a NOC entity.
    *
    * @param NOC $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(NOC $entity)
    {
        $form = $this->createForm(new NOCType(), $entity, array(
            'action' => $this->generateUrl('noc_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new NOC entity.
     *
     * @Route("/new", name="noc_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new NOC();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a NOC entity.
     *
     * @Route("/{id}", name="noc_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:NOC')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NOC entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing NOC entity.
     *
     * @Route("/{id}/edit", name="noc_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:NOC')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NOC entity.');
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
    * Creates a form to edit a NOC entity.
    *
    * @param NOC $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(NOC $entity)
    {
        $form = $this->createForm(new NOCType(), $entity, array(
            'action' => $this->generateUrl('noc_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing NOC entity.
     *
     * @Route("/{id}", name="noc_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:NOC:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:NOC')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NOC entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('noc_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a NOC entity.
     *
     * @Route("/{id}", name="noc_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:NOC')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NOC entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('noc'));
    }

    /**
     * Creates a form to delete a NOC entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('noc_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
