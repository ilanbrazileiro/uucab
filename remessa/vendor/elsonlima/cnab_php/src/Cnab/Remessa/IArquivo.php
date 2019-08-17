<?php
namespace Cnab\Remessa;

interface IArquivo
{
	public function configure(array $params);
	public function insertDetalhe(array $params);
	public function listDetalhes();
	public function save($filename);
	public function getText();

}