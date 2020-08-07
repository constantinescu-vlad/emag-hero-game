<?php


use PHPUnit\Framework\TestCase;

class HeroSkillTest extends TestCase
{

    /** @test */
    public function it_should_set_skill_chance()
    {
        $skill = new \App\Skills\RapidStrike(100);

        $this->assertEquals(100, $skill->getChance());
    }

    /** @test */
    public function it_should_return_if_hero_can_use_skill()
    {
        $skill = new \App\Skills\RapidStrike( 100);

        $this->assertEquals(true, $skill->canUseSkill());
    }

    /** @test */
    public function it_should_return_if_hero_cannot_use_skill()
    {
        $skill = new \App\Skills\RapidStrike(0);

        $this->assertEquals(false, $skill->canUseSkill());
    }

}
