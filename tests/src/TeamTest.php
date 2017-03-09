<?php

namespace jamiehollern\futbol\Tests;

use PHPUnit\Framework\TestCase;
use jamiehollern\futbol\Team;

/**
 * Class TeamTest
 *
 * @package jamiehollern\futbol\Tests
 */
class TeamTest extends TestCase
{

    /**
     * @test
     */
    public function testBadId() {
        $this->expectException(\InvalidArgumentException::class);
        $team = new Team(0, 'Test');
    }

    /**
     * @test
     */
    public function testBadName() {
        $this->expectException(\InvalidArgumentException::class);
        $team = new Team(1, '');
    }

    /**
     * @test
     */
    public function testPropertyValues() {
        $team = new Team(1, 'Celtic');
        $this->assertEquals(1, $team->getId());
        $this->assertEquals('Celtic', $team->getName());
    }

}
