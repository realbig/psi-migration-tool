<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PSI_Migrate {

	// index, source_type, source, article_source, article_source_keywords

	// material_type, publisher, author, full_text, year, keywords

	private $tables;

	function __construct() {

		$this->setup();
		$this->create_tables();
		$this->migrate_existing_columns();
	}

	private function setup() {
		$this->tables = psi_tables();
	}

	public static function table_exists( $table ) {

		/** @var wpdb $wpdb */
		global $wpdb;

		return $wpdb->get_var( "SHOW TABLES LIKE '$table'" ) != $table ? false : true;
	}

	public static function column_exists( $table, $column ) {

		/** @var wpdb $wpdb */
		global $wpdb;

		$test = $wpdb->get_col(
			"
			SELECT *
			FROM information_schema.COLUMNS
			WHERE
				TABLE_NAME = '{$table}'
			AND COLUMN_NAME = '{$column}'
			"
		);

		return ! empty( $test ) ? true : false;
	}

	private function create_tables() {

		/** @var wpdb $wpdb */
		global $wpdb;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$charset_collate = $wpdb->get_charset_collate();

		foreach ( $this->tables as $ID => $table ) {

			if ( self::table_exists( $ID ) ) {
				continue;
			}

			dbDelta( $table['query'] );
		}
	}

	private function migrate_existing_columns() {

		/** @var wpdb $wpdb */
		global $wpdb;

		foreach ( psi_tables() as $ID => $table ) {

			if ( ! isset( $table['column'] ) ) {
				continue;
			}

			$column = str_replace( 'tbl', '', $ID );

			if ( self::column_exists( 'articles', $column ) ) {

				// Get all rows from the column
				$results = $wpdb->get_col(
					"
					SELECT articles.$column
					FROM articles
					"
				);

				if ( empty( $results ) ) {
					continue;
				}

				$new_column = $table['column'];
				$results    = array_unique( $results );

				foreach ( $results as $result ) {

					if ( ! $result ) {
						continue;
					}

					$wpdb->insert( $ID, array(
						$new_column => $result,
					) );
				}
			}
		}
	}

	private function migrate_articles() {

	}
}