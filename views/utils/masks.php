<?php
	class Masks {
		function formatarDataYMD($data){
			$data = explode('-', $data);
			$data = array_reverse($data);
			$data = implode('/', $data);

			return $data;
		}

		function formatarDateTimeYMD($datetime){
			$data = explode(' ', $datetime);

			return $this->formatarDataYMD($data[0]).' '.$data[1];
		}
	}
?>