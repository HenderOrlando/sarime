<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaPaciente;
use Sirepae\RegistrosEnfermeriaBundle\Form\RespuestaPacienteType;

/**
 * RespuestaPaciente controller.
 *
 * @Route("/respuesta_paciente")
 */
class RespuestaPacienteController extends Controller
{

    /**
     * Lists all RespuestaPaciente entities.
     *
     * @Route("/", name="respuesta_paciente")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaPaciente')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new RespuestaPaciente entity.
     *
     * @Route("/", name="respuesta_paciente_create")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:RespuestaPaciente:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new RespuestaPaciente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('respuesta_paciente_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a RespuestaPaciente entity.
    *
    * @param RespuestaPaciente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(RespuestaPaciente $entity)
    {
        $form = $this->createForm(new RespuestaPacienteType(), $entity, array(
            'action' => $this->generateUrl('respuesta_paciente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new RespuestaPaciente entity.
     *
     * @Route("/new", name="respuesta_paciente_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new RespuestaPaciente();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a RespuestaPaciente entity.
     *
     * @Route("/{id}", name="respuesta_paciente_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaPaciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RespuestaPaciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing RespuestaPaciente entity.
     *
     * @Route("/{id}/edit", name="respuesta_paciente_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaPaciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RespuestaPaciente entity.');
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
    * Creates a form to edit a RespuestaPaciente entity.
    *
    * @param RespuestaPaciente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(RespuestaPaciente $entity)
    {
        $form = $this->createForm(new RespuestaPacienteType(), $entity, array(
            'action' => $this->generateUrl('respuesta_paciente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing RespuestaPaciente entity.
     *
     * @Route("/{id}", name="respuesta_paciente_update")
     * @Method("PUT")
     * @Template("SirepaeRegistrosEnfermeriaBundle:RespuestaPaciente:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaPaciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RespuestaPaciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('respuesta_paciente_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a RespuestaPaciente entity.
     *
     * @Route("/{id}", name="respuesta_paciente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaPaciente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RespuestaPaciente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('respuesta_paciente'));
    }

    /**
     * Creates a form to delete a RespuestaPaciente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('respuesta_paciente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
