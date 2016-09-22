<?php

namespace UKMNorge\UKMHuskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UKMNorge\UKMHuskBundle\Entity\Person;
use DateTime;
use stdClass;

use UKMNorge\APIBundle\Util\Access;

class APIController extends Controller
{
	public function listeAction(Request $request, $fylke, $kommune) {
		$response = new stdClass();
		try {
			$access = $this->getAccessFromRequest($request);	

			if($access->got('readPhones')) {
				$response->success = true;
				$response->data = $this->get('ukm_husk.person')->getByKommune($fylke, $kommune);
			}
			else {
				$response->success = false;
				$response->errors = $access->errors();
				$response->errors[] = 'UKMHuskBundle:APIController: Du har ikke tilgang til å hente ut kommunelister! Det krever "readPhones"-tilgangen.';
			}
			return new JsonResponse($response);
		}
		catch (Exception $e) {
			$response->success = false;
			$response->errors[] = 'UKMHuskBundle:APIController: Det oppsto en feil med feilmeldingen "'.$e->getMessage().'"';
		}
	}
	
	private function getAccessFromRequest($request) {
		try {
			if($request->getMethod() == 'GET') {
				$this->access = new Access($request->query->get('API_KEY'), $this->getParameter('ukmapi.api_key'), $this->getParameter('ukmapi.api_secret'));
				$this->access->validate($request->query->all());
			} 
			else {
				$this->access = new Access($request->request->get('API_KEY'), $this->getParameter('ukmapi.api_key'), $this->getParameter('ukmapi.api_secret'));
				$this->access->validate($request->request->all());
			}
			
			return $this->access;
		}
		catch(Exception $e) {
			// TODO: Do something better here.
			throw new Exception('Die');
		}
	}
}