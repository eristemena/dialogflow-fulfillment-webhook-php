<?php

namespace Dialogflow;

use Dialogflow\Action\Conversation;
use Dialogflow\RichMessage\Payload;
use Dialogflow\RichMessage\RichMessage;
use Dialogflow\RichMessage\Text;
use RuntimeException;

class WebhookClient extends RichMessage
{
    /** @var string */
    protected $agentVersion;

    /** @var string */
    protected $intent;

    /** @var string|null */
    protected $action;

    /** @var string */
    protected $session;

    /** @var array */
    protected $parameters = [];

    /** @var array|null */
    protected $contexts;

    /** @var string */
    protected $requestSource;

    /** @var array|null */
    protected $originalRequest;

    /** @var string */
    protected $query;

    /** @var string */
    protected $locale;

    /** @var array */
    protected $messages = [];

    /** @var string */
    protected $text;

    /** @var array */
    protected $outgoingContexts = [];

    /**
     * Constructor for WebhookClient object.
     *
     * @param array $data request data payload from Dialogflow
     */
    public function __construct($data)
    {
        if (isset($data['result'])) {
            $this->parseRequestV1($data);
        } elseif (isset($data['queryResult'])) {
            $this->parseRequestV2($data);
        } else {
            throw new RuntimeException('Invalid Dialogflow request');
        }
    }

    /**
     * @param array $data
     *
     * @return WebhookClient
     */
    public static function fromData($data)
    {
        return new self($data);
    }

    private function parseRequestV1($data)
    {
        $this->agentVersion = 1;

        $this->intent = $data['result']['metadata']['intentName'];
        $this->action = (isset($data['result']['action'])) ? $data['result']['action'] : null;
        $this->session = $data['sessionId'];
        $this->parameters = $data['result']['parameters'];

        if (isset($data['result']['contexts'])) {
            $this->contexts = [];
            foreach ($data['result']['contexts'] as $arrContext) {
                $this->contexts[] = new Context($arrContext['name'], $arrContext['lifespan'], $arrContext['parameters']);
            }
        }

        if (isset($data['originalRequest'])) {
            $originalRequest = $data['originalRequest'];

            if (isset($originalRequest['data'])) {
                // Rename 'data' attr to 'payload' to be consistent with v2
                if (isset($originalRequest['data'])) {
                    $originalRequest['payload'] = $originalRequest['data'];
                    unset($originalRequest['data']);
                }
                $this->originalRequest = $originalRequest;
            }

            if (isset($originalRequest['source'])) {
                $this->requestSource = $originalRequest['source'];
            } elseif (isset($originalRequest['payload']['source'])) {
                $this->requestSource = $originalRequest['data']['source'];
            }
        }

        if (! $this->requestSource && isset($data['result']['source'])) {
            $this->requestSource = $data['result']['source'];
        }

        $this->query = $data['result']['resolvedQuery'];
        $this->locale = $data['lang'];
    }

    private function parseRequestV2($data)
    {
        $this->agentVersion = 2;

        $this->intent = $data['queryResult']['intent']['displayName'];
        $this->action = (isset($data['queryResult']['action'])) ? $data['queryResult']['action'] : null;
        $this->session = $data['session'];
        $this->parameters = $data['queryResult']['parameters'];

        if (isset($data['queryResult']['outputContexts'])) {
            $this->contexts = [];
            foreach ($data['queryResult']['outputContexts'] as $arrContext) {
                $name = substr($arrContext['name'], strlen($this->session) + strlen('/contexts/'));
                $lifespan = (isset($arrContext['lifespanCount'])) ? $arrContext['lifespanCount'] : 0;
                $parameters = (isset($arrContext['parameters'])) ? $arrContext['parameters'] : [];
                $this->contexts[] = new Context($name, $lifespan, $parameters);
            }
        }

        if (isset($data['originalDetectIntentRequest'])) {
            $this->originalRequest = $data['originalDetectIntentRequest'];

            if (isset($this->originalRequest['source'])) {
                $this->requestSource = $this->originalRequest['source'];
            } elseif (isset($this->originalRequest['payload']['source'])) {
                $this->requestSource = $this->originalRequest['payload']['source'];
            }
        }

        $this->query = $data['queryResult']['queryText'];
        $this->locale = $data['queryResult']['languageCode'];
    }

    /**
     * The agent version (v1 or v2) based on Dialogflow webhook request.
     * Reference: https://dialogflow.com/docs/reference/v2-comparison.
     *
     * @return string
     */
    public function getAgentVersion()
    {
        return $this->agentVersion;
    }

    /**
     * Get intent name.
     * Reference: https://dialogflow.com/docs/intents.
     *
     * @return string
     */
    public function getIntent()
    {
        return $this->intent;
    }

    /**
     * Get action name.
     * Reference: https://dialogflow.com/docs/actions-and-parameters.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Get session id.
     * Reference: https://dialogflow.com/docs/reference/api-v2/rest/v2beta1/WebhookRequest#FIELDS.session.
     *
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Get parameters.
     * Reference: https://dialogflow.com/docs/actions-and-parameters.
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Get contexts.
     * Reference: https://dialogflow.com/docs/actions-and-parameters.
     *
     * @return array|null
     */
    public function getContexts()
    {
        return $this->contexts;
    }

    /**
     * Convenience method to get a Dialogflow context by name.
     * Reference: https://dialogflow.com/docs/contexts.
     *
     * @param string $name context name
     *
     * @return null|Context
     */
    public function getContext($name)
    {
        if (is_array($this->contexts)) {
            foreach ($this->contexts as $context) {
                if ($context->getName() == $name) {
                    return $context;
                }
            }
        }
    }

    /**
     * Get request source.
     * Reference: https://dialogflow.com/docs/reference/agent/query#query_parameters_and_json_fields.
     *
     * @return string
     */
    public function getRequestSource()
    {
        return $this->requestSource;
    }

    /**
     * Dialogflow original request object from detectIntent/query or platform integration (Google Assistant, Slack, etc.) in the request or null if no value.
     * Reference: https://dialogflow.com/docs/reference/agent/query#query_parameters_and_json_fields.
     *
     * @return array|null
     */
    public function getOriginalRequest()
    {
        return $this->originalRequest;
    }

    /**
     * Original user query as indicated by Dialogflow or null if no value.
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Original request language code (i.e. "en").
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Response to incoming request.
     *
     * @param string|\Dialogflow\Richmessage|\Dialogflow\Action\Conversation $message
     *
     * @return \Dialogflow\WebhookClient
     */
    public function reply($message)
    {
        if (is_string($message)) {
            $this->messages[] = Text::create()
                ->text($message)
                ->setAgentVersion($this->agentVersion)
                ->setRequestSource($this->requestSource);

            if (! $this->doesSupportRichMessage()) {
                $this->text = $message;
            }
        } elseif ($message instanceof RichMessage) {
            $message->setAgentVersion($this->agentVersion)
                ->setRequestSource($this->requestSource);

            $this->messages[] = $message;
        } elseif ($message instanceof Conversation) {
            $this->messages[] = Payload::create($message->render())
                ->setAgentVersion($this->agentVersion)
                ->setRequestSource($this->requestSource);
        }

        return $this;
    }

    /**
     * Get all Dialogflow outgoing contexts.
     * Reference: https://dialogflow.com/docs/contexts.
     *
     * @return array
     */
    public function getOutgoingContexts()
    {
        return $this->outgoingContexts;
    }

    /**
     * Get a Dialogflow outgoing context.
     * Reference: https://dialogflow.com/docs/contexts.
     *
     * @param string $name context name
     *
     * @return null|Context
     */
    public function getOutgoingContext($name)
    {
        foreach ($this->outgoingContexts as $outgoingContext) {
            if ($outgoingContext->getName() == $name) {
                return $outgoingContext;
            }
        }
    }

    /**
     * Set a new Dialogflow outgoing context.
     * Reference: https://dialogflow.com/docs/contexts.
     *
     * @param string|array|\Dialogflow\Context $context
     *
     * @return \Dialogflow\WebhookClient
     */
    public function setOutgoingContext($context)
    {
        if (is_string($context)) {
            $outgoingContext = new Context($context);
        } elseif (is_array($context)) {
            if (! isset($context['name'])) {
                throw new RuntimeException('Context must have a name');
            }

            $name = $context['name'];

            $lifespan = 1;
            if (isset($context['lifespan'])) {
                $lifespan = is_numeric($context['lifespan']) ? $context['lifespan'] : null;
            }

            $parameters = [];
            if (isset($context['parameters'])) {
                $parameters = is_array($context['parameters']) ? $context['parameters'] : null;
            }

            $outgoingContext = new Context($name, $lifespan, $parameters);
        } elseif ($context instanceof Context) {
            $outgoingContext = $context;
        } else {
            throw new RuntimeException('Context must be provided');
        }

        $this->outgoingContexts[] = $outgoingContext;

        return $this;
    }

    /**
     * Clear an existing outgoing context.
     * Reference: https://dialogflow.com/docs/contexts.
     *
     * @param string $contextName
     *
     * @return \Dialogflow\WebhookClient
     */
    public function clearOutgoingContext($contextName)
    {
        foreach ($this->outgoingContexts as $i => $context) {
            if ($context->getName() == $contextName) {
                unset($this->outgoingContexts[$i]);
            }
        }

        return $this;
    }

    /**
     * Clear all existing outgoing contexts.
     * Reference: https://dialogflow.com/docs/contexts.
     *
     * @return \Dialogflow\WebhookClient
     */
    public function clearOutgoingContexts()
    {
        $this->outgoingContexts = [];

        return $this;
    }

    /**
     * Replace all Dialogflow outgoing contexts.
     * Reference: https://dialogflow.com/docs/contexts.
     *
     * @param array $contexts
     *
     * @return \Dialogflow\WebhookClient
     */
    public function setOutgoingContexts($contexts)
    {
        $this->outgoingContexts = $contexts;

        return $this;
    }

    /**
     * Get Actions on Google DialogflowConversation object.
     *
     * @return null|\Dialogflow\Action\Conversation
     */
    public function getActionConversation()
    {
        if ('google' == $this->requestSource) {
            return new Conversation($this->originalRequest['payload']);
        } else {
            return;
        }
    }

    /**
     * Render response as array for API V1.
     *
     * @return array
     */
    protected function renderV1()
    {
        $out = ['messages' => []];

        $messages = [];

        foreach ($this->messages as $message) {
            if ($message instanceof Payload) {
                $out['data'] = $message->render();
            } else {
                $messages[] = $message->render();
            }
        }

        $out['messages'] = $messages;

        if ($this->text) {
            $out['speech'] = $this->text;
        }

        $outgoingContexts = [];
        foreach ($this->outgoingContexts as $outgoingContext) {
            $outContexts = ['name' => $outgoingContext->getName()];

            if ($outgoingContext->getLifespan()) {
                $outContexts['lifespan'] = $outgoingContext->getLifespan();
            }

            if ($outgoingContext->getParameters()) {
                $outContexts['parameters'] = $outgoingContext->getParameters();
            }

            $outgoingContexts[] = $outContexts;
        }
        $out['contextOut'] = $outgoingContexts;

        return $out;
    }

    /**
     * Render response as array for API V2.
     *
     * @param string $session session
     *
     * @return array
     */
    protected function renderV2()
    {
        $out = [];

        $messages = [];

        foreach ($this->messages as $message) {
            if ($message instanceof Payload) {
                $out['payload'] = $message->render();
            } else {
                $messages[] = $message->render();
            }
        }

        if (count($messages)) {
            $out['fulfillmentMessages'] = $messages;
        }

        if ($this->text) {
            $out['fulfillmentText'] = $this->text;
        }

        $outgoingContexts = [];
        foreach ($this->outgoingContexts as $outgoingContext) {
            $outContexts = [
                'name' => $this->session.'/contexts/'.$outgoingContext->getName(),
            ];

            if ($outgoingContext->getLifespan()) {
                $outContexts['lifespanCount'] = $outgoingContext->getLifespan();
            }

            if ($outgoingContext->getParameters()) {
                $outContexts['parameters'] = $outgoingContext->getParameters();
            }

            $outgoingContexts[] = $outContexts;
        }
        $out['outputContexts'] = $outgoingContexts;

        return $out;
    }
}
