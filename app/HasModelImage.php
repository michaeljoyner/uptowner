<?php


namespace App;


trait HasModelImage
{
    public function setImage($file)
    {
        return tap($this->makeImage($file), function ($image) {
            $this->deleteAllImagesExcept($image);
        });
    }

    public function imageUrl($conversion = '')
    {
        return $this->getImage()->getUrl($conversion);
    }

    private function getImage()
    {
        return $this->getMedia()->first() ?? new DefaultImage(static::DEFAULT_IMG_URL ?? '');
    }

    private function deleteAllImagesExcept($image)
    {
        $this->getMedia()->reject(function ($file) use ($image) {
            return $file->id === $image->id;
        })->each(function ($file) {
            $file->delete();
        });
    }

    protected function makeImage($file): \Spatie\MediaLibrary\Media
    {
        return $this->addMedia($file)->preservingOriginal()->toCollection('default');
    }
}