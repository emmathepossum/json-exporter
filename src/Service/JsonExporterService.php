<?php declare(strict_types=1);

namespace Possum\JsonExporter\Service;

use League\Flysystem\FilesystemOperator;
use Shopware\Core\Checkout\Order\OrderEntity;
class JsonExporterService
{
    public function __construct(private FilesystemOperator $filesystem)
    {
    }

    public function export(OrderEntity $order): void
    {
        $id = $order->getOrderNumber();
        $json = $order->jsonSerialize();
        $content = json_encode($json);
        if ($content) {
            $this->filesystem->write( "$id.json", $content);
        }
    }
}