<?php

namespace Refaltor\KillMoney;

use pocketmine\plugin\PluginBase;
use Refaltor\KillMoney\Events\Listeners\PlayerListeners;

class Main extends PluginBase
{
    public function onEnable()
    {
        if (is_null($this->getServer()->getPluginManager()->getPlugin('EconomyAPI'))) {
            $this->getServer()->getLogger()->error('EconomyAPI is not installed.');
            $this->getServer()->getPluginManager()->disablePlugin($this);
        }
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents(new PlayerListeners($this), $this);
    }
}