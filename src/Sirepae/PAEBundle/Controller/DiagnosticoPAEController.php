<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\DiagnosticoPAE;
use Sirepae\PAEBundle\Form\DiagnosticoPAEType;

/**
 * DiagnosticoPAE controller.
 *
 * @Route("/diagnostico_pae")
 */
class DiagnosticoPAEController extends Controller
{

    /**
     * Lists all DiagnosticoPAE entities.
     *
     * @Route("/", name="diagnostico_pae")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:DiagnosticoPAE')->findAll();

        return array(
            'entities' => $entities,
            'active_diagnosticos_pae_resumen'  =>  true
        );
    }
    /**
     * Creates a new DiagnosticoPAE entity.
     *
     * @Route("/", name="diagnostico_pae_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:DiagnosticoPAE:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new DiagnosticoPAE();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('diagnostico_pae'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_diagnosticos_pae_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a DiagnosticoPAE entity.
    *
    * @param DiagnosticoPAE $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(DiagnosticoPAE $entity)
    {
        $form = $this->createForm(new DiagnosticoPAEType(), $entity, array(
            'action' => $this->generateUrl('diagnostico_pae_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new DiagnosticoPAE entity.
     *
     * @Route("/new", name="diagnostico_pae_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new DiagnosticoPAE();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_diagnosticos_pae_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a DiagnosticoPAE entity.
     *
     * @Route("/{id}", name="diagnostico_pae_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:DiagnosticoPAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DiagnosticoPAE entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_diagnosticos_pae_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing DiagnosticoPAE entity.
     *
     * @Route("/{id}/edit", name="diagnostico_pae_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:DiagnosticoPAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DiagnosticoPAE entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_diagnosticos_pae_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a DiagnosticoPAE entity.
    *
    * @param DiagnosticoPAE $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(DiagnosticoPAE $entity)
    {
        $form = $this->createForm(new DiagnosticoPAEType(), $entity, array(
            'action' => $this->generateUrl('diagnostico_pae_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing DiagnosticoPAE entity.
     *
     * @Route("/{id}", name="diagnostico_pae_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:DiagnosticoPAE:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:DiagnosticoPAE')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DiagnosticoPAE entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('diagnostico_pae_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_diagnosticos_pae_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a DiagnosticoPAE entity.
     *
     * @Route("/{id}", name="diagnostico_pae_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:DiagnosticoPAE')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DiagnosticoPAE entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('diagnostico_pae'));
    }

    /**
     * Creates a form to delete a DiagnosticoPAE entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('diagnostico_pae_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
    
    /**
     * Deletes a Diagnostico pae entity.
     *
     * @Route("/{id_diagnostico}/pae/{id_pae}/factorRelacionado/{id_factorRelacionado}/", name="toggle_diagnostico_to_pae_fr")
     * @Route("/{id_diagnostico}/pae/{id_pae}/evidencia/{id_evidencia}/", name="toggle_diagnostico_to_pae_e")
     * @Method("GET")
     */
    public function toggleDiagnosticoPAEAction(Request $request, $id_diagnostico,$id_pae, $id_factorRelacionado = null, $id_evidencia = null)
    {
        if($request->isXmlHttpRequest()){
            $json = array(
                'error' =>  false,
                'msg'   =>  'Hecho',
                'clear'   =>  false,
            );
            $em = $this->getDoctrine()->getManager();
            $diagnostico = $em->getRepository('SirepaePAEBundle:Diagnostico')->find($id_diagnostico);
            if($diagnostico){
                $pae = $em->getRepository('SirepaePAEBundle:PAE')->find($id_pae);
                if($pae && !$pae->isCalificado()){
                    if(is_null($id_factorRelacionado)){
                        $evidencia = $em->getRepository('SirepaePAEBundle:Evidencia')->find($id_evidencia);
                        if($evidencia){
                            $dpae = $em->getRepository('SirepaePAEBundle:DiagnosticoPAE')->findOneBy(array(
                                'diagnostico' => $id_diagnostico,
                                'planCuidado' => $id_pae,
                            ));
                            if($dpae){
                                $existe = false;
                                foreach($dpae->getEvidencias() as $evidencia_){
                                    if($evidencia_->getId() == $id_evidencia){
                                        $dpae->removeEvidencia($evidencia_);
//                                        $em->persist($dpae);
//                                        $em->flush();
                                        $json['add']  = false;
                                        $existe = true;
                                        break;
                                    }
                                }
                                if(!$existe){
                                    $dpae->addEvidencia($evidencia);
//                                    $em->persist($dpae);
//                                    $em->flush();
                                    $json['add']  = true;
//                                        $json['clear']  = true;
                                }
                            }else{
                                $dpae = new \Sirepae\PAEBundle\Entity\DiagnosticoPAE();
                                $dpae
                                    ->setDiagnostico($diagnostico)
                                    ->addEvidencia($evidencia)
                                    ->setPlanCuidado($pae);
                                $em->persist($dpae);
                                $json['add']  = true;
                            }
                            $em->flush();
                        }else{
                            $json['error']  = true;
                            $json['msg']    = 'Evidencia no válida';
                        }
                    }elseif(is_null($id_evidencia)){
                        $factorRelacionado = $em->getRepository('SirepaePAEBundle:FactorRelacionado')->find($id_factorRelacionado);
                        if($factorRelacionado){
                            $dpae = $em->getRepository('SirepaePAEBundle:DiagnosticoPAE')->findOneBy(array(
                                'diagnostico' => $id_diagnostico,
                                'planCuidado' => $id_pae,
                            ));
                            if($dpae){
                                $existe = false;
                                foreach($dpae->getFactorRelacionados() as $factorRelacionado_){
                                    if($factorRelacionado_->getId() == $id_factorRelacionado){
                                        $dpae->removeFactorRelacionado($factorRelacionado_);
//                                        $em->persist($dpae);
//                                        $em->flush();
                                        $json['add']  = false;
                                        $existe = true;
                                        break;
                                    }
                                }
                                if(!$existe){
                                    $dpae->addFactorRelacionado($factorRelacionado);
//                                    $em->persist($dpae);
//                                    $em->flush();
                                    $json['add']  = true;
//                                        $json['clear']  = true;
                                }
                                $em->flush();
                            }else{
                                $dpae = new \Sirepae\PAEBundle\Entity\DiagnosticoPAE();
                                $dpae
                                    ->setDiagnostico($diagnostico)
                                    ->addFactorRelacionado($factorRelacionado)
                                    ->setPlanCuidado($pae);
                                $em->persist($dpae);
                                $json['add']  = true;
                            }
                            $em->flush();
                        }else{
                            $json['error']  = true;
                            $json['msg']    = 'FactorRelacionado no válida';
                        }
                    }else{
                        $json['error']  = true;
                        $json['msg']    = 'Datos no encontrados';
                    }
                }else{
                    $json['error']  = true;
                    $json['msg']    = $pae->isCalificado()?'PAE Calificado':'PAE no válido';
                }
            }else{
                $json['error']  = true;
                $json['msg']    = 'Diagnostico no válido';
            }

            return \Symfony\Component\HttpFoundation\JsonResponse::create($json);
            
        }else{
            throw $this->createNotFoundException('Diagnostico o Proceso de Atención de Enfermería no Encontradas');
        }
    }
}
