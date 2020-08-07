<?php


use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{

    private $game;

    public function setUp(): void
    {
        parent::setUp();

        $this->game = new \App\HeroGame();
    }

    /** @test */
    public function it_should_set_the_hero()
    {
        $hero = new \App\Characters\Hero();
        $this->game->addHero($hero);
        $this->assertEquals($hero, $this->game->getHero());
    }

    /** @test */
    public function it_should_set_the_enemy()
    {
        $enemy = new \App\Characters\WildBeast();
        $this->game->addEnemy($enemy);
        $this->assertEquals($enemy, $this->game->getEnemy());
    }

    /** @test */
    public function it_should_set_the_hero_as_first_attacker_based_on_character_speed()
    {
        $hero = new \App\Characters\Hero();
        $hero->setSpeed(50);
        $this->game->addHero($hero);

        $enemy = new \App\Characters\WildBeast();
        $enemy->setSpeed(40);
        $this->game->addEnemy($enemy);

        $this->game->determineFirstAttacker();

        $this->assertEquals($hero, $this->game->getAttacker());
    }

    /** @test */
    public function it_should_set_the_enemy_as_first_attacker_based_on_character_speed()
    {
        $hero = new \App\Characters\Hero();
        $hero->setSpeed(30);
        $this->game->addHero($hero);

        $enemy = new \App\Characters\WildBeast();
        $enemy->setSpeed(40);
        $this->game->addEnemy($enemy);

        $this->game->determineFirstAttacker();

        $this->assertEquals($enemy, $this->game->getAttacker());
    }

    /** @test */
    public function it_should_set_the_hero_as_first_attacker_based_on_character_luck()
    {
        $hero = new \App\Characters\Hero();
        $hero->setSpeed(50);
        $hero->setLuck(50);
        $this->game->addHero($hero);

        $enemy = new \App\Characters\WildBeast();
        $enemy->setSpeed(50);
        $enemy->setLuck(40);
        $this->game->addEnemy($enemy);

        $this->game->determineFirstAttacker();

        $this->assertEquals($hero, $this->game->getAttacker());
    }

    /** @test */
    public function it_should_set_the_enemy_as_first_attacker_based_on_character_luck()
    {
        $hero = new \App\Characters\Hero();
        $hero->setSpeed(50);
        $hero->setLuck(30);
        $this->game->addHero($hero);

        $enemy = new \App\Characters\WildBeast();
        $enemy->setSpeed(50);
        $enemy->setLuck(40);
        $this->game->addEnemy($enemy);

        $this->game->determineFirstAttacker();

        $this->assertEquals($enemy, $this->game->getAttacker());
    }

}
