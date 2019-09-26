<?php
/**
 * This file is part of the WebDav package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tgi\WebDav;

use Tgi\WebDav\Response;


/**
 * A filder object that contains main informations for file or folder item
 *
 * @author tgicm <cmalfroy@tgi.fr>
 */
class Filder
{

  /**
   * @var string
   */
  protected $path;

  /**
   * @var string
   */
  protected $name;

  /**
   * @var string
   */
  protected $mimeType;

  /**
   * @var string
   */
  protected $ext;

  /**
   * @var \DateTime
   */
  protected $lastEdited;

  /**
   * @var string
   */
  protected $size = null;

  public function __construct(Response $response)
  {
    $isFolder = ($response->getproperties()->get('D:quota-used-bytes') != null) ? true : false;
    if ($isFolder){
      $size = ($response->getproperties()->get('D:getcontentlength') != null) ? $response->getproperties()->get('D:getcontentlength')->getValue() : null;
    } else {
      $size = ($response->getproperties()->get('D:quota-used-bytes') != null) ? $response->getproperties()->get('D:quota-used-bytes')->getValue() : null;
    }
    $this->response = $response;

    $this->path = $response->getHref();
    $this->name = basename($this->path);
    $this->mimeType = ($isFolder == false) ? $response->getproperties()->get('D:getcontenttype')->getValue() : null;
    $this->ext = ($isFolder == false) ? pathinfo($this->getName(), PATHINFO_EXTENSION) : null;
    $this->lastEdited = ($response->getproperties()->get('D:getlastmodified') != null) ? $response->getproperties()->get('D:getlastmodified')->getTime() : null;
    $this->size = $size;
  }

    /**
     * Get the file/folder path
     *
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get the file/folder Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the file MimeType
     *
     * @return mixed
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Get the file extension
     *
     * @return string
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * Get the value of Last Edited
     * @return \DateTime
     */
    public function getLastEdited()
    {
        return $this->lastEdited;
    }

    /**
     * Get the file/folder Size
     *
     * @return mixed
     */
    public function getSize($string = true)
    {
      if ($this->size != null){
        return ($string == true) ? $this->formatSizeUnits($this->size) : $this->size;
      }

      return $this->size;
    }


    /**
    * Get the file/folder Tag
     *
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * return true if filder is a folder
     *
     * @return bool
     */
    public function isFolder()
    {
        return ($this->response->getproperties()->get('D:quota-used-bytes') != null) ? true : false;
    }

    /**
     * Get the file/folder path
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

}
