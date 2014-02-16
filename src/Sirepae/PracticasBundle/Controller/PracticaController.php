<?php

namespace Sirepae\PracticasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PracticasBundle\Entity\Practica;
use Sirepae\PracticasBundle\Form\PracticaType;

/**
 * Practica controller.
 *
 * @Route("/practica")
 */
class PracticaController extends Controller
{

    /**
     * Lists all Practica entities.
     *
     * @Route("/", name="practica")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePracticasBundle:Practica')->createQueryBuilder('p')
                ->orderBy('p.fecha_creado','DESC');
        if($this->getUser()->hasRole('ROLE_COORDINADOR')){
            $entities->andWhere('p.coordinador = '.$this->getUser()->getId());
        }elseif(!$this->getUser()->hasRole('ROLE_SUPER_ADMIN')){
            throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException();
        }
        $entities = $entities->getQuery()->getResult();

        return array(
            'entities' => $entities,
            'active_practicas_resumen'  =>  true,
        );
    }
    /**
     * Creates a new Practica entity.
     *
     * @Route("/", name="practica_create")
     * @Method("POST")
     * @Template("SirepaePracticasBundle:Practica:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Practica();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('practica', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_practicas_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
    * Creates a form to create a Practica entity.
    *
    * @param Practica $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Practica $entity)
    {
        $form = $this->createForm(new PracticaType($this->getUser()), $entity, array(
            'action' => $this->generateUrl('practica_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Practica entity.
     *
     * @Route("/new", name="practica_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Practica();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'active_practicas_resumen'  =>  true,
            'active_new'  =>  true,
        );
    }

    /**
     * Finds and displays a Practica entity.
     *
     * @Route("/{id}", name="practica_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePracticasBundle:Practica')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Practica entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'active_practicas_resumen'  =>  true,
            'active_ver'  =>  true,
        );
    }

    /**
     * Displays a form to edit an existing Practica entity.
     *
     * @Route("/{id}/edit", name="practica_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePracticasBundle:Practica')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Practica entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_practicas_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }

    /**
    * Creates a form to edit a Practica entity.
    *
    * @param Practica $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Practica $entity)
    {
        $form = $this->createForm(new PracticaType($this->getUser()), $entity, array(
            'action' => $this->generateUrl('practica_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array( 'class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Practica entity.
     *
     * @Route("/{id}", name="practica_update")
     * @Method("PUT")
     * @Template("SirepaePracticasBundle:Practica:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePracticasBundle:Practica')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Practica entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('practica_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active_practicas_resumen'  =>  true,
            'active_edit'  =>  true,
        );
    }
    /**
     * Deletes a Practica entity.
     *
     * @Route("/{id}", name="practica_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePracticasBundle:Practica')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Practica entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('practica'));
    }

    /**
     * Creates a form to delete a Practica entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('practica_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar', 'attr' => array( 'class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
