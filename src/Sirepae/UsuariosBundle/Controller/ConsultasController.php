<?php

namespace Sirepae\UsuariosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
//use Sirepae\PAEBundle\Entity;
//use Sirepae\UsuariosBundle\Entity;
//use Sirepae\PracticasBundle\Entity;
//use Sirepae\RegistrosEnfermeriaBundle\Entity;

/**
 * Consultas controller.
 *
 * @Route("/consultas")
 */
class ConsultasController extends Controller
{

    /**
     * Lists all Usuario entities.
     *
     * @Route("/", name="consultas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()->hasRole('ROLE_COORDINADOR') || $this->getUser()->hasRole('ROLE_SUPER_ADMIN')){
            $res = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria')->createQueryBuilder('re')
                    ->join('re.estudiante', 'e')
                    ->join('e.practica', 'p')
                    ->addOrderBy('p.docente', 'ASC')
                    ->addOrderBy('re.fecha_creado', 'DESC')
                    ->setMaxResults(12)
//                    ->groupBy('p.docente')
                    ->getQuery()
                    ->getResult();
            $paes = $em->getRepository('SirepaePAEBundle:PAE')->createQueryBuilder('pae')
                    ->join('pae.estudiante', 'e')
                    ->join('e.practica', 'p')
                    ->addOrderBy('p.docente', 'ASC')
                    ->addOrderBy('pae.fecha_creado', 'DESC')
                    ->setMaxResults(9)
//                    ->groupBy('p.docente')
                    ->getQuery()
                    ->getResult();
            $ps = $em->getRepository('SirepaePracticasBundle:Practica')->findAll();
        }

        return array(
            'res'   => $res,
            'paes'  => $paes,
            'ps'    => $ps,
            'active_consultas_resumen' => true,
        );
    }

    /**
     * Lists all Usuario entities.
     *
     * @Route("/docentes/", name="consulta_docentes")
     * @Method("GET")
     * @Template("SirepaeUsuariosBundle:Consultas:docentes.html.twig")
     */
    public function docentesAction()
    {
        
        $entities = $this->getAreas();
        $docentes = array();
        foreach($entities as $area){
            foreach($area->getPracticas() as $practica){
                $docentes[$practica->getDocente()->getId()] = $practica->getDocente();
            }
        }
        
        return array(
            'entities' => $entities,
            'docentes' => $docentes,
            'active_consulta_docentes_resumen' => true,
        );
    }

    /**
     * Consulta del uso del sistema
     *
     * @Route("/uso-de-sistema/", name="consulta_uso")
     * @Method("GET")
     * @Template("SirepaeUsuariosBundle:Consultas:usoSistema.html.twig")
     */
    public function usoSistemaAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $ahora = new \DateTime('now');
        $_mes = new \DateTime('now');
        $_dia = new \DateTime('now');
        $_semana = new \DateTime('now');
        $_semestre = new \DateTime('now');
        $_mes = "'".$_mes->sub(new \DateInterval('P1M'))->format('Y-m-d H:i:s')."'";
        $_dia = "'".$_dia->format('Y-m-d 00:00:00')."'";
        $_semana = "'".$_semana->sub(new \DateInterval('P6D'))->format('Y-m-d H:i:s')."'";
        $_semestre = "'".$_semestre->sub(new \DateInterval('P6M'))->format('Y-m-d H:i:s')."'";
        $ahora = "'".$ahora->format('Y-m-d H:i:s')."'";
        /*Ingresos al sistema*/
        $qu = $this->getUsuariosRepository()->findAll();
        $qu_semestre = $this->getUsuariosRepository()->getUsuariosBetween('lastLogin', $_semestre, $ahora);
        $qu_mes = $this->getUsuariosRepository()->getUsuariosBetween('lastLogin', $_mes, $ahora);
        $qu_semana = $this->getUsuariosRepository()->getUsuariosBetween('lastLogin', $_semana, $ahora);
        $qu_dia = $this->getUsuariosRepository()->getUsuariosBetween('lastLogin', $_dia, $ahora);
        
        
        /*Registros de Enfermería*/
        $qre = $this->getRegistrosEnfermeriaRepository()->findAll();
        $qre_semestre = $this->getRegistrosEnfermeriaRepository()->getRegistrosEnfermeriaBetween('fecha_creado', $_semestre, $ahora);
        $qre_mes = $this->getRegistrosEnfermeriaRepository()->getRegistrosEnfermeriaBetween('fecha_creado', $_mes, $ahora);
        $qre_semana = $this->getRegistrosEnfermeriaRepository()->getRegistrosEnfermeriaBetween('fecha_creado', $_semana, $ahora);
        $qre_dia = $this->getRegistrosEnfermeriaRepository()->getRegistrosEnfermeriaBetween('fecha_creado', $_dia, $ahora);
        $pacientes = [];
        $estudiantes = [];
        
        $qre_reg = $em->getRepository('SirepaeRegistrosEnfermeriaBundle:Registro')->getRegistrosUsados();
        
        foreach($qre as $re){
            if(!key_exists($re->getPaciente()->getId(), $pacientes)){
                $pacientes[$re->getPaciente()->getId()] = $re->getPaciente();
            }
            if(!key_exists($re->getEstudiante()->getId(), $estudiantes)){
                $estudiantes[$re->getEstudiante()->getId()] = $re->getEstudiante();
            }
        }
        
        /*Procesos de Atención de Enfermería*/
        $qpae = $this->getPAERepository()->findAll();
        $q_libros = new \Doctrine\Common\Collections\ArrayCollection(
                array_merge($em->getRepository('SirepaePAEBundle:NIC')->findAll(), $em->getRepository('SirepaePAEBundle:NANDA')->findAll(), $em->getRepository('SirepaePAEBundle:NOC')->findAll())
        );
        $qpae_actividades = $this->getPAERepository()->getActividadesPAE();
        $qpae_indicadores = $this->getPAERepository()->getIndicadoresPAE();
        $qpae_diagnosticos = $this->getPAERepository()->getDiagnosticosPAE();
        $qpae_semestre = $this->getPAERepository()->getPAEsBetween('fecha_creado', $_semestre, $ahora);
        $qpae_mes = $this->getPAERepository()->getPaesBetween('fecha_creado', $_mes, $ahora);
        $qpae_semana = $this->getPAERepository()->getPaesBetween('fecha_creado', $_semana, $ahora);
        $qpae_dia = $this->getPAERepository()->getPaesBetween('fecha_creado', $_dia, $ahora);
        
        return array(
            'ingresos'  =>  array(
                'semestre'  =>  $qu_semestre,
                'semana'    =>  $qu_semana,
                'mes'       =>  $qu_mes,
                'dia'       =>  $qu_dia,
                'total'     =>  $qu,
            ),
            'registros'  =>  array(
                'semestre'  =>  $qre_semestre,
                'semana'    =>  $qre_semana,
                'mes'       =>  $qre_mes,
                'dia'       =>  $qre_dia,
                'total'     =>  array(
                    'registros'             =>  $qre_reg,
                    'pacientes'             =>  $pacientes,
                    'estudiantes'           =>  $estudiantes,
                    'registrosEnfermeria'   =>  $qre,
                ),
            ),
            'paes'  =>  array(
                'semestre'  =>  $qpae_semestre,
                'semana'    =>  $qpae_semana,
                'mes'       =>  $qpae_mes,
                'dia'       =>  $qpae_dia,
                'total'     =>  array(
                    'paes'          =>  $qpae,
                    'libros'        =>  $q_libros,
                    'actividades'   =>  $qpae_actividades,
                    'indicadores'   =>  $qpae_indicadores,
                    'diagnosticos'   =>  $qpae_diagnosticos,
                ),
            ),
            'active_consulta_uso_resumen' => true,
        );
    }

    /**
     * Consulta del pae
     *
     * @Route("/procesos-de-atencion-de-enfermeria-inferiores-a/{menor}/", name="consulta_pae_menor")
     * @Route("/procesos-de-atencion-de-enfermeria-superiores-a/{mayor}/", name="consulta_pae_mayor")
     * @Route("/procesos-de-atencion-de-enfermeria-superiores/form/", name="consulta_pae_form")
     * @Route("/procesos-de-atencion-de-enfermeria-superiores/", name="consulta_pae")
     * @Method("GET")
     * @Template("SirepaeUsuariosBundle:Consultas:paeConsulta.html.twig")
     */
    public function paesConsultaAction(Request $request, $mayor = null, $menor = null)
    {
        $routeName = $request->get('_route');
        $form = $this->createFormBuilder(null,array('attr'   => array(
                'class' =>  'form-all-inline'
            )))
            ->add('mayor', 'number', array(
                'label' => false, 
                'required' => false, 
                'attr' => array( 
                    'class' => '', 
                    'Placeholder' => 'Mayor que'
                    )
                )
            )
            ->add('menor', 'number', array(
                'label' => false, 
                'required' => false, 
                'attr' => array( 
                    'class' => '', 
                    'Placeholder' => 'Menor que'
                    )
                )
            )
            ->setAction($this->generateUrl('consulta_pae_form'))
            ->setMethod('GET')
            ->add('submit', 'submit', array('label' => 'Buscar', 'attr' => array( 'class' => 'btn-success btn-lg')))
            ->getForm()
        ;
        if(strpos($routeName, 'form') !== false){
            $form->handleRequest($request);
            if ($form->isValid()){
                $datos = $form->getData();
                $valor = 4.5;
                $param = 'mayor';
                if(is_null($datos['menor'])){
                    $valor = $datos['mayor'];
                    $param = 'mayor';
                }elseif(is_null($datos['mayor'])){
                    $param = 'menor';
                    $valor = $datos['menor'];
                }
                return $this->redirect($this->generateUrl('consulta_pae_'.$param, array(
                    $param =>  $valor,
                )));
            }
        }
        $entities = $this->getPAERepository()->createQueryBuilder('pae')
                ->join('pae.calificacion', 'c');
        $valor = 4.5;
        $mayor_ = true;
        $signo = '>';
        if(!is_numeric($mayor) && is_numeric($menor)){
            $signo = '<';
            $mayor_ = false;
            $valor = (float)$menor;
        }elseif(is_numeric($mayor) && !is_numeric($menor)){
            $valor = (float)$mayor;
        }
        $entities->andWhere ('c.valor'.$signo.$valor);
        
        return array(
            'form'     =>  $form->createView(),
            'mayor'     =>  $mayor_,
            'valor'     =>  $valor,
            'entities' => $entities->getQuery()->getResult(),
            'active_consulta_pae_sup_resumen' => true,
        );
    }

    /**
     * Consulta del pae
     *
     * @Route("/procesos-de-atencion-de-enfermeria/diagnósticos/", name="consulta_pae_diagnostico")
     * @Method("GET")
     * @Template("SirepaeUsuariosBundle:Consultas:paeDiagnostico.html.twig")
     */
    public function paesDiagnosticosAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('SirepaePAEBundle:PAE')->findAllPaesGroupByDiagnostico($this->getUser()->getId());
        
        return array(
            'entities' => $entities,
            'active_consulta_pae_diagnostico_resumen' => true,
        );
    }

    /**
     * Consulta del pae
     *
     * @Route("/estudiantes/", name="consulta_estudiantes")
     * @Method("GET")
     * @Template("SirepaeUsuariosBundle:Consultas:estudiantes.html.twig")
     */
    public function estudiantesAction()
    {
        $entities = $this->getAreas();
        
        return array(
            'entities' => $entities,
            'active_consulta_estudiantes_resumen' => true,
        );
    }
    
    private function getAreas($qb = false){
        $a = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('SirepaePracticasBundle:Area')->createQueryBuilder('a')
                ->join('a.practicas','p')
//                ->join('a.sitios','s')
                ;
        if($this->getUser()->hasRole('ROLE_COORDINADOR')){
            $a = $a->andWhere('p.coordinador = '.$this->getUser()->getId());
        }elseif(!$this->getUser()->hasRole('ROLE_SUPER_ADMIN')){
            $a = array();
        }
        if($qb)
            return $a;
        return $a->getQuery()->getResult();
    }
    /**
     * @return \Sirepae\PAEBundle\Repository\PAERepository PAERepository
     */
    public function getPAERepository(){
        return $this->getDoctrine()->getRepository('SirepaePAEBundle:PAE');
    }
    /**
     * @return \Sirepae\RegistrosEnfermeriaBundle\Repository\EstudianteRepository PAERepository
     */
    public function getEstudianteRepository(){
        return $this->getDoctrine()->getRepository('SirepaeRegistrosEnfermeriaBundle:Estudiante');
    }
    /**
     * @return \Sirepae\RegistrosEnfermeriaBundle\Repository\RegistroEnfermeriaRepository PAERepository
     */
    public function getRegistrosEnfermeriaRepository(){
        return $this->getDoctrine()->getRepository('SirepaeRegistrosEnfermeriaBundle:RegistroEnfermeria');
    }
    /**
     * @return \Sirepae\UsuariosBundle\Repository\UsuarioRepository UsuarioRepository
     */
    public function getUsuariosRepository(){
        return $this->getDoctrine()->getRepository('SirepaeUsuariosBundle:Usuario');
    }
}
