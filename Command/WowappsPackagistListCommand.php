<?php

namespace WowApps\PackagistBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use WowApps\PackagistBundle\Service\Packagist;

class WowappsPackagistListCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('wowapps:packagist:list')
            ->setDescription('Get packages list')
            ->addOption(
                'vendor',
                null,
                InputOption::VALUE_OPTIONAL,
                'You can set a vendor name to list it\'s packages'
            )
            ->addOption(
                'type',
                null,
                InputOption::VALUE_OPTIONAL,
                'You can set a type of packages'
            )
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Packagist $packagist */
        $packagist = $this->getContainer()->get('wowapps.packagist.service');
        $symfonyStyle = new SymfonyStyle($input, $output);

        echo PHP_EOL;
        $output->writeln('<bg=green;options=bold;fg=white>                                               </>');
        $output->writeln('<bg=green;options=bold;fg=white>         Symfony Packagist API Bundle          </>');
        $output->writeln('<bg=green;options=bold;fg=white>                                               </>');
        echo PHP_EOL;

        $symfonyStyle->title('Getting packages list');

        $packagesList = $packagist->getPackageList($input->getOption('vendor'), $input->getOption('type'));

        $showList = $symfonyStyle->confirm(
            sprintf('Founded %d packages. Do you want to show them all?', count($packagesList)),
            false
        );

        if ($showList) {
            $symfonyStyle->listing($packagesList);
        }
    }

}
