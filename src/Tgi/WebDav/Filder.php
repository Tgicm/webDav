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
  protected $size;

  public function __construct(Response $response)
  {
    $this->response = $response;
    $this->path = $response->getHref();
    $this->name = basename($this->path);
    $this->lastEdited = ($response->getproperties()->get('D:getlastmodified') != null) ? $response->getproperties()->get('D:getlastmodified')->getTime() : null;

    $size = null;
    $isFolder = ($response->getproperties()->get('D:quota-used-bytes') != null) ? true : false;
    if ($isFolder == false){
       $size = ($response->getproperties()->get('D:getcontentlength') != null) ? $response->getproperties()->get('D:getcontentlength')->getValue() : null;
    }else {
       $size = ($response->getproperties()->get('D:quota-used-bytes') != null) ? $response->getproperties()->get('D:quota-used-bytes')->getValue() : null;
    }

    $this->size = $size;
    $this->mimeType = ($isFolder == false) ? $response->getproperties()->get('D:getcontenttype')->getValue() : null;
    $this->ext = ($isFolder == false) ? pathinfo($this->getName(), PATHINFO_EXTENSION) : null;
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
    public function getSize()
    {
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



}
