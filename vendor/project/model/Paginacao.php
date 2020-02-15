<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 22/11/2018
 * Time: 15:53
 */

namespace project\model;

interface Paginacao{

    public static function getPage($pagina, $itemsPerPage);

    public static function getPageBusca($busca,$pagina, $itemsPerPage);



}