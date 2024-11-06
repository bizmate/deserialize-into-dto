<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\Dto;
use Psr\Log\LoggerInterface;

/**
 * @implements ProviderInterface<Dto[]|Dto|null>
 */

class DtoProvider implements ProviderInterface
{
    public function __construct(private LoggerInterface $logger){
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): Dto|null
    {
        $noCache = false;

        if (isset($context['filters']['noCache']) && $context['filters']['noCache'] === 'true'){
            $noCache = true;
        }

        $this->logger->error(
            __METHOD__ . " operation: " . $operation->getName() . " operationShort: " . $operation->getShortName() .
            " uriVariables " . json_encode($uriVariables) .
            " context: " . json_encode($context)
        );

        try{
            //die("provider");

            return new Dto();
        }catch (\Exception $ex){
            $this->logger->error(
                __METHOD__ . " exception: " . get_class($ex) . " code: " . $ex->getCode() . " message: " .
                $ex->getMessage() . " trace: " . $ex->getTraceAsString()
            );

            return null;
        }
    }
}
