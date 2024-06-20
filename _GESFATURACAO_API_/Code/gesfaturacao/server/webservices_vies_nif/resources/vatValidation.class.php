<?php

# =================================
# Copyright (c) 2011, Edwin Hermans
# @Licence - LICENCE
# @Readme - README.MD
# ---------------------------------
# 
# Altered By Tiago Pais - Ftkode - 20/02/2020
# =================================

# LIBS
use SoapClient;

# INIT CLASS
class vatValidation
{
	# INIT VARS
	const WSDL = "http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl";
	private $_client = null;

	private $_options  = array(
						'debug' => false,
						);	
	
	private $_valid = false;
	private $_data = array();
	
	# START CONSTRUCT
	public function __construct($options = array(), $wsdlCustomStr = "") {
		# DEFINE OPTIONS
		foreach($options as $option => $value) {
			$this->_options[$option] = $value;
		}
		
		# CHECK NECESSARY DEPENDENCIES
		if(!class_exists('SoapClient')) {
			throw new Exception('The Soap library has to be installed and enabled');
		}
		
		# CALL REMOTE WS	
		try {
			$finalWSDL = self::WSDL;
			
			if($wsdlCustomStr && $wsdlCustomStr != '' ) $finalWSDL = $wsdlCustomStr;

			$this->_client = new SoapClient(self::WSDL, array('trace' => true) );
		} catch(Exception $e) {
			$this->trace('Vat Translation Error', $e->getMessage());
		}
	}

	# METHODS
	
	# CHECK VAT NUMBER AND GET INFO FROM WS
	public function checkVatNumber($countryCode, $vatNumber) {

		$rs = $this->_client->checkVat( array('countryCode' => $countryCode, 'vatNumber' => $vatNumber) );

		if($this->isDebug()) {
			$this->trace('Web Service result', $this->_client->__getLastResponse());	
		}

		if($rs->valid) {
			$this->_valid = true;
			$name_arr = explode(" ", $rs->name, 2);
			if (count($name_arr) > 1) {
				list($denomination,$name) = $name_arr;
			} else {
				$denomination = $name_arr[0];
				$name = "";
			}
			$this->_data = array(
									'denomination' => 	$denomination, 
									'name' => 			$this->cleanUpString($name), 
									'address' => 		$this->cleanUpString($rs->address),
								);
			return true;
		} else {
			$this->_valid = false;
			$this->_data = array();
		    return false;
		}
	}

	# RETURN VALIDATION BOOL
	public function isValid() {
		return $this->_valid;
	}
	
	# RETURN DENOMINATION IF EXISTS
	public function getDenomination() {
		return $this->_data['denomination'];
	}
	
	# RETURN NAME IF EXISTS
	public function getName() {
		return $this->_data['name'];
	}

	# RETURN ADDRESS IF EXISTS
	public function getAddress() {
		return $this->_data['address'];
	}

	# RETURN DEBUG
	public function isDebug() {
		return ($this->_options['debug'] === true);
	}
	private function trace($title,$body) {
		echo '<h2>TRACE: '.$title.'</h2><pre>'. htmlentities($body).'</pre>';
	}

	# HELPER FUNC CLEAN STRING
	private function cleanUpString($string) {
        for($i=0;$i<100;$i++)
        {               
            $newString = str_replace("  "," ",$string);
            if($newString === $string) {
            	break;
            } else {
            	$string = $newString;
			}
        }
                        
        $newString = "";
        $words = explode(" ",$string);
        foreach($words as $k=>$w)
        {                       
           	$newString .= ucfirst(strtolower($w))." "; 
        }                
        return $newString;
	}
}

?>
