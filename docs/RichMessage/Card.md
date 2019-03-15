# Dialogflow\RichMessage\Card  





## Extend:

Dialogflow\RichMessage\RichMessage

## Methods

| Name | Description |
|------|-------------|
|[button](#cardbutton)|Set the button for a Card.|
|[create](#cardcreate)|Create a new Card instance.|
|[image](#cardimage)|Set the image for a Card.|
|[text](#cardtext)|Set the text for a Card.|
|[title](#cardtitle)|Set the title for a Card.|

## Inherited methods

| Name | Description |
|------|-------------|
|doesSupportRichMessage|Check if request source support rich message.|
|fallbackText|Alias of setFallbackText() to fit more inline with text(), button(), image(), etc.|
|getFallbackText|Get the fallback text.|
|render|Render response as array.|
|setFallbackText|Set the fallback text if a request source doesn't support rich messages.|



### Card::button  

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




### Card::create  

**Description**

```php
public static create (void)
```

Create a new Card instance. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Dialogflow\Response\Card`





### Card::image  

**Description**

```php
public image (string $image)
```

Set the image for a Card. 

 

**Parameters**

* `(string) $image`
: image URL  

**Return Values**




### Card::text  

**Description**

```php
public text (string $text)
```

Set the text for a Card. 

 

**Parameters**

* `(string) $text`

**Return Values**




### Card::title  

**Description**

```php
public title (string $title)
```

Set the title for a Card. 

 

**Parameters**

* `(string) $title`

**Return Values**



