<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Baseintencoder {
	/*
	* Produce short base x value for a numeric id, or restores original id from base-converted string
	* USAGE:
	*	default params:		$this->load->library('baseintencoder');
	*	custom base:		$this->load->library('baseintencoder', array("0123456789abcdef"));
	*	Encode:				$this->baseintencoder->encode(2752); Decode: $this->baseintencoder->decode("Si4");
	*/
	private $codeset = "abcdefghijkmnopqrstvuwxyz123456789BCDEFGHIJKLMNPQRSTUVWXY";

	/*
	* Constructor
	*/
	public function __construct($config = array()) {
		if(!empty($config)) $this->codeset = $config[0];
	}
	
	public function encode($num) {
		$base = strlen($this->codeset);
		$converted = '';
		while ($num > 0) {
			$converted = substr($this->codeset, bcmod($num,$base), 1) . $converted;
			$num = $this->_bcFloor(bcdiv($num, $base));
		}
		return $converted ;
	}

	public function decode($code) {
		$base = strlen($this->codeset);
		$c = '0';
		for ($i = strlen($code); $i; $i--) {
			$c = bcadd($c,bcmul(strpos($this->codeset, substr($code, (-1 * ( $i - strlen($code) )),1)) ,bcpow($base,$i-1)));
		}
		return bcmul($c, 1, 0);
	}

	private function _bcFloor($x) {
		return bcmul($x, '1', 0);
	}

	private function _bcCeil($x) {
		$floor = $this->_bcFloor($x);
		return bcadd($floor, ceil(bcsub($x, $floor)));
	}

	private function _bcRound($x) {
		$floor = $this->_bcFloor($x);
		return bcadd($floor, round(bcsub($x, $floor)));
	}
}

/* End of file */
