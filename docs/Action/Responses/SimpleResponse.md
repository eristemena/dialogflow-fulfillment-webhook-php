# Dialogflow\Action\Responses\SimpleResponse  



## Implements:
Dialogflow\Action\Interfaces\ResponseInterface



## Methods

| Name | Description |
|------|-------------|
|[__construct](#simpleresponse__construct)|Create a new Simple Response instance.|
|[create](#simpleresponsecreate)|Create a new instance.|
|[displayText](#simpleresponsedisplaytext)|Set display text.|
|[renderRichResponseItem](#simpleresponserenderrichresponseitem)|Render a single Rich Response item as array.|
|[ssml](#simpleresponsessml)|Set ssml.|
|[textToSpeech](#simpleresponsetexttospeech)|Set text to speech.|




### SimpleResponse::__construct  

**Description**

```php
public __construct (string|array $options)
```

Create a new Simple Response instance. 

 

**Parameters**

* `(string|array) $options`
: (optional) options  

**Return Values**

`\Dialogflow\Action\Responses\SimpleResponse`





### SimpleResponse::create  

**Description**

```php
public static create (string|array $options)
```

Create a new instance. 

 

**Parameters**

* `(string|array) $options`
: (optional) options  

**Return Values**

`\Dialogflow\Action\Responses\SimpleResponse`





### SimpleResponse::displayText  

**Description**

```php
public displayText (string $displayText)
```

Set display text. 

 

**Parameters**

* `(string) $displayText`

**Return Values**

`\Dialogflow\Action\Responses\SimpleResponse`





### SimpleResponse::renderRichResponseItem  

**Description**

```php
public renderRichResponseItem (void)
```

Render a single Rich Response item as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|array`





### SimpleResponse::ssml  

**Description**

```php
public ssml (string $ssml)
```

Set ssml. 

 

**Parameters**

* `(string) $ssml`

**Return Values**

`\Dialogflow\Action\Responses\SimpleResponse`





### SimpleResponse::textToSpeech  

**Description**

```php
public textToSpeech (string $textToSpeech)
```

Set text to speech. 

 

**Parameters**

* `(string) $textToSpeech`

**Return Values**

`\Dialogflow\Action\Responses\SimpleResponse`




