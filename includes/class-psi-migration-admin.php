<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PSI_Migration_Admin {

	private $migrated = false;

	function __construct() {

		$this->add_actions();
		$this->setup();
	}

	private function add_actions() {
		add_action( 'admin_menu', array( $this, '_create_admin_page' ) );
	}

	private function setup() {

		/** @var wpdb $wpdb */
		global $wpdb;

		$migrated_tables = array();
		foreach ( psi_tables() as $ID => $table ) {

			if ( PSI_Migrate::table_exists( $ID ) ) {
				$migrated_tables[] = $ID;
			}
		}

		if ( count( $migrated_tables ) === 0 ) {
			$this->migrated = 'none';
		} elseif ( count( $migrated_tables ) < count( psi_tables() ) ) {
			$this->migrated = 'partial';
		} else {
			$this->migrated = 'complete';
		}
	}

	function _create_admin_page() {

		add_menu_page(
			'PSI Migration',
			'PSI Migraiton',
			'manage_options',
			'psi-migration',
			array( $this, 'admin_page' )
		);
	}

	function admin_page() {
		?>
		<div class="wrap">

			<h2>PSI Migration Tool</h2>

			<p class="description">
				This tool will migrate PSI data to the new database structure.
			</p>

			<p>
				Status: <code>
					<?php
					switch ( $this->migrated ) {
						case 'none':
							echo 'Not migrated';
							break;
						case 'partial':
							echo 'Paritally migrated';
							break;
						case 'complete':
							echo 'Migration complete';
							break;
					}
					?>
				</code>
			</p>

			<form method="post">
				<input type="submit" class="button" name="psi-perform-migration" value="Perform Migration" />
			</form>
		</div>
	<?php
	}
}