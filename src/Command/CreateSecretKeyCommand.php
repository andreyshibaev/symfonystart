<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'create-secret-key',
    description: 'This command generates a secret key',
)]
class CreateSecretKeyCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $app_secret = random_bytes(32);
        print(bin2hex($app_secret));
        $io->success('You have successfully generated the key');
        return Command::SUCCESS;
    }
}
