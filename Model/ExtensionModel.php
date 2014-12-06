<?php

namespace Model;

use Core\BaseModel;

/**
 * Class ExtensionModel
 *
 * @package Model
 */
class ExtensionModel extends BaseModel
{

    /**
     * @throws
     * @see LINK
     *
     * @return array - list of extensions
     */
    public function getAllExtensions()
    {
        $connection = $this->getConnection();
        $connection->exec('');

        return array();
    }

    public function getExtension($id)
    {
    }
}