<?php
namespace RebieKong\MpTools\Entity;
/**
 * Follow class should Not Be Call
 */
exit(-1);

/**
 * Class TextBean
 *
 * @package RebieKong\MpTools\Entity
 * @property string content
 */
class TextBean extends MessageBean
{

}

/**
 * Class VoiceBean
 *
 * @package RebieKong\MpTools\Entity
 * @property string mediaId
 * @property string format
 * @property string recognition
 */
class VoiceBean extends MessageBean
{

}

/**
 * Class VideoBean
 *
 * @package RebieKong\MpTools\Entity
 * @property string mediaId
 * @property string thumbMediaId
 */
class VideoBean extends MessageBean
{

}

/**
 * Class ShortVideoBean
 *
 * @package RebieKong\MpTools\Entity
 * @property string mediaId
 * @property string thumbMediaId
 */
class ShortVideoBean extends MessageBean
{

}

/**
 * Class LocationBean
 *
 * @package RebieKong\MpTools\Entity
 * @property string location_X
 * @property string location_Y
 * @property int scale
 * @property string label
 */
class LocationBean extends MessageBean
{

}

/**
 * Class LinkBean
 *
 * @package RebieKong\MpTools\Entity
 * @property string title
 * @property string description
 * @property string url
 */
class LinkBean extends MessageBean
{

}

