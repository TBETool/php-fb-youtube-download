## PHP Library: Facebook-Youtube downloader

PHP Library to download Facebook and Youtube videos.

---
### Using the Library


#### Requirement   
1. FFMPEG: Media editing library
2. youtube-dl: command line library to download videos

#### Installation

Intall library in PHP project using composer
```
composer require tbetool/php-fb-youtube-download
```

#### Using Library

$downloader = new Downloader(FFMPEG_PATH, YOUTUBE-DL_PATH);

#### Setting output path
Set absolute path of the directory where to save the output. You don't need to provide a file name as it will be auto generated.
```
$path = '/aboslute/path/to/directory';

$downloader->setOutputPath($path);
```

#### Download video
```
$downloader->download(video_url);
```
You can pass Facebook or Youtube video url to the `download()` function.  
If video is downloaded successfully, this will return the path of the local video saved, otherwise will throw an exception.

---
### Exception handling

Every function throws an Exception in case of any error/issue. Bind the code block within `try-catch` block to catch any exception occurred.

_Ex:_
```
try {
    $downloader->download(video_url);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
```

---
### Bug Reporting

If you found any bug, create an [issue](https://github.com/TBETool/php-fb-youtube-download/issues/new).

---
### Support and Contribution

Something is missing? 
* `Fork` the repositroy
* Make your contribution
* make a `pull request`

