![Symfony Packagist Banner](http://cdn.wow-apps.pro/packagist/symfony-packagist-banner-v2.png)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/9e427ba8-ceee-47a4-aeef-a788b9875064/big.png)](https://insight.sensiolabs.com/projects/9e427ba8-ceee-47a4-aeef-a788b9875064)

[![Packagist](https://img.shields.io/packagist/v/wow-apps/symfony-packagist.svg?style=flat-square)](https://github.com/wow-apps/symfony-packagist)
[![Packagist](https://img.shields.io/packagist/dt/wow-apps/symfony-packagist.svg?style=flat-square)](https://packagist.org/packages/wow-apps/symfony-packagist)
[![Build Status](https://scrutinizer-ci.com/g/wow-apps/symfony-packagist/badges/build.png?b=master)](https://scrutinizer-ci.com/g/wow-apps/symfony-packagist/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/wow-apps/symfony-packagist/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/wow-apps/symfony-packagist/?branch=master)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://github.com/wow-apps/symfony-packagist/blob/master/LICENCE)
[![Code Climate](https://codeclimate.com/github/wow-apps/symfony-packagist/badges/gpa.svg)](https://codeclimate.com/github/wow-apps/symfony-packagist)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/ce3fffd811f2463a94ed4065a341885a)](https://www.codacy.com/app/lion-samara/symfony-packagist?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=wow-apps/symfony-packagist&amp;utm_campaign=Badge_Grade)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/9e427ba8-ceee-47a4-aeef-a788b9875064/mini.png)](https://insight.sensiolabs.com/projects/9e427ba8-ceee-47a4-aeef-a788b9875064)


# Symfony Packagist API Bundle

Packagist API Bundle for Symfony 3 and 4

## Installation:

### Requires:

* PHP 7.0+
* Symfony 3.0+
* Guzzle Client 6.0+

### Step 1: Download the Bundle

```json
"require": {
        "wow-apps/symfony-packagist": "^1"
}
```

or

```bash
$ composer require wow-apps/symfony-packagist 
```

### Step 2: Enable the Bundle (skip for Symfony 4)

```php
// ./app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new WowApps\PackagistBundle\WowAppsPackagistBundle(),
    );

    // ...

    return $bundles
}
```

# Documentation

* [Installation](https://github.com/wow-apps/symfony-packagist/wiki/1_Installation)
* [Commands](https://github.com/wow-apps/symfony-packagist/wiki/2.-Commands)
* [Using Packagist API Bundle](https://github.com/wow-apps/symfony-packagist/wiki/3.-Using-Packagist-API-Bundle)
    
# News and updates:

Follow news and updates in my Telegram channel [@wow_apps_pro](https://t.me/wow_apps_pro) or Twitter [@alexey_samara_](https://twitter.com/alexey_samara_)

![Symfony Packagist Preview](http://cdn.wow-apps.pro/packagist/symfony-packagist-preview.jpg)
