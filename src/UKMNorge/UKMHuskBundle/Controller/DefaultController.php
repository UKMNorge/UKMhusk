<?php

namespace UKMNorge\UKMHuskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use UKMNorge\UKMHuskBundle\Entity\Person;
use DateTime;
use Exception;

class DefaultController extends Controller
{
	public function fakeAction() {
		return $this->redirectToRoute('ukm_husk_kommune', array('fylke'=>0, 'kommune'=>0));
	}
    public function inputAction( $fylke, $kommune )
    {
	    $data = [];
	    $data['kommune'] = $kommune;
	    $data['fylke'] = $fylke;
	    
        return $this->render('UKMHuskBundle:Default:input.html.twig', $data);
    }

    public function saveAction( Request $request, $fylke, $kommune )
    {
	    $session = new Session();	    

	    $data = [];
	    $data['kommune'] = $kommune;

		$mobil = $request->request->get('mobil');
		if( !is_numeric( $mobil ) ) {
			$session->getFlashbag()->add('danger', 'Sorry! Kunne ikke lagre "'. $mobil .'"');
			return $this->redirectToRoute('ukm_husk_kommune', array('kommune'=>$kommune, 'fylke'=>$fylke));
		}
		$em = $this->getDoctrine()->getManager();
		$repo = $this->getDoctrine()->getRepository('UKMHuskBundle:Person');

		$person = $repo->findBy( array('mobil'=>$mobil, 'kommune'=>$kommune) );
		if( !$person ) {
			try {	
				$person = new Person();
				$person->setMobil( $mobil );
				$person->setKommune( $kommune );
				$person->setFylke( $fylke );
				$person->setTimestamp( new DateTime() );
				
				$em->persist( $person );
				$res = $em->flush();
			} catch( Exception $e ) {
				$session->getFlashbag()->add('danger', 'Sorry! Kunne ikke lagre '. $mobil);
				return $this->redirectToRoute('ukm_husk_kommune', array('kommune'=>$kommune, 'fylke'=>$fylke));
			}
		}

	    $session->getFlashbag()->add('success', 'Takk!');
	
        return $this->redirectToRoute('ukm_husk_kommune', array('kommune'=>$kommune, 'fylke'=>$fylke));
	}
}
