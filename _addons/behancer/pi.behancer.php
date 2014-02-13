<?php

class Plugin_behancer extends Plugin {

	var $meta = array(
		'name'        => 'Behancer',
		'version'     => '1.1',
		'author'      => 'Philip Meissner',
		'author_url'  => 'http://lou.pe'
	);

	protected $client_id;
	protected $client_secret;

	function __construct() {

		parent::__construct();

		$this->client_id = $this->fetch('client_id', null, null, false, false);
		$this->client_secret = $this->fetch('client_secret', null, null, false, false);

		$yesterday = time() - 60 * 60 * 24;
		$this->cache->purgeFromBefore($yesterday);

	}

	public function project() {

		$project_id = $this->fetchParam('id');

		if ($this->cache->exists($project_id . '_project.yaml')) {

			$output = $this->cache->getYAML($project_id . '_project.yaml');

		} else {

			require_once( 'lib/Be/Api.php' );

			$api = new Be_Api( $this->client_id, $this->client_secret );
			$project = $api->getProject($project_id);

			$encoded = json_encode($project);
			$decoded = json_decode($encoded, true);

			$this->cache->putYAML($project_id . '_project.yaml', $decoded);
			$output = $this->cache->getYAML($project_id . '_project.yaml');

		};

		return $output;

	}

	public function listing() {

		$user_id = $this->fetchParam('user');

		if ($this->cache->exists($user_id . '_user.yaml')) {

			$output = $this->cache->getYAML($user_id . '_user.yaml');

		} else {

			require_once( 'lib/Be/Api.php' );

			$api = new Be_Api( $this->client_id, $this->client_secret );
			$listing = $api->getUserProjects($user_id);

			$encoded = "{\"listing\":" . json_encode($listing) . "}";
			$decoded = json_decode($encoded, true);

			$this->cache->putYAML($user_id . '_user.yaml', $decoded);
			$output = $this->cache->getYAML($user_id . '_user.yaml');

		};

		return $output;

	}

}
