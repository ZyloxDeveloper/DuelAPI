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

namespace ZyloxDeveloper\DuelAPITestPlugin\duel;

use pocketmine\player\Player;
use ZyloxDeveloper\DuelAPI\duel\Duel;
use function count;

class TestDuel extends Duel{

	protected int $queueDuration = 1;
	protected int $maxDuration = 1;

	public function onQueue() : void {
		foreach($this->getPlayers() as $player) {
			$player->sendMessage("You are now queuing for a duel...");
			// Send a message to each player indicating they are queuing for a duel
			// Freeze each player to prevent movement
			// Teleport each player to the designated spawn point
			// Clear the player's inventory
			// Give each player the duel kit
			// Set each player's health to maximum
			// Set each player's hunger level to full
			// Apply any necessary potion effects to each player (e.g., resistance, speed)
		}
	}

	public function onStart() : void {
		foreach($this->getPlayers() as $player) {
			$player->sendMessage("The duel is now starting...");
			// Unfreeze all players to allow movement
			// Teleport players to their duel positions (if different from spawn point)
			// Clear any temporary effects that should not persist into the duel
			// Apply duel-specific effects or buffs
			// Ensure all players' health and hunger levels are full
			// Start the duel timer (if applicable)
			// Enable PvP mode
			// Send a message to all players confirming the duel has started
		}
	}

	public function onEnd() : void {
		foreach($this->getPlayers() as $player) {
			$player->sendMessage("The duel has ended...");
			// Announce the end of the duel to all players
			// Freeze all players to prevent movement
			// Teleport players back to the main lobby or designated area
			// Clear players' inventories of duel items
			// Restore players' original inventories (if applicable)
			// Clear any duel-specific effects or buffs
			// Restore players' health and hunger levels to full
			// Disable PvP mode
			// Reward the winner(s) (e.g., with points, items, etc.)
			// Send a message to all players confirming the duel has ended and announce the winner
		}
	}

	public function onTick() : void {
		foreach($this->getPlayers() as $player) {
			$player->sendActionBarMessage("There are " . count($this->players) . " remaining...");
		}
	}

	public function onKill(Player $damager, Player $damaged) : void {
		foreach($this->getPlayers() as $player) {
			$player->sendMessage($damaged->getName() . " has killed " . $damager->getName() . ".");
		}
	}
}
