# PHP Explore Directory

## Example Code

```
/**
 * example function directory
 */

// create new folder
$class->createFolder($path);

// chmod folder
$class->chmodFolder($path, '777');

// delete folder without file
$class->deleteFolder($path);

/**
 * example function file
 */
// create new file
$class->createFile($path_file);

// read file
$class->readFile($path_file);

// write file
$class->writeFile($path_file, 'hello world');

// append file
$class->appendFile($path_file, 'hello world');

// append line file
$class->appendLineFile($path_file, 'hello world');

// delete file
$class->deleteFile($path_file);
```
