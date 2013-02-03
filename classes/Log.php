<?php 

class Log {

	private $file;
	private $headers;

	//formato csv http://pt.wikipedia.org/wiki/Comma-separated_values
	function __construct($_file = '../log/Log.csv') {
		$this->file = $_file;
		$this->headers = array('DATA', 'TIPO', 'MENSAGEM', 'ARQUIVO', 'LINHA');
	}

	public function write($level, $message) {
		
		//colunas do arquivo de log
		if (!file_exists($this->file))
			$_headers = $this->headers;

		$fp = fopen($this->file, "a") or exit("Erro na abertura do log");

		if (isset($_headers))
			fputcsv($fp, $_headers);
		
		$date = date("d/m/Y \à\s H:i:s");
		$debugBacktrace = debug_backtrace();

		if(isset($debugBacktrace)) {
			$line = $debugBacktrace[1]['line'];
			$filename = $debugBacktrace[1]['file'];
		}

		$entry = array($date, $level, $message, $filename, $line);
		fputcsv($fp, $entry);
		fclose($fp);
	}

	public function info($message) {
		self::write('INFORMATION', $message);

	}

	public function warning($message) {
		self::write('WARNING', $message);

	}

	public function debug($message) {
		self::write('DEBUG', $message);

	}

	public function error($message) {
		self::write('ERROR', $message);

	}
}

?>