<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 06.12.16
 * Time: 18:49
 */

namespace App\Services;

use App\Contracts\ImportProvider;
use App\Exceptions\NotSupportedImportFileExtensionException;
use Exception;
use Illuminate\Http\UploadedFile;

/**
 * Class ImportService
 * @package App\Services
 */
class ImportService
{
    
    /**
     * @var ImportProvider
     */
    protected $provider;
    
    /**
     * @param UploadedFile|null $file
     *
     * @throws \App\Exceptions\NotSupportedImportFileExtensionException
     * @throws \Exception
     */
    public function import($file)
    {
        if (!file_exists($file)) {
            throw new Exception(
                trans('messages.file not exists: :file_name', ['file_name' => $file->getClientOriginalName()])
            );
        }
        
        $this->provider = $this->getProvider($file);
        
        if (!$this->provider) {
            throw new NotSupportedImportFileExtensionException(
                trans(
                    'messages.import file extensions not supported :extensions',
                    ['extensions' => $file->getClientOriginalExtension()]
                )
            );
        }
    
        set_time_limit(3600);
        
        $this->provider->import($file);
    }
    
    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->provider->getErrors();
    }
    
    /**
     * @param UploadedFile $file
     *
     * @return bool|ImportProvider
     */
    public function getProvider($file)
    {
        $extension = $file->getClientOriginalExtension();
        
        $extensions = config('import.supported_providers');
        
        if (!isset($extensions[$extension])) {
            return false;
        }
        
        return app(config('import.providers_path').'\\'.title_case($extensions[$extension]));
    }
}