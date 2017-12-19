<?php

namespace WowApps\PackagistBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use WowApps\PackagistBundle\Exception\PackagistException;
use WowApps\PackagistBundle\Service\Packagist;

class WowappsPackagistSearchCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('wowapps:packagist:search')
            ->setDescription('Search for packages')
            ->addArgument('search_query', InputArgument::OPTIONAL, 'Search query')
            ->addOption(
                'tag',
                null,
                InputOption::VALUE_OPTIONAL,
                'You can set package tag to search'
            )
            ->addOption(
                'type',
                null,
                InputOption::VALUE_OPTIONAL,
                'You can set type of packages to search'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Packagist $packagist */
        $packagist = $this->getContainer()->get('wowapps.packagist.service');
        $searchQuery = strtolower($input->getArgument('search_query'));
        $symfonyStyle = new SymfonyStyle($input, $output);

        echo PHP_EOL;
        $output->writeln('<bg=green;options=bold;fg=white>                                               </>');
        $output->writeln('<bg=green;options=bold;fg=white>         Symfony Packagist API Bundle          </>');
        $output->writeln('<bg=green;options=bold;fg=white>                                               </>');
        echo PHP_EOL;

        if (empty($searchQuery)) {
            $symfonyStyle->error([
                PackagistException::E_EMPTY_SEARCH_QUERY,
                PackagistException::E_EMPTY_SEARCH_QUERY_DESCRIPTION,
            ]);

            die;
        }

        $symfonyStyle->title('Search for packages');

        $packagesList = $packagist->searchPackages(
            $searchQuery,
            $input->getOption('tag'),
            $input->getOption('type')
        );

        $showList = $symfonyStyle->confirm(
            sprintf('Founded %d packages. Do you want to show them all?', $packagesList->count()),
            false
        );

        if ($showList) {
            $symfonyStyle->listing($packagesList);
        }
    }
}
