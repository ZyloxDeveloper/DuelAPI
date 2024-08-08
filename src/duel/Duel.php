<?php

/*
 *  ____                   _      _      ____    ___
 * |  _ \   _   _    ___  | |    / \    |  _ \  |_ _|
 * | | | | | | | |  / _ \ | |   / _ \   | |_) |  | |
 * | |_| | | |_| | |  __/ | |  / ___ \  |  __/   | |
 * |____/   \__,_|  \___| |_| /_/   \_\ |_|     |___|
 *
 * Copyright 2024 ZyloxDeveloper
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”),
 * to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @author ZyloxDeveloper
 * @link https://github.com/ZyloxDeveloper
 *
 *
 */

declare(strict_types=1);

namespace ZyloxDeveloper\DuelAPI\duel;

use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use ZyloxDeveloper\DuelAPI\DuelAPI;
use function intval;

class Duel{

		/** @var Player[] */
	protected array $players = [];

			/** @var Player[] */
	protected array $deadPlayers = [];

		/** The mount of seconds before the duel begins. */
	protected int $queueDuration = 20;

		/** The maximum amount of seconds before the duel ends. */
	protected int $maxDuration = 60 * 10;

	final function init(array $players) : void {
		$this->players = $players;

		$this->onQueue();

		DuelAPI::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function() {
			$this->onStart();
		}), $this->queueDuration * intval(DuelAPI::getInstance()->getServer()->getTicksPerSecond()));

		DuelAPI::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function() {
			$this->onEnd();
		}), ($this->queueDuration + $this->maxDuration) * intval(DuelAPI::getInstance()->getServer()->getTicksPerSecond()));
	}

	public function onQueue() : void { }
	public function onStart() : void { }
	public function onEnd() : void { }

	public function onTick() : void { }

	public function onPlayerAttack(Player $damager, Player $damaged) : void { }
	public function onKill(Player $damager, Player $damaged) : void { }
	public function onDeath(Player $player) : void { }

		/** @var ?Player[] */
	public function getPlayers() : array {
		return $this->players;
	}

		/** @var ?Player[] */
	public function getAlive() : array {
		$alive = [];
		foreach($this->players as $player) {
			if(in_array($player, $this->deadPlayers)) continue;

			$alive[] = $player;
		}

		return $alive;
	 }

		/** @var ?Player[] */
	public function getDead() : array {
		return $this->deadPlayers;
	}
}
