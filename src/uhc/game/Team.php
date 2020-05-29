<?php
declare(strict_types=1);

namespace uhc\game;

use pocketmine\Player;
use function count;

class Team{
	/** @var string */
	private $teamName;
	/** @var Player */
	private $teamLeader;
	/** @var Player[] */
	private $members = [];
	/** @var int */
	public const TEAM_LIMIT = 2;

	public function __construct(string $teamName, Player $teamLeader){
		$this->teamName = $teamName;
		$this->teamLeader = $teamLeader;

		$this->members[$teamLeader->getUniqueId()] = $teamLeader;
	}

	/**
	 * @return Player[]
	 */
	public function getMembers() : array{
		return $this->members;
	}

	public function memberExists(Player $player) : bool{
		return isset($this->members[$player->getUniqueId()]);
	}

	public function addMember(Player $player) : bool{
		if($this->isFull() || $player->getName() === $this->teamLeader){
			return false;
		}

		$this->members[$player->getUniqueId()] = $player;

		return true;
	}

	public function removeMember(Player $player) : bool{
		if(!isset($this->members[$player->getUniqueId()]) || $player->getName() === $this->teamLeader){
			return false;
		}

		unset($this->members[$player->getUniqueId()]);

		return true;
	}

	public function getName() : string{
		return $this->teamName;
	}

	public function getLeader() : Player{
		return $this->teamLeader;
	}

	public function isFull() : bool{
		return count($this->members) === self::TEAM_LIMIT;
	}
}
