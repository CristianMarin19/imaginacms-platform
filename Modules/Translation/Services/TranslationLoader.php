<?php

namespace Modules\Translation\Services;

use Illuminate\Translation\FileLoader;
use Modules\Translation\Repositories\TranslationRepository;

class TranslationLoader extends FileLoader
{
    /**
     * Get all Paths where Translations could be found.
     */
    public function paths()
    {
        return array_merge(
            [$this->path],
            $this->hints
        );
    }

    /**
     * Load the messages for the given locale.
     */
    public function load($locale,  $group, $namespace = null)
    {
        $fileTranslations = parent::load($locale, $group, $namespace);

        $loaderTranslations = app(TranslationRepository::class)->getTranslationsForGroupAndNamespace($locale, $group, $namespace);

        return array_merge($fileTranslations, $loaderTranslations);
    }
}
