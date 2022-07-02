<?php
	class huruf{
		private $bil;
		public function __construct(){
			$this->bil = 0;
		}
		public function terbilang($n){
			$this->bil = $n;
			$bilangan = array("NOL","SATU","DUA","TIGA","EMPAT","LIMA","ENAM","TUJUH","DELAPAN","SEMBILAN","SEPULUH","SEBELAS");
			if($this->bil < 12){
				return $bilangan[$this->bil];
			} else if($this->bil < 20){
				$b = $this->bil % 10;
				return $this->terbilang($b)." BELAS ";
			} else if($this->bil < 100){
				$b = $this->bil % 10;
				$c = $this->bil / 10;
				if($b == 0){
					return $this->terbilang($c). " PULUH ";
				} else{
					return $this->terbilang($c). " PULUH ".$bilangan[$b];
				}
			} else if($this->bil < 200){
				$b = $this->bil % 100;
				$str = "";
				if($b == 0){
					return "SERATUS ";
				} else{
					return "SERATUS ".$this->terbilang($b);
				}
			} else if($this->bil < 1000){
				$b = $this->bil % 100;
				$c = $this->bil / 100;
				if($b == 0){
					return $bilangan[$c]. " RATUS ";
				} else{
					return $bilangan[$c]. " RATUS ".$this->terbilang($b);
				}
			} else if($this->bil < 2000){
				$b = $this->bil % 1000;
				$str = "";
				if($b == 0){
					return "SERIBU ";
				} else{
					return "SERIBU ".$this->terbilang($b);
				}
			} else if($this->bil < 1000000){
				$b = $this->bil % 1000;
				$c = $this->bil / 1000;
				if($b == 0){
					return $this->terbilang($c). " RIBU ";
				} else{
					return $this->terbilang($c). " RIBU ".$this->terbilang($b);
				}
			} else if($this->bil < 1000000000){
				$b = $this->bil % 1000000;
				$c = $this->bil / 1000000;
				if($b == 0){
					return $this->terbilang($c). " JUTA ";
				} else{
					return $this->terbilang($c). " JUTA ".$this->terbilang($b);
				}
			} else if($this->bil == 1000000000){
				return $this->terbilang($this->bil / 1000000000) . " MILYAR ";
			}
		}
	}
?>
