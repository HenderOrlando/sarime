<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\FactorRelacionado;
use Sirepae\PAEBundle\Form\FactorRelacionadoType;

/**
 * FactorRelacionado controller.
 *
 * @Route("/factor_relacionado")
 */
class FactorRelacionadoController extends Controller
{

    /**
     * Lists all FactorRelacionado entities.
     *
     * @Route("/", name="factor_relacionado")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:FactorRelacionado')->findAll();

        return array(
            'entities' => $entities,
            'active_factores_relacionados_resumen'  =>  true,'active_nandas_resumen'  =>  true
        );
    }
    /**
     * Creates a new FactorRelacionado entity.
     *
     * @Route("/diagnostico/{id}/", name="factor_relacionado_create_diagnostico")
     * @Route("/clase/{id_clase}/", name="factor_relacionado_create_clase")
     * @Route("/", name="factor_relacionado_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:FactorRelacionado:new.html.twig")
     */
    public function createAction(Request $request, $id = null, $id_clase = null)
    {
        $entity = new FactorRelacionado();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            if(!is_null($id)){
                return $this->redirect($this->generateUrl('diagnostico_edit',array('id' => $id)));
            }elseif(!is_null($id_clase)){
                return $this->redirect($this->generateUrl('clase_edit',array('id' => $id_clase)));
            }
            return $this->redirect($this->generateUrl('factor_relacionado'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_factores_relacionados_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_factores_relacionados_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a FactorRelacionado entity.
    *
    * @param FactorRelacionado $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(FactorRelacionado $entity, \Sirepae\PAEBundle\Entity\Clase $clase = null, \Sirepae\PAEBundle\Entity\Diagnostico $diagnostico = null)
    {
        $url = $this->generateUrl('factor_relacionado_create');
        if (!is_null($clase)) {
            $url = $this->generateUrl('factor_relacionado_create_clase', array('id_clase' => $clase->getId()));
        }elseif (!is_null($diagnostico)) {
            $url = $this->generateUrl('factor_relacionado_create_diagnostico', array('id' => $diagnostico->getId()));
        }
        $form = $this->createForm(new FactorRelacionadoType($clase), $entity, array(
            'action' => $url,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new FactorRelacionado entity.
     *
     * @Route("/new/clase/{id_clase}/", name="factor_relacionado_new_clase")
     * @Route("/new/diagnostico/{id}/", name="factor_relacionado_new_diagnostico")
     * @Route("/new/", name="factor_relacionado_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = null, $id_clase = null)
    {
        $entity = new FactorRelacionado();
        $em = $this->getDoctrine()->getManager();

        $diagnostico = null;
        if(!is_null($id)){
            $diagnostico = $em->getRepository('SirepaePAEBundle:Diagnostico')->find($id);
            $entity->setDiagnostico($diagnostico);
        }
        $clase = null;
        if(!is_null($id_clase)){
            $clase = $em->getRepository('SirepaePAEBundle:Clase')->find($id_clase);
        }
        $form   = $this->createCreateForm($entity, $clase, $diagnostico);
        return array(
            'entity'        => $entity,
            'clase'         => $clase,
            'diagnostico'   => $diagnostico,
            'active_factores_relacionados_new'  =>  true,
            'form'          => $form->createView(),
            'active_factores_relacionados_resumen'  =>  true,'active_nandas_resumen'  =>  true,
        );
    }

    /**
     * Finds and displays a FactorRelacionado entity.
     *
     * @Route("/{id}", name="factor_relacionado_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:FactorRelacionado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FactorRelacionado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_factores_relacionados_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_factores_relacionados_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing FactorRelacionado entity.
     *
     * @Route("/{id}/edit", name="factor_relacionado_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:FactorRelacionado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FactorRelacionado entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_factores_relacionados_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_factores_relacionados_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a FactorRelacionado entity.
    *
    * @param FactorRelacionado $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FactorRelacionado $entity)
    {
        $form = $this->createForm(new FactorRelacionadoType(), $entity, array(
            'action' => $this->generateUrl('factor_relacionado_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing FactorRelacionado entity.
     *
     * @Route("/{id}", name="factor_relacionado_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:FactorRelacionado:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:FactorRelacionado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FactorRelacionado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('factor_relacionado_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_factores_relacionados_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_factores_relacionados_edit'  =>  true,
        );
    }
    /**
     * Deletes a FactorRelacionado entity.
     *
     * @Route("/{id}", name="factor_relacionado_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:FactorRelacionado')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FactorRelacionado entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('factor_relacionado'));
    }

    /**
     * Creates a form to delete a FactorRelacionado entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('factor_relacionado_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
