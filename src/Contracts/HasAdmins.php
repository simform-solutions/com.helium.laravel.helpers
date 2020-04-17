<?php

namespace Helium\LaravelHelpers\Contracts;

interface HasAdmins
{
	public function isAdmin(): bool;
}