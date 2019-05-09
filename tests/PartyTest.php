<?php


use MMunoz\Party;

class PartyTest extends \PHPUnit\Framework\TestCase
{

    private function createPlayer($level, $name = "") {
        $player = new \MMunoz\Player();
        $player->level = $level;
        $player->name = $name;
        return $player;
    }

    public function testShared()
    {
        $party = new Party();
        $party->addMember($this->createPlayer(50));
        $party->addMember($this->createPlayer(80));

        $player1 = $this->createPlayer(40);
        $player2 = $this->createPlayer(53);
        $player3 = $this->createPlayer(122);

        $this->assertFalse($party->isShared($player1));
        $this->assertTrue($party->isShared($player2));
        $this->assertTrue($party->isShared($player3));


    }


}
