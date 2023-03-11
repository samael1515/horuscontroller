<?php

class HorusSmartControllerAPI {
	private $ip;
	private $port;

	public function __construct('192.168.1.27', 53) {
		$this->ip = $ip;
		$this->port = $port;
	}

	public function encender($dispositivo) {
		$comando = "encender $dispositivo";
		$this->enviarComando($comando);
	}

	public function apagar($dispositivo) {
		$comando = "apagar $dispositivo";
		$this->enviarComando($comando);
	}

	private function enviarComando($comando) {
		$socket = fsockopen($this->ip, $this->port, $errno, $errstr, 10);
		if (!$socket) {
			throw new Exception("No se pudo conectar a la Horus Smart Controller: $errstr ($errno)");
		}

		fwrite($socket, "$comando\n");
		$response = fgets($socket);

		fclose($socket);

		if ($response != "OK\n") {
			throw new Exception("La Horus Smart Controller devolvió una respuesta inesperada: $response");
		}
	}
}

?>
