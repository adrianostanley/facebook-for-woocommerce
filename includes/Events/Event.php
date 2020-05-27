<?php
/**
 * Copyright (c) Facebook, Inc. and its affiliates. All Rights Reserved
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 *
 * @package FacebookCommerce
 */

namespace SkyVerge\WooCommerce\Facebook\Events;

defined( 'ABSPATH' ) or exit;

/**
 * Event object.
 *
 * @since 2.0.0-dev.1
 */
class Event {


	/**
	 * @var array data specific to this event instance with the same structure as the event’s payload
	 *
	 * @see https://developers.facebook.com/docs/marketing-api/server-side-api/payload-helper
	 */
	protected $data = [];


	/**
	 * Constructor.
	 *
	 * @see https://developers.facebook.com/docs/marketing-api/server-side-api/parameters
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @param array $data event data
	 */
	public function __construct( $data ) {

		$this->prepare_data( $data );
	}


	/**
	 * Provides defaults for properties if not already defined.
	 *
	 * @see https://developers.facebook.com/docs/marketing-api/server-side-api/parameters/server-event
	 * @see https://developers.facebook.com/docs/marketing-api/server-side-api/parameters/custom-data
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @param array $data event data
	 */
	protected function prepare_data( $data ) {

		$this->data = wp_parse_args( $data, [
			'event_time'       => time(),
			'event_id'         => $this->generate_event_id(),
			'event_source_url' => $this->get_current_url(),
			'custom_data'      => [],
			'user_data'        => [],
		] );

		$this->prepare_user_data( $this->data['user_data'] );
	}


	/**
	 * Provides defaults for user properties if not already defined.
	 *
	 * @see https://developers.facebook.com/docs/marketing-api/server-side-api/parameters/user-data
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @param array $data user data
	 */
	protected function prepare_user_data( $data ) {

		$this->data['user_data'] = wp_parse_args( $data, [
			'client_ip_address' => $this->get_client_ip(),
			'client_user_agent' => $this->get_client_user_agent(),
			'click_id'          => $this->get_click_id(),
			'browser_id'        => $this->get_browser_id(),
		] );
	}


	/**
	 * Generates a unique ID for the event.
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @return string
	 */
	protected function generate_event_id() {

		// TODO: implement
		return '';
	}


	/**
	 * Gets the current URL.
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @return string
	 */
	protected function get_current_url() {

		// TODO: implement
		return '';
	}


	/**
	 * Gets the client IP address.
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @return string
	 */
	protected function get_client_ip() {

		// TODO: implement
		return '';
	}


	/**
	 * Gets the client user agent.
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @return string
	 */
	protected function get_client_user_agent() {

		// TODO: implement
		return '';
	}


	/**
	 * Gets the click ID from the cookie or the query parameter.
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @return string
	 */
	protected function get_click_id() {

		// TODO: implement
		return '';
	}


	/**
	 * Gets the browser ID from the cookie.
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @return string
	 */
	protected function get_browser_id() {

		// TODO: implement
		return '';
	}


	/**
	 * Gets the data.
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @return array
	 */
	public function get_data() {

		return $this->data;
	}


	/**
	 * Gets the event ID.
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @return string
	 */
	public function get_id() {

		return ! empty( $this->data['event_id'] ) ? $this->data['event_id'] : '';
	}


	/**
	 * Gets the event name.
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @return string
	 */
	public function get_name() {

		return ! empty( $this->data['event_name'] ) ? $this->data['event_name'] : '';
	}


	/**
	 * Gets the user data.
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @return array
	 */
	public function get_user_data() {

		return ! empty( $this->data['user_data'] ) ? $this->data['user_data'] : [];
	}


	/**
	 * Gets the event custom data.
	 *
	 * @since 2.0.0-dev.1
	 *
	 * @return array
	 */
	public function get_custom_data() {

		return ! empty( $this->data['custom_data'] ) ? $this->data['custom_data'] : [];
	}


}
