<?php

namespace jamiehollern\futbol\Tests;

use jamiehollern\futbol\Match;
use jamiehollern\futbol\Team;
use PHPUnit\Framework\TestCase;
use jamiehollern\futbol\Traits\MatchEnsureTrait;

/**
 * Class MatchEnsureTraitTest
 *
 * @package jamiehollern\futbol\Tests
 */
class MatchEnsureTraitTest extends TestCase
{

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $mock;

    /**
     * Setup method.
     */
    public function setUp()
    {
        $this->mock = $this->getMockForTrait(MatchEnsureTrait::class);
    }

    /**
     * @test
     */
    public function testNoMatches()
    {
        $this->mock->ensureMatches();
        $this->assertNull($this->mock->matches);
    }

    /**
     * @test
     */
    public function testBadMatches()
    {
        $aberdeen = new Team(1, 'Aberdeen');
        $celtic = new Team(2, 'Celtic');
        $match = new Match($aberdeen, $celtic, 0, 3);
        $this->mock->matches = [$match, ['array']];
        $this->expectException(\Exception::class);
        $this->mock->ensureMatches();
        $this->assertNotEmpty($this->mock->matches);
    }

    /**
     * @test
     */
    public function testGoodMatches()
    {
        $aberdeen = new Team(1, 'Aberdeen');
        $celtic = new Team(2, 'Celtic');
        $match1 = new Match($aberdeen, $celtic, 0, 3);
        $match2 = new Match($celtic, $aberdeen, 2, 1);
        $this->mock->matches = [$match1, $match2];
        $this->mock->ensureMatches();
        $this->assertNotEmpty($this->mock->matches);
    }

}
