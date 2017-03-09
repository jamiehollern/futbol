<?php

namespace jamiehollern\futbol\Tests;

use jamiehollern\futbol\Team;
use jamiehollern\futbol\Match;
use PHPUnit\Framework\TestCase;


class MatchTest extends TestCase
{

    private $aberdeen;

    private $celtic;

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
        $this->assertInstanceOf('jamiehollern\futbol\Team', $match->getHomeTeam());
        $this->assertInstanceOf('jamiehollern\futbol\Team', $match->getAwayTeam());
        $this->assertEquals(1, $match->getHomeTeam()->getId());
        $this->assertEquals(2, $match->getAwayTeam()->getId());
        $this->assertEquals(0, $match->getHomeGoals());
        $this->assertEquals(3, $match->getAwayGoals());
    }

}
