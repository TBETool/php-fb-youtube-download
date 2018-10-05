## AWS Polly Text-To-Speech PHP Library

PHP Library to download youtube videos.

---
### Using the Library


#### Requirement   
1. FFMPEG: Media editing library
2. youtube-dl: command line library to download videos

#### Installation

Intall library in PHP project using composer
```
composer require tbetool/php-youtube-download
```

#### Using Library

$youtubeDownloader = new YoutubeDownloader(FFMPEG_PATH, YOUTUBE-DL_PATH);

#### Setting output path
Set absolute path of the directory where to save the output. You don't need to provide a file name as it will be auto generated.
```
$path = '/aboslute/path/to/directory';

$youtubeDownloader->setOutputPath($path);
```

#### Download video
```
$youtubeDownloader->download(video_url);
```
If video is downloaded successfully, this will return the path of the local video saved, otherwise will throw an exception.

---
### Exception handling

Every function throws an Exception in case of any error/issue. Bind the code block within `try-catch` block to catch any exception occurred.

_Ex:_
```
try {
    $youtubeDownloader->download(video_url);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
```

---
### Bug Reporting

If you found any bug, create an [issue](https://github.com/TBETool/aws-polly/issues/new).

---
### Support and Contribution

Something is missing? 
* `Fork` the repositroy
* Make your contribution
* make a `pull request`

