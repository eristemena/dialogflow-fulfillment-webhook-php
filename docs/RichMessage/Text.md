# Dialogflow\RichMessage\Text  





## Extend:

Dialogflow\RichMessage\RichMessage

## Methods

| Name | Description |
|------|-------------|
|[create](#textcreate)|Create a new Text instance.|
|[ssml](#textssml)|Set the SSML for a Text.|
|[text](#texttext)|Set the text for a Text.|

## Inherited methods

| Name | Description |
|------|-------------|
|doesSupportRichMessage|Check if request source support rich message.|
|render|Render response as array.|



### Text::create  

**Description**

```php
public static create (void)
```

Create a new Text instance. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Dialogflow\Response\Text`





### Text::ssml  

**Description**

```php
public ssml (string $text)
```

Set the SSML for a Text. 

 

**Parameters**

* `(string) $text`
: containing the SSML response content  

**Return Values**




### Text::text  

**Description**

```php
public text (string $text)
```

Set the text for a Text. 

 

**Parameters**

* `(string) $text`
: containing the text response content  

**Return Values**



