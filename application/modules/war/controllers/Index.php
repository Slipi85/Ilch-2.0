<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\War\Controllers;

use Modules\War\Mappers\Group as GroupMapper;
use Modules\War\Mappers\Enemy as EnemyMapper;
use Modules\War\Mappers\Games as GamesMapper;
use Modules\War\Mappers\War as WarMapper;

class Index extends \Ilch\Controller\Frontend
{
    public function indexAction()
    {
        $this->getLayout()->getHmenu()->add($this->getTranslator()->trans('menuWarList'), ['action' => 'index']);

        $pagination = new \Ilch\Pagination();
        $warMapper = new WarMapper();

        $pagination->setRowsPerPage(!$this->getConfig()->get('war_warsPerPage') ? $this->getConfig()->get('defaultPaginationObjects') : $this->getConfig()->get('war_warsPerPage'));
        $pagination->setPage($this->getRequest()->getParam('page'));

        $this->getView()->set('war', $warMapper->getWarList($pagination));
        $this->getView()->set('pagination', $pagination);
    }

    public function showAction()
    {
        $warMapper = new WarMapper();
        $gamesMapper = new GamesMapper();
        $groupMapper = new GroupMapper();
        $enemyMapper = new EnemyMapper();

        $war = $warMapper->getWarById($this->getRequest()->getParam('id'));
        $this->getView()->set('games', $gamesMapper->getGamesByWarId($this->getRequest()->getParam('id')));
        $group = $groupMapper->getGroupById($war->getWarGroup());
        $enemy = $enemyMapper->getEnemyById($war->getWarEnemy());

        $this->getLayout()->getHmenu()
            ->add($this->getTranslator()->trans('menuWarList'), ['action' => 'index'])
            ->add($group->getGroupName(), ['controller' => 'group', 'action' => 'show', 'id' => $group->getId()])
            ->add($this->getTranslator()->trans('warPlay'), ['action' => 'show', 'id' => $this->getRequest()->getParam('id')]);

        $this->getView()->set('gamesMapper', $gamesMapper);
        $this->getView()->set('group', $group);
        $this->getView()->set('enemy', $enemy);
        $this->getView()->set('war', $war);
    }
}
