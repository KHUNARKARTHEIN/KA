<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   SOFTLAB24 LIMITED, COMMERCIAL LICENSE  https://www.softlab24.com/license/commercial-license-v1
 * @link      https://www.softlab24.com/
 */
$options = array(
		array(
				'field_name' => 'birthdate',
				'field_placeholder' => 'birthdate',
				'field_options' => false,
				'field_type' => 'text',
				'show_on_signup' => 'yes',
				'is_required' => 'yes',
				'show_label' => 'no',
				'show_on_about' => 'yes'
		),
		array(
				'field_name' => 'gender',
				'field_placeholder' => 'gender',
				'field_options' => "male, female",
				'field_type' => 'radio',
				'show_on_signup' => 'yes',
				'is_required' => 'yes',
				'show_label' => 'no',
				'show_on_about' => 'yes'
		)
);

foreach ($options as $option) {
		$fields = new CustomFields(array(
				$option
		));
		$fields->addField();
}
$init = new OssnComponents;
$ini  = array(
		'init' => true
);
if ($init->setSettings('CustomFields', $ini)) {
		ossn_trigger_message(ossn_print('customfield:fields:initlized'));
		redirect(REF);
}
redirect(REF);