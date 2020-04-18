<?php

namespace Tests\UnitTests;

use Helium\LaravelHelpers\Exceptions\EnumException;
use Tests\Enums\Color;
use Tests\Models\TestHasEnumsModel;
use Tests\TestCase;

class HasEnumsTest extends TestCase
{
	protected const FAVORITE_COLOR_DEFAULT = Color::PURPLE;
	protected const FAVORITE_PRIMARY_COLOR_DEFAULT = Color::BLUE;

	protected function getInstance(): TestHasEnumsModel
	{
		return factory(TestHasEnumsModel::class)->create([
			'favorite_color' => self::FAVORITE_COLOR_DEFAULT,
			'favorite_primary_color' => self::FAVORITE_PRIMARY_COLOR_DEFAULT
		]);
	}

	public function testCreateEnumAttribute()
	{
		$model = $this->getInstance();

		/**
		 * Test that value constrained by enum class successfully set
		 */
		$this->assertEquals($model->favorite_color, self::FAVORITE_COLOR_DEFAULT);

		/**
		 * Test that value constrained by array successfully set
		 */
		$this->assertEquals($model->favorite_primary_color, self::FAVORITE_PRIMARY_COLOR_DEFAULT);
	}

	public function testCreateInvalidEnumAttribute()
	{
		/**
		 * Test that value constrained by enum class successfully rejects
		 */
		$this->assertThrowsException(function() {
			factory(TestHasEnumsModel::class)->create([
				'favorite_color' => 'NotAColor'
			]);
		}, EnumException::class);

		/**
		 * Test that value constrained by array successfully rejects
		 */
		$this->assertThrowsException(function() {
			factory(TestHasEnumsModel::class)->create([
				'favorite_primary_color' => Color::PURPLE //Not in Color::PRIMARY
			]);
		}, EnumException::class);
	}

	public function testUpdateEnumAttribute()
	{
		$model = $this->getInstance();

		/**
		 * Test that value constrained by enum class successfully set via update
		 */
		$newFavoriteColor = Color::GREEN;

		$model->update([
			'favorite_color' => $newFavoriteColor
		]);

		$this->assertEquals($model->favorite_color, $newFavoriteColor);

		/**
		 * Test that value constrained by enum class successfully set via set attribute
		 */
		$newFavoriteColor = Color::ORANGE;

		$model->favorite_color = $newFavoriteColor;

		$this->assertEquals($model->favorite_color, $newFavoriteColor);

		/**
		 * Test that value constrained by array successfully set via update
		 */
		$newFavoritePrimaryColor = Color::RED;

		$model->update([
			'favorite_primary_color' => $newFavoritePrimaryColor
		]);

		$this->assertEquals($model->favorite_primary_color, $newFavoritePrimaryColor);

		/**
		 * Test that value constrained by array successfully set via set attribute
		 */
		$newFavoritePrimaryColor = Color::YELLOW;

		$model->favorite_primary_color = $newFavoritePrimaryColor;

		$this->assertEquals($model->favorite_primary_color, $newFavoritePrimaryColor);
	}

	public function testUpdateInvalidEnumAttribute()
	{
		/**
		 * Test that value constrained by enum class successfully rejects via update
		 */
		$this->assertThrowsException(function() {
			$model = $this->getInstance();
			
			$model->update([
				'favorite_color' => 'NotAColor'
			]);
		}, EnumException::class);

		/**
		 * Test that value constrained by enum class successfully rejects via set attribute
		 */
		$this->assertThrowsException(function() {
			$model = $this->getInstance();

			$model->favorite_color = 'NotAColor';
		}, EnumException::class);
		
		/**
		 * Test that value constrained by array successfully rejects via update
		 */
		$this->assertThrowsException(function() {
			$model = $this->getInstance();

			$model->update([
				'favorite_primary_color' => Color::PURPLE //Not in Color::PRIMARY
			]);
		}, EnumException::class);

		/**
		 * Test that value constrained by array successfully rejects via set attribute
		 */
		$this->assertThrowsException(function() {
			$model = $this->getInstance();

			$model->favorite_primary_color = Color::PURPLE; //Not in Color::PRIMARY
		}, EnumException::class);
	}
}