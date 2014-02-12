<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\Clase;
use Sirepae\PAEBundle\Form\ClaseType;

/**
 * Clase controller.
 *
 * @Route("/clase")
 */
class ClaseController extends Controller
{

    /**
     * Lists all Clase entities.
     *
     * @Route("/", name="clase")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:Clase')->findAll();

        return array(
            'entities' => $entities,
            'active_clases_resumen'  =>  true            ,'active_nandas_resumen'  =>  true
        );
    }
    /**
     * Creates a new Clase entity.
     *
     * @Route("/dominio/{id_dominio}/", name="clase_create_dominio")
     * @Route("/nanda/{id}/", name="clase_create_nanda")
     * @Route("/", name="clase_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:Clase:new.html.twig")
     */
    public function createAction(Request $request, $id = null, $id_dominio = null)
    {
        $entity = new Clase();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            if (!is_null($id)) {
                return $this->redirect($this->generateUrl('nanda_edit', array('id' => $id)));
            } elseif (!is_null($id_dominio)) {
                return $this->redirect($this->generateUrl('dominio_edit', array('id' => $id_dominio)));
            } else {
                return $this->redirect($this->generateUrl('clase'));
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_clases_resumen'  =>  true            ,'active_nandas_resumen'  =>  true,
            'active_clases_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Clase entity.
    *
    * @param Clase $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Clase $entity, \Sirepae\PAEBundle\Entity\NANDA $nanda = null, \Sirepae\PAEBundle\Entity\Dominio $dominio = null)
    {
        $url = $this->generateUrl('clase_create');
        if (!is_null($nanda)) {
            $url = $this->generateUrl('clase_create_nanda', array('id' => $nanda->getId()));
        }elseif(!is_null($dominio)){
            $url = $this->generateUrl('clase_create_dominio', array('id_dominio' => $dominio->getId()));
        }
        $form = $this->createForm(new ClaseType($nanda), $entity, array(
            'action' => $url,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Clase entity.
     *
     * @Route("/new/dominio/{id_dominio}/", name="clase_new_dominio")
     * @Route("/new/nanda/{id}/", name="clase_new_nanda")
     * @Route("/new/", name="clase_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id_dominio = null, $id = null)
    {
        $entity = new Clase();
        $em = $this->getDoctrine()->getManager();
        $nanda = null;
        if(!is_null($id)){
            $nanda = $em->getRepository('SirepaePAEBundle:NANDA')->find($id);
        }
        $dominio = null;
        if(!is_null($id_dominio)){
            $dominio = $em->getRepository('SirepaePAEBundle:Dominio')->find($id_dominio);
            $entity->setDominio($dominio);
        }
        $form   = $this->createCreateForm($entity, $nanda, $dominio);
        return array(
            'nanda' => $nanda,
            'entity' => $entity,
            'dominio' => $dominio,
            'form'   => $form->createView(),
            'active_clases_resumen'  =>  true            ,'active_nandas_resumen'  =>  true,
            'active_clases_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Clase entity.
     *
     * @Route("/{id}", name="clase_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Clase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clase entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_clases_resumen'  =>  true            ,'active_nandas_resumen'  =>  true,
            'active_clases_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Clase entity.
     *
     * @Route("/{id}/edit", name="clase_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Clase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clase entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_clases_resumen'  =>  true            ,'active_nandas_resumen'  =>  true,
            'active_clases_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Clase entity.
    *
    * @param Clase $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Clase $entity)
    {
        $form = $this->createForm(new ClaseType(), $entity, array(
            'action' => $this->generateUrl('clase_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Clase entity.
     *
     * @Route("/{id}", name="clase_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:Clase:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Clase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Clase entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('clase_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_clases_resumen'  =>  true            ,'active_nandas_resumen'  =>  true,
            'active_clases_edit'  =>  true,
        );
    }
    /**
     * Deletes a Clase entity.
     *
     * @Route("/{id}", name="clase_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:Clase')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Clase entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('clase'));
    }

    /**
     * Creates a form to delete a Clase entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clase_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
