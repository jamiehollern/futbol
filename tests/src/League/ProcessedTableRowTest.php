<?php

namespace jamiehollern\futbol\Tests\Model\League;

use jamiehollern\futbol\Model\League\ProcessedTableRow;
use jamiehollern\futbol\Model\Team;
use jamiehollern\futbol\Model\Match;
use PHPUnit\Framework\TestCase;

/**
 * Class ProcessedTableRowTest
 *
 * @package jamiehollern\futbol\Tests\Model\League
 */
class ProcessedTableRowTest extends TestCase
{

    /**
     * @var \jamiehollern\futbol\Model\Team
     */
    private $aberdeen;

    /**
     * @var \jamiehollern\futbol\Model\Team
     */
    private $celtic;

    /**
     * @var \jamiehollern\futbol\Model\Team
     */
    private $dundee;

    /**
     * @var \jamiehollern\futbol\Model\Team
     */
    private $hearts;

    /**
     * @var \jamiehollern\futbol\Model\Team
     */
    private $kilmarnock;

    /**
     * @var array
     */
    private $matches;

    /**
     * Setup method.
     */
    public function setUp()
    {
        $this->aberdeen = new Team(1, 'Aberdeen');
        $this->celtic = new Team(2, 'Celtic');
        $this->dundee = new Team(3, 'Dundee');
        $this->hearts = new Team(4, 'Hearts');
        $this->kilmarnock = new Team(5, 'Kilmarnock');
        // We add Hearts and Kilmarnock to test that their matches are ignored.
        $this->matches = [
          new Match($this->aberdeen, $this->celtic, 2, 2),
          new Match($this->celtic, $this->aberdeen, 3, 2),
          new Match($this->celtic, $this->dundee, 5, 0),
          new Match($this->dundee, $this->celtic, 1, 2),
          new Match($this->dundee, $this->aberdeen, 0, 0),
          new Match($this->aberdeen, $this->dundee, 1, 0),
          new Match($this->hearts, $this->kilmarnock, 1, 0),
          new Match($this->kilmarnock, $this->hearts, 1, 0),
        ];
    }

    /**
     * @test
     */
    public function testRowAberdeen() {
        $row_aberdeen = new ProcessedTableRow($this->aberdeen, $this->matches);
        $this->assertEquals($this->aberdeen, $row_aberdeen->getTeam());
        $this->assertEquals($this->aberdeen->getId(), $row_aberdeen->getTeamId());
        $this->assertEquals($this->aberdeen->getName(), $row_aberdeen->getTeamName());
        $this->assertEquals(4, $row_aberdeen->getGamesPlayed());
        $this->assertEquals(2, $row_aberdeen->getHomeGamesPlayed());
        $this->assertEquals(2, $row_aberdeen->getAwayGamesPlayed());
        $this->assertEquals(1, $row_aberdeen->getWins());
        $this->assertEquals(2, $row_aberdeen->getDraws());
        $this->assertEquals(1, $row_aberdeen->getLosses());
        $this->assertEquals(1, $row_aberdeen->getHomeWins());
        $this->assertEquals(1, $row_aberdeen->getHomeDraws());
        $this->assertEquals(0, $row_aberdeen->getHomeLosses());
        $this->assertEquals(0, $row_aberdeen->getAwayWins());
        $this->assertEquals(1, $row_aberdeen->getAwayDraws());
        $this->assertEquals(1, $row_aberdeen->getAwayLosses());
        $this->assertEquals(5, $row_aberdeen->getGoalsFor());
        $this->assertEquals(5, $row_aberdeen->getGoalsAgainst());
        $this->assertEquals(0, $row_aberdeen->getGoalDifference());
        $this->assertEquals(3, $row_aberdeen->getHomeGoalsFor());
        $this->assertEquals(2, $row_aberdeen->getHomeGoalsAgainst());
        $this->assertEquals(1, $row_aberdeen->getHomeGoalDifference());
        $this->assertEquals(2, $row_aberdeen->getAwayGoalsFor());
        $this->assertEquals(3, $row_aberdeen->getAwayGoalsAgainst());
        $this->assertEquals(-1, $row_aberdeen->getAwayGoalDifference());
        $this->assertEquals(4, $row_aberdeen->getHomePoints());
        $this->assertEquals(1, $row_aberdeen->getAwayPoints());
        $this->assertEquals(5, $row_aberdeen->getPoints());
    }

    /**
     * @test
     */
    public function testRowCeltic() {
        $row_celtic = new ProcessedTableRow($this->celtic, $this->matches);
        $this->assertEquals($this->celtic, $row_celtic->getTeam());
        $this->assertEquals($this->celtic->getId(), $row_celtic->getTeamId());
        $this->assertEquals($this->celtic->getName(), $row_celtic->getTeamName());
        $this->assertEquals(4, $row_celtic->getGamesPlayed());
        $this->assertEquals(2, $row_celtic->getHomeGamesPlayed());
        $this->assertEquals(2, $row_celtic->getAwayGamesPlayed());
        $this->assertEquals(3, $row_celtic->getWins());
        $this->assertEquals(1, $row_celtic->getDraws());
        $this->assertEquals(0, $row_celtic->getLosses());
        $this->assertEquals(2, $row_celtic->getHomeWins());
        $this->assertEquals(0, $row_celtic->getHomeDraws());
        $this->assertEquals(0, $row_celtic->getHomeLosses());
        $this->assertEquals(1, $row_celtic->getAwayWins());
        $this->assertEquals(1, $row_celtic->getAwayDraws());
        $this->assertEquals(0, $row_celtic->getAwayLosses());
        $this->assertEquals(12, $row_celtic->getGoalsFor());
        $this->assertEquals(5, $row_celtic->getGoalsAgainst());
        $this->assertEquals(7, $row_celtic->getGoalDifference());
        $this->assertEquals(8, $row_celtic->getHomeGoalsFor());
        $this->assertEquals(2, $row_celtic->getHomeGoalsAgainst());
        $this->assertEquals(6, $row_celtic->getHomeGoalDifference());
        $this->assertEquals(4, $row_celtic->getAwayGoalsFor());
        $this->assertEquals(3, $row_celtic->getAwayGoalsAgainst());
        $this->assertEquals(1, $row_celtic->getAwayGoalDifference());
        $this->assertEquals(6, $row_celtic->getHomePoints());
        $this->assertEquals(4, $row_celtic->getAwayPoints());
        $this->assertEquals(10, $row_celtic->getPoints());
    }

    /**
     * @test
     */
    public function testRowDundee() {
        $row_dundee = new ProcessedTableRow($this->dundee, $this->matches);
        $this->assertEquals($this->dundee, $row_dundee->getTeam());
        $this->assertEquals($this->dundee->getId(), $row_dundee->getTeamId());
        $this->assertEquals($this->dundee->getName(), $row_dundee->getTeamName());
        $this->assertEquals(4, $row_dundee->getGamesPlayed());
        $this->assertEquals(2, $row_dundee->getHomeGamesPlayed());
        $this->assertEquals(2, $row_dundee->getAwayGamesPlayed());
        $this->assertEquals(0, $row_dundee->getWins());
        $this->assertEquals(1, $row_dundee->getDraws());
        $this->assertEquals(3, $row_dundee->getLosses());
        $this->assertEquals(0, $row_dundee->getHomeWins());
        $this->assertEquals(1, $row_dundee->getHomeDraws());
        $this->assertEquals(1, $row_dundee->getHomeLosses());
        $this->assertEquals(0, $row_dundee->getAwayWins());
        $this->assertEquals(0, $row_dundee->getAwayDraws());
        $this->assertEquals(2, $row_dundee->getAwayLosses());
        $this->assertEquals(1, $row_dundee->getGoalsFor());
        $this->assertEquals(8, $row_dundee->getGoalsAgainst());
        $this->assertEquals(-7, $row_dundee->getGoalDifference());
        $this->assertEquals(1, $row_dundee->getHomeGoalsFor());
        $this->assertEquals(2, $row_dundee->getHomeGoalsAgainst());
        $this->assertEquals(-1, $row_dundee->getHomeGoalDifference());
        $this->assertEquals(0, $row_dundee->getAwayGoalsFor());
        $this->assertEquals(6, $row_dundee->getAwayGoalsAgainst());
        $this->assertEquals(-6, $row_dundee->getAwayGoalDifference());
        $this->assertEquals(1, $row_dundee->getHomePoints());
        $this->assertEquals(0, $row_dundee->getAwayPoints());
        $this->assertEquals(1, $row_dundee->getPoints());
    }

}
