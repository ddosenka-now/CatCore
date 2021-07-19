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

/**
 * This class must be extended by all custom threading classes
 */
abstract class Worker extends \Worker {

	/** @var \ClassLoader */
	protected $classLoader;

	protected $isKilled = false;

	public function registerClassLoader(){
		if(!interface_exists("ClassLoader", false)){
			require(\pocketmine\PATH . "src/spl/ClassLoader.php");
			require(\pocketmine\PATH . "src/spl/BaseClassLoader.php");
			require(\pocketmine\PATH . "src/pocketmine/CompatibleClassLoader.php");
		}
		if($this->classLoader !== null){
			$this->classLoader->register(true);
		}
	}

	/**
	 * @param int $options
	 *
	 * @return bool
	 */
	public function start(?int $options = PTHREADS_INHERIT_ALL){
		ThreadManager::getInstance()->add($this);

		if(!$this->isRunning() and !$this->isJoined() and !$this->isTerminated()){
			if($this->getClassLoader() === null){
				$this->setClassLoader();
			}

			return parent::start($options);
		}

		return false;
	}

	/**
	 * @return \ClassLoader
	 */
	public function getClassLoader(){
		return $this->classLoader;
	}

	/**
	 * @param \ClassLoader|null $loader
	 */
	public function setClassLoader(\ClassLoader $loader = null){
		if($loader === null){
			$loader = Server::getInstance()->getLoader();
		}
		$this->classLoader = $loader;
	}

	/**
	 * Stops the thread using the best way possible. Try to stop it yourself before calling this.
	 */
	public function quit(){
		$this->isKilled = true;

		$this->notify();

		if($this->isRunning()){
			$this->shutdown();
			$this->notify();
			$this->unstack();
		}elseif(!$this->isJoined()){
			if(!$this->isTerminated()){
				$this->join();
			}
		}

		ThreadManager::getInstance()->remove($this);
	}

	/**
	 * @return string
	 */
	public function getThreadName(){
		return (new \ReflectionClass($this))->getShortName();
	}
}
