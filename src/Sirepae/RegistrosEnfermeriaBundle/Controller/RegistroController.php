<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\RegistrosEnfermeriaBundle\Entity\Registro;
use Sirepae\RegistrosEnfermeriaBundle\Form\RegistroType;

/**
 * Registro controller.
 *
 * @Route("/registro")
 */
class RegistroController extends Controller
{

    /**
     * Lists all Registro entities.
     *
     * @Route("/", name="registro")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->findAll();

        return array(
            'entities' => $entities,
            'active_registros_resumen'  =>  true
        );
    }
    /**
     * Creates a new Registro entity.
     *
     * @Route("/", name="registro_create")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Registro:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Registro();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setNombre($entity->getTipo()->getNombre().' ');
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('registro'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_registros_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Registro entity.
    *
    * @param Registro $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Registro $entity)
    {
        $form = $this->createForm(new RegistroType(), $entity, array(
            'action' => $this->generateUrl('registro_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Registro entity.
     *
     * @Route("/new", name="registro_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Registro();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_registros_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Registro entity.
     *
     * @Route("/{id}", name="registro_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Registro entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_registros_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Registro entity.
     *
     * @Route("/{id}/edit", name="registro_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Registro entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_registros_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Registro entity.
    *
    * @param Registro $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Registro $entity)
    {
        $form = $this->createForm(new RegistroType(), $entity, array(
            'action' => $this->generateUrl('registro_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Registro entity.
     *
     * @Route("/{id}", name="registro_update")
     * @Method("PUT")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Registro:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Registro entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('registro_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_registros_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a Registro entity.
     *
     * @Route("/{id}", name="registro_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Registro entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('registro'));
    }
    /**
     * Deletes a Registro dinamico.
     *
     * @Route("/llenado/{nombre}/{idRegistro}/{idRegistroEnfermeria}/{numero}/", name="borrar_registro_dinamico")
     * @Method("DELETE")
     */
    public function deleteRegistroDinamicoAction(Request $request, $numero, $idRegistro, $idRegistroEnfermeria, $nombre)
    {
        $form = $this->createDeleteFormLleno($nombre, $numero, $idRegistro, $idRegistroEnfermeria);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
            $idRegistroEnfermeria_ = $data['id_registro_enfermeria'];
            $numero_ = $data['numero'];
            if($idRegistroEnfermeria == $idRegistroEnfermeria_ && $numero == $numero_){
                $em = $this->getDoctrine()->getManager();
                $registro = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->find($idRegistro);
                if($registro){
                    $em->transactional(function($em) use ($idRegistroEnfermeria_, $registro, $numero_){
                        foreach($registro->getPreguntas() as $pregunta){
                            $rtaRe = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaRegistroEnfermeria')->getRespuestaByRegistroEnfermeriaPregunta($idRegistroEnfermeria_, $pregunta->getId(), $numero_);
                            $rta = $rtaRe->getRespuesta();
                            $em->remove($rtaRe);
                            $em->remove($rta);
                        }
                    });
                }
            } else {
                throw $this->createNotFoundException('Unable to find Registro Lleno entity.');
            }
        }

        return $this->redirect($this->generateUrl('registros_enfermeria_edit',array('id' => $idRegistroEnfermeria_)));
    }

    /**
     * Creates a form to delete a Registro entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('registro_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }

    /**
     * Creates a form to delete a Registro entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteFormLleno($nombre, $numero, $idRegistro, $idRegistroEnfermeria)
    {
        return $this->createFormBuilder()
                    ->setAction($this->generateUrl('borrar_registro_dinamico', array(
                        'nombre' => str_replace(' ', '-', $this->canonicalize($nombre)),
                        'numero' => $numero,
                        'idRegistro' => $idRegistro,
                        'idRegistroEnfermeria' => $idRegistroEnfermeria,
                    )))
                    ->add('id_registro', 'hidden', array('data' => $idRegistro))
                    ->add('id_registro_enfermeria', 'hidden', array('data' => $idRegistroEnfermeria))
                    ->add('numero', 'hidden', array('data' => $numero))
                    ->setMethod('DELETE')
                    ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
                    ->getForm()
                ;
    }
    /**
     * Muestra el Formulario de un Registro.
     *
     * @Route("/editar-registro/{idRegistro}/{idRegistroEnfermeria}/{numero}/", name="editar_registro_enfermeria")
     * @Route("/llenar-registro/{idRegistro}/{idRegistroEnfermeria}/", name="llenar_registro")
     * @Method("GET")
     * @Template()
     */
    public function llenarRegistroAction(Request $request, $idRegistro, $idRegistroEnfermeria, $numero = null)
    {
        $routeName = $request->get('_route');
        $editar = false;
        if(strpos($routeName, 'editar') !== false){
            $editar = true;
        }
        $em = $this->getDoctrine()->getManager();

        $registro = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->find($idRegistro);
        $registroEnfermeria = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->find($idRegistroEnfermeria);
        if($registro && $registroEnfermeria){
            $form = $this->constructForm($registro, $registroEnfermeria, $numero, $editar);
            if(!method_exists($form,'createView')){
                return $form;
                /*Mensaje por el form*/
            }
            $deleteForm = null;
            if($editar){
                $deleteForm = $this->createDeleteFormLleno($registro->getNombre(), $numero, $idRegistro, $idRegistroEnfermeria)->createView();
            }
            return array(
                'reg' => $registro,
                'entity' => $registroEnfermeria,
                'form' => $form->createView(),
                'delete_form' => $deleteForm,
                'active_registrosEnfermeria_resumen'  =>  true,
                'active_edit'  =>  true,
            );
        }
        return $this->redirect($this->generateUrl('registros_enfermeria'));
    }
    
    /**
     * Procesa y Guarda el Formulario de un Registro.
     *
     * @Route("/actualizar_registro/{idRegistro}/{idRegistroEnfermeria}/{numero}/", name="update_llenar_registro")
     * @Route("/guardar-registro/{idRegistro}/{idRegistroEnfermeria}/", name="guardar_llenar_registro")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Registro:llenarRegistro.html.twig")
     */
    public function guardarLlenarRegistroAction(Request $request, $idRegistro, $idRegistroEnfermeria, $numero = null)
    {
        $routeName = $request->get('_route');
        $editar = false;
        if(strpos($routeName, 'update') !== false){
            $editar = true;
        }
        
        $em = $this->getDoctrine()->getManager();

        $registro = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->find($idRegistro);
        $registroEnfermeria = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->find($idRegistroEnfermeria);
        if($registro && $registroEnfermeria){
            $form = $this->constructForm($registro, $registroEnfermeria, $numero, $editar);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->transactional(function($em) use ($registroEnfermeria, $form, $numero, $editar, $registro){
                    foreach($form->getData() as $id => $dato){
                        if(count(explode('-', $id)) > 1){
                            $id = explode('-', $id);
                            $preg_id = $id[0];
                            $optRta_id = $id[1];
                        }else{
                            $preg_id = $id;
                            if(!empty($dato) && is_array($dato)){
                                $optRta_id = $dato[0];
                            }else{
                                $optRta_id = $dato;
                            }
                        }
                        $preg = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Pregunta')->find($preg_id);
                        if(empty($dato)){
                            $optRta_id = $preg->getOpcionesRespuesta()->first()->getId();
                        }
                        $rtaRe = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaRegistroEnfermeria')->getRespuestaByRegistroEnfermeriaPregunta($registroEnfermeria->getId(),$preg->getId(), $numero);
                        if(!$editar && ($registro->isUnico() && !$rtaRe) || (!$editar && !$registro->isUnico())){
                            $rta = new \Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta();
                        }elseif($editar && $rtaRe){
                            $rta = $rtaRe->getRespuesta();
                        }else{
                            return $this->redirect($this->generateUrl('registros_enfermeria_edit', array('id' => $registroEnfermeria->getId())));
                        }
                        $optRta = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:OpcionRespuesta')->find($optRta_id);
                        $tipoCampo = $optRta->getTipoRespuesta()->getTipoCampo();
                        if($tipoCampo === 'date' || $tipoCampo === 'time' || $tipoCampo === 'datetime'){
                            $format = '';
                            if($optRta->getTipoRespuesta()->getTipoCampo() === 'date')
                                $format .= 'Y/m/d';
                            elseif($optRta->getTipoRespuesta()->getTipoCampo() === 'time')
                                $format .= 'H:i:s';
                            else
                                $format .= 'Y/m/d H:i:s';
                            $dato = $dato->format($format);
                        }elseif($tipoCampo === 'choice'){
                            if($preg->isMultiRta())
                                if(empty($dato))
                                    $dato = '';
                                else
                                    $dato = implode('\#_*/|\*_#/',$dato);
                            else
                                $dato = null;
                        }
                        
                        $rta
                            ->setOpcionRespuesta($optRta)
                            ->setPregunta($preg)
                            ->setValor($dato);
                        $em->persist($rta);
                        if(!$editar){
                            $rtaRe = new \Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaRegistroEnfermeria();
                            $rtaRe->setNumero(count($em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaRegistroEnfermeria')->getRespuestasByRegistroEnfermeriaPregunta(3,$registroEnfermeria->getId(),$preg->getId()))+1);
                        }
                        $rtaRe->setRespuesta($rta);
                        $rtaRe->setRegistroEnfermeria($registroEnfermeria);
                        $em->persist($rtaRe);
                    }
                });
                return $this->redirect($this->generateUrl('registros_enfermeria_edit', array('id' => $registroEnfermeria->getId())));
            }
            return array(
                'reg' => $registro,
                'entity' => $registroEnfermeria,
                'form' => $form->createView(),
                'active_registrosEnfermeria_resumen'  =>  true,
                'active_edit'  =>  true,
            );
        }
        return $this->redirect($this->generateUrl('registros_enfermeria'));
    }
    public function canonicalize($string)
    {
        return null === $string ? null : str_replace(' ','_',mb_convert_case($string, MB_CASE_LOWER, mb_detect_encoding($string)));
    }
    /**
     * @return \Symfony\Component\Form\FormBuilder FormBuilder
     */
    public function constructForm(Registro $registro, \Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria $registroEnfermeria, $numero = null, $editar = false, $btnSubmit = true){
        $form = $this->createFormBuilder();
        $em = $this->getDoctrine()->getManager();
        foreach($registro->getPreguntas() as $preg){
            $rta = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RespuestaRegistroEnfermeria')->getRespuestaByRegistroEnfermeriaPregunta($registroEnfermeria->getId(),$preg->getId(), $numero);
            $datos = array();
            $datos['label'] = $preg->getEnunciado();
            $tipo_campo = 'choice';
            $id_campo = '';
            $opts = array();
            $datos['required'] = $preg->isRequerido();
            if(count($preg->getOpcionesRespuesta()) > 1){
                foreach($preg->getOpcionesRespuesta() as $optRta){
                    $opts[$optRta->getId()] = $optRta->getEnunciado();
                }
                $datos['multiple'] = $preg->isMultiRta();
                $datos['expanded'] = $preg->isExpandido();
                $datos['choices'] = $opts;
                $id_campo = $preg->getId();
            }else{
                $optRta = $preg->getOpcionesRespuesta()->first();
                if($optRta){
                    $tipo_campo = $optRta->getTipoRespuesta()->getTipoCampo();
                    $id_campo = $preg->getId().'-'.$optRta->getId();
                }else{
                    return $this->redirect($this->generateUrl('addOpcionRespuesta_new',array('id' => $preg->getId())));
                }
            }
            if($tipo_campo === 'date' || $tipo_campo === 'time' || $tipo_campo === 'datetime')
                $datos['data'] = new \DateTime ('now');
            if($editar && $rta){
                if(is_null($rta->getRespuesta()->getValor())){
                    $dato = $rta->getRespuesta()->getOpcionRespuesta()->getId();
                }
                else{
                    $dato = $rta->getRespuesta()->getValor();
                }
                if($tipo_campo === 'date' || $tipo_campo === 'time' || $tipo_campo === 'datetime'){
                    $dato = new \DateTime ($dato);
                }
                elseif($tipo_campo === 'choice' && $preg->isMultiRta()){
                    $dato = explode('\#_*/|\*_#/',$dato);
                }
                elseif($tipo_campo !== 'textarea' && $tipo_campo !== 'choice'){
                    $dato = $preg->getId().'-'.$dato;
                }
                $datos['data'] = $dato;
            }elseif(!$editar && $rta && $registro->isUnico()){
                return $this->redirect($this->generateUrl('registros_enfermeria_edit', array('id' => $registroEnfermeria->getId())));
//                return $this->redirect($this->generateUrl('editar_registro_enfermeria', array(
//                    'idRegistro' => $registro->getId(),
//                    'idRegistroEnfermeria' => $registroEnfermeria->getId(),
//                    'numero' => $numero,
//                )));
            }
            $form->add($id_campo, $tipo_campo, $datos);
        }
        if($btnSubmit && count($registro->getPreguntas())){
            $form
                ->setAction($this->generateUrl(($editar?'update':'guardar').'_llenar_registro', array('idRegistro' => $registro->getId(), 'idRegistroEnfermeria' => $registroEnfermeria->getId(), 'numero' => $numero)))
                ->setMethod('POST')
                ->add('submit', 'submit', array('label' => 'Guardar '.$registro->getNombre(), 'attr' => array( 'class' => 'btn-success')))
                ;
        }
        return $form->getForm();
    }
}
