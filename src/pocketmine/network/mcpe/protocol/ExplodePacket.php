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


class ExplodePacket extends DataPacket {

	const NETWORK_ID = ProtocolInfo::EXPLODE_PACKET;

	public $x;
	public $y;
	public $z;
	/** @var float */
	public $radius;
	/** @var Vector3[] */
	public $records = [];

	/**
	 * @return $this
	 */
	public function clean(){
		$this->records = [];
		return parent::clean();
	}

	/**
	 *
	 */
	public function decode(){

	}

	/**
	 *
	 */
	public function encode(){
		$this->reset();
		$this->putVector3f($this->x, $this->y, $this->z);
		$this->putVarInt((int) ($this->radius * 32));
		$this->putUnsignedVarInt(count($this->records));
		if(count($this->records) > 0){
			foreach($this->records as $record){
				$this->putBlockCoords((int) $record->x, (int) $record->y, (int) $record->z);
			}
		}
	}

	/**
	 * @return string Current packet name
	 */
	public function getName(){
		return "ExplodePacket";
	}

}