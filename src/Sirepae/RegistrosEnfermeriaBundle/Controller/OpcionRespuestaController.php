<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\RegistrosEnfermeriaBundle\Entity\OpcionRespuesta;
use Sirepae\RegistrosEnfermeriaBundle\Form\OpcionRespuestaType;

/**
 * OpcionRespuesta controller.
 *
 * @Route("/opcion_respuesta")
 */
class OpcionRespuestaController extends Controller
{

    /**
     * Lists all OpcionRespuesta entities.
     *
     * @Route("/", name="opcion_respuesta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:OpcionRespuesta')->findAll();

        return array(
            'entities' => $entities,
            'active_opcionesRespuesta_resumen'  =>  true
        );
    }
    /**
     * Creates a new OpcionRespuesta entity.
     *
     * @Route("/", name="opcion_respuesta_create")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:OpcionRespuesta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new OpcionRespuesta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('opcion_respuesta'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_opcionesRespuesta_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a OpcionRespuesta entity.
    *
    * @param OpcionRespuesta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(OpcionRespuesta $entity)
    {
        $form = $this->createForm(new OpcionRespuestaType(), $entity, array(
            'action' => $this->generateUrl('opcion_respuesta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new OpcionRespuesta entity.
     *
     * @Route("/new/", name="opcion_respuesta_new")
     * @Route("/new/pregunta/{id}", name="addOpcionRespuesta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = null)
    {
        $entity = new OpcionRespuesta();
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
            'active_opcionesRespuesta_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a OpcionRespuesta entity.
     *
     * @Route("/{id}", name="opcion_respuesta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:OpcionRespuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OpcionRespuesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_opcionesRespuesta_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing OpcionRespuesta entity.
     *
     * @Route("/{id}/edit", name="opcion_respuesta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:OpcionRespuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OpcionRespuesta entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_opcionesRespuesta_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a OpcionRespuesta entity.
    *
    * @param OpcionRespuesta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(OpcionRespuesta $entity)
    {
        $form = $this->createForm(new OpcionRespuestaType(), $entity, array(
            'action' => $this->generateUrl('opcion_respuesta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing OpcionRespuesta entity.
     *
     * @Route("/{id}", name="opcion_respuesta_update")
     * @Method("PUT")
     * @Template("SirepaeRegistrosEnfermeriaBundle:OpcionRespuesta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:OpcionRespuesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OpcionRespuesta entity.');
        }

        $tipoRta_ = $entity->getTipoRespuesta()->getTipoCampo();
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $tipoRta = $entity->getTipoRespuesta()->getTipoCampo();
            if(
                count($entity->getRespuesta()) === 0 ||
                strstr($tipoRta_, 'text') !== false && strstr($tipoRta, 'text') !== false ||
                (
                    (
                        strstr($tipoRta_, 'date') !== false || strstr($tipoRta_, 'time') !== false
                    ) && 
                    (
                        strstr($tipoRta, 'date') !== false || strstr($tipoRta, 'time') !== false
                    )   
                )
            ){
                $em->flush();
            }else{
                //Tipos de dato no compatibles
            }

            return $this->redirect($this->generateUrl('opcion_respuesta_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_opcionesRespuesta_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a OpcionRespuesta entity.
     *
     * @Route("/{id}", name="opcion_respuesta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:OpcionRespuesta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OpcionRespuesta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('opcion_respuesta'));
    }

    /**
     * Creates a form to delete a OpcionRespuesta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('opcion_respuesta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
