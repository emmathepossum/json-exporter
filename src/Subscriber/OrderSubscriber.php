<?php declare(strict_types=1);

namespace Possum\JsonExporter\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Possum\JsonExporter\Service\JsonExporterService;
use Shopware\Core\Checkout\Order\Event\OrderStateMachineStateChangeEvent;

class OrderSubscriber implements EventSubscriberInterface
{
    public function __construct(private JsonExporterService $jsonExporterService)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'state_enter.order_transaction.state.authorized' => 'onTransactionAuthorized',
        ];
    }
    public function onTransactionAuthorized(OrderStateMachineStateChangeEvent $event)
    {
        $this->jsonExporterService->export($event->getOrder());
    }
}