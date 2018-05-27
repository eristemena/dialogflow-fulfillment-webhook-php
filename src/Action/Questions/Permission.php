<?php

namespace Dialogflow\Action\Questions;

use Dialogflow\Action\Interfaces\QuestionInterface;
use RuntimeException;

class Permission implements QuestionInterface
{
    /** @var string */
    protected $context;

    /** @var array */
    protected $permissions;

    /** @var array */
    protected $validPermissions = [
        'NAME',
        'DEVICE_PRECISE_LOCATION',
        'DEVICE_COARSE_LOCATION',
        'UPDATE',
    ];

    /**
     * Constructor for Permission object.
     *
     * @param string $context
     * @param array  $permissions
     *
     * @throws RuntimeException
     *
     * @return Dialogflow\Action\Questions\Permission
     */
    public function __construct($context, $permissions)
    {
        $this->context = $context;

        foreach ($permissions as $permission) {
            if (! in_array($permission, $this->validPermissions)) {
                throw new RuntimeException('Invalid permission: '.$permission);
            }
        }

        $this->permissions = $permissions;
    }

    /**
     * Create a new Permission instance.
     *
     * @param string $context
     * @param array  $permissions
     *
     * @return Dialogflow\Action\Questions\ListCard
     */
    public static function create($context, $permissions)
    {
        return new self($context, $permissions);
    }

    /**
     * Render a single Rich Response item as array.
     *
     * @return null|array
     */
    public function renderRichResponseItem()
    {
        $out = [];

        $out['simpleResponse'] = ['textToSpeech' => 'PLACEHOLDER_FOR_PERMISSION'];

        return $out;
    }

    /**
     * Render System Intent as array.
     *
     * @return null|array
     */
    public function renderSystemIntent()
    {
        $out = [];

        $out['intent'] = 'actions.intent.PERMISSION';
        $out['data'] = [
            '@type'       => 'type.googleapis.com/google.actions.v2.PermissionValueSpec',
            'optContext'  => $this->context,
            'permissions' => $this->permissions,
        ];

        return $out;
    }
}
