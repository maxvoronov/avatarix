<?php
/*
 * This file is part of the Avatarix project.
 *
 * (c) Max Voronov <maxivoronov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MaxVoronov\Avatarix;

class SpriteCollection
{
    /** @var array List of sprites */
    protected $sprites = [];

    /**
     * Initialize sprite collection
     * If you pass directory path collection will be automatically filled
     *
     * @param string $dir
     * @return SpriteCollection
     */
    public static function init(string $dir = ''): self
    {
        $collection = new self;
        $collection->readSpritesFromDirectory($dir);

        return $collection;
    }

    /**
     * Read files from directory and add to collection
     *
     * @param string $dir
     * @return SpriteCollection
     */
    public function readSpritesFromDirectory(string $dir): self
    {
        $files = new \FilesystemIterator($dir);
        foreach ($files as $file) {
            $this->addSprite($file->getRealPath());
        }

        return $this;
    }

    /**
     * Add sprite to collection
     *
     * @param string $filePath
     * @return SpriteCollection
     */
    public function addSprite(string $filePath): self
    {
        $this->sprites[] = $filePath;

        return $this;
    }

    /**
     * Return list of sprites
     *
     * @return array
     */
    public function getSprites(): array
    {
        return $this->sprites;
    }
}
