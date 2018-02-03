<?php
/**
 * This file is part of the wow-apps/symfony-packagist project
 * https://github.com/wow-apps/symfony-packagist
 *
 * (c) 2017 WoW-Apps
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WowApps\PackagistBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use WowApps\PackagistBundle\DTO\Package;
use WowApps\PackagistBundle\DTO\PackageAuthor;
use WowApps\PackagistBundle\DTO\PackageDependency;
use WowApps\PackagistBundle\Exception\PackagistException;
use WowApps\PackagistBundle\Service\Packagist;

/**
 * Class WowAppsPackagistPackageCommand
 *
 * @author Alexey Samara <lion.samara@gmail.com>
 * @package wow-apps/symfony-packagist
 */
class WowAppsPackagistPackageCommand extends ContainerAwareCommand
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('wowapps:packagist:package')
            ->setDescription('Get selected package and show it\'s data')
            ->addArgument('package_name', InputArgument::OPTIONAL, 'Package name')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     * @throws PackagistException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Packagist $packagist */
        $packagist = $this->getContainer()->get('wowapps.packagist');
        $argument = strtolower($input->getArgument('package_name'));
        $symfonyStyle = new SymfonyStyle($input, $output);

        echo PHP_EOL;
        $output->writeln('<bg=green;options=bold;fg=white>                                               </>');
        $output->writeln('<bg=green;options=bold;fg=white>         Symfony Packagist API Bundle          </>');
        $output->writeln('<bg=green;options=bold;fg=white>                                               </>');
        echo PHP_EOL;

        if (empty($argument)) {
            $symfonyStyle->error([
                PackagistException::E_EMPTY_PACKAGE_NAME,
                PackagistException::E_EMPTY_PACKAGE_NAME_DESCRIPTION,
            ]);

            return;
        }

        $symfonyStyle->title('Getting package ' . $argument);

        $package = $packagist->getPackage($argument);

        $output->writeln('<options=bold;fg=yellow>Package name:</> ' . $package->getName());
        $output->writeln('<options=bold;fg=yellow>Package description:</> ' . $package->getDescription());
        $output->writeln('<options=bold;fg=yellow>Package version:</> ' . $package->getVersion());
        $output->writeln('<options=bold;fg=yellow>Package time:</> ' . $package->getTime());
        $output->writeln('<options=bold;fg=yellow>Package type:</> ' . $package->getType());
        $output->writeln('<options=bold;fg=yellow>Package repository:</> ' . $package->getRepository());
        $output->writeln(
            '<options=bold;fg=yellow>Package keywords:</> '
            . implode(', ', $package->getVersions()->offsetGet($package->getVersion())->getKeywords())
        );
        $output->writeln('<options=bold;fg=yellow>Package GitHub stat:</>');
        $symfonyStyle->listing([
            'Stars: ' . $package->getGithub()->getStars(),
            'Watchers: ' . $package->getGithub()->getWatchers(),
            'Forks: ' . $package->getGithub()->getForks(),
            'Open issues: ' . $package->getGithub()->getOpenIssues(),
        ]);
        $output->writeln('<options=bold;fg=yellow>Package language:</> ' . $package->getLanguage());
        $output->writeln('<options=bold;fg=yellow>Package dependents:</> ' . $package->getDependents());
        $output->writeln('<options=bold;fg=yellow>Package suggesters:</> ' . $package->getSuggesters());
        $output->writeln('<options=bold;fg=yellow>Package downloads stat:</>');
        $symfonyStyle->listing([
            'Total: ' . $package->getDownloads()->getTotal(),
            'Monthly: ' . $package->getDownloads()->getMonthly(),
            'Daily: ' . $package->getDownloads()->getDaily(),
        ]);
        $output->writeln('<options=bold;fg=yellow>Package favers:</> ' . $package->getFavers());
        $output->writeln('<options=bold;fg=yellow>Package authors:</>');
        $authors = [];
        if (!empty($package->getMaintainers())) {
            foreach ($package->getMaintainers() as $maintainer) {
                $authors[] = $maintainer->getName();
            }
        }
        $symfonyStyle->listing($authors);

        $this->viewVersionHistory($symfonyStyle, $package);
    }

    /**
     * @param SymfonyStyle $symfonyStyle
     * @param Package $package
     */
    private function viewVersionHistory(SymfonyStyle $symfonyStyle, Package $package)
    {
        $versions = ['exit'];
        if (!empty($package->getVersions())) {
            foreach ($package->getVersions() as $version) {
                $versions[] = $version->getVersion();
            }
        }

        $showVersionsHistory = $symfonyStyle->choice('Do you want to view version history?', $versions, 'exit');

        if ($showVersionsHistory != 'exit') {
            $header = ['Key', 'Value'];

            $authors = [];
            /** @var PackageAuthor $author */
            foreach ($package->getVersions()->offsetGet($showVersionsHistory)->getAuthors() as $author) {
                $authors[] = "[" . $author->getRole() . "] " . $author->getName() . " (" . $author->getEmail() . ")";
            }

            $source = "[" . $package->getVersions()->offsetGet($showVersionsHistory)->getSource()->getType() . "] ";
            $source .= $package->getVersions()->offsetGet($showVersionsHistory)->getSource()->getUrl();

            $dist = "[" . $package->getVersions()->offsetGet($showVersionsHistory)->getDist()->getType() . "] ";
            $dist .= $package->getVersions()->offsetGet($showVersionsHistory)->getDist()->getUrl();

            $require = [];
            /** @var PackageDependency $dependency */
            foreach ($package->getVersions()->offsetGet($showVersionsHistory)->getRequire() as $dependency) {
                $require[] = $dependency->getName() . " => " . $dependency->getVersion();
            }

            $body = [
                ['version', $package->getVersions()->offsetGet($showVersionsHistory)->getVersion()],
                ['name', $package->getVersions()->offsetGet($showVersionsHistory)->getName()],
                ['description', $package->getVersions()->offsetGet($showVersionsHistory)->getDescription()],
                ['type', $package->getVersions()->offsetGet($showVersionsHistory)->getType()],
                ['time', $package->getVersions()->offsetGet($showVersionsHistory)->getTime()],
                ['keywords', implode(', ', $package->getVersions()->offsetGet($showVersionsHistory)->getKeywords())],
                ['homepage', $package->getVersions()->offsetGet($showVersionsHistory)->getHomePage()],
                ['version_normalized', $package->getVersions()->offsetGet($showVersionsHistory)->getVersionNormalized()],
                ['license', $package->getVersions()->offsetGet($showVersionsHistory)->getLicense()],
                ['authors', implode("\n", $authors)],
                ['source', $source],
                ['dist', $dist],
                ['require', implode("\n", $require)],
            ];

            $symfonyStyle->table($header, $body);

            $this->viewVersionHistory($symfonyStyle, $package);
        }
    }
}
