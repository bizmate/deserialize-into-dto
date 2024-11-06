<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Dto;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @implements ProcessorInterface<Dto[]|Dto|null>
 */

class DtoProcessor implements ProcessorInterface
{
    public function __construct(private LoggerInterface $logger, private SerializerInterface $serializer){
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): Dto|null
    {
        $noCache = false;

        if (isset($context['filters']['noCache']) && $context['filters']['noCache'] === 'true'){
            $noCache = true;
        }

        $this->logger->info(
            __METHOD__ . " operation: " . $operation->getName() . " operationShort: " . $operation->getShortName() .
            " uriVariables " . json_encode($uriVariables) .
            " context: " . json_encode($context) .
            " data: " . json_encode($data)
        );

        try{
            //die("processor");
            $dto = $this->serializer->deserialize($data, Dto::class, 'json');
            return $dto;
        }catch (\Exception $ex){
            $this->logger->error(
                __METHOD__ . " exception: " . get_class($ex) . " code: " . $ex->getCode() . " message: " .
                $ex->getMessage() . " trace: " . $ex->getTraceAsString()
            );

            return null;
        }
    }
}
