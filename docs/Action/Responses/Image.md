# Dialogflow\Action\Responses\Image  



## Implements:
Dialogflow\Action\Interfaces\ResponseInterface



## Methods

| Name | Description |
|------|-------------|
|[__construct](#image__construct)|Create a new Image instance.|
|[create](#imagecreate)|Create a new Image instance.|
|[renderRichResponseItem](#imagerenderrichresponseitem)|Render a single Rich Response item as array.|




### Image::__construct  

**Description**

```php
public __construct (string $imageUrl, string $accessibilityText)
```

Create a new Image instance. 

 

**Parameters**

* `(string) $imageUrl`
: image URL  
* `(string) $accessibilityText`
: (optional) accessibility text of the image  

**Return Values**

`\Dialogflow\Action\Responses\Image`





### Image::create  

**Description**

```php
public static create (string $imageUrl, string $accessibilityText)
```

Create a new Image instance. 

 

**Parameters**

* `(string) $imageUrl`
: image URL  
* `(string) $accessibilityText`
: (optional) accessibility text of the image  

**Return Values**

`\Dialogflow\Action\Responses\Image`





### Image::renderRichResponseItem  

**Description**

```php
public renderRichResponseItem (void)
```

Render a single Rich Response item as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|array`




