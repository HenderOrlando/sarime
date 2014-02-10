<?php

namespace Sirepae\UsuariosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\UsuariosBundle\Entity\Usuario;
use Sirepae\UsuariosBundle\Form\UsuarioType;

/**
 * Usuario controller.
 *
 * @Route("/")
 */
class UsuarioController extends Controller
{

    /**
     * Lists all Usuario entities.
     *
     * @Route("/", name="home")
     * @Method("GET")
     * @Template()
     */
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();

        return array(
            'active_home_resumen' => true,
        );
    }
    
    /**
     * Lists all Usuario entities.
     *
     * @Route("/usuario/", name="usuario")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaeUsuariosBundle:Usuario')->findAll();

        return array(
            'entities' => $entities,
            'active_usuarios_resumen' => true,
        );
    }
    
    /**
     * Lists all Docente entities.
     *
     * @Route("/docente/", name="docente")
     * @Method("GET")
     * @Template("SirepaeUsuariosBundle:Usuario:index.html.twig")
     */
    public function indexDocenteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaeUsuariosBundle:Usuario')->findAllDocentes();

        return array(
            'entities' => $entities,
            'active_docentes_resumen' => true,
        );
    }
    
    /**
     * Lists all Coordinador entities.
     *
     * @Route("/coordinador/", name="coordinador")
     * @Method("GET")
     * @Template("SirepaeUsuariosBundle:Usuario:index.html.twig")
     */
    public function indexCoordinadorAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaeUsuariosBundle:Usuario')->findAllCoordinadores();

        return array(
            'entities' => $entities,
            'active_coordinadores_resumen' => true,
        );
    }
    
    /**
     * Creates a new Usuario entity.
     *
     * @Route("/usuario/", name="usuario_create")
     * @Route("/coordinador/", name="coordinador_create")
     * @Route("/docente/", name="docente_create")
     * @Method("POST")
     * @Template("SirepaeUsuariosBundle:Usuario:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $routeName = $request->get('_route');
        $active = 'usuarios';
        $rolName = null;
        if(strpos($routeName, 'coordinador') !== false){
            $active = 'coordinadores';
            $rolName = 'Coordinador';
        }
        elseif(strpos($routeName, 'docente') !== false){
            $active = 'docentes';
            $rolName = 'Docente';
        }
        $entity = new Usuario();
        $rol = null;
        $em = $this->getDoctrine()->getManager();
        if(!is_null($rolName)){
            $rol = $em->getRepository('SirepaeUsuariosBundle:Rol')->findOneByNombre($rolName);
            $entity->setRolUsuario($rol);
        }
        $form   = $this->createCreateForm($entity, $rol);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $factory = $this->get('security.encoder_factory');

            $encoder = $factory->getEncoder($entity);
            if(empty($entity->getPassword()) || is_null($entity->getPassword())){
                $entity->setPassword($entity->getUsername());
            }
            if(empty($entity->getEmail()) || is_null($entity->getEmail())){
                $entity->setEmail($this->canonicalize($entity->getUsername().'@email.com'));
                $entity->setEmailCanonical($this->canonicalize($entity->getUsername().'@email.com'));
            }
            $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
            $entity->setRolUsuario($rol);
            $entity->setPassword($password);
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usuario', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_usuarios_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Usuario entity.
    *
    * @param Usuario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Usuario $entity, \Sirepae\UsuariosBundle\Entity\Rol $rol = null)
    {
        $form = $this->createForm(new UsuarioType($rol), $entity, array(
            'action' => $this->generateUrl(strtolower($rol->getNombre()).'_create'),
            'method' => 'POST',
            'attr'   => array(
                'class' =>  'form-all-inline'
            ),
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Usuario entity.
     *
     * @Route("/usuario/new/", name="usuario_new")
     * @Route("/coordinador/new/", name="coordinador_new")
     * @Route("/docente/new/", name="docente_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $routeName = $request->get('_route');
        $em = $this->getDoctrine()->getManager();
        $rolName = null;
        $active = 'usuarios';
        if(strpos($routeName, 'coordinador') !== false){
            $active = 'coordinadores';
            $rolName = 'Coordinador';
        }
        elseif(strpos($routeName, 'docente') !== false){
            $active = 'docentes';
            $rolName = 'Docente';
        }
        $entity = new Usuario();
        $rol = null;
        if(!is_null($rolName)){
            $rol = $em->getRepository('SirepaeUsuariosBundle:Rol')->findOneByNombre($rolName);
            $entity->setRolUsuario($rol);
        }
        $form   = $this->createCreateForm($entity, $rol);

        return array(
            'entity' => $entity,
            'rol' => $rol,
            'form'   => $form->createView(),
            'active_'.$active.'_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/usuario/{id}/", name="usuario_show")
     * @Route("/coordinador/{id}/", name="coordinador_show")
     * @Route("/docente/{id}/", name="docente_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeUsuariosBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_usuarios_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     * @Route("/usuario/{id}/edit/", name="usuario_edit")
     * @Route("/coordinador/{id}/edit/", name="coordinador_edit")
     * @Route("/docente/{id}/edit/", name="docente_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeUsuariosBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        $active = 'usuarios';
        if(method_exists($entity->getRolUsuario(), 'getNombre'))
            $active = strtolower ($entity->getRolUsuario()->getNombre());

        return array(
            'entity'      => $entity,
            'active_'.$active.'_resumen' => true,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_usuarios_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Usuario entity.
    *
    * @param Usuario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Usuario $entity)
    {
        $form = $this->createForm(new UsuarioType(), $entity, array(
            'action' => $this->generateUrl('usuario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr'   => array(
                'class' =>  'form-all-inline'
            ),
        ));

        $form->add('Crear', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'save btn-success')));

        return $form;
    }
    /**
     * Edits an existing Usuario entity.
     *
     * @Route("/usuario/{id}/", name="usuario_update")
     * @Route("/coordinador/{id}/", name="coordinador_update")
     * @Route("/docente/{id}/", name="docente_update")
     * @Method("PUT")
     * @Template("SirepaeUsuariosBundle:Usuario:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeUsuariosBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('usuario_edit', array('id' => $id)));
        }
        
        $active = 'usuarios';
        if(method_exists($entity->getRolUsuario(), 'getNombre'))
            $active = strtolower ($entity->getRolUsuario()->getNombre());

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_'.$active.'_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a Usuario entity.
     *
     * @Route("/usuario/{id}/", name="usuario_delete")
     * @Route("/coordinador/{id}/", name="coordinador_delete")
     * @Route("/docente/{id}/", name="docente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeUsuariosBundle:Usuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('usuario'));
    }

    /**
     * Creates a form to delete a Usuario entity by id.
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
            ->setAction($this->generateUrl('usuario_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('Borrar', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger btn-lg')))
            ->getForm()
        ;
    }
    public function canonicalize($string)
    {
        return null === $string ? null : mb_convert_case($string, MB_CASE_LOWER, mb_detect_encoding($string));
    }
}
