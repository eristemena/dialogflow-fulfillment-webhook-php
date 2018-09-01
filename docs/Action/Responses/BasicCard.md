# Dialogflow\Action\Responses\BasicCard  



## Implements:
Dialogflow\Action\Interfaces\ResponseInterface



## Methods

| Name | Description |
|------|-------------|
|[button](#basiccardbutton)|Set the button for a Card.|
|[create](#basiccardcreate)|Create a new Basic Card instance.|
|[formattedText](#basiccardformattedtext)|Set the formattedText for a Card.|
|[image](#basiccardimage)|Set the image for a Card.|
|[renderRichResponseItem](#basiccardrenderrichresponseitem)|Render a single Rich Response item as array.|
|[title](#basiccardtitle)|Set the title for a Card.|




### BasicCard::button  

**Description**

```php
public button (string $buttonText, string $buttonUrl)
```

Set the button for a Card. 

 

**Parameters**

* `(string) $buttonText`
: button text  
* `(string) $buttonUrl`
: button link URL  

**Return Values**

`\Dialogflow\Action\Responses\BasicCard`





### BasicCard::create  

**Description**

```php
public static create (void)
```

Create a new Basic Card instance. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Dialogflow\Action\Responses\BasicCard`





### BasicCard::formattedText  

**Description**

```php
public formattedText (string $formattedText)
```

Set the formattedText for a Card. 

 

**Parameters**

* `(string) $formattedText`

**Return Values**

`\Dialogflow\Action\Responses\BasicCard`





### BasicCard::image  

**Description**

```php
public image (string $imageUrl, string $accessibilityText)
```

Set the image for a Card. 

 

**Parameters**

* `(string) $imageUrl`
: image URL  
* `(string) $accessibilityText`
: (optional) accessibility text of the image  

**Return Values**

`\Dialogflow\Action\Responses\BasicCard`





### BasicCard::renderRichResponseItem  

**Description**

```php
public renderRichResponseItem (void)
```

Render a single Rich Response item as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|array`





### BasicCard::title  

**Description**

```php
public title (string $title)
```

Set the title for a Card. 

 

**Parameters**

* `(string) $title`

**Return Values**

`\Dialogflow\Action\Responses\BasicCard`




