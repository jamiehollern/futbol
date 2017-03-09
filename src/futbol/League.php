<?php

namespace jamiehollern\futbol;

use jamiehollern\futbol\League\LeagueRow;
use jamiehollern\futbol\Traits\MatchEnsureTrait;

class League
{

    use MatchEnsureTrait;

    private $teams = [];

    private $rows = [];

    private $matches;

    public function __construct(array $matches)
    {
        $this->matches = $matches;
        $this->ensureMatches();
        $teams = $this->setTeams();
        foreach ($teams as $team) {
            $this->rows[] = new LeagueRow($team, $matches);
        }
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
    public function getTeams() {
        return $this->teams;
    }

    public function sort()
    {
    }

    public function __toString()
    {
        // Return a cheeky ASCII table.
        return '';
    }
}
