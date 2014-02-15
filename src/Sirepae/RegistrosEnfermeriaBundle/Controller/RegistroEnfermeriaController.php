<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria;
use Sirepae\RegistrosEnfermeriaBundle\Form\RegistroEnfermeriaType;

/**
 * RegistroEnfermeria controller.
 *
 * @Route("/registros_enfermeria")
 */
class RegistroEnfermeriaController extends Controller
{

    /**
     * Lists all RegistroEnfermeria entities.
     *
     * @Route("/", name="registros_enfermeria")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        if($this->getUser()->hasRole('ROLE_ESTUDIANTE')){
            $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->findAllEstudiante($this->getUser()->getEstudiantes()->getId());
        }elseif($this->getUser()->hasRole('ROLE_DOCENTE')){
            $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->findAllDocente($this->getUser()->getId());
        }elseif($this->getUser()->hasRole('ROLE_COORDINADOR')){
            $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->findAllCoordinador($this->getUser()->getId());
        }elseif($this->getUser()->hasRole('ROLE_SUPER_ADMIN')){
            $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->findAll();
        }else{
            $entities = array();
        }

        return array(
            'entities' => $entities,
            'active_registrosEnfermeria_resumen'  =>  true
        );
    }
    /**
     * Creates a new RegistroEnfermeria entity.
     *
     * @Route("/", name="registros_enfermeria_create")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new RegistroEnfermeria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('registros_enfermeria'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_registrosEnfermeria_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a RegistroEnfermeria entity.
    *
    * @param RegistroEnfermeria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(RegistroEnfermeria $entity)
    {
        $form = $this->createForm(new RegistroEnfermeriaType($this->getUser()->getEstudiantes()), $entity, array(
            'action' => $this->generateUrl('registros_enfermeria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new RegistroEnfermeria entity.
     *
     * @Route("/new/paciente/{id_paciente}/", name="registros_enfermeria_new_paciente")
     * @Route("/new", name="registros_enfermeria_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id_paciente = null)
    {
        $entity = new RegistroEnfermeria();
        $paciente = null;
        if(!is_null($id_paciente)){
            $paciente = $this->getDoctrine()->getManager()->getRepository('SirepaeRegistrosEnfermeriaBundle:Paciente')->find($id_paciente);
            $entity->setPaciente($paciente);
        }

        $form   = $this->createCreateForm($entity);
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_registrosEnfermeria_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a RegistroEnfermeria entity.
     *
     * @Route("/{id}", name="registros_enfermeria_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RegistroEnfermeria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_registrosEnfermeria_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing RegistroEnfermeria entity.
     *
     * @Route("/{id}/edit", name="registros_enfermeria_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RegistroEnfermeria entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        
        $registros = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->findAll();
        $optRtas = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:OpcionRespuesta')->findArrayAll();

        return array(
            'entity'        => $entity,
            'optRtas'        => $optRtas,
            'registros'     => $registros,
            'respuestas'    => $entity->getRespuestas(),
            'edit_form'     => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
            'active_registrosEnfermeria_resumen'  =>  true,
            'active_edit'   =>  true,
        );
    }

    /**
    * Creates a form to edit a RegistroEnfermeria entity.
    *
    * @param RegistroEnfermeria $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(RegistroEnfermeria $entity)
    {
        $form = $this->createForm(new RegistroEnfermeriaType($this->getUser()->getEstudiantes()), $entity, array(
            'action' => $this->generateUrl('registros_enfermeria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing RegistroEnfermeria entity.
     *
     * @Route("/{id}", name="registros_enfermeria_update")
     * @Method("PUT")
     * @Template("SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RegistroEnfermeria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('registros_enfermeria_edit', array('id' => $id)));
        }
        $registros = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->findAll();

        return array(
            'entity'      => $entity,
            'registros'      => $registros,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_registrosEnfermeria_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a RegistroEnfermeria entity.
     *
     * @Route("/{id}", name="registros_enfermeria_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RegistroEnfermeria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('registros_enfermeria'));
    }

    /**
     * Creates a form to delete a RegistroEnfermeria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('registros_enfermeria_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
