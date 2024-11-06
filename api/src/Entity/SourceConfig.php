<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;

/**
 *
 */
class SourceConfig
{
    /**
     * @var string
     */
    private string $siteId;

    /**
     * @param string $siteId
     */
    public function __construct(string $siteId)
    {
        if (empty($siteId) == true) {
            throw new \InvalidArgumentException('Please provide a valid Site Id string');
        }
        $this->siteId = $siteId;
    }

    /**
     * @return string
     */
    public function getSiteId(): string
    {
        return $this->siteId;
    }
}
