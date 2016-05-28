<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Partner\Controllers;

use Modules\Partner\Mappers\Partner as PartnerMapper;
use Modules\Partner\Models\Partner as PartnerModel;

class Index extends \Ilch\Controller\Frontend
{
    public function indexAction()
    {
        $partnerMapper = new PartnerMapper();

        $this->getLayout()->getHmenu()
                ->add($this->getTranslator()->trans('menuPartnerAdd'), ['action' => 'index']);

        if ($this->getRequest()->getPost('savePartner')) {
            $name = $this->getRequest()->getPost('name');
            $link = trim($this->getRequest()->getPost('link'));
            $banner = trim($this->getRequest()->getPost('banner'));
            $captcha = trim(strtolower($this->getRequest()->getPost('captcha')));

            if (empty($_SESSION['captcha']) || $captcha != $_SESSION['captcha']) {
                $this->addMessage('invalidCaptcha', 'danger');
            } elseif (empty($name)) {
                $this->addMessage('missingName', 'danger');
            } elseif(empty($link)) {
                $this->addMessage('missingLink', 'danger');
            } elseif(empty($banner)) {
                $this->addMessage('missingBanner', 'danger');
            } else {
                $partnerModel = new PartnerModel();
                $partnerModel->setName($name);
                $partnerModel->setLink($link);
                $partnerModel->setBanner($banner);
                $partnerModel->setFree(0);
                $partnerMapper->save($partnerModel);

                $this->addMessage('sendSuccess');
            }
        }
    }
}
