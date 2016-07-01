<?php
namespace Hborras\TwitterAdsSDK\DateTime;
/**
 * A collection of helper functions for string->date conversion
 *
 * @since 2016-06-24
 */
trait DateTimeFormatter
{
    /**
     * Returns the current date and time
     *
     * @return DateTime
     */
    public function now()
    {
        return new \DateTime(null, new \DateTimeZone('UTC'));
    }

    /**
     * Returns a DateTime object from a date string.
     *
     * @param string
     * @return DateTime
     */
    public function toDateTime($datestr)
    {
        return (new \DateTime($datestr))->setTimeZone(new \DateTimeZone('UTC'));
    }

    /**
     * Returns an ImmutableDateTime object from a date string.
     *
     * @param string
     * @return DateTimeImmutable
     */
    public function toDateTimeImmutable($datestr)
    {
        return (new \DateTimeImmutable($datestr))->setTimeZone(new \DateTimeZone('UTC'));
    }
}
