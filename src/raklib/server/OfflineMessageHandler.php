<?php

/*
 * RakLib network library
 *
 *
 * This project is not affiliated with Jenkins Software LLC nor RakNet.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 */

declare(strict_types=1);

namespace raklib\server;

use raklib\protocol\IncompatibleProtocolVersion;
use raklib\protocol\OfflineMessage;
use raklib\protocol\OpenConnectionReply1;
use raklib\protocol\OpenConnectionReply2;
use raklib\protocol\OpenConnectionRequest1;
use raklib\protocol\OpenConnectionRequest2;
use raklib\protocol\UnconnectedPing;
use raklib\protocol\UnconnectedPong;
use function min;

class OfflineMessageHandler{
	/** @var SessionManager */
	private $sessionManager;

	public function __construct(SessionManager $manager){
		$this->sessionManager = $manager;
	}

	public function handle(OfflineMessage $packet, string $source, int $port){
		switch($packet::$ID){
			case UnconnectedPing::$ID:
				/** @var UnconnectedPing $packet */
				$pk = new UnconnectedPong();
				$pk->serverID = $this->sessionManager->getID();
				$pk->pingID = $packet->pingID;
				$pk->serverName = $this->sessionManager->getName();
				$this->sessionManager->sendPacket($pk, $source, $port);
				return true;
			case OpenConnectionRequest1::$ID:
				/** @var OpenConnectionRequest1 $packet */
				$serverProtocol = $this->sessionManager->getProtocolVersion();
				if($packet->protocol !== $serverProtocol){
					$pk = new IncompatibleProtocolVersion();
					$pk->protocolVersion = $serverProtocol;
					$pk->serverId = $this->sessionManager->getID();
					$this->sessionManager->sendPacket($pk, $source, $port);
					$this->sessionManager->getLogger()->notice("Refused connection from $source $port due to incompatible RakNet protocol version (expected $serverProtocol, got $packet->protocol)");
				}else{
					$pk = new OpenConnectionReply1();
					$pk->mtuSize = $packet->mtuSize + 28; //IP header size (20 bytes) + UDP header size (8 bytes)
					$pk->serverID = $this->sessionManager->getID();
					$this->sessionManager->sendPacket($pk, $source, $port);
				}
				return true;
			case OpenConnectionRequest2::$ID:
				/** @var OpenConnectionRequest2 $packet */

				if($packet->serverPort === $this->sessionManager->getPort() or !$this->sessionManager->portChecking){
					if($packet->mtuSize < Session::MIN_MTU_SIZE){
						$this->sessionManager->getLogger()->debug("Not creating session for $source $port due to bad MTU size $packet->mtuSize");
						return true;
					}
					$mtuSize = min($packet->mtuSize, $this->sessionManager->getMaxMtuSize()); //Max size, do not allow creating large buffers to fill server memory
					$pk = new OpenConnectionReply2();
					$pk->mtuSize = $mtuSize;
					$pk->serverID = $this->sessionManager->getID();
					$pk->clientAddress = $source;
					$pk->clientPort = $port;
					$this->sessionManager->sendPacket($pk, $source, $port);
					$this->sessionManager->createSession($source, $port, $packet->clientID, $mtuSize);
				}else{
					$this->sessionManager->getLogger()->debug("Not creating session for $source $port due to mismatched port, expected " . $this->sessionManager->getPort() . ", got " . $packet->serverPort);
				}

				return true;
		}

		return false;
	}

}