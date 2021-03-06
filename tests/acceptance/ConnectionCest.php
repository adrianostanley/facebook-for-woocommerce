<?php

use SkyVerge\WooCommerce\Facebook\Handlers\Connection;

class ConnectionCest {


	/** @see Connection::handle_connect() */
	public function try_handle_connect_as_guest( AcceptanceTester $I ) {

		$I->wantTo( 'Ensure the token is not stored by the callback for guests' );

		$I->amOnUrl( add_query_arg( 'access_token', 'xyz', facebook_for_woocommerce()->get_connection_handler()->get_redirect_url() ) );

		$I->dontHaveOptionInDatabase( Connection::OPTION_ACCESS_TOKEN );
		$I->see( '-1' );
	}


	/** @see Connection::handle_connect() */
	public function try_handle_connect_with_bad_nonce( AcceptanceTester $I ) {

		$I->wantTo( 'Ensure the token is not stored by the callback with an invalid nonce' );

		$I->loginAsAdmin();

		$url = add_query_arg( 'access_token', 'xyz', facebook_for_woocommerce()->get_connection_handler()->get_redirect_url() );

		// override the nonce with a fake
		$url = add_query_arg( 'nonce', 'bad-nonce', $url );

		$I->amOnUrl( $url );

		$I->dontHaveOptionInDatabase( Connection::OPTION_ACCESS_TOKEN );
	}


	/** @see Connection::handle_connect() */
	public function try_handle_connect_with_no_token( AcceptanceTester $I ) {

		$I->wantTo( 'Ensure the callback halts if the access token is missing' );

		$I->loginAsAdmin();

		$I->amOnUrl( facebook_for_woocommerce()->get_connection_handler()->get_redirect_url() );

		$I->dontHaveOptionInDatabase( Connection::OPTION_ACCESS_TOKEN );
	}


	/** @see Connection::handle_connect() */
	public function try_handle_connect( AcceptanceTester $I ) {

		$I->wantTo( 'Ensure the callback stores the token if everything passes security checks' );

		$I->loginAsAdmin();

		$I->amOnUrl( add_query_arg( 'access_token', 'xyz', facebook_for_woocommerce()->get_connection_handler()->get_redirect_url() ) );

		$I->haveOptionInDatabase( Connection::OPTION_ACCESS_TOKEN, 'xyz' );
	}


}
