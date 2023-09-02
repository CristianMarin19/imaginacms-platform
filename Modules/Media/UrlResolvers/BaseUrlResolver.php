<?php

namespace Modules\Media\UrlResolvers;

use Illuminate\Contracts\Filesystem\Factory;
use League\Flysystem\Adapter\Ftp;
use League\Flysystem\Adapter\Local;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class BaseUrlResolver
{
    /**
     * @var array
     */
    private $resolvers = [];

    public function __construct()
    {
        $this->resolvers = [
            Local::class => new LocalUrlResolver(),
            AwsS3Adapter::class => new AwsS3UrlResolver(),
            Ftp::class => new FtpUrlResolver(),
        ];
    }

    /**
     * Resolve the given path based on the set filesystem
     */
    public function resolve(string $path, string $disk = null): string
    {
        $factory = app(Factory::class);
        $disk = is_null($disk) ? $this->getConfiguredFilesystem() : $disk;
        $adapter = $factory->disk($disk)->getDriver()->getAdapter();

        return $this->resolvers[get_class($adapter)]->resolve($adapter, $path);
    }

    private function getConfiguredFilesystem(): string
    {
        return setting('media::filesystem', null, config('asgard.media.config.filesystem'));
    }
}
