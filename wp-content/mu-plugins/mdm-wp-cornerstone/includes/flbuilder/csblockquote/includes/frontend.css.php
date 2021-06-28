<?php

\FLBuilderCSS::typography_field_rule( [
	'settings' => $settings,
	'setting_name' => 'quote_typeography',
	'selector' => ".fl-node-$id .cs-blockquote-container blockquote.cs-blockquote",
] );

\FLBuilderCSS::typography_field_rule( [
	'settings' => $settings,
	'setting_name' => 'cite_typeography',
	'selector' => ".fl-node-$id .cs-blockquote-container figcaption",
] );