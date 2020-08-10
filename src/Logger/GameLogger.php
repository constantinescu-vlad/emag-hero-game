<?php


namespace App\Logger;


use App\Characters\Character;

class GameLogger implements Logger
{

    public function log($data)
    {
        print($data . PHP_EOL);
    }

    public function printSeparator()
    {
        print('===================================================' . PHP_EOL);
    }

    public function logPlayerStats(Character $character)
    {
        $this->log($character->getName() . ' stats: ');
        $this->log('HEALTH: ' . $character->getHealth());
        $this->log('STRENGTH: ' . $character->getStrength());
        $this->log('DEFENCE: ' . $character->getDefence());
        $this->log('SPEED: ' . $character->getSpeed());
        $this->log('Luck: ' . $character->getLuck());
        $this->printSeparator();
    }

}