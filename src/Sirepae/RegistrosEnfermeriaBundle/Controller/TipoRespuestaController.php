<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\RegistrosEnfermeriaBundle\Entity\TipoRespuesta;
use Sirepae\RegistrosEnfermeriaBundle\Form\TipoRespuestaType;

/**
 * TipoRespuesta controller.
 *
 * @Route("/tipo_respuesta")
 */
class TipoRespuestaController extends Controller
{

    /**
     * Lists all TipoRespuesta entities.
     *
     * @Route("/", name="tipo_respuesta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:TipoRespuesta')->findAll();

        return array(
            'entities' => $entities,
            'active_tiposRespuesta_resumen'  =>  true
        );
    }
    /**
     * Creates a new TipoRespuesta entity.
     *
     * @Route("/", name="tipo_respuesta_create")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:TipoRespuesta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TipoRespuesta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipo_respuesta'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_tiposRespuesta_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a TipoRespuesta entity.
    *
    * @param TipoRespuesta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(TipoRespuesta $entity)
    {
        $form = $this->createForm(new TipoRespuestaType(), $entity, array(
            'action' => $this->generateUrl('tipo_respuesta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new TipoRespuesta entity.
     *
     * @Route("/new/", name="tipo_respuesta_new")
     * @Route("/new/pregunta/{id}", name="addTipoRespuesta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = null)
    {
        $entity = new TipoRespuesta();
        $preg = null;
        if(!is_null($id)){
            $em = $this->getDoctrine()->getManager();
            $preg = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Pregunta')->find($id);
            if($preg){
                $entity->setPregunta($preg);
            }
        }
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'pregunta' => $preg,
            'form'   => $form->createView(),
            'active_tiposRespuesta_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a TipoRespuesta entity.
     *
     * @Route("/{id}", name="tipo_respuesta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:TipoRespuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoRespuesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_tiposRespuesta_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing TipoRespuesta entity.
     *
     * @Route("/{id}/edit", name="tipo_respuesta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:TipoRespuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoRespuesta entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_tiposRespuesta_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a TipoRespuesta entity.
    *
    * @param TipoRespuesta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoRespuesta $entity)
    {
        $form = $this->createForm(new TipoRespuestaType(), $entity, array(
            'action' => $this->generateUrl('tipo_respuesta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing TipoRespuesta entity.
     *
     * @Route("/{id}", name="tipo_respuesta_update")
     * @Method("PUT")
     * @Template("SirepaeRegistrosEnfermeriaBundle:TipoRespuesta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:TipoRespuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoRespuesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipo_respuesta_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_tiposRespuesta_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a TipoRespuesta entity.
     *
     * @Route("/{id}", name="tipo_respuesta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:TipoRespuesta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoRespuesta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipo_respuesta'));
    }

    /**
     * Creates a form to delete a TipoRespuesta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipo_respuesta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
