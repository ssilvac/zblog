<?php

namespace App;

class AccessHandler {

	protected static $hierarchy = [
		'admin' => 100,
		'editor' => 50,
		'user' => 10,
	];

	public static function check($userRole, $requiredRole) {

		return static::$hierarchy[$userRole] >= static::$hierarchy[$requiredRole];

	}
}