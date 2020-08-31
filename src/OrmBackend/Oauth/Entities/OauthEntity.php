<?php

namespace OrmBackend\Oauth\Entities;

use App\Model\User;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
abstract class OauthEntity extends \OrmBackend\ORM\Entities\BaseEntity
{

    /**
     * 
     * {@inheritDoc}
     * @see \OrmBackend\ORM\Entities\Entity::onBeforeAdd()
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