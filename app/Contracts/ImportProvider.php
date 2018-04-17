<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 07.12.16
 * Time: 12:08
 */

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

/**
 * Interface ImportProvider
 * @package App\Contracts
 */
interface ImportProvider
{
    /**
     * @param UploadedFile $file
     *
     * @return
     */
    public function import($file);
    
    /**
     * @return array
     */
    public function getErrors();
}