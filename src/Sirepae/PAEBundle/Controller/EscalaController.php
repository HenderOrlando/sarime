<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\Escala;
use Sirepae\PAEBundle\Form\EscalaType;

/**
 * Escala controller.
 *
 * @Route("/escala")
 */
class EscalaController extends Controller
{

    /**
     * Lists all Escala entities.
     *
     * @Route("/", name="escala")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:Escala')->findAll();

        return array(
            'entities' => $entities,
            'active_escalas_resumen'  =>  true,            'active_nocs_resumen'  =>  true
        );
    }
    /**
     * Creates a new Escala entity.
     *
     * @Route("/resultado-esperado/{id}/", name="escala_create_resultado_esperado")
     * @Route("/", name="escala_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:Escala:new.html.twig")
     */
    public function createAction(Request $request, $id = null)
    {
        $entity = new Escala();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            if (!is_null($id)) {
                return $this->redirect($this->generateUrl('resultado_esperado_edit', array('id' => $id)));
            } else {
                return $this->redirect($this->generateUrl('escala'));
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_escalas_resumen'  =>  true,            'active_nocs_resumen'  =>  true,
            'active_escalas_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Escala entity.
    *
    * @param Escala $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Escala $entity, \Sirepae\PAEBundle\Entity\ResultadoEsperado $re = null)
    {
        $url = $this->generateUrl('resultado_esperado_create');
        if (!is_null($re)) {
            $url = $this->generateUrl('escala_create_resultado_esperado', array('id' => $re->getId()));
        }
        $form = $this->createForm(new EscalaType(), $entity, array(
            'action' => $url,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Escala entity.
     *
     * @Route("/new/escala/{id}/", name="escala_new_resultado_esperado")
     * @Route("/new/", name="escala_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = null)
    {
        $entity = new Escala();
        $em = $this->getDoctrine()->getManager();
        $re = null;
        if(!is_null($id)){
            $re = $em->getRepository('SirepaePAEBundle:ResultadoEsperado')->find($id);
            $entity->addResultadosEsperado($re);
        }
        $form   = $this->createCreateForm($entity, $re);

        return array(
            'resultado_esperado' => $re,
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_escalas_resumen'  =>  true,            'active_nocs_resumen'  =>  true,
            'active_escalas_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Escala entity.
     *
     * @Route("/{id}", name="escala_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Escala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Escala entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_escalas_resumen'  =>  true,            'active_nocs_resumen'  =>  true,
            'active_escalas_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Escala entity.
     *
     * @Route("/{id}/edit", name="escala_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Escala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Escala entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_escalas_resumen'  =>  true,            'active_nocs_resumen'  =>  true,
            'active_escalas_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Escala entity.
    *
    * @param Escala $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Escala $entity)
    {
        $form = $this->createForm(new EscalaType(), $entity, array(
            'action' => $this->generateUrl('escala_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Escala entity.
     *
     * @Route("/{id}", name="escala_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:Escala:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Escala')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Escala entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('escala_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_escalas_resumen'  =>  true,            'active_nocs_resumen'  =>  true,
            'active_escalas_edit'  =>  true,
        );
    }
    /**
     * Deletes a Escala entity.
     *
     * @Route("/{id}", name="escala_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:Escala')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Escala entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('escala'));
    }

    /**
     * Creates a form to delete a Escala entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('escala_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
