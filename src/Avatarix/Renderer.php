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

use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Image\Palette\RGB;

class Renderer
{
    /** @var \Imagine\Image\ImageInterface */
    protected $imagine;

    protected $options;

    /**
     * Renderer constructor
     */
    public function __construct(Options $options)
    {
        $this->options = $options;
        $this->imagine = ($this->options->getEngine() === Options::ENGINE_IMAGICK)
            ? new \Imagine\Imagick\Imagine
            : new \Imagine\Gd\Imagine;
    }

    /**
     * Return Imagine object with merged sprites
     *
     * @param array $sprites
     * @return \Imagine\Image\ImageInterface
     */
    public function render(array $sprites)
    {
        $result = $this->imagine->create(
            new Box($this->options->getWidth(), $this->options->getHeight()),
            (new RGB)->color($this->options->getBackgroundColor(), $this->options->getBackgroundAlpha())
        );

        foreach ($sprites as $sprite) {
            $imagineSprite = $this->imagine->open($sprite);
            $result->paste($imagineSprite, new Point(0, 0));
        }

        return $result;
    }
}
