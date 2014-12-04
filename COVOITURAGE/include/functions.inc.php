<?php
	function getEnglishDate($date){
		$membres = explode('/', $date);
		$date = $membres[2].'-'.$membres[1].'-'.$membres[0];
		return $date;
	}
	
	function addJours($date, $nbJours){
        $membres = explode('/', $date);
        $date = $membres[2].'-'.$membres[1].'-'.$membres[0];
        $date = date('Y-m-d', strtotime($date. ' + '.$nbJours.' days'));
        return $date;
	}

    function removeJours($date, $nbJours){
        $membres = explode('/', $date);
        $date = $membres[2].'-'.$membres[1].'-'.$membres[0];
        $date = date('Y-m-d', strtotime($date. ' - '.$nbJours.' days'));
        return $date;
	}
	
?>