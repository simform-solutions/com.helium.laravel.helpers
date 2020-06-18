<?php

namespace Tests\TestModels;

use Helium\LaravelHelpers\Traits\BulkActions;
use Helium\LaravelHelpers\Traits\DefaultOrdering;
use Helium\LaravelHelpers\Traits\GeneratesPrimaryKey;
use Tests\TestModels\Base\TestModel;

class TestBulkActionsModel extends TestModel
{
	use BulkActions;

	protected $fillable = [
		'data'
	];

	public $firedSaving = false;
	public $firedUpdating = false;
	public $firedCreating = false;
	public $firedSaved = false;
	public $firedUpdated = false;
	public $firedCreated = false;

	protected static function boot()
	{
		parent::boot();

		self::saving(function (TestBulkActionsModel $model) {
			$model->firedSaving = true;
		});

		self::updating(function (TestBulkActionsModel $model) {
			$model->firedUpdating = true;
		});

		self::creating(function (TestBulkActionsModel $model) {
			$model->firedCreating = true;
		});

		self::saved(function (TestBulkActionsModel $model) {
			$model->firedSaved = true;
		});

		self::updated(function (TestBulkActionsModel $model) {
			$model->firedUpdated = true;
		});

		self::created(function (TestBulkActionsModel $model) {
			$model->firedCreated = true;
		});
	}
}