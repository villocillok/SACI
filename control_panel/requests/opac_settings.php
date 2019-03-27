<?php
    class OpacSettings {
        private $file = 'assets/xml/opac_settings.xml';
        private $xml;

        function OpacSettings($rel = '') {
            $this->file = $rel . $this->file;
            
            if(!file_exists($this->file)) {
                $xml = fopen($this->file, 'w');

                fwrite($xml, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL);
                fwrite($xml, '<settings>' . PHP_EOL);
                fwrite($xml, '<setting name="displayMode" value="default" />' . PHP_EOL);
                fwrite($xml, '</settings>' . PHP_EOL);
                fclose($xml);
            }

            $this->xml = simplexml_load_file($this->file);
        }

        function getDisplayMode() {
            foreach($this->xml->setting as $setting) {
                if($setting['name'] == 'displayMode') {
                    return $setting['value'];
                }
            }
        }

        function setDisplayMode($value) {
            foreach($this->xml->setting as $setting) {
                if($setting['name'] == 'displayMode') {
                    $setting['value'] = $value;
                }
            }

            $this->xml->asXML($this->file);
        }
    }
?>