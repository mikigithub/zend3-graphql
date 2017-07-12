<?php
namespace Graphql\Entity;

use GraphQL\Utils;
/**
 * Description of package
 *
 * @author miki
 */
class Package {
	
	public $id;
	public $nombre;
	public $precio;
	public $precioAviso;
	public $cantWebs;
	public $cantImpresos;
	public $semanas;
	public $tipo;
	public $cantFotos;
	public $cantPalabLibres;
	public $destaquePortada;
	public $cantAvisoSinFoto;
	public $tienda;
	public $informacion;
	public $subSecId;
	public $codSubseccion;
	public $dscSubseccion;
	public $ubiId;
	public $tarId;
  
	public function __construct(array $data)
    {
        Utils::assign($this, $data);
    }
}
