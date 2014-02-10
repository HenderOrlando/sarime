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
     * Muestra el Formulario de un Registro.
     *
     * @Route("/llenar/{idRegistro}/{idRegistroEnfermeria}", name="llenar_registro")
     * @Method("GET")
     * @Template()
     */
    public function llenarRegistroAction($idRegistro, $idRegistroEnfermeria)
    {
        $em = $this->getDoctrine()->getManager();

        $registro = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->find($idRegistro);
        $registroEnfermeria = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->find($idRegistroEnfermeria);
        if($registro && $registroEnfermeria){
            $form = $this->constructForm($registro, $registroEnfermeria);
            return array(
                'reg' => $registro,
                'entity' => $registroEnfermeria,
                'form' => $form->createView(),
                'active_registrosEnfermeria_resumen'  =>  true,
                'active_edit'  =>  true,
            );
        }
        $this->redirect($this->generateUrl('registros_enfermeria'));
    }
    
    /**
     * Procesa y Guarda el Formulario de un Registro.
     *
     * @Route("/guardar_llenar/{idRegistro}/{idRegistroEnfermeria}", name="guardar_llenar_registro")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Registro:llenarRegistro.html.twig")
     */
    public function guardarLlenarRegistroAction(Request $request, $idRegistro, $idRegistroEnfermeria)
    {
        $em = $this->getDoctrine()->getManager();

        $registro = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->find($idRegistro);
        $registroEnfermeria = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->find($idRegistroEnfermeria);
        if($registro && $registroEnfermeria){
            $form = $this->constructForm($registro, $registroEnfermeria);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $rtas = array();
                $em->transactional(function($em) use ($registroEnfermeria, $form){
                    foreach($form->getData() as $id => $dato){
                        $rta = new \Sirepae\RegistrosEnfermeriaBundle\Entity\Respuesta();
                        $id = explode('-', $id);
                        $preg_id = $id[0];
                        $optRta_id = $id[1];
                        $preg = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Pregunta')->find($preg_id);
                        $optRta = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:OpcionRespuesta')->find($optRta_id);
                        if($optRta->getTipoRespuesta()->getTipoCampo() === 'date' || $optRta->getTipoRespuesta()->getTipoCampo() === 'time' || $optRta->getTipoRespuesta()->getTipoCampo() === 'datetime'){
                            $format = '';
                            if($optRta->getTipoRespuesta()->getTipoCampo() === 'date')
                                $format .= 'Y/m/d';
                            elseif($optRta->getTipoRespuesta()->getTipoCampo() === 'time')
                                $format .= 'H:i:s';
                            else
                                $format .= 'Y/m/d H:i:s';
                            $dato = $dato->format($format);
                        }
                        if($optRta->getTipoRespuesta()->getTipoCampo() === 'choice')
                            $dato = null;
                        $rta
                            ->setOpcionRespuesta($optRta)
                            ->setPregunta($preg)
                            ->setValor($dato);
                        $em->persist($rta);
                        $rtaRe = new \Sirepae\RegistrosEnfermeriaBundle\Entity\RespuestaRegistroEnfermeria();
                        $rtaRe->setRespuesta($rta);
                        $rtaRe->setRegistroEnfermeria($registroEnfermeria);
                        $em->persist($rtaRe);
                    }
                });
                $this->redirect($this->generateUrl('registros_enfermeria'));
            }
            return array(
                'reg' => $registro,
                'entity' => $registroEnfermeria,
                'form' => $form->createView(),
                'active_registrosEnfermeria_resumen'  =>  true,
                'active_edit'  =>  true,
            );
        }
        $this->redirect($this->generateUrl('registro_enfermeria'));
    }
    public function canonicalize($string)
    {
        return null === $string ? null : str_replace(' ','_',mb_convert_case($string, MB_CASE_LOWER, mb_detect_encoding($string)));
    }
    /**
     * @return \Symfony\Component\Form\FormBuilder FormBuilder
     */
    public function constructForm(Registro $registro, \Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria $registroEnfermeria, $btnSubmit = true){
        $form = $this->createFormBuilder();
        foreach($registro->getPreguntas() as $preg){
            $datos = array();
            $datos['label'] = $preg->getEnunciado();
            $tipo_campo = 'choice';
            $id_campo = '';
            if(count($preg->getOpcionesRespuesta()) > 1){
                $opts = array();
                foreach($preg->getOpcionesRespuesta() as $optRta){
                    $opts[$preg->getId().'-'.$optRta->getId()] = $optRta->getEnunciado();
                }
                $datos['choices'] = $opts;
                $id_campo = $preg->getId().'-'.$optRta->getId();
            }else{
                $optRta = $preg->getOpcionesRespuesta()->first();
                $tipo_campo = $optRta->getTipoRespuesta()->getTipoCampo();
                $id_campo = $preg->getId().'-'.$optRta->getId();
            }
            if($tipo_campo === 'date' || $tipo_campo === 'time' || $tipo_campo === 'datetime')
                $datos['data'] = new \DateTime ('now');
            $form->add($id_campo, $tipo_campo, $datos);
        }
        if($btnSubmit){
            $form
                ->setAction($this->generateUrl('guardar_llenar_registro', array('idRegistro' => $registro->getId(), 'idRegistroEnfermeria' => $registroEnfermeria->getId())))
                ->setMethod('POST')
                ->add('submit', 'submit', array('label' => 'Guardar '.$registro->getNombre(), 'attr' => array( 'class' => 'btn-success')))
                ;
        }
        return $form->getForm();
    }
}
