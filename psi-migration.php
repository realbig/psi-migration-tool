<?php

/*
 * Plugin Name: PSI Migration
 * Description: Performs a migration of PSI data.
 * Version: 0.1.0
 * Author: Real Big Marketing
 * Author URI: http://realbigmarketing.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PSI_Migration {

	private $admin;
	private $migrate;

	function __construct() {

		$this->setup();
	}

	private function setup() {

		require_once __DIR__ . '/includes/psi-migrate-functions.php';
		require_once __DIR__ . '/includes/class-psi-migrate.php';

		require_once __DIR__ . '/includes/class-psi-migration-admin.php';
		$this->admin = new PSI_Migration_Admin();

		// Migrate
		if ( isset( $_POST['psi-perform-migration'] ) ) {
			$this->migrate = new PSI_Migrate();
		}
	}
}

new PSI_Migration();