<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy {
	use HandlesAuthorization;

	public function update($user, $post) {
		# user autentificado / user a editar

		/**
		 * Solamente podremos editar un post si somos el autor o un admin
		 */
		return $user->isAuthor($post) || $user->isAdmin();
	}
}
