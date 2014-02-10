<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\RegistrosEnfermeriaBundle\Entity\Tipo;
use Sirepae\RegistrosEnfermeriaBundle\Form\TipoType;

/**
 * Tipo controller.
 *
 * @Route("/tipo")
 */
class TipoController extends Controller
{

    /**
     * Lists all Tipo entities.
     *
     * @Route("/", name="tipo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Tipo')->findAll();

        return array(
            'entities' => $entities,
            'active_tipos_resumen'  =>  true
        );
    }
    /**
     * Creates a new Tipo entity.
     *
     * @Route("/", name="tipo_create")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Tipo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Tipo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipo'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_tipos_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Tipo entity.
    *
    * @param Tipo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Tipo $entity)
    {
        $form = $this->createForm(new TipoType(), $entity, array(
            'action' => $this->generateUrl('tipo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Tipo entity.
     *
     * @Route("/new", name="tipo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Tipo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_tipos_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Tipo entity.
     *
     * @Route("/{id}", name="tipo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Tipo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_tipos_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Tipo entity.
     *
     * @Route("/{id}/edit", name="tipo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Tipo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_tipos_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Tipo entity.
    *
    * @param Tipo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tipo $entity)
    {
        $form = $this->createForm(new TipoType(), $entity, array(
            'action' => $this->generateUrl('tipo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Tipo entity.
     *
     * @Route("/{id}", name="tipo_update")
     * @Method("PUT")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Tipo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Tipo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_tipos_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a Tipo entity.
     *
     * @Route("/{id}", name="tipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Tipo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tipo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipo'));
    }

    /**
     * Creates a form to delete a Tipo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
