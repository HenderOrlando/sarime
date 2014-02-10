<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\RegistrosEnfermeriaBundle\Entity\Pregunta;
use Sirepae\RegistrosEnfermeriaBundle\Form\PreguntaType;

/**
 * Pregunta controller.
 *
 * @Route("/pregunta")
 */
class PreguntaController extends Controller
{

    /**
     * Lists all Pregunta entities.
     *
     * @Route("/", name="pregunta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Pregunta')->findAll();

        return array(
            'entities' => $entities,
            'active_preguntas_resumen'  =>  true
        );
    }
    /**
     * Creates a new Pregunta entity.
     *
     * @Route("/", name="pregunta_create")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Pregunta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pregunta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            if(is_null($entity->getOrden()))
                $entity->setOrden ($entity->getRegistro()->getPreguntas()->count()+1);
            $em->flush();

            return $this->redirect($this->generateUrl('pregunta'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_preguntas_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Pregunta entity.
    *
    * @param Pregunta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Pregunta $entity)
    {
        $form = $this->createForm(new PreguntaType(), $entity, array(
            'action' => $this->generateUrl('pregunta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Pregunta entity.
     *
     * @Route("/new/", name="pregunta_new")
     * @Route("/new/registro/{id}", name="addPregunta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = null)
    {
        $entity = new Pregunta();
        if(!is_null($id)){
            $em = $this->getDoctrine()->getManager();
            $reg = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->find($id);
            if($reg){
                $entity->setRegistro($reg);
            }
        }
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_preguntas_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Pregunta entity.
     *
     * @Route("/{id}", name="pregunta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Pregunta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pregunta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_preguntas_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Pregunta entity.
     *
     * @Route("/{id}/edit", name="pregunta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Pregunta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pregunta entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_preguntas_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Pregunta entity.
    *
    * @param Pregunta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pregunta $entity)
    {
        $form = $this->createForm(new PreguntaType(), $entity, array(
            'action' => $this->generateUrl('pregunta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Pregunta entity.
     *
     * @Route("/{id}", name="pregunta_update")
     * @Method("PUT")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Pregunta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Pregunta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pregunta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pregunta_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_preguntas_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a Pregunta entity.
     *
     * @Route("/{id}", name="pregunta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Pregunta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pregunta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pregunta'));
    }

    /**
     * Creates a form to delete a Pregunta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pregunta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
