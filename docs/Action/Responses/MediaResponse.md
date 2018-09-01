# Dialogflow\Action\Responses\MediaResponse  



## Implements:
Dialogflow\Action\Interfaces\ResponseInterface



## Methods

| Name | Description |
|------|-------------|
|[__construct](#mediaresponse__construct)|Create a new MediaResponse instance.|
|[add](#mediaresponseadd)|Add MediaObject.|
|[create](#mediaresponsecreate)|Create a new MediaResponse instance.|
|[renderRichResponseItem](#mediaresponserenderrichresponseitem)|Render a single Rich Response item as array.|




### MediaResponse::__construct  

**Description**

```php
public __construct (null|\Dialogflow\Action\Responses\MediaObject $mediaObject)
```

Create a new MediaResponse instance. 

 

**Parameters**

* `(null|\Dialogflow\Action\Responses\MediaObject) $mediaObject`
: Media objects  

**Return Values**

`\Dialogflow\Action\Responses\MediaResponse`





### MediaResponse::add  

**Description**

```php
public add (\Dialogflow\Action\Responses\MediaObject $mediaObject)
```

Add MediaObject. 

 

**Parameters**

* `(\Dialogflow\Action\Responses\MediaObject) $mediaObject`

**Return Values**

`\Dialogflow\Action\Responses\MediaResponse`





### MediaResponse::create  

**Description**

```php
public static create (null|\Dialogflow\Action\Responses\MediaObject $mediaObject)
```

Create a new MediaResponse instance. 

 

**Parameters**

* `(null|\Dialogflow\Action\Responses\MediaObject) $mediaObject`
: Media objects  

**Return Values**

`\Dialogflow\Action\Responses\MediaResponse`





### MediaResponse::renderRichResponseItem  

**Description**

```php
public renderRichResponseItem (void)
```

Render a single Rich Response item as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|array`




