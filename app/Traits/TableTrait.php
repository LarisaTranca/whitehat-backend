<?php

namespace App\Traits;

trait TableTrait
{
    /**
     * Get table name from the model.
     *
     * @return string
     */
    public function getName() : string
    {
        return with(new static)->getTable();
    }

    /**
     * Qualify the given column name by the model's table.
     *
     * @param  string  $column
     * @return string
     */
    public function getColumn(string $column) : string
    {
        if (str_contains($column, '.')) {
            return $column;
        }

        return $this->getName().'.'.$column;
    }
}