<?php
    class ControlPanelSettings {
        private $file = 'assets/xml/control_panel_settings.xml';
        private $xml;

        function ControlPanelSettings($rel = '') {
            $this->file = $rel . $this->file;
            
            if(!file_exists($this->file)) {
				echo $this->file;
                $xml = fopen($this->file, 'w');

                fwrite($xml, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL);
                fwrite($xml, '<settings>' . PHP_EOL);
                fwrite($xml, '<setting name="penalty" value="20"/>' . PHP_EOL);
                fwrite($xml, '<setting name="studentReservationPeriod" value="8"/>' . PHP_EOL);
                fwrite($xml, '<setting name="studentReservationLimit" value="2"/>' . PHP_EOL);
                fwrite($xml, '<setting name="studentLoanPeriod" value="5"/>' . PHP_EOL);
                fwrite($xml, '<setting name="studentLoanLimit" value="2"/>' . PHP_EOL);
                fwrite($xml, '<setting name="facultyReservationPeriod" value="7"/>' . PHP_EOL);
                fwrite($xml, '<setting name="facultyReservationLimit" value="2"/>' . PHP_EOL);
                fwrite($xml, '<setting name="facultyLoanPeriod" value="7"/>' . PHP_EOL);
                fwrite($xml, '<setting name="facultyLoanLimit" value="2"/>' . PHP_EOL);
                fwrite($xml, '</settings>' . PHP_EOL);
                fclose($xml);
            }

            $this->xml = simplexml_load_file($this->file);
        }

        function getSetting($name) {
            foreach($this->xml->setting as $setting) {
                if($setting['name'] == $name) {
                    return $setting['value'];
                }
            }
        }

        function setSetting($name, $value) {
            foreach($this->xml->setting as $setting) {
                if($setting['name'] == $name) {
                    $setting['value'] = $value;
                }
            }

            $this->xml->asXML($this->file);
        }
    }
?>