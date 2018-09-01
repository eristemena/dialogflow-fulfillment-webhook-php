# Dialogflow\Action\Responses\LinkOutSuggestion  



## Implements:
Dialogflow\Action\Interfaces\LinkOutSuggestionInterface, Dialogflow\Action\Interfaces\ResponseInterface



## Methods

| Name | Description |
|------|-------------|
|[__construct](#linkoutsuggestion__construct)|Create a new LinkOutSuggestion instance.|
|[renderRichResponseItem](#linkoutsuggestionrenderrichresponseitem)|Render a single Rich Response item as array.|
|[renderRichResponseLinkOutSuggestion](#linkoutsuggestionrenderrichresponselinkoutsuggestion)|Render Rich Response suggestions as array.|




### LinkOutSuggestion::__construct  

**Description**

```php
public __construct (string $name, string $url)
```

Create a new LinkOutSuggestion instance. 

 

**Parameters**

* `(string) $name`
: the name of the app or site this chip is linking to  
* `(string) $url`
: URL  

**Return Values**

`\Dialogflow\Action\Responses\LinkOutSuggestion`





### LinkOutSuggestion::renderRichResponseItem  

**Description**

```php
public renderRichResponseItem (void)
```

Render a single Rich Response item as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|array`





### LinkOutSuggestion::renderRichResponseLinkOutSuggestion  

**Description**

```php
public renderRichResponseLinkOutSuggestion (void)
```

Render Rich Response suggestions as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|string|array`




