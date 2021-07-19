<?php

namespace pocketmine\command\defaults;

use pocketmine\command\CommandSender;
use pocketmine\event\TranslationContainer;
use pocketmine\plugin\Plugin;
use pocketmine\catcore\InfoCmd;
use pocketmine\utils\TextFormat;

class InfoCommand extends VanillaCommand {

	/**
	 * VersionCommand constructor.
	 *
	 * @param string $name
	 */
  public function getVC() : string{
      return "6.0-release";
  }
  public function getAVC() : string{
      return "3.0.2";
  }
  public function getAC() : string{
      return "vk.com/dixsin";
  }
  public function getPC() : string{
      return " 110, 111, 112, 113";
  }

public function __construct($name){
		parent::__construct(
			$name,
			"%pocketmine.command.version.usage",
			["info", "information"]
		);
		$this->setPermission("pocketmine.command.info");
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
			return \true;
		}

		if(\count($args) === 0){
        $verc = $this->getVC();
        $verapic = $this->getAVC();
        $authc = $this->getAC();
        $protc = $this->getPC();

			$sender->sendMessage(new TranslationContainer("Информация о ядре CatCore:\nВерсия ядра: ". $verc ."\nApi версия ядра: ". $verapic ."\nОфициальный Автор ядра: ". $authc ."\nРазрешеные протоколы: ". $protc .""));
    }
  }
}
