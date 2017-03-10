<?php

namespace jamiehollern\futbol\Model;

/**
 * Class ProcessedLeagueTable
 *
 * @package jamiehollern\futbol\Model
 */
final class LeagueTable
{

    /**
     * @var array
     */
    private $table_rows = [];

    /**
     * LeagueTable constructor.
     *
     * @param array $table_rows
     */
    public function __construct(array $table_rows)
    {
        $this->table_rows = $table_rows;
    }

    /**
     * @return array
     */
    public function getTableRows()
    {
        return $this->table_rows;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        // Return a cheeky ASCII table.
        return '';
    }

}
