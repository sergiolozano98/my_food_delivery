<?php

namespace App\Command;

use App\Order\Application\SearchAllDeliveryOrder\GetAllDeliveryOrderQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

#[AsCommand(
    name: 'app:orders:delivery',
    description: 'All delivery orders',
    aliases: ['app:orders:delivery'],
    hidden: false
)]
class GetAllDeliveryOrderCommand extends Command
{
    public function __construct(private readonly QueryBus $queryBus)
    {
        parent::__construct('app:orders:delivery');
    }

    protected function configure(): void
    {
        $this->setHelp('Get all delivery orders');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $result = $this->queryBus->ask(new GetAllDeliveryOrderQuery());
        } catch (\Exception $exception) {
            $output->writeln($exception->getMessage());
            return Command::FAILURE;
        }

        foreach ($result->orders() as $order) {
            $output->writeln(
                sprintf(
                    'Order {id: %s, food_id: %s, amount: %s, money: %s}',
                    $order->id(),
                    $order->foodId(),
                    $order->amount(),
                    $order->money())
            );
        }
        return Command::SUCCESS;
    }
}