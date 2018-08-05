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

class Options
{
    public const ENGINE_GD = 'GD';
    public const ENGINE_IMAGICK = 'Imagick';

    /** @var string Imagine engine */
    protected $engine = self::ENGINE_GD;

    /** @var int Base image width */
    protected $width = 400;

    /** @var int Base image height */
    protected $height = 400;

    /** @var string Base image background color */
    protected $backgroundColor = '#000000';

    /** @var int Base image background alpha channel */
    protected $backgroundAlpha = 100;

    /**
     * Init new options object with default values
     *
     * @return Options
     */
    public static function init(): self
    {
        return new self;
    }

    /**
     * Return base image width
     *
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * Set base image width
     *
     * @param int $width
     * @return Options
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Return base image height
     *
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * Set base image height
     *
     * @param int $height
     * @return Options
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Return Imagine engine
     *
     * @return string
     */
    public function getEngine(): string
    {
        return $this->engine;
    }

    /**
     * Set Imagine engine (GD or Imagick)
     *
     * @param string $engine
     * @return Options
     */
    public function setEngine(string $engine): self
    {
        if (\in_array($engine, [self::ENGINE_GD, self::ENGINE_IMAGICK], true)) {
            $this->engine = $engine;
        }

        return $this;
    }

    /**
     * Return base image background color
     *
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    /**
     * Set base image background color
     *
     * @param string $color
     * @return Options
     */
    public function setBackgroundColor(string $color): self
    {
        $this->backgroundColor = $color;

        return $this;
    }

    /**
     * Return base image background alpha channel value
     *
     * @return int
     */
    public function getBackgroundAlpha(): int
    {
        return $this->backgroundAlpha;
    }

    /**
     * Set base image background alpha channel value
     *
     * @param int $backgroundAlpha
     * @return Options
     */
    public function setBackgroundAlpha(int $backgroundAlpha): self
    {
        $this->backgroundAlpha = $backgroundAlpha;

        return $this;
    }
}
