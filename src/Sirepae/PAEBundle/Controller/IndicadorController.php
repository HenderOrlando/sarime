<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\Indicador;
use Sirepae\PAEBundle\Form\IndicadorType;

/**
 * Indicador controller.
 *
 * @Route("/indicador")
 */
class IndicadorController extends Controller
{

    /**
     * Lists all Indicador entities.
     *
     * @Route("/", name="indicador")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:Indicador')->findAll();

        return array(
            'entities' => $entities,
            'active_indicadores_resumen'  =>  true,'active_nocs_resumen'  =>  true
        );
    }
    /**
     * Creates a new Indicador entity.
     *
     * @Route("/resultado-esperado/{id_resultado_esperado}/", name="indicador_create_resultado_esperado")
     * @Route("/noc/{id}/", name="indicador_create_noc")
     * @Route("/", name="indicador_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:Indicador:new.html.twig")
     */
    public function createAction(Request $request, $id = null, $id_resultado_esperado = null)
    {
        $entity = new Indicador();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            if (!is_null($id)) {
                return $this->redirect($this->generateUrl('noc_edit', array('id' => $id)));
            }elseif (!is_null($id_resultado_esperado)) {
                return $this->redirect($this->generateUrl('resultado_esperado_edit', array('id' => $id_resultado_esperado)));
            } else {
                return $this->redirect($this->generateUrl('indicador'));
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_indicadores_resumen'  =>  true,'active_nocs_resumen'  =>  true,
            'active_indicadores_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Indicador entity.
    *
    * @param Indicador $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Indicador $entity, \Sirepae\PAEBundle\Entity\NOC $noc = null, \Sirepae\PAEBundle\Entity\ResultadoEsperado $resultado = null)
    {
        $url = $this->generateUrl('indicador_create');
        if (!is_null($noc)) {
            $url = $this->generateUrl('indicador_create_noc', array('id' => $noc->getId()));
        }elseif (!is_null($resultado)) {
            $url = $this->generateUrl('indicador_create_resultado_esperado', array('id_resultado_esperado' => $resultado->getId()));
        }
        $form = $this->createForm(new IndicadorType($noc), $entity, array(
            'action' => $url,
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Indicador entity.
     *
     * @Route("/new/resultado-esperado/{id_resultado_esperado}/", name="indicador_new_resultado_esperado")
     * @Route("/new/noc/{id}/", name="indicador_new_noc")
     * @Route("/new", name="indicador_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = null, $id_resultado_esperado = null)
    {
        $entity = new Indicador();
        $em = $this->getDoctrine()->getManager();
        
        $noc = null;
        if(!is_null($id)){
            $noc = $em->getRepository('SirepaePAEBundle:NOC')->find($id);
        }
        $resultado_esperado = null;
        if(!is_null($id_resultado_esperado)){
            $resultado_esperado = $em->getRepository('SirepaePAEBundle:ResultadoEsperado')->find($id_resultado_esperado);
            $entity->setResultadoEsperado($resultado_esperado);
        }
        $form   = $this->createCreateForm($entity, $noc, $resultado_esperado);

        return array(
            'noc' => $noc,
            'entity' => $entity,
            'resultado_esperado' => $resultado_esperado,
            'form'   => $form->createView(),
            'active_indicadores_resumen'  =>  true,'active_nocs_resumen'  =>  true,
            'active_indicadores_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Indicador entity.
     *
     * @Route("/{id}", name="indicador_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Indicador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Indicador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_indicadores_resumen'  =>  true,'active_nocs_resumen'  =>  true,
            'active_indicadores_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Indicador entity.
     *
     * @Route("/{id}/edit", name="indicador_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Indicador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Indicador entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_indicadores_resumen'  =>  true,'active_nocs_resumen'  =>  true,
            'active_indicadores_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Indicador entity.
    *
    * @param Indicador $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Indicador $entity)
    {
        $form = $this->createForm(new IndicadorType(), $entity, array(
            'action' => $this->generateUrl('indicador_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Indicador entity.
     *
     * @Route("/{id}", name="indicador_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:Indicador:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:Indicador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Indicador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('indicador_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_indicadores_resumen'  =>  true,'active_nocs_resumen'  =>  true,
            'active_indicadores_edit'  =>  true,
        );
    }
    /**
     * Deletes a Indicador entity.
     *
     * @Route("/{id}", name="indicador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:Indicador')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Indicador entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('indicador'));
    }

    /**
     * Creates a form to delete a Indicador entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('indicador_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
