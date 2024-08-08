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

namespace ZyloxDeveloper\DuelAPI;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\SingletonTrait;
use ZyloxDeveloper\DuelAPI\duel\Duel;
use ZyloxDeveloper\DuelAPI\Listener\DuelListener;

use function in_array;

class DuelAPI extends PluginBase{
	use SingletonTrait;

		/** @var Duel[] */
	private ?array $activeDuels = [];

	public function onLoad() : void {
		$this->setInstance($this);

		$this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function() {
			foreach($this->activeDuels as $duel){
				$duel->onTick();
			}
		}), 1);
	}

	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents(new DuelListener(), $this);
	}

	public function startDuel(Duel $duel, Player...$players) : bool {
		if(in_array($duel, $this->activeDuels, true)) return false;

		$duel->init($players);
		$this->activeDuels[] = $duel;

		return true;
	}

	public function endDuel(Duel $duel) : bool {
		if(!in_array($duel, $this->activeDuels, true)) return false;
		$duel->onEnd();

		return true;
	}

	public function getDuelByPlayer(Player $player) : ?Duel {
		foreach($this->activeDuels as $duel) {
			foreach($duel->getPlayers() as $player) {
				if($player == $player) return $duel;
			}
		}

		return null;
	}

		/** @var Duel[] */
	public function getActiveDuels() : array {
		return $this->activeDuels;
	}

	public function isRunning(Duel $duel) : bool {
		if(in_array($duel, $this->activeDuels, true)) return true;

		return false;
	}
}
