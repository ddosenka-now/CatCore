<?php

/*
*╭━━━╮╱╱╭╮╭━━━╮
*┃╭━╮┃╱╭╯╰┫╭━╮┃
*┃┃╱╰╋━┻╮╭┫┃╱╰╋━━┳━┳━━╮
*┃┃╱╭┫╭╮┃┃┃┃╱╭┫╭╮┃╭┫┃━┫
*┃╰━╯┃╭╮┃╰┫╰━╯┃╰╯┃┃┃┃━┫
*╰━━━┻╯╰┻━┻━━━┻━━┻╯╰━━╯
*
*Автор: https://vk.com/dixsin
*
*Версия ядра: 6.0-release
*
*Ядро переделано очень сильно, в отличии от *LiteCore тут куча всяких приколов и плюшек, *автор не несёт ответственности за насилие, *избиение и т.п умышленные действия!
*
*Советую войти в группу в вк: vk.com/*uptex_mcpe!
*/

namespace pocketmine;

use pocketmine\permission\ServerOperator;

interface IPlayer extends ServerOperator {

	/**
	 * @return bool
	 */
	public function isOnline();

	/**
	 * @return string
	 */
	public function getName();

	/**
	 * @return bool
	 */
	public function isBanned();

	/**
	 * @param bool $banned
	 */
	public function setBanned($banned);

	/**
	 * @return bool
	 */
	public function isWhitelisted();

	/**
	 * @param bool $value
	 */
	public function setWhitelisted($value);

	/**
	 * @return Player|null
	 */
	public function getPlayer();

	/**
	 * @return int|double
	 */
	public function getFirstPlayed();

	/**
	 * @return int|double
	 */
	public function getLastPlayed();

	/**
	 * @return mixed
	 */
	public function hasPlayedBefore();

}
