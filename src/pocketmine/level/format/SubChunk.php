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

declare(strict_types=1);

namespace pocketmine\level\format;

use function assert;
use function chr;
use function define;
use function defined;
use function ord;
use function str_repeat;
use function strlen;
use function substr;
use function substr_count;

if(!defined(__NAMESPACE__ . '\ZERO_NIBBLE_ARRAY')){
	define(__NAMESPACE__ . '\ZERO_NIBBLE_ARRAY', str_repeat("\x00", 2048));
}

class SubChunk {
	private const ZERO_NIBBLE_ARRAY = ZERO_NIBBLE_ARRAY;

	/** @var string */
	protected $ids;
	/** @var string */
	protected $data;
	/** @var string */
	protected $blockLight;
	/** @var string */
	protected $skyLight;

	private static function assignData(string $data, int $length, string $value = "\x00") : string{
		if(strlen($data) !== $length){
			assert($data === "", "Invalid non-zero length given, expected $length, got " . strlen($data));
			return str_repeat($value, $length);
		}
		return $data;
	}

	/**
	 * SubChunk constructor.
	 *
	 * @param string $ids
	 * @param string $data
	 * @param string $skyLight
	 * @param string $blockLight
	 */
	public function __construct(string $ids = "", string $data = "", string $skyLight = "", string $blockLight = ""){
		$this->ids = self::assignData($ids, 4096);
		$this->data = self::assignData($data, 2048);
		$this->skyLight = self::assignData($skyLight, 2048, "\xff");
		$this->blockLight = self::assignData($blockLight, 2048);
		$this->collectGarbage();
	}

	/**
	 * @return bool
	 */
	public function isEmpty() : bool{
		assert(strlen($this->ids) === 4096, "Wrong length of ID array, expecting 4096 bytes, got " . strlen($this->ids));
		return substr_count($this->ids, "\x00") === 4096;
	}

	/**
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 *
	 * @return int
	 */
	public function getBlockId(int $x, int $y, int $z) : int{
		return ord($this->ids[($x << 8) | ($z << 4) | $y]);
	}

	/**
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 * @param int $id
	 *
	 * @return bool
	 */
	public function setBlockId(int $x, int $y, int $z, int $id) : bool{
		$this->ids[($x << 8) | ($z << 4) | $y] = chr($id);
		return true;
	}

	/**
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 *
	 * @return int
	 */
	public function getBlockData(int $x, int $y, int $z) : int{
		return (ord($this->data{($x << 7) | ($z << 3) | ($y >> 1)}) >> (($y & 1) << 2)) & 0xf;
	}

	/**
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 * @param int $data
	 *
	 * @return bool
	 */
	public function setBlockData(int $x, int $y, int $z, int $data) : bool{
		$i = ($x << 7) | ($z << 3) | ($y >> 1);

		$shift = ($y & 1) << 2;
		$byte = ord($this->data[$i]);
		$this->data[$i] = chr(($byte & ~(0xf << $shift)) | (($data & 0xf) << $shift));

		return true;
	}

	/**
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 *
	 * @return int
	 */
	public function getFullBlock(int $x, int $y, int $z) : int{
		$i = ($x << 8) | ($z << 4) | $y;
		return (ord($this->ids[$i]) << 4) | ((ord($this->data{$i >> 1}) >> (($y & 1) << 2)) & 0xf);
	}

	/**
	 * @param int  $x
	 * @param int  $y
	 * @param int  $z
	 * @param null $id
	 * @param null $data
	 *
	 * @return bool
	 */
	public function setBlock(int $x, int $y, int $z, $id = null, $data = null) : bool{
		$i = ($x << 8) | ($z << 4) | $y;
		$changed = false;
		if($id !== null){
			$block = chr($id);
			if($this->ids[$i] !== $block){
				$this->ids[$i] = $block;
				$changed = true;
			}
		}

		if($data !== null){
			$i >>= 1;

			$shift = ($y & 1) << 2;
			$oldPair = ord($this->data[$i]);
			$newPair = ($oldPair & ~(0xf << $shift)) | (($data & 0xf) << $shift);
            if($newPair !== $oldPair){
                $this->data[$i] = chr($newPair);
				$changed = true;
			}
		}

		return $changed;
	}

	/**
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 *
	 * @return int
	 */
	public function getBlockLight(int $x, int $y, int $z) : int{
		return (ord($this->blockLight{($x << 7) | ($z << 3) | ($y >> 1)}) >> (($y & 1) << 2)) & 0xf;
	}

	/**
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 * @param int $level
	 *
	 * @return bool
	 */
	public function setBlockLight(int $x, int $y, int $z, int $level) : bool{
		$i = ($x << 7) | ($z << 3) | ($y >> 1);

		$shift = ($y & 1) << 2;
		$byte = ord($this->blockLight[$i]);
		$this->blockLight[$i] = chr(($byte & ~(0xf << $shift)) | (($level & 0xf) << $shift));

		return true;
	}

	/**
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 *
	 * @return int
	 */
	public function getBlockSkyLight(int $x, int $y, int $z) : int{
		return (ord($this->skyLight{($x << 7) | ($z << 3) | ($y >> 1)}) >> (($y & 1) << 2)) & 0xf;
	}

	/**
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 * @param int $level
	 *
	 * @return bool
	 */
	public function setBlockSkyLight(int $x, int $y, int $z, int $level) : bool{
		$i = ($x << 7) | ($z << 3) | ($y >> 1);

		$shift = ($y & 1) << 2;
		$byte = ord($this->skyLight[$i]);
		$this->skyLight[$i] = chr(($byte & ~(0xf << $shift)) | (($level & 0xf) << $shift));

		return true;
	}

	/**
	 * @param int $x
	 * @param int $z
	 *
	 * @return int
	 */
	public function getHighestBlockAt(int $x, int $z) : int{
		$low = ($x << 8) | ($z << 4);
		$i = $low | 0x0f;
		for(; $i >= $low; --$i){
			if($this->ids[$i] !== "\x00"){
				return $i & 0x0f;
			}
		}

		return -1; //highest block not in this subchunk
	}

	/**
	 * @param int $x
	 * @param int $z
	 *
	 * @return string
	 */
	public function getBlockIdColumn(int $x, int $z) : string{
		return substr($this->ids, (($x << 8) | ($z << 4)), 16);
	}

	/**
	 * @param int $x
	 * @param int $z
	 *
	 * @return string
	 */
	public function getBlockDataColumn(int $x, int $z) : string{
		return substr($this->data, (($x << 7) | ($z << 3)), 8);
	}

	/**
	 * @param int $x
	 * @param int $z
	 *
	 * @return string
	 */
	public function getBlockLightColumn(int $x, int $z) : string{
		return substr($this->blockLight, (($x << 7) | ($z << 3)), 8);
	}

	/**
	 * @param int $x
	 * @param int $z
	 *
	 * @return string
	 */
	public function getSkyLightColumn(int $x, int $z) : string{
		return substr($this->skyLight, (($x << 7) | ($z << 3)), 8);
	}

	/**
	 * @return string
	 */
	public function getBlockIdArray() : string{
		assert(strlen($this->ids) === 4096, "Wrong length of ID array, expecting 4096 bytes, got " . strlen($this->ids));
		return $this->ids;
	}

	/**
	 * @return string
	 */
	public function getBlockDataArray() : string{
		assert(strlen($this->data) === 2048, "Wrong length of data array, expecting 2048 bytes, got " . strlen($this->data));
		return $this->data;
	}

	/**
	 * @return string
	 */
	public function getSkyLightArray() : string{
		assert(strlen($this->skyLight) === 2048, "Wrong length of skylight array, expecting 2048 bytes, got " . strlen($this->skyLight));
		return $this->skyLight;
	}

	public function setBlockSkyLightArray(string $data){
		assert(strlen($data) === 2048, "Wrong length of skylight array, expecting 2048 bytes, got " . strlen($data));
		$this->skyLight = $data;
	}

	/**
	 * @return string
	 */
	public function getBlockLightArray() : string{
		assert(strlen($this->blockLight) === 2048, "Wrong length of light array, expecting 2048 bytes, got " . strlen($this->blockLight));
		return $this->blockLight;
	}

	public function setBlockLightArray(string $data){
		assert(strlen($data) === 2048, "Wrong length of light array, expecting 2048 bytes, got " . strlen($data));
		$this->blockLight = $data;
	}

	/**
	 * @return string
	 */
	public function networkSerialize() : string{
		// storage version, ids, data, skylight, blocklight
		return "\x00" . $this->ids . $this->data . $this->skyLight . $this->blockLight;
	}

	/**
	 * @return mixed[]
	 */
	public function __debugInfo(){
		return [];
	}

	public function collectGarbage() : void{
		/*
		 * This strange looking code is designed to exploit PHP's copy-on-write behaviour. Assigning will copy a
		 * reference to the const instead of duplicating the whole string. The string will only be duplicated when
		 * modified, which is perfect for this purpose.
		 */
		if($this->data === self::ZERO_NIBBLE_ARRAY){
			$this->data = self::ZERO_NIBBLE_ARRAY;
		}
		if($this->skyLight === self::ZERO_NIBBLE_ARRAY){
			$this->skyLight = self::ZERO_NIBBLE_ARRAY;
		}
		if($this->blockLight === self::ZERO_NIBBLE_ARRAY){
			$this->blockLight = self::ZERO_NIBBLE_ARRAY;
		}
	}
}