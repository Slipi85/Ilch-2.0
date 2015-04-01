<legend><?=$this->getTrans('menuComments') ?></legend>
<?php if ($this->get('comments') != ''): ?>
    <form class="form-horizontal" method="POST" action="">
        <?=$this->getTokenField() ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <colgroup>
                    <col class="icon_width" />
                    <col class="icon_width" />
                    <col class="col-1" />
                    <col class="col-1" />
                    <col class="col-1" />
                    <col />
                </colgroup>
                <thead>
                    <tr>
                        <th><?=$this->getCheckAllCheckbox('check_comments') ?></th>
                        <th></th>
                        <th><?=$this->getTrans('commentDate') ?></th>
                        <th><?=$this->getTrans('commentFrom') ?></th>
                        <th><?=$this->getTrans('commentLink') ?></th>
                        <th><?=$this->getTrans('commentText') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $userMapper = new \Modules\User\Mappers\User() ?>
                    <?php foreach ($this->get('comments') as $comment): ?>
                        <?php $user = $userMapper->getUserById($comment->getUserId()) ?>
                        <?php $date = new \Ilch\Date($comment->getDateCreated()) ?>
                        <tr>
                            <td><input value="<?=$comment->getId() ?>" type="checkbox" name="check_comments[]" /></td>
                            <td><?=$this->getDeleteIcon(array('action' => 'delete', 'id' => $comment->getId())) ?></td>
                            <td><?=$date->format("d.m.Y H:i", true) ?></td>
                            <td><a href="<?=$this->getUrl('user/profil/index/user/'.$user->getId()) ?>"><?=$this->escape($user->getName()) ?></a></td>
                            <td><a target="_blank" href="<?=$this->getUrl($comment->getKey()) ?>"><?=$this->getTrans('commentLink') ?></a></td>
                            <td><?=nl2br($this->escape($comment->getText())) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?=$this->getListBar(array('delete' => 'delete')) ?>
    </form>
<?php else: ?>
    <?=$this->getTranslator()->trans('noComments') ?>
<?php endif; ?>