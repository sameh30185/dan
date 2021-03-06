<?php

namespace WPML\ST\AdminTexts;

use WPML\Ajax\ST\AdminText\Register;
use WPML\Collect\Support\Collection;
use WPML\ST\WP\App\Resources;
use function WPML\Container\make;
use WPML\LIB\WP\Hooks as WPHooks;

class UI implements \IWPML_Backend_Action_Loader {

	// shouldShow :: Collection -> bool
	public static function shouldShow( Collection $data ) {
		return $data->get( 'page' ) === WPML_ST_FOLDER . '/menu/string-translation.php' &&
		       (int) $data->get( 'trop' ) === 1;
	}

	public static function localize( Collection $model ) {
		return [
			'name' => 'wpml_admin_strings',
			'data' => [
				'model'    => $model->toArray(),
				'endpoint' => Register::class,
			],
		];
	}

	/**
	 * @return callable|null
	 */
	public function create() {
		if ( self::shouldShow( wpml_collect( $_GET ) ) ) {

			return function() {
				WPHooks::onAction( 'admin_enqueue_scripts' )
					->then( [ make( \WPML_Admin_Texts::class ), 'getModelForRender' ] )
					->then( [ self::class, 'localize' ] )
					->then( Resources::enqueueApp( 'admin-strings' ) );
			};
		}
	}
}
