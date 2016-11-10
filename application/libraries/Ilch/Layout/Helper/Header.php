<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Ilch\Layout\Helper;

use Ilch\Layout\Base as Layout;
use Ilch\Layout\Helper\Header\Model;

class Header
{
    /**
     * var Model
     */
    private $model;

    /**
     * Injects the header.
     *
     * @param Layout $header
     */
    public function __construct(Layout $header)
    {
        $this->model = new Model(($header));
    }

    /**
     * Gets the header
     * @return \Ilch\Layout\Helper\Header\Model
     */
    public function header()
    {
        return $this->model;
    }
}
