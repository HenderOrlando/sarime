<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\Dominio;
use Sirepae\PAEBundle\Form\DominioType;

/**
 * Dominio controller.
 *
 * @Route("/dominio")
 */
class DominioController extends Controller
{

    /**
     * Lists all Dominio entities.
     *
     * @Route("/", name="dominio")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:Dominio')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Dominio entity.
     *
     * @Route("/", name="dominio_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:Dominio:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Dominio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('dominio_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Dominio entity.
    *
    * @param Dominio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Dominio $entity)
    {
        $form = $this->createForm(new DominioType(), $entity, array(
            'action' => $this->generateUrl('dominio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Dominio entity.
     *
     * @Route("/new", name="dominio_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Dominio();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Dominio entity.
     *
     * @Route("/{id}", name="dominio_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Dominio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dominio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Dominio entity.
     *
     * @Route("/{id}/edit", name="dominio_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Dominio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dominio entity.');
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
    * Creates a form to edit a Dominio entity.
    *
    * @param Dominio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Dominio $entity)
    {
        $form = $this->createForm(new DominioType(), $entity, array(
            'action' => $this->generateUrl('dominio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Dominio entity.
     *
     * @Route("/{id}", name="dominio_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:Dominio:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Dominio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dominio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('dominio_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Dominio entity.
     *
     * @Route("/{id}", name="dominio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:Dominio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Dominio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('dominio'));
    }

    /**
     * Creates a form to delete a Dominio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dominio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
