# Dialogflow\WebhookClient  





## Extend:

Dialogflow\RichMessage\RichMessage

## Methods

| Name | Description |
|------|-------------|
|[__construct](#webhookclient__construct)||
|[clearContext](#webhookclientclearcontext)|Clear an existing outgoing context.|
|[clearOutgoingContexts](#webhookclientclearoutgoingcontexts)|Clear all existing outgoing contexts.|
|[getAction](#webhookclientgetaction)|Get action name.|
|[getAgentVersion](#webhookclientgetagentversion)|The agent version (v1 or v2) based on Dialogflow webhook request.|
|[getContexts](#webhookclientgetcontexts)|Get contexts.|
|[getIntent](#webhookclientgetintent)|Get intent name.|
|[getLocale](#webhookclientgetlocale)|Original request language code (i.e. "en").|
|[getOriginalRequest](#webhookclientgetoriginalrequest)|Dialogflow original request object from detectIntent/query or platform integration (Google Assistant, Slack, etc.) in the request or null if no value.|
|[getParameters](#webhookclientgetparameters)|Get parameters.|
|[getQuery](#webhookclientgetquery)|Original user query as indicated by Dialogflow or null if no value.|
|[getRequestSource](#webhookclientgetrequestsource)|Get request source.|
|[getSession](#webhookclientgetsession)|Get session id.|
|[reply](#webhookclientreply)|Response to incoming request.|
|[setContext](#webhookclientsetcontext)|Set a new Dialogflow outgoing context.|
|[setContexts](#webhookclientsetcontexts)|Set a new Dialogflow outgoing context.|

## Inherited methods

| Name | Description |
|------|-------------|
|doesSupportRichMessage|-|
|render|Render response as array|



### WebhookClient::__construct  

**Description**

```php
public __construct (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**




### WebhookClient::clearContext  

**Description**

```php
public clearContext (string $contextName)
```

Clear an existing outgoing context. 

Reference: https://dialogflow.com/docs/contexts 

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

Reference: https://dialogflow.com/docs/contexts 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Dialogflow\WebhookClient`





### WebhookClient::getAction  

**Description**

```php
public getAction (void)
```

Get action name. 

Reference: https://dialogflow.com/docs/actions-and-parameters 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`





### WebhookClient::getAgentVersion  

**Description**

```php
public getAgentVersion (void)
```

The agent version (v1 or v2) based on Dialogflow webhook request. 

Reference: https://dialogflow.com/docs/reference/v2-comparison 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`





### WebhookClient::getContexts  

**Description**

```php
public getContexts (void)
```

Get contexts. 

Reference: https://dialogflow.com/docs/actions-and-parameters 

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

Reference: https://dialogflow.com/docs/intents 

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

Reference: https://dialogflow.com/docs/reference/agent/query#query_parameters_and_json_fields 

**Parameters**

`This function has no parameters.`

**Return Values**

`array|null`





### WebhookClient::getParameters  

**Description**

```php
public getParameters (void)
```

Get parameters. 

Reference: https://dialogflow.com/docs/actions-and-parameters 

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

Reference: https://dialogflow.com/docs/reference/agent/query#query_parameters_and_json_fields 

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

Reference: https://dialogflow.com/docs/reference/api-v2/rest/v2beta1/WebhookRequest#FIELDS.session 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`





### WebhookClient::reply  

**Description**

```php
public reply (string|\Dialogflow\Richmessage $message)
```

Response to incoming request. 

 

**Parameters**

* `(string|\Dialogflow\Richmessage) $message`

**Return Values**

`\Dialogflow\WebhookClient`





### WebhookClient::setContext  

**Description**

```php
public setContext (string|array|\Dialogflow\Context $context)
```

Set a new Dialogflow outgoing context. 

Reference: https://dialogflow.com/docs/contexts 

**Parameters**

* `(string|array|\Dialogflow\Context) $context`

**Return Values**

`\Dialogflow\WebhookClient`





### WebhookClient::setContexts  

**Description**

```php
public setContexts (array $contexts)
```

Set a new Dialogflow outgoing context. 

Reference: https://dialogflow.com/docs/contexts 

**Parameters**

* `(array) $contexts`

**Return Values**

`\Dialogflow\WebhookClient`




