<?php

namespace jamiehollern\futbol\Tests\Model;

use jamiehollern\futbol\Model\Team;
use jamiehollern\futbol\Model\Match;
use PHPUnit\Framework\TestCase;

/**
 * Class MatchTest
 *
 * @package jamiehollern\futbol\Tests\Model
 */
class MatchTest extends TestCase
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
     * Setup method.
     */
    public function setUp()
    {
        $this->aberdeen = new Team(1, 'Aberdeen');
        $this->celtic = new Team(2, 'Celtic');
    }

    /**
     * @test
     */
    public function testBadHomeGoals() {
        $this->expectException(\InvalidArgumentException::class);
        $match = new Match($this->aberdeen, $this->celtic, -1, 2);
    }

    /**
     * @test
     */
    public function testBadAwayGoals() {
        $this->expectException(\InvalidArgumentException::class);
        $match = new Match($this->aberdeen, $this->celtic, 0, -2);
    }

    /**
     * @test
     */
    public function testPropertyValues() {
        $match = new Match($this->aberdeen, $this->celtic, 0, 3);
        $this->assertInstanceOf('jamiehollern\futbol\Model\Team', $match->getHomeTeam());
        $this->assertInstanceOf('jamiehollern\futbol\Model\Team', $match->getAwayTeam());
        $this->assertEquals(1, $match->getHomeTeam()->getId());
        $this->assertEquals(2, $match->getAwayTeam()->getId());
        $this->assertEquals(0, $match->getHomeGoals());
        $this->assertEquals(3, $match->getAwayGoals());
    }

}
