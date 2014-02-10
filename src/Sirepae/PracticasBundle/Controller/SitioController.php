<?php

namespace Sirepae\PracticasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PracticasBundle\Entity\Sitio;
use Sirepae\PracticasBundle\Form\SitioType;

/**
 * Sitio controller.
 *
 * @Route("/sitio")
 */
class SitioController extends Controller
{

    /**
     * Lists all Sitio entities.
     *
     * @Route("/", name="sitio")
     * @Route("/sede/{id}/", name="sitios_sede")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();

        if(is_null($id))
            $entities = $em->getRepository('SirepaePracticasBundle:Sitio')->findAll();
        else
            $entities = $em->getRepository('SirepaePracticasBundle:Sitio')->findBySede($id);

        return array(
            'entities' => $entities,
            'active_sitios_resumen'  =>  true
        );
    }
    /**
     * Creates a new Sitio entity.
     *
     * @Route("/", name="sitio_create")
     * @Route("/{id}/", name="sitio_create_sede")
     * @Method("POST")
     * @Template("SirepaePracticasBundle:Sitio:new.html.twig")
     */
    public function createAction(Request $request, $id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Sitio();
        if(!is_null($id)){
            $sede = $em->getRepository('SirepaePracticasBundle:Sede')->find($id);
            if($sede)
                $entity->setSede($sede);
        }
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sitio'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_sitios_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Sitio entity.
    *
    * @param Sitio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Sitio $entity)
    {
        $form = $this->createForm(new SitioType(), $entity, array(
            'action' => $this->generateUrl('sitio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Sitio entity.
     *
     * @Route("/new/", name="sitio_new")
     * @Route("/new/{id}/", name="sitio_new_sede")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Sitio();
        if(!is_null($id)){
            $sede = $em->getRepository('SirepaePracticasBundle:Sede')->find($id);
            if($sede)
                $entity->setSede($sede);
        }
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_sitios_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Sitio entity.
     *
     * @Route("/{id}/", name="sitio_show")
     * @Route("/{id}/", name="sitio_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePracticasBundle:Sitio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sitio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_sitios_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Sitio entity.
     *
     * @Route("/{id}/edit/", name="sitio_edit")
     * @Route("/{id_sede}/edit/{id}", name="sitio_edit_sede")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePracticasBundle:Sitio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sitio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_sitios_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Sitio entity.
    *
    * @param Sitio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sitio $entity)
    {
        $form = $this->createForm(new SitioType(), $entity, array(
            'action' => $this->generateUrl('sitio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Sitio entity.
     *
     * @Route("/{id}/", name="sitio_update")
     * @Route("/{id_sede}/{id}/", name="sitio_update_sede")
     * @Method("PUT")
     * @Template("SirepaePracticasBundle:Sitio:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePracticasBundle:Sitio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sitio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sitio_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_sitios_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a Sitio entity.
     *
     * @Route("/{id}/", name="sitio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePracticasBundle:Sitio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sitio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sitio'));
    }

    /**
     * Creates a form to delete a Sitio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sitio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
    
}
