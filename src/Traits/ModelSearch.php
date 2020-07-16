<?php

namespace Helium\LaravelHelpers\Traits;

use Helium\LaravelHelpers\Search\SearchQuery;

trait ModelSearch
{
    /** @var array $allowedRelations */
    protected $allowedRelations = null;

    public static function search(?array $filters = null): SearchQuery
    {
        return (new SearchQuery(static::query()));
    }

    public function allowRelations(?array $allowedRelations = null)
    {
        if (is_null($this->allowedRelations))
        {
            $this->allowedRelations = [];
        }

        if ($allowedRelations)
        {
            $this->allowedRelations = array_merge($this->allowedRelations, $allowedRelations);
        }

        return $this;
    }

    public function load($relations)
    {
        if (is_string($relations) &&
            (is_null($this->allowedRelations) || in_array($relations, $this->allowedRelations)))
        {
            return parent::load($relations);
        }

        if(is_array($relations))
        {
            return parent::load(array_intersect($this->allowedRelations, $relations));
        }

        return $this;
    }
}