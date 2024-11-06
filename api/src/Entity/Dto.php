<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\State\DtoProcessor;
use App\State\DtoProvider;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\Get;


/**
 * This is a dummy entity. Remove it!
 */
#[ApiResource(
    operations: [
        new Get(),
        new Post()
    ],
    provider: DtoProvider::Class
)]
#[Post(input: Dto::class, processor: DtoProcessor::class)]

class Dto
{
    private ?int $id = null;

    /**
     * @var Collection<SourceConfig>
     */
    private Collection $sourceConfigs;

    public function __construct(int $id = null, string $name=null, Collection $sourceConfigs = null){

        if(null === $id){
            $this->id = 1;
        }

        if(null === $name){
            $this->name = "name";
        }

        if(null === $sourceConfigs){
            $sourceConfigs = new SourceConfigs();
            $sourceconfig = new SourceConfig("aSiteId");
            $sourceconfig2 = new SourceConfig("aSiteId2");
            $sourceconfig3 = new SourceConfig("aSiteId3");
            $sourceConfigs->add($sourceconfig);
            $sourceConfigs->add($sourceconfig2);
            $sourceConfigs->add($sourceconfig3);

            $this->sourceConfigs = $sourceConfigs;
        }
    }

    /**
     * A nice person
     */
    //#[Assert\NotBlank]
    public string $name = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection
     */
    public function getSourceConfigs(): Collection|SourceConfigs
    {
        return $this->sourceConfigs;
    }
}
