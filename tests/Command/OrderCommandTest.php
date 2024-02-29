<?php

namespace App\Tests\Command;

use App\Command\OrderCommand;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class OrderCommandTest extends KernelTestCase
{
    protected function setUp(): void
    {
        self::bootKernel();
    }

    #[Test]
    public function it_should_message_correct_when_order_is_success()
    {
        $application = new Application(self::$kernel);
        $application->add(new OrderCommand());

        $command = $application->find('app:order:register');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command' => $command->getName(),
            'selectedFood' => 'pizza',
            'money' => 14,
            'isDelivery' => 1
        ]);

        $output = $commandTester->getDisplay();

        $this->assertEquals('Your order has been registered.' . PHP_EOL, $output);
    }

    #[Test]
    public function it_should_error_message_when_money_is_not_exactly_is_delivery()
    {
        $application = new Application(self::$kernel);
        $application->add(new OrderCommand());

        $command = $application->find('app:order:register');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command' => $command->getName(),
            'selectedFood' => 'pizza',
            'money' => 10,
            'isDelivery' => 1
        ]);

        $output = $commandTester->getDisplay();

        $this->assertEquals('Money must be the exact order amount on delivery orders.' . PHP_EOL, $output);
    }

    #[Test]
    public function it_should_error_message_when_money_is_not_exactly()
    {
        $application = new Application(self::$kernel);
        $application->add(new OrderCommand());

        $command = $application->find('app:order:register');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command' => $command->getName(),
            'selectedFood' => 'pizza',
            'money' => 10,
            'isDelivery' => 0
        ]);

        $output = $commandTester->getDisplay();

        $this->assertEquals('Money does not reach the order amount.' . PHP_EOL, $output);
    }

    #[Test]
    public function it_should_error_message_when_drink_number_is_not_between_0_2()
    {
        $application = new Application(self::$kernel);
        $application->add(new OrderCommand());

        $command = $application->find('app:order:register');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command' => $command->getName(),
            'selectedFood' => 'pizza',
            'money' => 10,
            'isDelivery' => 1,
            'drinks' => 99
        ]);

        $output = $commandTester->getDisplay();

        $this->assertEquals('Number of drinks should be between 0 and 2.' . PHP_EOL, $output);
    }

    #[Test]
    public function it_should_message_when_included_drink_in_order()
    {
        $application = new Application(self::$kernel);
        $application->add(new OrderCommand());

        $command = $application->find('app:order:register');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command' => $command->getName(),
            'selectedFood' => 'pizza',
            'money' => 16,
            'isDelivery' => 1,
            'drinks' => 1
        ]);

        $output = $commandTester->getDisplay();

        $this->assertEquals('Your order with drinks included has been registered.' . PHP_EOL, $output);
    }

    protected function tearDown(): void
    {
        restore_exception_handler();
        parent::tearDown();
    }
}