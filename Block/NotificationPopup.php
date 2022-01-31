<?php
namespace Vmr\NotificationPopup\Block;

use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\View\Element\Template\Context;

class NotificationPopup extends \Magento\Framework\View\Element\Template
{
    /**
     * @var DateTime
     */
    private $dateTime;
    
    /**
     * Validator constructor.
     *
     * @param DateTime $dateTime
     */
    public function __construct(
        DateTime $dateTime,
        Context $context,
        array $data = []
        ) {
            $this->dateTime = $dateTime;
            parent::__construct($context, $data);
    }
    /**
     * Enable or disable the notification popup
     *
     * @return mixed
     */
    public function getNotificationPopupEnable()
    {
        return $this->_scopeConfig->getValue('notification_popup/general/enable');
    }

    /**
     * Show the heading of the notification popup
     *
     * @return string
     */
    public function getNotificationPopupDisplayHeading()
    {
        return $this->_scopeConfig->getValue('notification_popup/general/display_heading');
    }

    /**
     * Show the text of the notification popup
     *
     * @return string
     */
    public function getNotificationPopupDisplayText()
    {
        return $this->_scopeConfig->getValue('notification_popup/general/display_text');
    }
    
    public function getNotificationStartDate()
    {
        return $this->_scopeConfig->getValue('notification_popup/general/start_date');
    }
    
    public function getNotificationEndDate()
    {
        return $this->_scopeConfig->getValue('notification_popup/general/end_date');
    }
    
    public function getValidateDate()
    {
        $start_date = $this->getNotificationStartDate();
        $end_date = $this->getNotificationEndDate();
        
        if ($start_date && $end_date) {
            if($start_date > $end_date){
                return false;
            }
            $now = $this->dateTime->date('Y-m-d H:i:s');
            if ($now < $start_date || $now > $end_date) {
                return false;
            }
        }
        
        return true;
    }
}