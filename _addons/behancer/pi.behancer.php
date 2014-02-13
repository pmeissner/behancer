<?php

class Plugin_behancer extends Plugin {

	var $meta = array(
		'name'        => 'Behancer',
		'version'     => '1.1',
		'author'      => 'Philip Meissner',
		'author_url'  => 'http://lou.pe'
	);


	public function project() {

		$beConfig = array();
		$beConfig['client_id'] = $this->fetch('client_id', null, null, false, false);
		$beConfig['client_secret'] = $this->fetch('client_secret', null, null, false, false);

		$project_id = $this->fetchParam('id');

		$yesterday = time() - 60 * 60 * 24;
		$this->cache->purgeFromBefore($yesterday);

		if ($this->cache->exists($project_id . '_project.yaml')) {

			$output = $this->cache->getYAML($project_id . '_project.yaml');

		} else {

			require_once( 'lib/Be/Api.php' );

			$api = new Be_Api( $beConfig['client_id'], $beConfig['client_secret'] );
			$project = $api->getProject($project_id);

			$encoded = json_encode($project);
			$decoded = json_decode($encoded, true);

			$this->cache->putYAML($project_id . '_project.yaml', $decoded);
			$output = $this->cache->getYAML($project_id . '_project.yaml');

		};

		return $output;

	}

	public function listing() {

		$beConfig = array();
		$beConfig['client_id'] = $this->fetch('client_id', null, null, false, false);
		$beConfig['client_secret'] = $this->fetch('client_secret', null, null, false, false);

		$user_id = $this->fetchParam('user');

		$yesterday = time() - 60 * 60 * 24;
		$this->cache->purgeFromBefore($yesterday);

		if ($this->cache->exists($user_id . '_user.yaml')) {

			$output = $this->cache->getYAML($user_id . '_user.yaml');

		} else {

			require_once( 'lib/Be/Api.php' );

			$api = new Be_Api( $beConfig['client_id'], $beConfig['client_secret'] );
			$listing = $api->getUserProjects($user_id);

			$encoded = "{\"listing\":" . json_encode($listing) . "}";
			$decoded = json_decode($encoded, true);

			$this->cache->putYAML($user_id . '_user.yaml', $decoded);
			$output = $this->cache->getYAML($user_id . '_user.yaml');

		};

		return $output;

	}

}
