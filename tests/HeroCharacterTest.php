<?php


use App\Characters\Hero;
use PHPUnit\Framework\TestCase;

class HeroCharacterTest extends TestCase
{

    /**
     * @var Hero
     */
    private $character;

    public function setUp(): void
    {
        parent::setUp();

        $this->character = new Hero();
    }

    /** @test */
    public function it_should_set_hero_name()
    {
        $this->character->setName("Orderus");

        $this->assertEquals("Orderus", $this->character->getName());
    }

    /** @test */
    public function it_should_set_hero_health()
    {
        $this->character->setHealth(80);

        $this->assertEquals(80, $this->character->getHealth());
    }

    /** @test */
    public function it_should_set_hero_strength()
    {
        $this->character->setStrength(80);

        $this->assertEquals(80, $this->character->getStrength());
    }

    /** @test */
    public function it_should_set_hero_defence()
    {
        $this->character->setDefence(80);

        $this->assertEquals(80, $this->character->getDefence());
    }

    /** @test */
    public function it_should_set_hero_speed()
    {
        $this->character->setSpeed(80);

        $this->assertEquals(80, $this->character->getSpeed());
    }

    /** @test */
    public function it_should_set_hero_luck()
    {
        $this->character->setLuck(80);

        $this->assertEquals(80, $this->character->getLuck());
    }

    /** @test */
    public function it_should_add_hero_skill()
    {
        $this->character->addSkill(new \App\Skills\RapidStrike(10));

        $this->assertCount(1, $this->character->getSkills());
    }

    /** @test */
    public function it_should_decrease_enemy_health_when_is_attacking()
    {
        $wildBeast = new \App\Characters\WildBeast();
        $wildBeast->setHealth(80);
        $wildBeast->setDefence(40);

        $this->character->setStrength(60);

        $this->assertEquals(20, $this->character->attack($wildBeast));
    }

}
