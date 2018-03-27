<?php 

class Estado {

	private $id;
	private $codigo;
	private $desc_estado;
	private $usuario_id;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getCodigo() {
		return $this->codigo;
	}
	public function setId($codigo) {
		$this->codigo = $codigo;
	}

	public function getDesc_estado() {
		return $this->desc_estado;
	}
	public function setDesc_estado($desc_estado) {
		$this->desc_estado = $desc_estado;
	}

	public function getUsuario_id() {
		return $this->id;
	}
	public function setUsuario_id($usuario_id) {
		$this->usuario_id = $usuario_id;
	}
}

?>