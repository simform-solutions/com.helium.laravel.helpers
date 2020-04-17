<?php

namespace Helium\LaravelHelpers\Helpers;

use Helium\LaravelHelpers\Contracts\HasAdmins;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PolicyHelper
{
	public static function isSelf(Authenticatable $user)
	{
		return $user->getAuthIdentifier() == Auth::user()->getAuthIdentifier();
	}

	public static function isAdmin(HasAdmins $user)
	{
		return $user->isAdmin();
	}

	public static function isAdminOrSelf($user)
	{
		/**
		 * Note: This call may throw a TypeError if $user does not implement both
		 * Authenticatable and HasAdmins. This error is purposefully not caught
		 * to enforce proper usage of this helper function.
		 */
		return self::isSelf($user) || self::isAdmin($user);
	}
}