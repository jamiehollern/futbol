<?php

namespace jamiehollern\futbol\Tests\Model\League;

use jamiehollern\futbol\Process\ProcessLeagueMatches;
use jamiehollern\futbol\Model\Team;
use jamiehollern\futbol\Model\Match;
use PHPUnit\Framework\TestCase;

/**
 * Class ProcessedTableRowTest
 *
 * @package jamiehollern\futbol\Tests\Model\League
 */
class ProcessLeagueMatchesTest extends TestCase
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
        $row_aberdeen = new ProcessLeagueMatches($this->aberdeen, $this->matches);
        $this->assertEquals($this->aberdeen, $row_aberdeen->getTableRow()->getTeam());
        $this->assertEquals(4, $row_aberdeen->getTableRow()->getGamesPlayed());
        $this->assertEquals(2, $row_aberdeen->getTableRow()->getHomeGamesPlayed());
        $this->assertEquals(2, $row_aberdeen->getTableRow()->getAwayGamesPlayed());
        $this->assertEquals(1, $row_aberdeen->getTableRow()->getWins());
        $this->assertEquals(2, $row_aberdeen->getTableRow()->getDraws());
        $this->assertEquals(1, $row_aberdeen->getTableRow()->getLosses());
        $this->assertEquals(1, $row_aberdeen->getTableRow()->getHomeWins());
        $this->assertEquals(1, $row_aberdeen->getTableRow()->getHomeDraws());
        $this->assertEquals(0, $row_aberdeen->getTableRow()->getHomeLosses());
        $this->assertEquals(0, $row_aberdeen->getTableRow()->getAwayWins());
        $this->assertEquals(1, $row_aberdeen->getTableRow()->getAwayDraws());
        $this->assertEquals(1, $row_aberdeen->getTableRow()->getAwayLosses());
        $this->assertEquals(5, $row_aberdeen->getTableRow()->getGoalsFor());
        $this->assertEquals(5, $row_aberdeen->getTableRow()->getGoalsAgainst());
        $this->assertEquals(0, $row_aberdeen->getTableRow()->getGoalDifference());
        $this->assertEquals(3, $row_aberdeen->getTableRow()->getHomeGoalsFor());
        $this->assertEquals(2, $row_aberdeen->getTableRow()->getHomeGoalsAgainst());
        $this->assertEquals(1, $row_aberdeen->getTableRow()->getHomeGoalDifference());
        $this->assertEquals(2, $row_aberdeen->getTableRow()->getAwayGoalsFor());
        $this->assertEquals(3, $row_aberdeen->getTableRow()->getAwayGoalsAgainst());
        $this->assertEquals(-1, $row_aberdeen->getTableRow()->getAwayGoalDifference());
        $this->assertEquals(4, $row_aberdeen->getTableRow()->getHomePoints());
        $this->assertEquals(1, $row_aberdeen->getTableRow()->getAwayPoints());
        $this->assertEquals(5, $row_aberdeen->getTableRow()->getPoints());
    }

    /**
     * @test
     */
    public function testRowCeltic() {
        $row_celtic = new ProcessLeagueMatches($this->celtic, $this->matches);
        $this->assertEquals($this->celtic, $row_celtic->getTableRow()->getTeam());
        $this->assertEquals(4, $row_celtic->getTableRow()->getGamesPlayed());
        $this->assertEquals(2, $row_celtic->getTableRow()->getHomeGamesPlayed());
        $this->assertEquals(2, $row_celtic->getTableRow()->getAwayGamesPlayed());
        $this->assertEquals(3, $row_celtic->getTableRow()->getWins());
        $this->assertEquals(1, $row_celtic->getTableRow()->getDraws());
        $this->assertEquals(0, $row_celtic->getTableRow()->getLosses());
        $this->assertEquals(2, $row_celtic->getTableRow()->getHomeWins());
        $this->assertEquals(0, $row_celtic->getTableRow()->getHomeDraws());
        $this->assertEquals(0, $row_celtic->getTableRow()->getHomeLosses());
        $this->assertEquals(1, $row_celtic->getTableRow()->getAwayWins());
        $this->assertEquals(1, $row_celtic->getTableRow()->getAwayDraws());
        $this->assertEquals(0, $row_celtic->getTableRow()->getAwayLosses());
        $this->assertEquals(12, $row_celtic->getTableRow()->getGoalsFor());
        $this->assertEquals(5, $row_celtic->getTableRow()->getGoalsAgainst());
        $this->assertEquals(7, $row_celtic->getTableRow()->getGoalDifference());
        $this->assertEquals(8, $row_celtic->getTableRow()->getHomeGoalsFor());
        $this->assertEquals(2, $row_celtic->getTableRow()->getHomeGoalsAgainst());
        $this->assertEquals(6, $row_celtic->getTableRow()->getHomeGoalDifference());
        $this->assertEquals(4, $row_celtic->getTableRow()->getAwayGoalsFor());
        $this->assertEquals(3, $row_celtic->getTableRow()->getAwayGoalsAgainst());
        $this->assertEquals(1, $row_celtic->getTableRow()->getAwayGoalDifference());
        $this->assertEquals(6, $row_celtic->getTableRow()->getHomePoints());
        $this->assertEquals(4, $row_celtic->getTableRow()->getAwayPoints());
        $this->assertEquals(10, $row_celtic->getTableRow()->getPoints());
    }

    /**
     * @test
     */
    public function testRowDundee() {
        $row_dundee = new ProcessLeagueMatches($this->dundee, $this->matches);
        $this->assertEquals($this->dundee, $row_dundee->getTableRow()->getTeam());
        $this->assertEquals(4, $row_dundee->getTableRow()->getGamesPlayed());
        $this->assertEquals(2, $row_dundee->getTableRow()->getHomeGamesPlayed());
        $this->assertEquals(2, $row_dundee->getTableRow()->getAwayGamesPlayed());
        $this->assertEquals(0, $row_dundee->getTableRow()->getWins());
        $this->assertEquals(1, $row_dundee->getTableRow()->getDraws());
        $this->assertEquals(3, $row_dundee->getTableRow()->getLosses());
        $this->assertEquals(0, $row_dundee->getTableRow()->getHomeWins());
        $this->assertEquals(1, $row_dundee->getTableRow()->getHomeDraws());
        $this->assertEquals(1, $row_dundee->getTableRow()->getHomeLosses());
        $this->assertEquals(0, $row_dundee->getTableRow()->getAwayWins());
        $this->assertEquals(0, $row_dundee->getTableRow()->getAwayDraws());
        $this->assertEquals(2, $row_dundee->getTableRow()->getAwayLosses());
        $this->assertEquals(1, $row_dundee->getTableRow()->getGoalsFor());
        $this->assertEquals(8, $row_dundee->getTableRow()->getGoalsAgainst());
        $this->assertEquals(-7, $row_dundee->getTableRow()->getGoalDifference());
        $this->assertEquals(1, $row_dundee->getTableRow()->getHomeGoalsFor());
        $this->assertEquals(2, $row_dundee->getTableRow()->getHomeGoalsAgainst());
        $this->assertEquals(-1, $row_dundee->getTableRow()->getHomeGoalDifference());
        $this->assertEquals(0, $row_dundee->getTableRow()->getAwayGoalsFor());
        $this->assertEquals(6, $row_dundee->getTableRow()->getAwayGoalsAgainst());
        $this->assertEquals(-6, $row_dundee->getTableRow()->getAwayGoalDifference());
        $this->assertEquals(1, $row_dundee->getTableRow()->getHomePoints());
        $this->assertEquals(0, $row_dundee->getTableRow()->getAwayPoints());
        $this->assertEquals(1, $row_dundee->getTableRow()->getPoints());
    }

}
