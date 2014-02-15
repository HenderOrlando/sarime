<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\IndicadorPAE;
use Sirepae\PAEBundle\Form\IndicadorPAEType;

/**
 * IndicadorPAE controller.
 *
 * @Route("/indicador_pae")
 */
class IndicadorPAEController extends Controller
{

    /**
     * Lists all IndicadorPAE entities.
     *
     * @Route("/", name="indicador_pae")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:IndicadorPAE')->findAll();

        return array(
            'entities' => $entities,
            'active_indicadores_pae_resumen'  =>  true
        );
    }
    /**
     * Creates a new IndicadorPAE entity.
     *
     * @Route("/", name="indicador_pae_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:IndicadorPAE:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new IndicadorPAE();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('indicador_pae'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_indicadores_pae_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a IndicadorPAE entity.
    *
    * @param IndicadorPAE $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(IndicadorPAE $entity)
    {
        $form = $this->createForm(new IndicadorPAEType(), $entity, array(
            'action' => $this->generateUrl('indicador_pae_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new IndicadorPAE entity.
     *
     * @Route("/new", name="indicador_pae_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new IndicadorPAE();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_indicadores_pae_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a IndicadorPAE entity.
     *
     * @Route("/{id}", name="indicador_pae_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:IndicadorPAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IndicadorPAE entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_indicadores_pae_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing IndicadorPAE entity.
     *
     * @Route("/{id}/edit", name="indicador_pae_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:IndicadorPAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IndicadorPAE entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_indicadores_pae_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a IndicadorPAE entity.
    *
    * @param IndicadorPAE $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(IndicadorPAE $entity)
    {
        $form = $this->createForm(new IndicadorPAEType(), $entity, array(
            'action' => $this->generateUrl('indicador_pae_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing IndicadorPAE entity.
     *
     * @Route("/{id}", name="indicador_pae_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:IndicadorPAE:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:IndicadorPAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IndicadorPAE entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('indicador_pae_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_indicadores_pae_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a IndicadorPAE entity.
     *
     * @Route("/{id}", name="indicador_pae_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:IndicadorPAE')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find IndicadorPAE entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('indicador_pae'));
    }

    /**
     * Creates a form to delete a IndicadorPAE entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('indicador_pae_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
    
    /**
     * Deletes a Indicador pae entity.
     *
     * @Route("/{id_indicador}/pae/{id_pae}/escala/{id_escala}/", name="toggle_indicador_to_pae")
     * @Method("GET")
     */
    public function toggleIndicadorPAEAction(Request $request, $id_indicador,$id_pae, $id_escala)
    {
        if($request->isXmlHttpRequest()){
            $json = array(
                'error' =>  false,
                'msg'   =>  'Hecho',
                'clear'   =>  false,
            );
            $em = $this->getDoctrine()->getManager();
            $indicador = $em->getRepository('SirepaePAEBundle:Indicador')->find($id_indicador);
            if($indicador){
                $pae = $em->getRepository('SirepaePAEBundle:PAE')->find($id_pae);
                if($pae){
                    $escala = $em->getRepository('SirepaePAEBundle:Escala')->find($id_escala);
                    if($escala){
                        $ipae = $em->getRepository('SirepaePAEBundle:IndicadorPAE')->findOneBy(array(
                            'indicador' => $id_indicador,
                            'planCuidado' => $id_pae,
                        ));
                        if($ipae){
                            if($ipae->getEscala()->getId() == $id_escala){
                                $em->remove($ipae);
                                $json['add']  = false;
                            }else{
                                $ipae->setEscala($escala);
                                $em->persist($ipae);
                                $json['add']  = true;
                                $json['clear']  = true;
                            }
                        }else{
                            $ipae = new \Sirepae\PAEBundle\Entity\IndicadorPAE();
                            $ipae
                                ->setIndicador($indicador)
                                ->setEscala($escala)
                                ->setPlanCuidado($pae);
                            $em->persist($ipae);
                            $json['add']  = true;
                        }
                        $em->flush();
                    }else{
                        $json['error']  = true;
                        $json['msg']    = 'Escala no válida';
                    }
                }else{
                    $json['error']  = true;
                    $json['msg']    = 'PAE no válido';
                }
            }else{
                $json['error']  = true;
                $json['msg']    = 'Indicador no válido';
            }

            return \Symfony\Component\HttpFoundation\JsonResponse::create($json);
            
        }else{
            throw $this->createNotFoundException('Indicador o Proceso de Enfermería no Encontradas');
        }
    }
}
