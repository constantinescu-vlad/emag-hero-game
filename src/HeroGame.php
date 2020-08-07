<?php

namespace App;

use App\Characters\Character;
use App\Characters\Hero;
use App\Characters\WildBeast;
use App\Skills\MagicShield;
use App\Skills\RapidStrike;

class HeroGame
{

    const MAX_ROUNDS = 20;

    protected $hero;

    protected $enemy;

    private $attacker;

    public function addHero(Character $hero)
    {
        $this->hero = $hero;
    }

    public function getHero()
    {
        return $this->hero;
    }

    public function addEnemy(Character $enemy)
    {
        $this->enemy = $enemy;
    }

    public function getEnemy()
    {
        return $this->enemy;
    }

    public function startGame()
    {
        // set hero
        $this->hero = new Hero();
        $this->hero->setHealth(80);
        $this->hero->setStrength(80);
        $this->hero->setDefence(40);
        $this->hero->setSpeed(50);
        $this->hero->setLuck(30);

        $this->hero->addSkill(new RapidStrike(30));
        $this->hero->addSkill(new MagicShield(10));

        // set enemy
        $this->enemy = new WildBeast();
        $this->enemy->setHealth(70);
        $this->enemy->setStrength(50);
        $this->enemy->setDefence(50);
        $this->enemy->setSpeed(40);
        $this->enemy->setLuck(20);

        // determine first attacker
        $this->determineFirstAttacker();

        // start battle
        $this->startBattle();

        // show winner
    }

    public function determineFirstAttacker()
    {
        if ($this->hero->getSpeed() < $this->enemy->getSpeed()) {
            $this->attacker = $this->enemy;
        } elseif ($this->hero->getSpeed() > $this->enemy->getSpeed()) {
            $this->attacker = $this->hero;
        } elseif ($this->hero->getLuck() > $this->enemy->getLuck()) {
            $this->attacker = $this->hero;
        } elseif ($this->hero->getLuck() < $this->enemy->getLuck()) {
            $this->attacker = $this->enemy;
        }

        print("First attacher is {$this->attacker->getName()}" . PHP_EOL);
    }

    public function getAttacker()
    {
        return $this->attacker;
    }

    private function startBattle()
    {
        $rounds = 1;

        while ($this->playersAreAlive() && $rounds <= self::MAX_ROUNDS) {
            print_r('Round ' . $rounds . PHP_EOL);

            $skills = $this->hero->getSkills();

            if ($this->attacker->getName() == $this->hero->getName()) {
                $damage = $this->hero->attack($this->enemy);

                if (isset($skills['RapidStrike']) && $skills['RapidStrike']->canUseSkill()) {
                    $skills['RapidStrike']->specialDamage($damage);
                    print_r($this->hero->getName() . ' used ' . 'RapidStrike' . PHP_EOL);
                }

                $this->enemy->setHealth($this->enemy->getHealth() - $damage);
                print_r($this->hero->getName() . ' dealt ' . $damage . ' damage to ' . $this->enemy->getName() . PHP_EOL);

                $this->attacker = $this->enemy;
            } else {
                $damage = $this->enemy->attack($this->hero);

                if (isset($skills['MagicShield']) && $skills['MagicShield']->canUseSkill()) {
                    $skills['MagicShield']->specialDamage($damage);
                    print_r($this->hero->getName() . ' used ' . 'MagicShield' . PHP_EOL);
                }

                $this->hero->setHealth($this->hero->getHealth() - $damage);
                print_r($this->enemy->getName() . ' dealt ' . $damage . ' damage to ' . $this->hero->getName() . PHP_EOL);


                $this->attacker = $this->hero;
            }

            print_r($this->hero->getName() . ': ' . $this->hero->getHealth() . PHP_EOL);
            print_r($this->enemy->getName() . ': ' . $this->enemy->getHealth()  . PHP_EOL);

            $rounds++;
        }
    }

    private function playersAreAlive()
    {
        return $this->hero->getHealth() > 0 && $this->enemy->getHealth() > 0;
    }

}