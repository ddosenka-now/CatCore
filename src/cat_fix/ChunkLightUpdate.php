<?php

namespace cat_fix;

use pocketmine\event\level\ChunkLoadEvent;
use pocketmine\event\Listener;
use pocketmine\level\generator\LightPopulationTask;

class ChunkLightUpdate extends PluginBase implements Listener{

public function updateLight(ChunkLoadEvent $event){

$this->getServer()->getScheduler()->scheduleAsyncTask(new LightPopulationTask($event->getLevel(), $event->getChunk()));
    }
}