# Dialogflow\Action\Conversation  







## Methods

| Name | Description |
|------|-------------|
|[__construct](#conversation__construct)|Constructor for Conversation object.|
|[add](#conversationadd)|Add a message.|
|[ask](#conversationask)|Asks to collect user's input.|
|[close](#conversationclose)|Have Assistant render the speech response and close the mic.|
|[getArguments](#conversationgetarguments)||
|[getAvailableSurfaces](#conversationgetavailablesurfaces)||
|[getDevice](#conversationgetdevice)||
|[getSurface](#conversationgetsurface)||
|[getUser](#conversationgetuser)||
|[render](#conversationrender)|Render response as array.|




### Conversation::__construct  

**Description**

```php
public __construct (array $payload)
```

Constructor for Conversation object. 

 

**Parameters**

* `(array) $payload`
: original payload from google  

**Return Values**




### Conversation::add  

**Description**

```php
public add (string|\Dialogflow\Action\Interfaces\ResponseInterface|\Dialogflow\Action\Interfaces\QuestionInterface $message)
```

Add a message. 

 

**Parameters**

* `(string|\Dialogflow\Action\Interfaces\ResponseInterface|\Dialogflow\Action\Interfaces\QuestionInterface) $message`

**Return Values**

`\Conversation`





### Conversation::ask  

**Description**

```php
public ask (string|\Dialogflow\Action\Interfaces\ResponseInterface|\Dialogflow\Action\Interfaces\QuestionInterface $message)
```

Asks to collect user's input. 

Follow [the guidelines](https://developers.google.com/actions/policies/general-policies#user_experience) when prompting the user for a response. 

**Parameters**

* `(string|\Dialogflow\Action\Interfaces\ResponseInterface|\Dialogflow\Action\Interfaces\QuestionInterface) $message`

**Return Values**

`\Conversation`





### Conversation::close  

**Description**

```php
public close (string|\Dialogflow\Action\Interfaces\ResponseInterface|\Dialogflow\Action\Interfaces\QuestionInterface $message)
```

Have Assistant render the speech response and close the mic. 

 

**Parameters**

* `(string|\Dialogflow\Action\Interfaces\ResponseInterface|\Dialogflow\Action\Interfaces\QuestionInterface) $message`

**Return Values**

`\Conversation`





### Conversation::getArguments  

**Description**

```php
public getArguments (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Dialogflow\Action\Arguments`





### Conversation::getAvailableSurfaces  

**Description**

```php
public getAvailableSurfaces (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Dialogflow\Action\AvailableSurfaces`





### Conversation::getDevice  

**Description**

```php
public getDevice (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|\Dialogflow\Action\Device`





### Conversation::getSurface  

**Description**

```php
public getSurface (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Dialogflow\Action\Surface`





### Conversation::getUser  

**Description**

```php
public getUser (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Dialogflow\Action\User`





### Conversation::render  

**Description**

```php
public render (void)
```

Render response as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`array`




