<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\Diagnostico;
use Sirepae\PAEBundle\Form\DiagnosticoType;

/**
 * Diagnostico controller.
 *
 * @Route("/diagnostico")
 */
class DiagnosticoController extends Controller
{

    /**
     * Lists all Diagnostico entities.
     *
     * @Route("/", name="diagnostico")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:Diagnostico')->findAll();

        return array(
            'entities' => $entities,
            'active_diagnosticos_resumen'  =>  true,'active_nandas_resumen'  =>  true
        );
    }
    /**
     * Creates a new Diagnostico entity.
     *
     * @Route("/dominio/{id}/", name="diagnostico_create_dominio")
     * @Route("/clase/{id_clase}/", name="diagnostico_create_clase")
     * @Route("/", name="diagnostico_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:Diagnostico:new.html.twig")
     */
    public function createAction(Request $request, $id = null, $id_clase = null)
    {
        $entity = new Diagnostico();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            if (!is_null($id)) {
                return $this->redirect($this->generateUrl('dominio_edit', array('id' => $id)));
            } elseif(!is_null($id_clase)){
                return $this->redirect($this->generateUrl('clase_edit', array('id' => $id_clase)));
            } else {
                return $this->redirect($this->generateUrl('diagnostico'));
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_diagnosticos_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_diagnosticos_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Diagnostico entity.
    *
    * @param Diagnostico $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Diagnostico $entity, \Sirepae\PAEBundle\Entity\Dominio $dominio = null, \Sirepae\PAEBundle\Entity\Clase $clase = null)
    {
        $url = $this->generateUrl('diagnostico_create');
        if (!is_null($dominio)) {
            $url = $this->generateUrl('diagnostico_create_dominio', array('id' => $dominio->getId()));
        }elseif (!is_null($clase)) {
            $url = $this->generateUrl('diagnostico_create_clase', array('id_clase' => $clase->getId()));
        }
        $form = $this->createForm(new DiagnosticoType($dominio), $entity, array(
            'action' => $url,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Diagnostico entity.
     *
     * @Route("/dominio/{id}/", name="diagnostico_new_dominio")
     * @Route("/clase/{id_clase}/", name="diagnostico_new_clase")
     * @Route("/new", name="diagnostico_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = null, $id_clase = null)
    {
        $entity = new Diagnostico();
        $em = $this->getDoctrine()->getManager();
        $dominio = null;
        if (!is_null($id)) {
            $dominio = $em->getRepository('SirepaePAEBundle:Dominio')->find($id);
        }
        $clase = null;
        if(!is_null($id_clase)){
            $clase = $em->getRepository('SirepaePAEBundle:Clase')->find($id_clase);
            $entity->setClase($clase);
        }
        $form   = $this->createCreateForm($entity, $dominio, $clase);

        return array(
            'clase' => $clase,
            'entity' => $entity,
            'dominio' => $dominio,
            'form'   => $form->createView(),
            'active_diagnosticos_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_diagnosticos_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Diagnostico entity.
     *
     * @Route("/{id}", name="diagnostico_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Diagnostico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diagnostico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_diagnosticos_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_diagnosticos_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Diagnostico entity.
     *
     * @Route("/{id}/edit", name="diagnostico_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Diagnostico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diagnostico entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_diagnosticos_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_diagnosticos_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Diagnostico entity.
    *
    * @param Diagnostico $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Diagnostico $entity)
    {
        $form = $this->createForm(new DiagnosticoType(), $entity, array(
            'action' => $this->generateUrl('diagnostico_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Diagnostico entity.
     *
     * @Route("/{id}", name="diagnostico_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:Diagnostico:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Diagnostico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diagnostico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('diagnostico_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_diagnosticos_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_diagnosticos_edit'  =>  true,
        );
    }
    /**
     * Deletes a Diagnostico entity.
     *
     * @Route("/{id}", name="diagnostico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:Diagnostico')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Diagnostico entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('diagnostico'));
    }

    /**
     * Creates a form to delete a Diagnostico entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('diagnostico_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
