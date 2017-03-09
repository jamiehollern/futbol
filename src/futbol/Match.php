<?php

namespace jamiehollern\futbol;

use jamiehollern\futbol\Team;

/**
 * Class Match
 *
 * @package jamiehollern\futbol\Competition
 */
class Match
{

    /**
     * @var \jamiehollern\futbol\Team
     */
    private $home_team;

    /**
     * @var int
     */
    private $home_goals;

    /**
     * @var \jamiehollern\futbol\Team
     */
    private $away_team;

    /**
     * @var int
     */
    private $away_goals;

    /**
     * Match constructor.
     *
     * @param \jamiehollern\futbol\Team $homeTeam
     * @param \jamiehollern\futbol\Team $awayTeam
     * @param int                       $homeGoals
     * @param int                       $awayGoals
     *
     * @throws \Exception
     */
    public function __construct(
      Team $homeTeam,
      Team $awayTeam,
      int $homeGoals,
      int $awayGoals
    ) {
        if ($homeGoals < 0) {
            throw new \InvalidArgumentException('Home goals must be a positive integer.');
        }
        if ($awayGoals < 0) {
            throw new \InvalidArgumentException('Away goals must be a positive integer.');
        }
        $this->home_team = $homeTeam;
        $this->away_team = $awayTeam;
        $this->home_goals = $homeGoals;
        $this->away_goals = $awayGoals;
    }

    /**
     * @return \jamiehollern\futbol\Team
     */
    public function getHomeTeam(): Team
    {
        return $this->home_team;
    }

    /**
     * @return int
     */
    public function getHomeGoals(): int
    {
        return $this->home_goals;
    }

    /**
     * @return \jamiehollern\futbol\Team
     */
    public function getAwayTeam(): Team
    {
        return $this->away_team;
    }

    /**
     * @return int
     */
    public function getAwayGoals(): int
    {
        return $this->away_goals;
    }

}
