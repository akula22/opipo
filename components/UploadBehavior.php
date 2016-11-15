<?php
namespace app\components;
use yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
// use Imagine\Image\ManipulatorInterface;

class UploadBehavior extends \vova07\fileapi\behaviors\UploadBehavior
{
    public $prevew = [];

	protected function saveFile($attribute, $insert = true)
    {
        if (empty($this->owner->$attribute)) {
            if ($insert !== true) {
                $this->deleteFile($this->oldFile($attribute));
            }
        } else {
            $tempFile = $this->tempFile($attribute);

            $file = $this->file($attribute);
            $newFile =  $this->newFile($attribute);

            Image::thumbnail($tempFile, $this->prevew['width'], $this->prevew['height'])
            ->save($newFile, [$this->prevew['quality']]);

            if (is_file($tempFile) && FileHelper::createDirectory($this->path($attribute))) {
                if (rename($tempFile, $file)) 
                {
                    if ($insert === false && $this->unlinkOnSave === true && $this->owner->getOldAttribute(
                            $attribute
                        )
                    ) {
                        $this->deleteFile($this->oldFile($attribute));
                    }
                    $this->triggerEventAfterUpload();
                } else {
                    unset($this->owner->$attribute);
                }
            } elseif ($insert === true) {
                unset($this->owner->$attribute);
            } else {
                $this->owner->setAttribute($attribute, $this->owner->getOldAttribute($attribute));
            }
        }
    }


    public function newFile($attribute)
    {
        return $this->path($attribute) . 'small' . $this->owner->$attribute;
    }

    protected function deleteFile($file)
    {
        if (is_file($file)) {
            return unlink($file);
        }

        return false;
    }

    public function beforeDelete()
    {
        if ($this->unlinkOnDelete) {
            foreach ($this->attributes as $attribute => $config) 
            {
                if ($this->owner->$attribute) 
                {
                    $this->deleteFile($this->file($attribute));
                    $this->deleteFile($this->newFile($attribute));
                }
            }
        }
    }

}