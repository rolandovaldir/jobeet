<?php

/**
 * JobeetJob
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    jobeet
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class JobeetJob extends BaseJobeetJob
{
  public function __toString()
  {
    return sprintf('%s at %s (%s)', $this->getPosition(), $this->getCompany(), $this->getLocation());
  }
  
  public function getCompanySlug()
  {
    return Jobeet::slugify($this->getCompany());
  }
   
  public function getPositionSlug()
  {
    return Jobeet::slugify($this->getPosition());
  }
   
  public function getLocationSlug()
  {
    return Jobeet::slugify($this->getLocation());
  }
  
  public function save(Doctrine_Connection $conn = null)
  {
    if ($this->isNew() && !$this->getExpiresAt())
    {
      $now = $this->getCreatedAt() ? $this->getDateTimeObject('created_at')->format('U') : time();
      $this->setExpiresAt(date('Y-m-d H:i:s', $now + 86400 * sfConfig::get('app_active_days')));
    }
 
    return parent::save($conn);
  }
}
