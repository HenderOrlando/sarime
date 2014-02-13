<?php

namespace Sirepae\UsuariosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\UsuariosBundle\Entity\Rol;
use Sirepae\UsuariosBundle\Form\RolType;

/**
 * Rol controller.
 *
 * @Route("/rol")
 */
class RolController extends Controller
{

    /**
     * Lists all Rol entities.
     *
     * @Route("/", name="rol")
     * @Route("/sede/{id}/", name="roles_sede")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();

        if(is_null($id))
            $entities = $em->getRepository('SirepaeUsuariosBundle:Rol')->findAll();
        else
            $entities = $em->getRepository('SirepaeUsuariosBundle:Rol')->findBySede($id);

        return array(
            'entities' => $entities,
            'active_roles_resumen'  =>  true
        );
    }
    /**
     * Creates a new Rol entity.
     *
     * @Route("/", name="rol_create")
     * @Route("/{id}/", name="rol_create_sede")
     * @Method("POST")
     * @Template("SirepaeUsuariosBundle:Rol:new.html.twig")
     */
    public function createAction(Request $request, $id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Rol();
        if(!is_null($id)){
            $sede = $em->getRepository('SirepaeUsuariosBundle:Sede')->find($id);
            if($sede)
                $entity->setSede($sede);
        }
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rol'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_roles_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Rol entity.
    *
    * @param Rol $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Rol $entity)
    {
        $form = $this->createForm(new RolType(), $entity, array(
            'action' => $this->generateUrl('rol_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Rol entity.
     *
     * @Route("/new/", name="rol_new")
     * @Route("/new/{id}/", name="rol_new_sede")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Rol();
        if(!is_null($id)){
            $sede = $em->getRepository('SirepaeUsuariosBundle:Sede')->find($id);
            if($sede)
                $entity->setSede($sede);
        }
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_roles_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Rol entity.
     *
     * @Route("/{id}/", name="rol_show")
     * @Route("/{id}/", name="rol_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeUsuariosBundle:Rol')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rol entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_roles_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Rol entity.
     *
     * @Route("/{id}/edit/", name="rol_edit")
     * @Route("/{id_sede}/edit/{id}", name="rol_edit_sede")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeUsuariosBundle:Rol')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rol entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_roles_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Rol entity.
    *
    * @param Rol $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Rol $entity)
    {
        $form = $this->createForm(new RolType(), $entity, array(
            'action' => $this->generateUrl('rol_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Rol entity.
     *
     * @Route("/{id}/", name="rol_update")
     * @Route("/{id_sede}/{id}/", name="rol_update_sede")
     * @Method("PUT")
     * @Template("SirepaeUsuariosBundle:Rol:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeUsuariosBundle:Rol')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rol entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('rol_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_roles_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a Rol entity.
     *
     * @Route("/{id}/", name="rol_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeUsuariosBundle:Rol')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Rol entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('rol'));
    }

    /**
     * Creates a form to delete a Rol entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rol_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
    
}
