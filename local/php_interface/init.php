<?php 
// init
// consts
define('CATALOG_ID', 7);

define('PATH_NOPHOTO', '/images/no-photo.png');



function help_arr($arr) {
    echo '<pre>'.print_r($arr, true).'</pre>';
}


function resize_img($img_id, $resize_type = BX_RESIZE_IMAGE_PROPORTIONAL_ALT, $width = 100, $height = 150) {
    return CFile::ResizeImageGet($img_id, array('width'=>$width, 'height'=>$height), $resize_type, true);
}


function getSectionsTabs() {
	$arSort = array("SORT" => "ASC");
	$arFilter = array("IBLOCK_ID" => CATALOG_ID, "DEPTH_LEVEL" => 1, 'ACTIVE' => 'Y');
	$arSelect = array("ID", "NAME");
	$sections = [];
	$itemsList = CIBlockSection::GetList($arSort, $arFilter, false, $arSelect, false);
	if ($itemsList->SelectedRowsCount() > 0) {
		while ($item = $itemsList->Fetch()) {
			$sections[] = $item;
		}
	}
	return $sections;
}

//AddEventHandler("main", "OnBeforeProlog", "setAgent");

// создание крон функции для битрикс
/* function setAgent() {
	if (isset($_GET['setagent'])) {
		$time = date('d.m.Y H:i:00', strtotime('+1 minute', time()));
		echo CAgent::AddAgent(
			"sendEmail1('$time');", // имя функции
			"",                          // идентификатор модуля
			"Y",                                  // агент не критичен к кол-ву запусков
			20,                                // интервал запуска - 1 сутки
			date('d.m.Y H:i:s'),                // дата первой проверки на запуск
			"Y",                                  // агент активен
			$time,                // дата первого запуска
			100);
		exit;
	}
}

setAgent();

function sendEmail1() {
	mail('ceo@aleksinsky.ru', 'test', 'test');
}

*/