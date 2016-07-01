<?php

namespace Hborras\TwitterAdsSDK\Ton;

use Hborras\TwitterAdsSDK\Ton\Exception\ErrorReadingFile;

/**
 * Represents a simple file to upload to the TON API
 *
 * @since 2016-07-01
 */
class TonFile
{
    use \Hborras\TwitterAdsSDK\DateTime\DateTimeFormatter;

    const CHUNK_DEFAULT_SIZE = 1048576; // 10MB - 1024 * 1024
    const HTTP_DATE = 'D, d M Y H:i:s \G\M\T';

    /**
     * @var \SplFileObject
     */
    private $file;

    /**
     * @var string
     */
    private $contentType;

    public function __construct($file, $contentType)
    {
        $this->file = new \SplFileObject($file, 'r');
        $this->contentType = $contentType;
    }

    /**
     * Reads a buffer from a file
     *
     * @param int|null - the number of bytes to read
     *
     * @throws ErrorReadingFile when no data is returned
     * @return array
     */
    public function read($bytes=null)
    {
        $bytes = $bytes ?: self::CHUNK_DEFAULT_SIZE;

        $data = $this->file->fread($bytes);

        if (!$data) {
            throw new ErrorReadingFile(
                sprintf('Count not read "%s" bytes from file "%s"', $bytes, $this->file->getPath())
            );
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return \SplFileObject
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * The file size in bytes
     *
     * @return int
     */
    public function getSize()
    {
        return self::getFileSize($this->file);
    }

    /**
     * PHP caches file sizes. This method is used to make sure we get the
     * correct file size in bytes.
     * 
     * @param $file \SplFileObject
     *
     * @return int
     */
    private static function getFileSize(\SplFileObject $file)
    {
        clearstatcache();
        return $file->getSize();
    }

    /**
     * Gets 1 day ahead of the current date and formats it to an acceptable
     * HTTP timestamp.
     *
     * @return string
     */
    public function getExpiration()
    {
        return $this->now()->modify('+1 day')->format(self::HTTP_DATE);
    }

}
