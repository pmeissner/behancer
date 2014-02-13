<?php

class Plugin_behancer extends Plugin {

	var $meta = array(
		'name'      	=> 'Behancer',
		'version'    	=> '1',
		'author'     	=> 'Philip Meissner',
		'author_url' 	=> 'http://lou.pe'
	);

	public function index() {

		$beConfig = array();
		$beConfig['client_id'] = $this->fetch('client_id', null, null, false, false);
		$beConfig['client_secret'] = $this->fetch('client_secret', null, null, false, false);

		$project_id  = $this->fetchParam('id');

		require_once( 'lib/Be/Api.php' );

		$api = new Be_Api( $beConfig['client_id'], $beConfig['client_secret'] );

		$project = $api->getProject($project_id);

		$encoded = json_encode($project);
		$decoded = json_decode($encoded, true);

		$yesterday = time() - 60 * 60 * 24;
		$this->cache->purgeFromBefore($yesterday);

		if ($this->cache->exists($project_id . '_content.yaml')) {

			$output = $this->cache->getYAML($project_id . '_content.yaml');

		} else {

			$this->cache->putYAML($project_id . '_content.yaml', $decoded);
			$output = $this->cache->getYAML($project_id . '_content.yaml');

		};

		return $output;

	}
}
