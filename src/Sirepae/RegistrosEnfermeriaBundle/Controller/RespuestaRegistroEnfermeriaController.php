<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaRegistroEnfermeria;
use Sirepae\RegistrosEnfermeriaBundle\Form\RespuestaRegistroEnfermeriaType;

/**
 * RespuestaRegistroEnfermeria controller.
 *
 * @Route("/respuesta_registro_enfermeria")
 */
class RespuestaRegistroEnfermeriaController extends Controller
{

    /**
     * Lists all RespuestaRegistroEnfermeria entities.
     *
     * @Route("/", name="respuesta_registro_enfermeria")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaRegistroEnfermeria')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new RespuestaRegistroEnfermeria entity.
     *
     * @Route("/", name="respuesta_registro_enfermeria_create")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:RespuestaRegistroEnfermeria:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new RespuestaRegistroEnfermeria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('respuesta_registro_enfermeria_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a RespuestaRegistroEnfermeria entity.
    *
    * @param RespuestaRegistroEnfermeria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(RespuestaRegistroEnfermeria $entity)
    {
        $form = $this->createForm(new RespuestaRegistroEnfermeriaType(), $entity, array(
            'action' => $this->generateUrl('respuesta_registro_enfermeria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new RespuestaRegistroEnfermeria entity.
     *
     * @Route("/new", name="respuesta_registro_enfermeria_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new RespuestaRegistroEnfermeria();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a RespuestaRegistroEnfermeria entity.
     *
     * @Route("/{id}", name="respuesta_registro_enfermeria_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaRegistroEnfermeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RespuestaRegistroEnfermeria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing RespuestaRegistroEnfermeria entity.
     *
     * @Route("/{id}/edit", name="respuesta_registro_enfermeria_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaRegistroEnfermeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RespuestaRegistroEnfermeria entity.');
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
    * Creates a form to edit a RespuestaRegistroEnfermeria entity.
    *
    * @param RespuestaRegistroEnfermeria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(RespuestaRegistroEnfermeria $entity)
    {
        $form = $this->createForm(new RespuestaRegistroEnfermeriaType(), $entity, array(
            'action' => $this->generateUrl('respuesta_registro_enfermeria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing RespuestaRegistroEnfermeria entity.
     *
     * @Route("/{id}", name="respuesta_registro_enfermeria_update")
     * @Method("PUT")
     * @Template("SirepaeRegistrosEnfermeriaBundle:RespuestaRegistroEnfermeria:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaRegistroEnfermeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RespuestaRegistroEnfermeria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('respuesta_registro_enfermeria_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a RespuestaRegistroEnfermeria entity.
     *
     * @Route("/{id}", name="respuesta_registro_enfermeria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaRegistroEnfermeria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RespuestaRegistroEnfermeria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('respuesta_registro_enfermeria'));
    }

    /**
     * Creates a form to delete a RespuestaRegistroEnfermeria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('respuesta_registro_enfermeria_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
