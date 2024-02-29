<?php

namespace App\Command;

use App\Order\Application\Create\CreateOrderCommand;
use App\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:order:register',
    description: 'Registers a new order.',
    aliases: ['app:order:register'],
    hidden: false
)]
class OrderCommand extends Command
{

    public function __construct(private readonly CommandBus $commandBus)
    {
        parent::__construct('app:order:register');
    }

    protected function configure(): void
    {
        $this->setHelp('Registers a new order in the system');

        $this
            ->addArgument('selectedFood', InputArgument::REQUIRED, 'Type of food')
            ->addArgument('money', InputArgument::REQUIRED, 'Amount of money given by the user')
            ->addArgument('isDelivery', InputArgument::REQUIRED, 'Is delivered or user must get the food from the restaurant')
            ->addArgument('drinks', InputArgument::OPTIONAL, 'Number of drinks', 0);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $productType = $input->getArgument('selectedFood');
        $money = $input->getArgument('money');
        $delivery = $input->getArgument('isDelivery');
        $drinks = $input->getArgument('drinks');

        try {
            $this->commandBus->dispatch(new CreateOrderCommand($productType, $money, $delivery, $drinks));
        } catch (\Exception $exception) {
            $output->writeln($exception->getMessage());
            return Command::FAILURE;
        }

        $output->writeln(sprintf('Your order%s has been registered.', ($drinks > 0) ? ' with drinks included' : ''));
        return Command::SUCCESS;
    }
}