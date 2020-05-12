<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 22/11/2018
 * Time: 15:53
 */

namespace App\Models;

interface Paginacao{

    public static function getPage($pagina, $itemsPerPage);

    public static function getPageBusca($busca,$pagina, $itemsPerPage);



}