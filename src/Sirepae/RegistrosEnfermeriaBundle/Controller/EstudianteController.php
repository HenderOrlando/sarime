<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\RegistrosEnfermeriaBundle\Entity\Estudiante;
use Sirepae\RegistrosEnfermeriaBundle\Form\EstudianteType;

/**
 * Estudiante controller.
 *
 * @Route("/estudiante")
 */
class EstudianteController extends Controller
{

    /**
     * Lists all Estudiante entities.
     *
     * @Route("/", name="estudiante")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Estudiante')->findAll();

        return array(
            'entities' => $entities,
            'active_estudiantes_resumen'  =>  true,
        );
    }
    /**
     * Creates a new Estudiante entity.
     *
     * @Route("/", name="estudiante_create")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Estudiante:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Estudiante();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $rol = $em->getRepository('SirepaeUsuariosBundle:Rol')->findOneByNombre('Estudiante');
            if($rol){
                $entity->getUsuario()->setRolUsuario($rol);
            }
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($entity->getUsuario());
            if(empty($entity->getUsuario()->getPassword()) || is_null($entity->getUsuario()->getPassword())){
                $entity->getUsuario()->setPassword($entity->getUsuario()->getUsername());
            }
            if(empty($entity->getUsuario()->getEmail()) || is_null($entity->getUsuario()->getEmail())){
                $entity->getUsuario()->setEmail($this->canonicalize($entity->getUsuario()->getUsername().'@email.com'));
                $entity->getUsuario()->setEmailCanonical($this->canonicalize($entity->getUsuario()->getUsername().'@email.com'));
            }
            $password = $encoder->encodePassword($entity->getUsuario()->getPassword(), $entity->getUsuario()->getSalt());
            $entity->getUsuario()->setRolUsuario($rol);
            $entity->getUsuario()->setPassword($password);
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('estudiante', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_estudiantes_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Estudiante entity.
    *
    * @param Estudiante $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Estudiante $entity, \Sirepae\UsuariosBundle\Entity\Rol $rol = null)
    {
        $form = $this->createForm(new EstudianteType($rol), $entity, array(
            'action' => $this->generateUrl('estudiante_create'),
            'method' => 'POST',
            'attr'   => array(
                'class' =>  'form-all-inline'
            ),
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'save btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Estudiante entity.
     *
     * @Route("/new", name="estudiante_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Estudiante();
        $rol = $em->getRepository('SirepaeUsuariosBundle:Rol')->findOneByNombre('Estudiante');
        $entity->getUsuario()->setRolUsuario($rol);
        $form   = $this->createCreateForm($entity, $rol);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_estudiantes_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Estudiante entity.
     *
     * @Route("/{id}", name="estudiante_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Estudiante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estudiante entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_estudiantes_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Estudiante entity.
     *
     * @Route("/{id}/edit", name="estudiante_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Estudiante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estudiante entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_estudiantes_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Estudiante entity.
    *
    * @param Estudiante $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Estudiante $entity)
    {
        $form = $this->createForm(new EstudianteType(), $entity, array(
            'action' => $this->generateUrl('estudiante_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr'   => array(
                'class' =>  'form-all-inline'
            ),
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Estudiante entity.
     *
     * @Route("/{id}", name="estudiante_update")
     * @Method("PUT")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Estudiante:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Estudiante')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estudiante entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('estudiante_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_estudiantes_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a Estudiante entity.
     *
     * @Route("/{id}", name="estudiante_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Estudiante')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Estudiante entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('estudiante'));
    }

    /**
     * Creates a form to delete a Estudiante entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(null,array('attr'   => array(
                'class' =>  'form-all-inline'
            )))
            ->setAction($this->generateUrl('estudiante_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array('class' => 'save btn-danger')))
            ->getForm()
        ;
    }
}
