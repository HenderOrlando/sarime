<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\PAE;
use Sirepae\PAEBundle\Form\PAEType;

/**
 * PAE controller.
 *
 * @Route("/pae")
 */
class PAEController extends Controller
{

    /**
     * Lists all PAE entities.
     *
     * @Route("/", name="pae")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        if($this->getUser()->hasRole('ROLE_ESTUDIANTE')){
            $entities = $em->getRepository('SirepaePAEBundle:PAE')->findAllEstudiante($this->getUser()->getEstudiantes()->getId());
        }elseif($this->getUser()->hasRole('ROLE_DOCENTE')){
            $entities = $em->getRepository('SirepaePAEBundle:PAE')->findAllDocente($this->getUser()->getId());
        }elseif($this->getUser()->hasRole('ROLE_COORDINADOR')){
            $entities = $em->getRepository('SirepaePAEBundle:PAE')->findAllCoordinador($this->getUser()->getId());
        }elseif($this->getUser()->hasRole('ROLE_SUPER_ADMIN')){
            $entities = $em->getRepository('SirepaePAEBundle:PAE')->findAll();
        }else{
            $entities = array();
        }
        

        return array(
            'entities' => $entities,
            'active_paes_resumen'  =>  true
        );
    }
    /**
     * Creates a new PAE entity.
     *
     * @Route("/", name="pae_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:PAE:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PAE();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pae'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_paes_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a PAE entity.
    *
    * @param PAE $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(PAE $entity)
    {
        $form = $this->createForm(new PAEType(null, $this->getUser()), $entity, array(
            'action' => $this->generateUrl('pae_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new PAE entity.
     *
     * @Route("/new", name="pae_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PAE();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_paes_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a PAE entity.
     *
     * @Route("/{id}", name="pae_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:PAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PAE entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_paes_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing PAE entity.
     *
     * @Route("/{id}/edit", name="pae_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:PAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PAE entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $nanda = $em->getRepository('SirepaePAEBundle:NANDA')->findOneByUsado(true);
        $nic = $em->getRepository('SirepaePAEBundle:NIC')->findOneByUsado(true);
        $noc = $em->getRepository('SirepaePAEBundle:NOC')->findOneByUsado(true);
        
        return array(
            'nanda'         => $nanda,
            'nic'           => $nic,
            'noc'           => $noc,
            'entity'        => $entity,
            'edit_form'     => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
            'active_edit'   =>  true,
            'active_paes_resumen'  =>  true,
        );
    }

    /**
    * Creates a form to edit a PAE entity.
    *
    * @param PAE $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PAE $entity)
    {
        $form = $this->createForm(new PAEType($entity, $this->getUser()), $entity, array(
            'action' => $this->generateUrl('pae_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing PAE entity.
     *
     * @Route("/{id}", name="pae_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:PAE:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:PAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PAE entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pae_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_paes_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a PAE entity.
     *
     * @Route("/{id}", name="pae_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:PAE')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PAE entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pae'));
    }

    /**
     * Creates a form to delete a PAE entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pae_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
