<?php

namespace Modules\Media\Image;

class ThumbnailManagerRepository implements ThumbnailManager
{
    /**
     * @var array
     */
    private $thumbnails = [];

    public function registerThumbnail($name, array $filters, $format = 'jpg')
    {
        $this->thumbnails[$name] = Thumbnail::make([$name => $filters], $format);
    }

    /**
     * Return all registered thumbnails
     */
    public function all()
    {
        return $this->thumbnails;
    }

    /**
     * Find the filters for the given thumbnail
     */
    public function find($thumbnail)
    {
        foreach ($this->all() as $thumb) {
            if ($thumb->name() === $thumbnail) {
                return $thumb->filters();
            }
        }

        return [];
    }
}
