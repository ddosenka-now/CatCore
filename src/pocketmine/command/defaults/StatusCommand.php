<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

namespace pocketmine\command\defaults;

use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Utils;

class StatusCommand extends VanillaCommand {

	/**
	 * StatusCommand constructor.
	 *
	 * @param $name
	 */
	public function __construct($name){
		parent::__construct(
			$name,
			"%pocketmine.command.status.description",
			"%pocketmine.command.status.usage"
		);
		$this->setPermission("pocketmine.command.status");
	}

	/**
	 * @param CommandSender $sender
	 * @param string        $currentAlias
	 * @param array         $args
	 *
	 * @return bool
	 */
	public function execute(CommandSender $sender, $currentAlias, array $args){
		if(!$this->testPermission($sender)){
			return true;
		}

		$rUsage = Utils::getRealMemoryUsage();
		$mUsage = Utils::getMemoryUsage(true);

		$server = $sender->getServer();
		$sender->sendMessage("§e§l[§6Cat§fCore§e] §7- §e§lСтатус §fсервера");

		$time = (int) (microtime(true) - \pocketmine\START_TIME);

		$seconds = $time % 60;
		$minutes = null;
		$hours = null;
		$days = null;

		if($time >= 60){
			$minutes = floor(($time % 3600) / 60);
			if($time >= 3600){
				$hours = floor(($time % (3600 * 24)) / 3600);
				if($time >= 3600 * 24){
					$days = floor($time / (3600 * 24));
				}
			}
		}

		$uptime = ($minutes !== null ?
				($hours !== null ?
					($days !== null ?
						"$days дней "
					: "") . "$hours часов(-а) "
					: "") . "$minutes минут(-ы) "
			: "") . "$seconds секунд(-ы)";

		$sender->sendMessage("§e§l[§6Cat§fCore§e] §7- §e§lСколько §6живет: §f". $uptime ."");

		$tpsColor = TextFormat::GREEN;
		if($server->getTicksPerSecond() < 17){
			$tpsColor = TextFormat::GOLD;
		}elseif($server->getTicksPerSecond() < 12){
			$tpsColor = TextFormat::RED;
		}

		$sender->sendMessage("§e§l[§6Cat§fCore§e] §7- §6§lTPS §eСервера §e" . $server->getTicksPerSecond() . " (§6" . $server->getTickUsage() . "%§f)");
		$sender->sendMessage("§e§l[§6Cat§fCore§e] §7- §6§lСредний §eTPS сервера: §f" . $server->getTicksPerSecondAverage() . " §e(§6" . $server->getTickUsageAverage() . "%§e)");
		
	}
}
