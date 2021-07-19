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

namespace pocketmine\network\mcpe\protocol;

#include <rules/DataPacket.h>

class CommandStepPacket extends DataPacket {

	const NETWORK_ID = ProtocolInfo::COMMAND_STEP_PACKET;

	public $command;
	public $overload;
	public $uvarint1;
	public $uvarint2;
	public $bool;
	public $uvarint64;
	public $args; //JSON formatted command arguments
	public $string4;

	public function decode(){
		$this->command = $this->getString();
		$this->overload = $this->getString();
		$this->uvarint1 = $this->getUnsignedVarInt();
		$this->uvarint2 = $this->getUnsignedVarInt();
		$this->bool = (bool) $this->getByte();
		$this->uvarint64 = $this->getUnsignedVarInt(); //TODO: varint64
		$this->args = json_decode($this->getString());
		$this->string4 = $this->getString();
		while(!$this->feof()){
			$this->getByte(); //prevent assertion errors. TODO: find out why there are always 3 extra bytes at the end of this packet.
		}
	}

	public function encode(){

	}

}