<?php

namespace Tests\Models;

use Helium\LaravelHelpers\Contracts\HasAdmins;
use Helium\LaravelHelpers\Traits\SelfValidates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Tests\Enums\Color;

class TestHasAdminsModel extends User implements HasAdmins
{
	protected $guarded = [];

	public function isAdmin(): bool
	{
		return $this->admin;
	}
}