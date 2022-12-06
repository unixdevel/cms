<?php namespace UnixDevel\Nlp\Models;

use Winter\Storm\Database\Model;

class NlpSettings extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    public string $settingsCode = 'unixdevel_nlp_settings';

    public string $settingsFields = 'fields.yaml';

    public array $rules = [
        'api_url' => ['string'],
    ];
}
