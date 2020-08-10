<?php

namespace App;

use App\Characters\Character;
use App\Characters\Hero;
use App\Characters\WildBeast;
use App\Logger\Logger;
use App\Skills\MagicShield;
use App\Skills\RapidStrike;

class HeroGame
{

    protected $hero;

    protected $enemy;

    private $attacker;

    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

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
        $this->createHero();
        $this->createEnemy();

        $this->determineFirstAttacker();
        $this->startBattle();
        $this->setWinner();
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

        $this->logger->log("First attacker is {$this->attacker->getName()}");
    }

    public function getAttacker()
    {
        return $this->attacker;
    }

    private function startBattle()
    {
        $rounds = 1;

        while ($this->playersAreAlive() && $rounds <= GameConfig::MAX_ROUNDS) {
            $this->logger->printSeparator();
            $this->logger->log("ROUND {$rounds}");

            $skills = $this->hero->getSkills();

            if ($this->attacker->getName() == $this->hero->getName()) {
                $damage = $this->hero->attack($this->enemy);

                if (isset($skills['RapidStrike']) && $skills['RapidStrike']->canUseSkill()) {
                    $skills['RapidStrike']->specialDamage($damage);
                    $this->logger->log($this->hero->getName() . ' used ' . 'RapidStrike');
                }

                $this->enemy->setHealth($this->enemy->getHealth() - $damage);
                $this->logger->log($this->hero->getName() . ' dealt ' . $damage . ' damage to ' . $this->enemy->getName() . PHP_EOL);

                $this->attacker = $this->enemy;
            } else {
                $damage = $this->enemy->attack($this->hero);

                if (isset($skills['MagicShield']) && $skills['MagicShield']->canUseSkill()) {
                    $skills['MagicShield']->specialDamage($damage);
                    $this->logger->log($this->hero->getName() . ' used ' . 'MagicShield');
                }

                $this->hero->setHealth($this->hero->getHealth() - $damage);
                $this->logger->log($this->enemy->getName() . ' dealt ' . $damage . ' damage to ' . $this->hero->getName() . PHP_EOL);


                $this->attacker = $this->hero;
            }

            $this->logger->log($this->hero->getName() . ' health: ' . $this->hero->getHealth());
            $this->logger->log($this->enemy->getName() . ' health: ' . $this->enemy->getHealth());

            $rounds++;
        }
    }

    private function playersAreAlive()
    {
        return $this->hero->getHealth() > 0 && $this->enemy->getHealth() > 0;
    }

    private function setWinner()
    {
        if ($this->hero->getHealth() > $this->enemy->getHealth()) {
            $winner = $this->hero;
        } else {
            $winner = $this->enemy;
        }

        $this->logger->log($winner->getName() . ' won the battle');
    }

    public function createHero()
    {
        try {
            $this->hero = new Hero();
            $heroStats = GameConfig::HERO_STATS;
            $this->hero->setHealth($this->getRandom($heroStats['MIN_HEALTH'], $heroStats['MAX_HEALTH']));
            $this->hero->setStrength($this->getRandom($heroStats['MIN_STRENGTH'], $heroStats['MAX_STRENGTH']));
            $this->hero->setDefence($this->getRandom($heroStats['MIN_DEFENCE'], $heroStats['MAX_DEFENCE']));
            $this->hero->setSpeed($this->getRandom($heroStats['MIN_SPEED'], $heroStats['MAX_SPEED']));
            $this->hero->setLuck($this->getRandom($heroStats['MIN_LUCK'], $heroStats['MAX_LUCK']));

            $this->logger->logPlayerStats($this->hero);

            $this->hero->addSkill(new RapidStrike(30));
            $this->hero->addSkill(new MagicShield(10));
        } catch (\Exception $exception) {
            $this->logger->log('Error: ' . $exception->getmessage());
        }
    }

    public function createEnemy()
    {
        try {
            $this->enemy = new WildBeast();
            $enemyStats = GameConfig::ENEMY_STATS;
            $this->enemy->setHealth($this->getRandom($enemyStats['MIN_HEALTH'], $enemyStats['MAX_HEALTH']));
            $this->enemy->setStrength($this->getRandom($enemyStats['MIN_STRENGTH'], $enemyStats['MAX_STRENGTH']));
            $this->enemy->setDefence($this->getRandom($enemyStats['MIN_DEFENCE'], $enemyStats['MAX_DEFENCE']));
            $this->enemy->setSpeed($this->getRandom($enemyStats['MIN_SPEED'], $enemyStats['MAX_SPEED']));
            $this->enemy->setLuck($this->getRandom($enemyStats['MIN_LUCK'], $enemyStats['MAX_LUCK']));

            $this->logger->logPlayerStats($this->enemy);
        } catch (\Exception $exception) {
            $this->logger->log('Error: ' . $exception->getmessage());
        }
    }

    private function getRandom($min, $max)
    {
        if ($min >= $max) {
            throw new \Exception('The values provided are not correct!') ;
        }

        return mt_rand($min, $max);
    }

}