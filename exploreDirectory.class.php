<?php
/**
 * Class Explore Directory
 *
 * @link https://github.com/hamfaz/php-explore-directory.git
 * @author hamam fajar <hamamfajar@gmail.com> | @hamfaz
 * @version 0.1
 */


class exploreDirectory
{

  /**
   * @var array
   */
  public $log = array();


  /***************************** function file *****************************/

  /**
   * Create File
   * @var file (str)
   * @return response
   */
  public function createFile($file)
  {

    if ($this->fileExists($file)) {
      $this->log('Create File - FileExists => ' . $file);
    } else {
      $handle = fopen($file, 'w');
      $this->log('Create File - Success => ' . $file);
    }

  }

  /**
   * Read File
   * @var file (str)
   * @return response
   */
  public function readFile($file)
  {

    if ($this->fileExists($file)) {
      $handle = fopen($file, 'r');
      $return = fread($handle,filesize($file));
      fclose($handle);
      $this->log('Read File - Success => ' . $file);
      return $return;
    } else {
      $this->log('Read File - Not Found => ' . $file);
    }

  }

  /**
   * Write File
   * @var file (str)
   * @var data (str)
   * @return response
   */
  public function writeFile($file, $data)
  {

    if ($this->fileExists($file)) {
      $handle = fopen($file, 'w') or die('Cannot open file:  '.$file);
      fwrite($handle, $data);
      fclose($handle);
      $this->log('Write File - Success => ' . $file);
    } else {
      $this->log('Write File - Not Found => ' . $file);
    }

  }

  /**
   * Append File
   * @var file (str)
   * @var data (str)
   * @return response
   */
  public function appendFile($file, $data)
  {

    if ($this->fileExists($file)) {
      $handle = fopen($file, 'a') or die('Cannot open file:  '.$file);
      fwrite($handle, $data);
      fclose($handle);
      $this->log('Append File - Success => ' . $file);
    } else {
      $this->log('Append File - Not Found => ' . $file);
    }

  }

  /**
   * Append Line File
   * @var file (str)
   * @var data (str)
   * @return response
   */
  public function appendLineFile($file, $data)
  {

    if ($this->fileExists($file)) {
      $handle = fopen($file, 'a') or die('Cannot open file:  '.$file);
      $data = "\r\n".$data;
      fwrite($handle, $data);
      fclose($handle);
      $this->log('AppendLine File - Success => ' . $file);
    } else {
      $this->log('AppendLine File - Not Found => ' . $file);
    }

  }

  /**
   * Delete File
   * @var file (str)
   * @return response
   */
  public function deleteFile($file)
  {

    if ($this->fileExists($file)) {
      unlink($file);
      $this->log('Delete File - Success => ' . $file);
    } else {
      $this->log('Delete File - Not Found => ' . $file);
    }

  }



  /***************************** function directory *****************************/

  /**
   * Delete Folder Tree
   * @var dir (str)
   * @return response
   */
  public static function scanFolder($dir) {

    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
      (is_dir("$dir/$file")) ? $this->scanFolder("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);

  }

  /**
   * Create Folder
   * @var dir (str)
   * @return response
   */
  public function createFolder($dir)
  {

    if ($this->fileExists($dir)) {
      $this->log('Create Folder - FileExists => ' . $dir);

    } else {

      if (!mkdir($dir, 0755, true)) {
        $this->log('Create Folder - Failed => ' . $dir);
      } else {
        $this->log('Create Folder - Success => ' . $dir);
      }

    }

  }

  /**
   * Delete Folder
   * @var dir (str)
   * @return response
   */
  public function deleteFolder($dir)
  {

    if ($this->fileExists($dir)) {
      $this->scanFolder($dir);
      $this->log('Delete Folder - Success => ' . $dir);
    } else {
      $this->log('Delete Folder - Not Found => ' . $dir);
    }

  }

  /**
   * Delete Folder
   * @var dir (str)
   * @var chmod (str)
   * @return response
   */
  public function chmodFolder($dir, $chmod)
  {

    if ($this->fileExists($dir)) {
      chmod($dir, $chmod);
      $this->log('Chmod Folder - Success => ' . $dir . ':' .$chmod);
    } else {
      $this->log('Chmod Folder - Not Found => ' . $dir . ':' .$chmod);
    }

  }


  /***************************** function core *****************************/


  /**
   * fileExists
   * @var dir (str)
   * @return bool
   */
  private function fileExists($path)
  {

    if (file_exists($path)) {
      return true;
    } else {
      return false;
    }

  }

  /**
   * log
   * @var data (str)
   * @return response
   */
  private function log($data)
  {
    $this->log[] = $data;
  }

  /**
   * debug
   * @return array
   */
  public function debug()
  {
    return $this->log;
  }


}


?>
