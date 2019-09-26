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
  protected $size;

  public function __construct(Response $response)
  {
    $this->response = $response;
  }

    /**
     * Get the file/folder path
     *
     * @return mixed
     */
    public function getPath()
    {
        return $this->response->getHref();
    }

    /**
     * Get the file/folder Name
     *
     * @return mixed
     */
    public function getName()
    {
        return basename($this->getPath());
    }

    /**
     * Get the file MimeType
     *
     * @return mixed
     */
    public function getMimeType()
    {
        return ($this->isfolder() == false) ? $response->getproperties()->get('D:getcontenttype')->getValue() : null;
    }

    /**
     * Get the file extension
     *
     * @return string
     */
    public function getExt()
    {
        return ($this->isfolder() == false) ? pathinfo($this->getName(), PATHINFO_EXTENSION) : null;
    }

    /**
     * Get the value of Last Edited
     * @return \DateTime
     */
    public function getLastEdited()
    {
        return $this->response->getproperties()->get('D:getlastmodified') != null) ? $response->getproperties()->get('D:getlastmodified')->getTime() : null;
    }

    /**
     * Get the file/folder Size
     *
     * @return mixed
     */
    public function getSize($string = true)
    {
      if ($this->isFolder()){
        $size = ($this->response->getproperties()->get('D:getcontentlength') != null) ? $this->response->getproperties()->get('D:getcontentlength')->getValue() : null;
      } else {
        $size = ($this->response->getproperties()->get('D:quota-used-bytes') != null) ? $this->response->getproperties()->get('D:quota-used-bytes')->getValue() : null;
      }

      if ($size != null){
        return ($string == true) ? $this->formatSizeUnits($size) : $size;
      }

      return $size;
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
