<?php

class LOOS_HCB_Activation {

	/**
	 * 外部からのインスタンス化を防ぐ
	 */
	private function __construct() {}


	/**
	 * Function for the plugin activated.
	 */
	public static function plugin_activate() {

		if ( get_option( LOOS_HCB::DB_NAME[ 'installed' ] ) === false ) {

			update_option( LOOS_HCB::DB_NAME[ 'installed' ], 1 );
			
			//初回・再インストール時 -> デフォルト設定
			$settings = LOOS_HCB::DEFAULT_SETTINGS;

		} else {

			//データが残っている場合 -> 既存設定
			$settings = get_option( LOOS_HCB::DB_NAME[ 'settings' ] );

		}

		//DB更新
		update_option( LOOS_HCB::DB_NAME[ 'settings' ], $settings );

	}


	/**
	 * Function for the plugin deactivated.
	 */
	public static function plugin_deactivate() {}


	/**
	 * Function for the plugin uninstalled.
	 */
	public static function plugin_uninstall() {
		foreach ( LOOS_HCB::DB_NAME as $db_name ) {
			delete_option( $db_name );
		}
	}
}
