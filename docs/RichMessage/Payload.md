# Dialogflow\RichMessage\Payload  





## Extend:

Dialogflow\RichMessage\RichMessage

## Methods

| Name | Description |
|------|-------------|
|[create](#payloadcreate)|Create a new Payload instance.|
|[payload](#payloadpayload)|Set the payload for a Payload.|

## Inherited methods

| Name | Description |
|------|-------------|
|doesSupportRichMessage|Check if request source support rich message.|
|fallbackText|Alias of setFallbackText() to fit more inline with text(), button(), image(), etc.|
|getFallbackText|Get the fallback text.|
|render|Render response as array.|
|setFallbackText|Set the fallback text if a request source doesn't support rich messages.|



### Payload::create  

**Description**

```php
public static create (array $payload)
```

Create a new Payload instance. 

 

**Parameters**

* `(array) $payload`

**Return Values**

`\Dialogflow\Response\Payload`





### Payload::payload  

**Description**

```php
public payload (array $payload)
```

Set the payload for a Payload. 

 

**Parameters**

* `(array) $payload`
: containing the payload response content  

**Return Values**



