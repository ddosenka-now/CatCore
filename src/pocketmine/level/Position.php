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

namespace pocketmine\level;

use pocketmine\math\Vector3;
use pocketmine\utils\MainLogger;


class Position extends Vector3 {

	/** @var Level */
	public $level = null;

	/**
	 * @param int   $x
	 * @param int   $y
	 * @param int   $z
	 * @param Level $level
	 */
	public function __construct($x = 0, $y = 0, $z = 0, Level $level = null){
		parent::__construct($x, $y, $z);
		$this->setLevel($level);
	}

	/**
	 * @param Vector3    $pos
	 * @param Level|null $level
	 *
	 * @return Position
	 */
	public static function fromObject(Vector3 $pos, Level $level = null){
		return new Position($pos->x, $pos->y, $pos->z, $level);
	}

	/**
	 * Return a Position instance
	 * 
	 * @return Position
	 */
	public function asPosition() : Position{
		return new Position($this->x, $this->y, $this->z, $this->level);
	}

	/**
	 * @param int|Vector3 $x
	 * @param int         $y
	 * @param int         $z
	 *
	 * @return Position
	 */
	public function add($x, $y = 0, $z = 0){
		if($x instanceof Vector3){
			return new Position($this->x + $x->x, $this->y + $x->y, $this->z + $x->z, $this->level);
		}else{
			return new Position($this->x + $x, $this->y + $y, $this->z + $z, $this->level);
		}
	}

	/**
	 * @return Level
	 */
	public function getLevel(){
		if($this->level !== null and $this->level->isClosed()){
			MainLogger::getLogger()->debug("Position was holding a reference to an unloaded Level");
			$this->level = null;
		}

		return $this->level;
	}

	/**
	 * Sets the target Level of the position.
	 *
	 * @param Level|null $level
	 *
	 * @return $this
	 *
	 * @throws \InvalidArgumentException if the specified Level has been closed
	 */
	public function setLevel(Level $level = null){
		if($level !== null and $level->isClosed()){
			throw new \InvalidArgumentException("Specified level has been unloaded and cannot be used");
		}

		$this->level = $level;
		return $this;
	}

	/**
	 * Checks if this object has a valid reference to a loaded Level
	 */
	public function isValid() : bool{
		if($this->level !== null and $this->level->isClosed()){
			$this->level = null;

			return false;
		}

		return $this->level !== null;
	}

	/**
	 * Returns a side Vector
	 *
	 * @param int $side
	 * @param int $step
	 *
	 * @return Position
	 *
	 * @throws LevelException
	 */
	public function getSide($side, $step = 1){
		assert($this->isValid());

		return Position::fromObject(parent::getSide($side, $step), $this->level);
	}

	/**
	 * @return string
	 */
	public function __toString(){
		return "Position(level=" . ($this->isValid() ? $this->getLevel()->getName() : "null") . ",x=" . $this->x . ",y=" . $this->y . ",z=" . $this->z . ")";
	}

	/**
	 * @param $x
	 * @param $y
	 * @param $z
	 *
	 * @return Position
	 */
	public function setComponents($x, $y, $z){
		$this->x = $x;
		$this->y = $y;
		$this->z = $z;
		return $this;
	}

	/**
	 * @param Vector3 $pos
	 * @param         $x
	 * @param         $y
	 * @param         $z
	 *
	 * @return $this
	 */
	public function fromObjectAdd(Vector3 $pos, $x, $y, $z){
		if($pos instanceof Position){
			$this->level = $pos->level;
		}
		parent::fromObjectAdd($pos, $x, $y, $z);
		return $this;
	}

	public function equals(Vector3 $v) : bool{
		if($v instanceof Position){
			return parent::equals($v) and $v->getLevel() === $this->getLevel();
		}
		return parent::equals($v);
	}
}