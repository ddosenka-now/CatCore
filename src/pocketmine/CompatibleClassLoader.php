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

class CompatibleClassLoader extends \BaseClassLoader {

}