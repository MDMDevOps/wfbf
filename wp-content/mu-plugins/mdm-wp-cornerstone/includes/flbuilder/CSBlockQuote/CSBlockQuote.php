<?php

namespace Mdm\Wp\Cornerstone\FLBuilder\CSBlockQuote;

class CSBlockQuote extends \FLBuilderModule {
	/**
	 * @method __construct
	 */
	public function __construct() {
		/**
		 * Construct our parent class (FLBuilderModule);
		 */
		parent::__construct( [
			'name' => __( 'Block Quote', 'mdm_cornerstone' ),
			'description' => '',
			'category' => __( 'Basic', 'mdm_cornerstone' ),
			'editor_export' => true,
			'partial_refresh' => true,
		]);

		return $this;
	}
	/**
	 * Update data before saving
	 *
	 * Formats the settings passed from beaver builder, into a usable settings
	 * Sets a rel setting for frontend.php
	 * Sets scss variables for frontend.css.php
	 *
	 * @param  [object] $settings : all settings passed from beaver builder
	 * @since version 1.0.0
	 */
	public function update( $settings ) {
		return $settings;
	}
	/**
	 * Register module with fl-builder
	 *
	 * @since  1.0.0
	 */
	public static function register() {
		\FLBuilder::register_module( __CLASS__, [
			'general' => [
				'title' => __( 'General', 'mdm_cornerstone' ),
				'sections' => [
					'general'=> [
						'title' => '',
						'fields' => [
							'quote' => [
								'type' => 'editor',
								'label' => __('Quote Text', 'mdm_cornerstone'),
								'media_buttons' => false,
								'wpautop' => true
							],
							'cite' => [
								'type' => 'text',
								'label' => __('Citation', 'mdm_cornerstone'),
							],
							'quote_typeography' => [
								'type' => 'typography',
								'label' => __('Quote Typography', 'mdm_cornerstone'),
								'responsive' => true,
								'preview' => [
									'type' => 'css',
									'selector' => '.cs-blockquote-container blockquote.cs-blockquote'
								]
							],
							'cite_typeography' => [
								'type' => 'typography',
								'label' => __('Citation Typography', 'mdm_cornerstone'),
								'responsive' => true,
								'preview' => [
									'type' => 'css',
									'selector' => '.cs-blockquote-container figcaption .cite'
								]
							],
						],
					],
				],
			],
		]);
	}
}