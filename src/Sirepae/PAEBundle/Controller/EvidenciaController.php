<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\Evidencia;
use Sirepae\PAEBundle\Form\EvidenciaType;

/**
 * Evidencia controller.
 *
 * @Route("/evidencia")
 */
class EvidenciaController extends Controller
{

    /**
     * Lists all Evidencia entities.
     *
     * @Route("/", name="evidencia")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:Evidencia')->findAll();

        return array(
            'entities' => $entities,
            'active_evidencias_resumen'  =>  true,'active_nandas_resumen'  =>  true
        );
    }
    /**
     * Creates a new Evidencia entity.
     *
     * @Route("/diagnostico/{id}/", name="evidencia_create_diagnostico")
     * @Route("/clase/{id_clase}/", name="evidencia_create_clase")
     * @Route("/", name="evidencia_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:Evidencia:new.html.twig")
     */
    public function createAction(Request $request, $id = null, $id_clase = null)
    {
        $entity = new Evidencia();
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
            return $this->redirect($this->generateUrl('evidencia'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_evidencias_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_evidencias_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Evidencia entity.
    *
    * @param Evidencia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Evidencia $entity, \Sirepae\PAEBundle\Entity\Clase $clase = null, \Sirepae\PAEBundle\Entity\Diagnostico $diagnostico = null)
    {
        $url = $this->generateUrl('evidencia_create');
        if (!is_null($clase)) {
            $url = $this->generateUrl('evidencia_create_clase', array('id_clase' => $clase->getId()));
        }elseif (!is_null($diagnostico)) {
            $url = $this->generateUrl('evidencia_create_diagnostico', array('id' => $diagnostico->getId()));
        }
        $form = $this->createForm(new EvidenciaType($clase), $entity, array(
            'action' => $url,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Evidencia entity.
     *
     * @Route("/new/clase/{id_clase}/", name="evidencia_new_clase")
     * @Route("/new/diagnostico/{id}/", name="evidencia_new_diagnostico")
     * @Route("/new/", name="evidencia_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = null, $id_clase = null)
    {
        $entity = new Evidencia();
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
            'active_evidencias_new'  =>  true,
            'form'          => $form->createView(),
            'active_evidencias_resumen'  =>  true,'active_nandas_resumen'  =>  true,
        );
    }

    /**
     * Finds and displays a Evidencia entity.
     *
     * @Route("/{id}", name="evidencia_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Evidencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evidencia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_evidencias_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_evidencias_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Evidencia entity.
     *
     * @Route("/{id}/edit", name="evidencia_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Evidencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evidencia entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_evidencias_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_evidencias_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Evidencia entity.
    *
    * @param Evidencia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Evidencia $entity)
    {
        $form = $this->createForm(new EvidenciaType(), $entity, array(
            'action' => $this->generateUrl('evidencia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Evidencia entity.
     *
     * @Route("/{id}", name="evidencia_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:Evidencia:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Evidencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evidencia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('evidencia_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_evidencias_resumen'  =>  true,'active_nandas_resumen'  =>  true,
            'active_evidencias_edit'  =>  true,
        );
    }
    /**
     * Deletes a Evidencia entity.
     *
     * @Route("/{id}", name="evidencia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:Evidencia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Evidencia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('evidencia'));
    }

    /**
     * Creates a form to delete a Evidencia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evidencia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
