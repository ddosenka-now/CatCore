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

namespace pocketmine\wizard;


class InstallerLang {
	public static $languages = [
		"eng" => "English",
		"chs" => "简体中文",
		"zho" => "繁體中文",
		"jpn" => "日本語",
		"rus" => "Русский",
		"ita" => "Italiano",
		"kor" => "한국어",
		"deu" => "Deutsch",
		"fra" => "Français",
		"ind" => "Bahasa Indonesia",
		"ukr" => "Хохл'вский"
	];
	private $texts = [];
	private $lang;
	private $langfile;

	/**
	 * InstallerLang constructor.
	 *
	 * @param string $lang
	 */
	public function __construct($lang = ""){
		if(file_exists(\pocketmine\PATH . "src/pocketmine/lang/Installer/" . $lang . ".ini")){
			$this->lang = $lang;
			$this->langfile = \pocketmine\PATH . "src/pocketmine/lang/Installer/" . $lang . ".ini";
		}else{
			$files = [];
			foreach(new \DirectoryIterator(\pocketmine\PATH . "src/pocketmine/lang/Installer/") as $file){
				if($file->getExtension() === "ini" and substr($file->getFilename(), 0, 2) === $lang){
					$files[$file->getFilename()] = $file->getSize();
				}
			}

			if(count($files) > 0){
				arsort($files);
				reset($files);
				$l = key($files);
				$l = substr($l, 0, -4);
				$this->lang = isset(self::$languages[$l]) ? $l : $lang;
				$this->langfile = \pocketmine\PATH . "src/pocketmine/lang/Installer/" . $l . ".ini";
			}else{
				$this->lang = "en";
				$this->langfile = \pocketmine\PATH . "src/pocketmine/lang/Installer/eng.ini";
			}
		}

		$this->loadLang(\pocketmine\PATH . "src/pocketmine/lang/Installer/eng.ini", "eng");
		if($this->lang !== "en"){
			$this->loadLang($this->langfile, $this->lang);
		}

	}

	/**
	 * @return string
	 */
	public function getLang(){
		return ($this->lang);
	}

	/**
	 * @param        $langfile
	 * @param string $lang
	 */
	public function loadLang($langfile, $lang = "en"){
		$this->texts[$lang] = [];
		$texts = explode("\n", str_replace(["\r", "\\/\\/"], ["", "//"], file_get_contents($langfile)));
		foreach($texts as $line){
			$line = trim($line);
			if($line === ""){
				continue;
			}
			$line = explode("=", $line);
			$this->texts[$lang][trim(array_shift($line))] = trim(str_replace(["\\n", "\\N",], "\n", implode("=", $line)));
		}
	}

	/**
	 * @param       $name
	 * @param array $search
	 * @param array $replace
	 *
	 * @return mixed
	 */
	public function get($name, $search = [], $replace = []){
		if(!isset($this->texts[$this->lang][$name])){
			if($this->lang !== "en" and isset($this->texts["en"][$name])){
				return $this->texts["en"][$name];
			}else{
				return $name;
			}
		}elseif(count($search) > 0){
			return str_replace($search, $replace, $this->texts[$this->lang][$name]);
		}else{
			return $this->texts[$this->lang][$name];
		}
	}

	/**
	 * @param $name
	 *
	 * @return mixed
	 */
	public function __get($name){
		return $this->get($name);
	}

}
