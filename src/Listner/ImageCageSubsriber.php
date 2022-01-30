<?php

namespace App\Listner;

use Doctrine\Common\EventSubscriber;

class ImageCacheSubsriber implements EventSubscriber
{
    public function _construct(CacheManager $cacheManager, UploaderHelper $uploaderhelper)
    {
    }
    public function getSubscribedEvents()
    {
        return [
            'preRemove',
            'preUpdate'
        ];
    }
}
