<?php

/*██████████████████████████████████████████████████████████████████████████████████████████████████████████████
/*█▒▒▒▒▒▒▒▒▒▒▒▒▒▒█▒▒▒▒▒▒▒▒▒▒▒▒▒▒█▒▒▒▒▒▒▒▒▒▒▒▒▒▒█▒▒▒▒▒▒▒▒▒▒▒▒▒▒█▒▒▒▒▒▒▒▒▒▒▒▒▒▒█▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒███▒▒▒▒▒▒▒▒▒▒▒▒▒▒█
/*█▒▒▄▄▄▄▄▄▄▄▄▄▒▒█▒▒▄▄▄▄▄▄▄▄▄▄▒▒█▒▒▄▄▄▄▄▄▄▄▄▄▒▒█▒▒▄▄▄▄▄▄▄▄▄▄▒▒█▒▒▄▄▄▄▄▄▄▄▄▄▒▒█▒▒▄▄▄▄▄▄▄▄▄▄▄▄▒▒███▒▒▄▄▄▄▄▄▄▄▄▄▒▒█
/*█▒▒▄▄▒▒▒▒▒▒▒▒▒▒█▒▒▄▄▒▒▒▒▒▒▄▄▒▒█▒▒▒▒▒▒▄▄▒▒▒▒▒▒█▒▒▄▄▒▒▒▒▒▒▒▒▒▒█▒▒▄▄▒▒▒▒▒▒▄▄▒▒█▒▒▄▄▒▒▒▒▒▒▒▒▄▄▒▒███▒▒▄▄▒▒▒▒▒▒▒▒▒▒█
/*█▒▒▄▄▒▒█████████▒▒▄▄▒▒██▒▒▄▄▒▒█████▒▒▄▄▒▒█████▒▒▄▄▒▒█████████▒▒▄▄▒▒██▒▒▄▄▒▒█▒▒▄▄▒▒████▒▒▄▄▒▒███▒▒▄▄▒▒█████████
/*█▒▒▄▄▒▒█████████▒▒▄▄▒▒▒▒▒▒▄▄▒▒█████▒▒▄▄▒▒█████▒▒▄▄▒▒█████████▒▒▄▄▒▒██▒▒▄▄▒▒█▒▒▄▄▒▒▒▒▒▒▒▒▄▄▒▒███▒▒▄▄▒▒▒▒▒▒▒▒▒▒█
/*█▒▒▄▄▒▒█████████▒▒▄▄▄▄▄▄▄▄▄▄▒▒█████▒▒▄▄▒▒█████▒▒▄▄▒▒█████████▒▒▄▄▒▒██▒▒▄▄▒▒█▒▒▄▄▄▄▄▄▄▄▄▄▄▄▒▒███▒▒▄▄▄▄▄▄▄▄▄▄▒▒█
/*█▒▒▄▄▒▒█████████▒▒▄▄▒▒▒▒▒▒▄▄▒▒█████▒▒▄▄▒▒█████▒▒▄▄▒▒█████████▒▒▄▄▒▒██▒▒▄▄▒▒█▒▒▄▄▒▒▒▒▒▒▄▄▒▒▒▒███▒▒▄▄▒▒▒▒▒▒▒▒▒▒█
/*█▒▒▄▄▒▒█████████▒▒▄▄▒▒██▒▒▄▄▒▒█████▒▒▄▄▒▒█████▒▒▄▄▒▒█████████▒▒▄▄▒▒██▒▒▄▄▒▒█▒▒▄▄▒▒██▒▒▄▄▒▒█████▒▒▄▄▒▒█████████
/*█▒▒▄▄▒▒▒▒▒▒▒▒▒▒█▒▒▄▄▒▒██▒▒▄▄▒▒█████▒▒▄▄▒▒█████▒▒▄▄▒▒▒▒▒▒▒▒▒▒█▒▒▄▄▒▒▒▒▒▒▄▄▒▒█▒▒▄▄▒▒██▒▒▄▄▒▒▒▒▒▒█▒▒▄▄▒▒▒▒▒▒▒▒▒▒█
/*█▒▒▄▄▄▄▄▄▄▄▄▄▒▒█▒▒▄▄▒▒██▒▒▄▄▒▒█████▒▒▄▄▒▒█████▒▒▄▄▄▄▄▄▄▄▄▄▒▒█▒▒▄▄▄▄▄▄▄▄▄▄▒▒█▒▒▄▄▒▒██▒▒▄▄▄▄▄▄▒▒█▒▒▄▄▄▄▄▄▄▄▄▄▒▒█
/*█▒▒▒▒▒▒▒▒▒▒▒▒▒▒█▒▒▒▒▒▒██▒▒▒▒▒▒█████▒▒▒▒▒▒█████▒▒▒▒▒▒▒▒▒▒▒▒▒▒█▒▒▒▒▒▒▒▒▒▒▒▒▒▒█▒▒▒▒▒▒██▒▒▒▒▒▒▒▒▒▒█▒▒▒▒▒▒▒▒▒▒▒▒▒▒█
/*██████████████████████████████████████████████████████████████████████████████████████████████████████████████
/*
/* × ████████████████████████ ×
/*    █       © Free Software, ® https://vk.com/dixsin        █
/*    █ Этот софт не приватный, но Харнэс может       █
/*    █ дать по ебалу за его распространение! Не        █
/*    █  пытайтесь скрыть то, что вы слили мой софт █
/* × ████████████████████████ ×
*/

namespace pocketmine;

use pocketmine\event\TranslationContainer;
use pocketmine\utils\TextFormat;

/**
 * Handles the achievement list and a bit more
 */
abstract class Achievement {
	/**
	 * @var array[]
	 */
	public static $list = [
		/*"openInventory" => array(
			"name" => "Taking Inventory",
			"requires" => [],
		),*/
		"mineWood" => [
			"name" => "Getting Wood",
			"requires" => [ //"openInventory",
			],
		],
		"buildWorkBench" => [
			"name" => "Benchmarking",
			"requires" => [
				"mineWood",
			],
		],
		"buildPickaxe" => [
			"name" => "Time to Mine!",
			"requires" => [
				"buildWorkBench",
			],
		],
		"buildFurnace" => [
			"name" => "Hot Topic",
			"requires" => [
				"buildPickaxe",
			],
		],
		"acquireIron" => [
			"name" => "Acquire hardware",
			"requires" => [
				"buildFurnace",
			],
		],
		"buildHoe" => [
			"name" => "Time to Farm!",
			"requires" => [
				"buildWorkBench",
			],
		],
		"makeBread" => [
			"name" => "Bake Bread",
			"requires" => [
				"buildHoe",
			],
		],
		"bakeCake" => [
			"name" => "The Lie",
			"requires" => [
				"buildHoe",
			],
		],
		"buildBetterPickaxe" => [
			"name" => "Getting an Upgrade",
			"requires" => [
				"buildPickaxe",
			],
		],
		"buildSword" => [
			"name" => "Time to Strike!",
			"requires" => [
				"buildWorkBench",
			],
		],
		"diamonds" => [
			"name" => "DIAMONDS!",
			"requires" => [
				"acquireIron",
			],
		],

	];


	/**
	 * @param Player $player
	 * @param        $achievementId
	 *
	 * @return bool
	 */
	public static function broadcast(Player $player, $achievementId){
		if(isset(Achievement::$list[$achievementId])){
			$translation = new TranslationContainer("chat.type.achievement", [$player->getDisplayName(), TextFormat::GREEN . Achievement::$list[$achievementId]["name"]]);
			if(Server::getInstance()->getConfigString("announce-player-achievements", true) === true){
				Server::getInstance()->broadcastMessage($translation);
			}else{
				$player->sendMessage($translation);
			}

			return true;
		}

		return false;
	}

	/**
	 * @param       $achievementId
	 * @param       $achievementName
	 * @param array $requires
	 *
	 * @return bool
	 */
	public static function add($achievementId, $achievementName, array $requires = []){
		if(!isset(Achievement::$list[$achievementId])){
			Achievement::$list[$achievementId] = [
				"name" => $achievementName,
				"requires" => $requires,
			];

			return true;
		}

		return false;
	}


}
