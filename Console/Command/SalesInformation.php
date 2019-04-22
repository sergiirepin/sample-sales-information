<?php

namespace Repin\SalesInformation\Console\Command;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\State;
use Magento\Framework\App\Area;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class SalesInformation extends Command
{
    const SKU_ARGUMENT = 'sku';

    protected $productRepository;

    protected $state;

    public function __construct(ProductRepositoryInterface $productRepository, State $state)
    {
        $this->productRepository = $productRepository;
        $this->state = $state;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('sales:information')
            ->setDescription('Display product sales information')
            ->setDefinition([
                new InputArgument(
                    self::SKU_ARGUMENT,
                    InputArgument::REQUIRED
                )
            ]);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $productSku  = $input->getArgument(self::SKU_ARGUMENT);

        if (!$productSku) {
            throw new \InvalidArgumentException('Argument '. self::SKU_ARGUMENT. ' is missing.');
        }

        try {
            $this->state->setAreaCode(Area::AREA_FRONTEND);
            $product = $this->productRepository->get($productSku);
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
            return;
        }
        
        $output->writeLn("Last order: {$product->getExtensionAttributes()->getSalesInformation()->getLastOrder()}");
        $output->writeLn("Product qty: {$product->getExtensionAttributes()->getSalesInformation()->getQty()}");
    }
}
