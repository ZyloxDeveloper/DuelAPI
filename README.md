# DuelAPI

DuelAPI is a simple, yet powerful API plugin for PocketMine-MP v5 that allows developers to create highly customizable duel events with ease. With DuelAPI, you can easily manage duel queues, start and end duels, and customize every aspect of the duel experience.

## Features

- **Custom Duel Events**: Create and manage your own duel events by extending the base `Duel` class.
- **Queue Management**: Automatically handles queue durations and transitions to duel start.
- **Customizable Events**: Override methods to define custom behaviors for queuing, starting, ending, and handling kills during duels.
- **Scheduler Integration**: Use the built-in scheduler to manage timing of duel events.

## Installation

1. **Download the Plugin**: Download the DuelAPI plugin `.phar` file from the releases section.
2. **Place the Plugin**: Move the `.phar` file to the `plugins` directory of your PocketMine-MP server.
3. **Restart the Server**: Restart your PocketMine-MP server to enable the plugin.

## Usage

To create a custom duel event, follow these steps:

1. **Extend the Base Duel Class**: Create a new class that extends the `Duel` class.

2. **Implement Custom Behavior**: Override methods to customize the behavior of your duel.

### Example Custom Duel: `TestDuel`

Here's an example of a custom duel class that demonstrates how to override the default behavior:

```php
<?php
namespace YourNamespace;

use pocketmine\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\plugin\PluginBase;

class TestDuel extends Duel {

    protected int $queueDuration = 1; // Duration in seconds before the duel starts
    protected int $maxDuration = 1;   // Maximum duration in seconds for the duel

    public function onQueue() : void {
        foreach($this->getPlayers() as $player) {
            $player->sendMessage("You are now queuing for a duel...");
            // Custom behavior during the queue phase
        }
    }

    public function onStart() : void {
        foreach($this->getPlayers() as $player) {
            $player->sendMessage("The duel is now starting...");
            // Custom behavior when the duel starts
        }
    }

    public function onEnd() : void {
        foreach($this->getPlayers() as $player) {
            $player->sendMessage("The duel has ended...");
            // Custom behavior when the duel ends
        }
    }

    public function onTick() : void {
        foreach($this->getPlayers() as $player) {
            $player->sendActionBarMessage("There are " . count($this->players) . " remaining...");
            // Custom behavior for each tick of the duel
        }
    }

    public function onKill(Player $damager, Player $damaged) : void {
        foreach($this->getPlayers() as $player) {
            $player->sendMessage($damaged->getName() . " has killed " . $damager->getName() . ".");
            // Custom behavior when a player is killed
        }
    }
}
?>
```

### Base API Duel Class

The `Duel` class is the base class for all duels and provides the following methods:

- **`onQueue()`**: Called when the duel is in the queue phase.
- **`onStart()`**: Called when the duel starts.
- **`onEnd()`**: Called when the duel ends.
- **`onTick()`**: Called on each tick of the duel.
- **`onPlayerAttack(Player $damager, Player $damaged)`**: Called when a player attacks another player.
- **`onKill(Player $damager, Player $damaged)`**: Called when a player kills another player.
- **`onDeath(Player $player)`**: Called when a player dies.

### Methods to Access Players

- **`getPlayers()`**: Returns an array of all players in the duel.

## Contributing

If you would like to contribute to DuelAPI, feel free to submit issues, suggest features, or create pull requests. Please follow the standard coding conventions and ensure your code is properly tested.

## License

DuelAPI is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

## Support

For support or inquiries, please open an issue on the [GitHub repository](https://github.com/ZyloxDeveloper/DuelAPI).

---

Enjoy creating custom duels with DuelAPI! If you have any questions or need assistance, don't hesitate to reach out.
