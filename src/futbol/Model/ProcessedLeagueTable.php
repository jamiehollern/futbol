<?php

namespace jamiehollern\futbol\Model;

use jamiehollern\futbol\Model\League\ProcessedTableRow as Row;
use jamiehollern\futbol\Helpers\MatchEnsureTrait;

/**
 * Class ProcessedLeagueTable
 *
 * @package jamiehollern\futbol\Model
 */
final class ProcessedLeagueTable
{

    use MatchEnsureTrait;

    /**
     * @var array
     */
    private $teams = [];

    /**
     * @var array
     */
    private $table_rows = [];

    /**
     * @var array
     */
    private $matches = [];

    /**
     * ProcessedLeagueTable constructor.
     *
     * @param array $matches
     */
    public function __construct(array $matches)
    {
        $this->matches = $matches;
        $this->ensureMatches();
        $this->setTeams();
        $this->setTableRows();
    }

    /**
     * @return array
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * Sets the teams property as an array of Team objects.
     */

    private function setTeams()
    {
        foreach ($this->matches as $match) {
            $home_team = $match->getHomeTeam();
            $away_team = $match->getAwayTeam();
            if (!isset($this->teams[$home_team->getId()])) {
                $this->teams[$home_team->getId()] = $home_team;
            }
            if (!isset($this->teams[$away_team->getId()])) {
                $this->teams[$away_team->getId()] = $away_team;
            }
        }
        return $this->teams;
    }

    /**
     * Returns an array of Team objects.
     *
     * @return array
     */

    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Sets the table rows as ProcessedTableRow objects.
     */
    private function setTableRows()
    {
        foreach ($this->getTeams() as $team) {
            $this->table_rows[] = new Row($team, $this->getMatches());
        }
    }

    /**
     * @return array
     */
    public function getTableRows()
    {
        return $this->table_rows;
    }

    /**
     *
     */
    public function sort()
    {
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
