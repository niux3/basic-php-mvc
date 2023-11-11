<?php
namespace src\core;


class Exception extends \Exception {
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    private function getErrorHttp(){
        switch($this->code){
            case 500:
                return "HTTP/1.0 500 Internal Server Error";
            case 404:
                return "HTTP/1.0 404 Not Found";
        }
    }

    public function getError() {
        header($this->getErrorHttp());
        if(DEBUG){
            $mask = '
                <h1>Exception error</h1>
                <ul>
                    <li><strong>code error</strong> : %s</li>
                    <li><strong>file</strong> : %s</li>
                    <li><strong>line</strong> : %s<br><br></li>
                    <li><strong>message</strong> : %s<br><br></li>
                    <li><strong>trace</strong> : %s</li>
                </ul>
            ';

            $traces = array_map(function($e){
                return sprintf('<li>%s</li>', substr($e, 2));
            }, array_slice(explode('#', $this->getTraceAsString()), 1));
            $tpl_trace = '<ol>%s</ol>';
            $outputTrace = sprintf($tpl_trace, implode('', $traces));

            $args = [
                $this->getCode(),
                $this->getFile(),
                $this->getLine(),
                $this->getMessage(),
                $outputTrace,
            ];
            $output = vsprintf($mask, $args);
            echo $output;
        }else{
            $ctrl = new Controller(null);
            $ctrl->render([], sprintf('errors/%s', $this->code));
        }
        die;
    }
}
