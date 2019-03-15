# Dialogflow\RichMessage\Image  





## Extend:

Dialogflow\RichMessage\RichMessage

## Methods

| Name | Description |
|------|-------------|
|[create](#imagecreate)|Create a new Image instance.|
|[image](#imageimage)|Set the image for a Image.|

## Inherited methods

| Name | Description |
|------|-------------|
|doesSupportRichMessage|Check if request source support rich message.|
|fallbackText|Alias of setFallbackText() to fit more inline with text(), button(), image(), etc.|
|getFallbackText|Get the fallback text.|
|render|Render response as array.|
|setFallbackText|Set the fallback text if a request source doesn't support rich messages.|



### Image::create  

**Description**

```php
public static create (string $image)
```

Create a new Image instance. 

 

**Parameters**

* `(string) $image`
: image URL  

**Return Values**

`\Dialogflow\Response\Image`





### Image::image  

**Description**

```php
public image (string $imageUrl)
```

Set the image for a Image. 

 

**Parameters**

* `(string) $imageUrl`

**Return Values**



