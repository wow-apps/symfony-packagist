<?php

namespace WowApps\PackagistBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use WowApps\PackagistBundle\Service\Packagist;

class WowappsPackagistPackageCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('wowapps:packagist:package')
            ->setDescription('Get selected package and show it\'s data')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Package name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Packagist $packagist */
        $packagist = $this->getContainer()->get('wowapps.packagist.service');
        $argument = strtolower($input->getArgument('argument'));
        $symfonyStyle = new SymfonyStyle($input, $output);

        echo PHP_EOL;
        $output->writeln('<bg=blue;options=bold;fg=white>                                               </>');
        $output->writeln('<bg=blue;options=bold;fg=white>         Symfony Packagist API Bundle          </>');
        $output->writeln('<bg=blue;options=bold;fg=white>                                               </>');
        echo PHP_EOL;

        if (empty($argument)) {
            $errorText = "Package name can't be empty.";
            $errorText .= "\nCommand example: ./bin/console wowapps:packagist:package wow-apps/symfony-slack-bot";
            $symfonyStyle->error($errorText);
            die;
        }

    }

}
