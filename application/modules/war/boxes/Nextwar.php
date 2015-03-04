<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\War\Boxes;

use Modules\War\Mappers\War as WarMapper;

defined('ACCESS') or die('no direct access');

class Nextwar extends \Ilch\Box
{
    public function render()
    {
        $warMapper = new WarMapper();

        $status = '1';
        $limit = '5';
        $war = $warMapper->getWarListByStatusAndLimt($status, $limit);

        $this->getView()->set('war', $war);
    }
}