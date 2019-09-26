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
  public function __construct(Response $response)
  {
    $this->path = $response->getHref();
    $this->isfolder = (array_key_exists('D:quota-used-bytes', $response->getproperties())) ? true : false;
    $this->mimeType = (!$this->isfolder) ? $response->getproperties()->get('D:getcontenttype')->getValue() : null;
    $this->lastEdited = ($response->getproperties()->get('D:getlastmodified') != null) ? $response->getproperties()->get('D:getlastmodified')->getTime() : null;
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
        return basename($this->getPath());
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
     * @return mixed
     */
    public function getExt()
    {
        $ext = null;
        if(!$this->isFolder){
          $ext = pathinfo($this->getName(), PATHINFO_EXTENSION);
        }

        return $ext;
    }

    /**
     * Get the value of Last Edited
     *
     * @return mixed
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



}
