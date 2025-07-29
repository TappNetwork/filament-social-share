<?php

namespace Tapp\FilamentSocialShare;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentSocialShareServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-social-share';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations();
    }

    public function packageBooted(): void
    {
        //
    }
}
