<?php

namespace ItAces\Oauth\Entities;

use App\Model\User;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use ItAces\Publishable;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
abstract class OauthEntity extends \ItAces\ORM\Entities\EntityBase
{

    /**
     * 
     * {@inheritDoc}
     * @see \ItAces\ORM\Entities\EntityBase::onBeforeAdd()
     */
    public function onBeforeAdd(LifecycleEventArgs $event)
    {
        if (app()->runningInConsole()) {
            /**
             * 
             * @var \Doctrine\ORM\EntityManager $em
             */
            $em = app('em');
            $createdBy = $em->find(User::class, 1);
            $this->setCreatedBy($createdBy);
        }
        
        parent::onBeforeAdd($event);
    }
    
}