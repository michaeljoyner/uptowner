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

    public function hasOwnImage()
    {
        return $this->imageUrl() !== static::DEFAULT_IMG_URL;
    }

    public function getImage()
    {
        return $this->getMedia()->first() ?? new DefaultImage(static::DEFAULT_IMG_URL ?? '');
    }

    public function imageInfoArray()
    {
        $image = $this->getImage();
        return [
            'image_id' => $image->id,
            'web_url' => $image->getUrl('web'),
            'thumb_url' => $image->getUrl('thumb'),
            'delete_url' => '/admin/services/media/' . $image->id
        ];
    }

    private function deleteAllImagesExcept($image)
    {
        $this->getMedia()->reject(function ($file) use ($image) {
            return $file->id === $image->id;
        })->each(function ($file) {
            $file->delete();
        });
    }

    protected function makeImage($file): \Spatie\MediaLibrary\Models\Media
    {
        return $this->addMedia($file)->preservingOriginal()->toMediaCollection();
    }
}