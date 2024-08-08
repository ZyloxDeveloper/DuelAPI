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

namespace ZyloxDeveloper\DuelAPITestPlugin;

use pocketmine\plugin\PluginBase;
use ZyloxDeveloper\DuelAPI\DuelAPI;
use ZyloxDeveloper\DuelAPITestPlugin\duel\TestDuel;

class Loader extends PluginBase{

	public function onEnable() : void {

		// Start with a custom duel class extending ZyloxDeveloper\DuelAPI\DuelAPI(),
		// Push all players involved in the duel into the function.
		DuelAPI::getInstance()->startDuel(new TestDuel());
	}
}
