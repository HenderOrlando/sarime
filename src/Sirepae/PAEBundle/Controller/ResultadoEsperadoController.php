<?php

namespace Sirepae\PAEBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirepae\PAEBundle\Entity\ResultadoEsperado;
use Sirepae\PAEBundle\Form\ResultadoEsperadoType;

/**
 * ResultadoEsperado controller.
 *
 * @Route("/resultado_esperado")
 */
class ResultadoEsperadoController extends Controller
{

    /**
     * Lists all ResultadoEsperado entities.
     *
     * @Route("/", name="resultado_esperado")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SirepaePAEBundle:ResultadoEsperado')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ResultadoEsperado entity.
     *
     * @Route("/", name="resultado_esperado_create")
     * @Method("POST")
     * @Template("SirepaePAEBundle:ResultadoEsperado:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ResultadoEsperado();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('resultado_esperado_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a ResultadoEsperado entity.
    *
    * @param ResultadoEsperado $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ResultadoEsperado $entity)
    {
        $form = $this->createForm(new ResultadoEsperadoType(), $entity, array(
            'action' => $this->generateUrl('resultado_esperado_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ResultadoEsperado entity.
     *
     * @Route("/new", name="resultado_esperado_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ResultadoEsperado();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ResultadoEsperado entity.
     *
     * @Route("/{id}", name="resultado_esperado_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:ResultadoEsperado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ResultadoEsperado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ResultadoEsperado entity.
     *
     * @Route("/{id}/edit", name="resultado_esperado_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:ResultadoEsperado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ResultadoEsperado entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a ResultadoEsperado entity.
    *
    * @param ResultadoEsperado $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ResultadoEsperado $entity)
    {
        $form = $this->createForm(new ResultadoEsperadoType(), $entity, array(
            'action' => $this->generateUrl('resultado_esperado_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ResultadoEsperado entity.
     *
     * @Route("/{id}", name="resultado_esperado_update")
     * @Method("PUT")
     * @Template("SirepaePAEBundle:ResultadoEsperado:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirepaePAEBundle:ResultadoEsperado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ResultadoEsperado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('resultado_esperado_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ResultadoEsperado entity.
     *
     * @Route("/{id}", name="resultado_esperado_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirepaePAEBundle:ResultadoEsperado')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ResultadoEsperado entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('resultado_esperado'));
    }

    /**
     * Creates a form to delete a ResultadoEsperado entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('resultado_esperado_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
