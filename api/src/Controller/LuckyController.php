<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Dto;
use Psr\Log\LoggerInterface;

class LuckyController extends AbstractController
{
    public function __construct(
        private WebDebugToolbarListener $webDebugToolbarListener, private SerializerInterface $serializer,
        private LoggerInterface $logger
    ) {
        $this->webDebugToolbarListener->setMode(WebDebugToolbarListener::DISABLED);
    }

    #[Route('/lucky/number', name: 'app_lucky_number')]
    //public function number(int $max=50): Response
    public function number(): Response
    {
        $number = random_int(0, 50);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }

    #[Route('/deserialize', name: 'app_deserialize')]
    public function deserialize(Request $request): Response
    {
        $contentString = $request->getContent();

        $this->logger->info(__METHOD__ . " received request with content: " .  $contentString);
        $reviewsConfig = $this->serializer->deserialize($contentString, Dto::class, 'json');

        return new Response(
            '<html><body>Content: '.$contentString.'</body></html>'
        );
    }
}
