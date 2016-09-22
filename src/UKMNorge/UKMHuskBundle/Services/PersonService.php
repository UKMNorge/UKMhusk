<?php
	
namespace UKMNorge\UKMHuskBundle\Services;

class PersonService {
	var $doctrine = null;
	
	public function __construct( $doctrine ) {
		$this->doctrine = $doctrine;
	}
	
	public function getByKommune( $fylke_id, $kommune_id ) {
		$personer = $this->doctrine->getRepository('UKMHuskBundle:Person')->findBy( array('fylke'=>$fylke_id, 'kommune'=>$kommune_id) );
		
		$data = [];
		foreach( $personer as $person ) {
			$data[] = $person->expose();
		}
		return $data;
	}
}