<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\RegistrosEnfermeriaBundle\Entity\Paciente;
use Sirepae\RegistrosEnfermeriaBundle\Form\PacienteType;

/**
 * Paciente controller.
 *
 * @Route("/paciente")
 */
class PacienteController extends Controller
{

    /**
     * Lists all Paciente entities.
     *
     * @Route("/", name="paciente")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Paciente')->findAll();

        return array(
            'entities' => $entities,
            'active_pacientes_resumen'  =>  true
        );
    }
    /**
     * Creates a new Paciente entity.
     *
     * @Route("/", name="paciente_create")
     * @Route("/registro-enfermeria/", name="paciente_create_registro_enfermeria")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Paciente:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $routeName = $request->get('_route');
        $entity = new Paciente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            if(strpos($routeName, 'registro_enfermeria') !== false){
                return $this->redirect($this->generateUrl('registros_enfermeria_new_paciente',array('id_paciente' => $entity->getId())));
            }
            return $this->redirect($this->generateUrl('paciente'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_pacientes_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Paciente entity.
    *
    * @param Paciente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Paciente $entity, $registro = false)
    {
        $url = $this->generateUrl('paciente_create');
        if($registro)
            $url = $this->generateUrl('paciente_create_registro_enfermeria');
        $form = $this->createForm(new PacienteType(), $entity, array(
            'action' => $url,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Paciente entity.
     *
     * @Route("/new/", name="paciente_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Paciente();
        $form   = $this->createCreateForm($entity, $this->getRequest()->get('registro'));

        $datos = array(
            'entity'    => $entity,
            'ajax'      => $this->getRequest()->get('ajax'),
            'form'      => $form->createView(),
            'active_pacientes_resumen'  =>  true,
            'active_new'  =>  true,
        );
        if($this->getRequest()->get('ajax')){
            return $this->render('SirepaeRegistrosEnfermeriaBundle:Paciente:new_ajax.html.twig', $datos);
        }
        return $datos;
    }

    /**
     * Finds and displays a Paciente entity.
     *
     * @Route("/{id}", name="paciente_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Paciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_pacientes_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Paciente entity.
     *
     * @Route("/{id}/edit", name="paciente_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Paciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_pacientes_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Paciente entity.
    *
    * @param Paciente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Paciente $entity)
    {
        $form = $this->createForm(new PacienteType(), $entity, array(
            'action' => $this->generateUrl('paciente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Paciente entity.
     *
     * @Route("/{id}", name="paciente_update")
     * @Method("PUT")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Paciente:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Paciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('paciente_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_pacientes_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a Paciente entity.
     *
     * @Route("/{id}", name="paciente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Paciente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Paciente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paciente'));
    }

    /**
     * Creates a form to delete a Paciente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paciente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
