<?php

namespace Sirepae\RegistrosEnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\RegistrosEnfermeriaBundle\Entity\Nota;
use Sirepae\RegistrosEnfermeriaBundle\Form\NotaType;

/**
 * Nota controller.
 *
 * @Route("/nota")
 */
class NotaController extends Controller
{

    /**
     * Lists all Nota entities.
     *
     * @Route("/registro-enfermeria/{id}/", name="nota_registro")
     * @Route("/usuario/{usuario}/", name="nota_usuario")
     * @Route("/usuario/{usuario}/registro-enfermeria/{id}/", name="nota_usuario_registro")
     * @Route("/", name="nota")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($id = null)
    {
        $em = $this->getDoctrine()->getManager();
        
        $re = null;
        $entities = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Nota')
                ->createQueryBuilder('n')
                ->orderBy('n.fecha_creado', 'DESC');
        if(!is_null($id)){
            $entities->andWhere('n.registroEnfermeria ='.$id);
            $re = $this->getDoctrine ()->getManager ()->getRepository ('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->find($id);
        }
        if($this->getUser()->hasRole('ROLE_ESTUDIANTE') || $this->getUser()->hasRole('ROLE_DOCENTE') || $this->getUser()->hasRole('ROLE_COORDINADOR')){
            $registros = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')
                ->createQueryBuilder('re')
                ->join('re.estudiante','e')
                ->where('e.usuario = '.$this->getUser()->getId())
                ->orderBy('re.fecha_creado', 'DESC');
            if(is_null($id)){
                $entities->orWhere($entities->expr()->In('n.registroEnfermeria', $registros->getDQL()));
            }
            $entities->orWhere('n.usuario = '.$this->getUser()->getId());
        }else{
            throw new \Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException();
        }
        return array(
            'entities'              =>  $entities->getQuery()->getResult(),
            'id_re'                 =>  $id,
            're'                    =>  $re,
            'active_notas_resumen'  =>  true
        );
    }
    /**
     * Creates a new Nota entity.
     *
     * @Route("/", name="nota_create")
     * @Method("POST")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Nota:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Nota();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('registros_enfermeria_edit',array('id' => $entity->getRegistroEnfermeria()->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_notas_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Nota entity.
    *
    * @param Nota $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Nota $entity, \Sirepae\RegistrosEnfermeriaBundle\Entity\RegistroEnfermeria $re = null)
    {
        $form = $this->createForm(new NotaType($re, $this->getUser()), $entity, array(
            'action' => $this->generateUrl('nota_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Nota entity.
     *
     * @Route("/add-registro-enfermeria/{id}/", name="nota_new_registro_enfermeria")
     * @Route("/new/", name="nota_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction( $id = null)
    {
        $entity = new Nota();
        $re = null;
        if(!is_null($id))
            $re = $this->getDoctrine ()->getManager ()->getRepository ('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->find ($id);
        if($re)
            $entity->setRegistroEnfermeria($re);
        $form   = $this->createCreateForm($entity, $re);

        return array(
            'entity' => $entity,
            're'     => $re,
            'form'   => $form->createView(),
            'active_notas_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Nota entity.
     *
     * @Route("/{id}/", name="nota_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Nota')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nota entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_notas_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Nota entity.
     *
     * @Route("/{id}/edit", name="nota_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Nota')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nota entity.');
        }
        if(!$this->getUser()->hasRole('ROLE_SUPER_ADMIN') && $entity->getUsuario()->getId() != $this->getUser()->getId()){
            throw new \Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException();
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_notas_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Nota entity.
    *
    * @param Nota $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Nota $entity)
    {
        $form = $this->createForm(new NotaType(null,$this->getUser()), $entity, array(
            'action' => $this->generateUrl('nota_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Nota entity.
     *
     * @Route("/{id}", name="nota_update")
     * @Method("PUT")
     * @Template("SirepaeRegistrosEnfermeriaBundle:Nota:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Nota')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nota entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('nota_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_notas_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a Nota entity.
     *
     * @Route("/{id}", name="nota_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Nota')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Nota entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nota'));
    }

    /**
     * Creates a form to delete a Nota entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nota_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
