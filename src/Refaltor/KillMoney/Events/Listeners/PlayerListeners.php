<?php

namespace Refaltor\KillMoney\Events\Listeners;

use onebone\economyapi\EconomyAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\Player;
use Refaltor\KillMoney\Main;

class PlayerListeners implements Listener
{
    /** @var Main */
    public $plugin;

    public function __construct(Main $main)
    {
        $this->plugin = $main;
    }

    public function onDeath(PlayerDeathEvent $event): void {
        $victim = $event->getPlayer();
        $cause = $victim->getLastDamageCause()->getCause();
        if ($cause === 1) {
            $damager = $victim->getLastDamageCause()->getDamager();
            if ($damager instanceof Player) {
                $config = $this->plugin->getConfig();
                $money = 1000;
                if ($config->exists('killMoney')) $money = intval($config->get('killMoney'));
                EconomyAPI::getInstance()->addMoney($damager, $money);
            }
        }
    }
}