<?php
/**
 * Created by PhpStorm.
 * User: anuj
 * Date: 19/1/18
 * Time: 2:54 PM
 * 
 * Author Anuj Sharma <contact@anujsh.in> <http://anujsh.in>
 */
namespace TBETool;


class Downloader
{
    private $ffmpeg_path;              // absolute path of the ffmpeg installation
    private $youtubedl_path;           // absolute path of the youtube-dl installation
    private $local_path;               // local path to store file
    
    private $video_url;                // url of the video file to download; youtube or facebook video url

    /**
     * Downloader constructor.
     *
     * @param $ffmpeg_path: Absolute path of the ffmpeg package installation
     * @param $youtubedl_path: Absolute path of the youtube-dl package installation
     * @param null $local_path: Local path to save download file to
     */
    function __construct($ffmpeg_path, $youtubedl_path, $local_path = null)
    {
        $this->ffmpeg_path = $ffmpeg_path;
        $this->youtubedl_path = $youtubedl_path;
        
        if ($local_path) {
            $this->local_path = $local_path;
        }
    }
    
    /**
     * Set local path
     *
     * @param $path: Absolute local path to save downloaded file
     */
     public function setLocalPath($path)
     {
         $this->local_path = $path;
     }

    /**
     * download video using youtube-dl and return local url
     *
     * @return bool|string
     * @throws \Exception
     */
    public function download($video_url)
    {
        /**
         * Check if video_url is provided
         */
        if (!$video_url) {
            throw new \Exception('Video url not provided. Make sure to pass youtube or facebook video url only');
        }
        
        /**
         * Check if local_path is set
         */
        if (!$this->local_path) {
            throw new \Exception('Local path not set. Set local path using setLocalPath() function. Local path must be absolute where to store the downloaded file.');
        }
        
        /**
         * Saved video_url to data member
         */
         $this->video_url = $video_url;
        
        /**
         * Generate new file name
         */
        $file_name = time().'.mp4';

        /**
         * Create directory if it does not exists already
         */
        if (!is_dir($this->local_path)) {
            if (!mkdir($this->local_path, 0777, true)) {
                throw new \Exception('Unable to create destination directory: '.$this->local_path);
            }
            if (!chmod($this->local_path, 0777)) {
                throw new \Exception('File permission could not be changed to 0777: '.$this->local_path);
            }
        }

        /**
         * Generate absolute file path with new file name
         */
        $absolute_file_path = $this->local_path . $file_name;

        /**
         * Generate command to run
         */
        $command = $this->youtubedl_path." -f 'bestvideo[ext=mp4]+bestaudio[ext=m4a]/mp4' -o ".$absolute_file_path.' '.$this->video_url;
        $command .= ' --ffmpeg-location '.$this->ffmpeg_path;

        /**
         * Execute the command
         */
        $res_exec = exec($command, $output_command, $output_variable);

        /**
         * Check command output
         */
        if ($output_variable === 0) {

            if (is_file($absolute_file_path)) {
                $this->local_path =  $absolute_file_path;
                return $this->local_path;
            } else {
                throw new \Exception('Failed to download youtube video: '.$res_exec);
            }
        } else {
            throw new \Exception('Failed to download youtube video: '.$res_exec);
        }
    }
}
