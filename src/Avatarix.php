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

namespace MaxVoronov;

use MaxVoronov\Avatarix\Options;
use MaxVoronov\Avatarix\Renderer;
use MaxVoronov\Avatarix\SpriteCollection;

class Avatarix
{
    /** @var Options */
    protected $options;

    /** @var SpriteCollection[] */
    protected $collectionList = [];

    /** @var string */
    protected $payload = '';

    public function __construct(?Options $options = null)
    {
        $this->options = $options ?? Options::init();
    }

    /**
     * Add sprite collection for selection
     * Appending position will used as layer position
     *
     * @param SpriteCollection $collection
     * @return $this
     */
    public function appendCollection(SpriteCollection $collection)
    {
        $this->collectionList[] = $collection;

        return $this;
    }

    /**
     * Return Imagine object for further processing
     *
     * @return \Imagine\Gd\Image|\Imagine\Image\ImageInterface
     */
    public function render()
    {
        $renderer = new Renderer($this->options);
        $sprites = $this->collectSpritesByHash($this->getPayloadHash());

        return $renderer->render($sprites);
    }

    /**
     * Return hashing payload
     *
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }

    /**
     * Set hashing payload
     *
     * @param string $payload
     * @return Avatarix
     */
    public function setPayload(string $payload): self
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Selection of sprites basing hash of payload
     *
     * @param string $hash
     * @return array
     */
    protected function collectSpritesByHash(string $hash): array
    {
        $collectionsCount = count($this->getCollections());
        $chunkLength = (int) floor(\strlen($hash) / $collectionsCount);
        $maxChunkInt = hexdec(str_repeat('f', $chunkLength));

        $hashChunks = str_split($hash, $chunkLength);
        $hashChunks = \array_slice($hashChunks, 0, $collectionsCount);

        $chunkIdx = 0;
        $spriteList = [];
        foreach ($this->getCollections() as $collection) {
            $sprites = $collection->getSprites();
            $chunkInt = hexdec($hashChunks[$chunkIdx++]);

            $spriteIdx = max(round(count($sprites) * ($chunkInt / $maxChunkInt)) - 1, 0);
            $spriteList[] = $sprites[$spriteIdx];
        }

        return $spriteList;
    }

    /**
     * Return hashed payload
     *
     * @return string
     */
    protected function getPayloadHash(): string
    {
        return md5($this->getPayload());
    }

    /**
     * Return sprite collections
     *
     * @return array
     */
    protected function getCollections(): array
    {
        return $this->collectionList;
    }
}
