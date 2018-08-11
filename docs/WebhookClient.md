# Dialogflow\WebhookClient  





## Extend:

Dialogflow\RichMessage\RichMessage

## Methods

| Name | Description |
|------|-------------|
|[__construct](#webhookclient__construct)|Constructor for WebhookClient object.|
|[clearOutgoingContext](#webhookclientclearoutgoingcontext)|Clear an existing outgoing context.|
|[clearOutgoingContexts](#webhookclientclearoutgoingcontexts)|Clear all existing outgoing contexts.|
|[fromData](#webhookclientfromdata)||
|[getAction](#webhookclientgetaction)|Get action name.|
|[getActionConversation](#webhookclientgetactionconversation)|Get Actions on Google DialogflowConversation object.|
|[getAgentVersion](#webhookclientgetagentversion)|The agent version (v1 or v2) based on Dialogflow webhook request.|
|[getContext](#webhookclientgetcontext)|Convenience method to get a Dialogflow context by name.|
|[getContexts](#webhookclientgetcontexts)|Get contexts.|
|[getIntent](#webhookclientgetintent)|Get intent name.|
|[getLocale](#webhookclientgetlocale)|Original request language code (i.e. "en").|
|[getOriginalRequest](#webhookclientgetoriginalrequest)|Dialogflow original request object from detectIntent/query or platform integration (Google Assistant, Slack, etc.) in the request or null if no value.|
|[getOutgoingContext](#webhookclientgetoutgoingcontext)|Get a Dialogflow outgoing context.|
|[getOutgoingContexts](#webhookclientgetoutgoingcontexts)|Get all Dialogflow outgoing contexts.|
|[getParameters](#webhookclientgetparameters)|Get parameters.|
|[getQuery](#webhookclientgetquery)|Original user query as indicated by Dialogflow or null if no value.|
|[getRequestSource](#webhookclientgetrequestsource)|Get request source.|
|[getSession](#webhookclientgetsession)|Get session id.|
|[reply](#webhookclientreply)|Response to incoming request.|
|[setOutgoingContext](#webhookclientsetoutgoingcontext)|Set a new Dialogflow outgoing context.|
|[setOutgoingContexts](#webhookclientsetoutgoingcontexts)|Replace all Dialogflow outgoing contexts.|

## Inherited methods

| Name | Description |
|------|-------------|
|doesSupportRichMessage|Check if request source support rich message.|
|render|Render response as array.|



### WebhookClient::__construct  

**Description**

```php
public __construct (array $data)
```

Constructor for WebhookClient object. 

 

**Parameters**

* `(array) $data`
: request data payload from Dialogflow  

**Return Values**




### WebhookClient::clearOutgoingContext  

**Description**

```php
public clearOutgoingContext (string $contextName)
```

Clear an existing outgoing context. 

Reference: https://dialogflow.com/docs/contexts. 

**Parameters**

* `(string) $contextName`

**Return Values**

`\Dialogflow\WebhookClient`





### WebhookClient::clearOutgoingContexts  

**Description**

```php
public clearOutgoingContexts (void)
```

Clear all existing outgoing contexts. 

Reference: https://dialogflow.com/docs/contexts. 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Dialogflow\WebhookClient`





### WebhookClient::fromData  

**Description**

```php
public static fromData (array $data)
```

 

 

**Parameters**

* `(array) $data`

**Return Values**

`\WebhookClient`





### WebhookClient::getAction  

**Description**

```php
public getAction (void)
```

Get action name. 

Reference: https://dialogflow.com/docs/actions-and-parameters. 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`





### WebhookClient::getActionConversation  

**Description**

```php
public getActionConversation (void)
```

Get Actions on Google DialogflowConversation object. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|\Dialogflow\Action\Conversation`





### WebhookClient::getAgentVersion  

**Description**

```php
public getAgentVersion (void)
```

The agent version (v1 or v2) based on Dialogflow webhook request. 

Reference: https://dialogflow.com/docs/reference/v2-comparison. 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`





### WebhookClient::getContext  

**Description**

```php
public getContext (string $name)
```

Convenience method to get a Dialogflow context by name. 

Reference: https://dialogflow.com/docs/contexts. 

**Parameters**

* `(string) $name`
: context name  

**Return Values**

`null|\Context`





### WebhookClient::getContexts  

**Description**

```php
public getContexts (void)
```

Get contexts. 

Reference: https://dialogflow.com/docs/actions-and-parameters. 

**Parameters**

`This function has no parameters.`

**Return Values**

`array|null`





### WebhookClient::getIntent  

**Description**

```php
public getIntent (void)
```

Get intent name. 

Reference: https://dialogflow.com/docs/intents. 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`





### WebhookClient::getLocale  

**Description**

```php
public getLocale (void)
```

Original request language code (i.e. "en"). 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`





### WebhookClient::getOriginalRequest  

**Description**

```php
public getOriginalRequest (void)
```

Dialogflow original request object from detectIntent/query or platform integration (Google Assistant, Slack, etc.) in the request or null if no value. 

Reference: https://dialogflow.com/docs/reference/agent/query#query_parameters_and_json_fields. 

**Parameters**

`This function has no parameters.`

**Return Values**

`array|null`





### WebhookClient::getOutgoingContext  

**Description**

```php
public getOutgoingContext (string $name)
```

Get a Dialogflow outgoing context. 

Reference: https://dialogflow.com/docs/contexts. 

**Parameters**

* `(string) $name`
: context name  

**Return Values**

`null|\Context`





### WebhookClient::getOutgoingContexts  

**Description**

```php
public getOutgoingContexts (void)
```

Get all Dialogflow outgoing contexts. 

Reference: https://dialogflow.com/docs/contexts. 

**Parameters**

`This function has no parameters.`

**Return Values**

`array`





### WebhookClient::getParameters  

**Description**

```php
public getParameters (void)
```

Get parameters. 

Reference: https://dialogflow.com/docs/actions-and-parameters. 

**Parameters**

`This function has no parameters.`

**Return Values**

`array`





### WebhookClient::getQuery  

**Description**

```php
public getQuery (void)
```

Original user query as indicated by Dialogflow or null if no value. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`





### WebhookClient::getRequestSource  

**Description**

```php
public getRequestSource (void)
```

Get request source. 

Reference: https://dialogflow.com/docs/reference/agent/query#query_parameters_and_json_fields. 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`





### WebhookClient::getSession  

**Description**

```php
public getSession (void)
```

Get session id. 

Reference: https://dialogflow.com/docs/reference/api-v2/rest/v2beta1/WebhookRequest#FIELDS.session. 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`





### WebhookClient::reply  

**Description**

```php
public reply (string|\Dialogflow\Richmessage|\Dialogflow\Action\Conversation $message)
```

Response to incoming request. 

 

**Parameters**

* `(string|\Dialogflow\Richmessage|\Dialogflow\Action\Conversation) $message`

**Return Values**

`\Dialogflow\WebhookClient`





### WebhookClient::setOutgoingContext  

**Description**

```php
public setOutgoingContext (string|array|\Dialogflow\Context $context)
```

Set a new Dialogflow outgoing context. 

Reference: https://dialogflow.com/docs/contexts. 

**Parameters**

* `(string|array|\Dialogflow\Context) $context`

**Return Values**

`\Dialogflow\WebhookClient`





### WebhookClient::setOutgoingContexts  

**Description**

```php
public setOutgoingContexts (array $contexts)
```

Replace all Dialogflow outgoing contexts. 

Reference: https://dialogflow.com/docs/contexts. 

**Parameters**

* `(array) $contexts`

**Return Values**

`\Dialogflow\WebhookClient`




