# Dialogflow Fulfillment PHP Library

[![Build Status](https://travis-ci.org/eristemena/dialogflow-fulfillment-webhook-php.svg?branch=master)](https://travis-ci.org/eristemena/dialogflow-fulfillment-webhook-php)
[![codecov](https://codecov.io/gh/eristemena/dialogflow-fulfillment-webhook-php/branch/master/graph/badge.svg)](https://codecov.io/gh/eristemena/dialogflow-fulfillment-webhook-php)
[![StyleCI](https://styleci.io/repos/132703866/shield?branch=master)](https://styleci.io/repos/132703866)

This Library is inspired by [dialogflow/dialogflow-fulfillment-nodejs](https://github.com/dialogflow/dialogflow-fulfillment-nodejs).

It supports Dialogflow's fulfillment webhook JSON requests and responses for v1 and v2 agents.

For full class reference please refer to the [doc](https://github.com/eristemena/dialog-fulfillment-webhook-php/blob/master/docs/README.md).

- [Installation](#installation)
- [Usage](#usage)
  - [Initiate Agent](#initiate-agent)
  - [Get Request Info](#get-request-info)
  - [Send Reply](#send-reply)
  - [Rich Message](#rich-message)

## Installation

Install via composer: `composer require eristemena/dialogflow-fulfillment-webhook-php`.

## Usage

### Initiate Agent

To initiate agent, use `\Dialogflow\WebhookClient` constructor with input parameter as array of request coming from Dialogflow. 

In Vanilla PHP, this can be done as follow,

```php
use Dialogflow\WebhookClient;

$agent = new WebhookClient($_POST);

// or

$agent = WebhookClient::fromData($_POST);
```

or if you're using Laravel,

```php
$agent = \Dialogflow\WebhookClient::fromData($request->json()->all());
```

### Get Request Info

- [Intent](https://github.com/eristemena/dialog-fulfillment-webhook-php/blob/master/docs/WebhookClient.md#webhookclientgetaction)

```php
$intent = $agent->getIntent();
```

- [Action](https://github.com/eristemena/dialog-fulfillment-webhook-php/blob/master/docs/WebhookClient.md#webhookclientgetaction)

```php
$action = $agent->getAction();
```

- [Query](https://github.com/eristemena/dialog-fulfillment-webhook-php/blob/master/docs/WebhookClient.md#webhookclientgetquery)

```php
$query = $agent->getQuery();
```

- [Parameters](https://github.com/eristemena/dialog-fulfillment-webhook-php/blob/master/docs/WebhookClient.md#webhookclientgetparameters)

```php
$parameters = $agent->getParameters();
```

- [Session](https://github.com/eristemena/dialog-fulfillment-webhook-php/blob/master/docs/WebhookClient.md#webhookclientgetsession)

```php
$session = $agent->getSession();
```

- [Contexts](https://github.com/eristemena/dialog-fulfillment-webhook-php/blob/master/docs/WebhookClient.md#webhookclientgetcontexts)

```php
$contexts = $agent->getContexts();
```

- [Language](https://github.com/eristemena/dialog-fulfillment-webhook-php/blob/master/docs/WebhookClient.md#webhookclientgetlocale)

```php
$language = $agent->getLocale();
```

- [Original Request](https://github.com/eristemena/dialog-fulfillment-webhook-php/blob/master/docs/WebhookClient.md#webhookclientgetoriginalrequest) (ex: google, facebook, slack, etc)

```php
$originalRequest = $agent->getOriginalRequest();
```

- [Agent Version](https://github.com/eristemena/dialog-fulfillment-webhook-php/blob/master/docs/WebhookClient.md#webhookclientgetagentversion) (1 or 2)

```php
$agentVersion = $agent->getAgentVersion();
```

### Send Reply

To send a reply, use `reply()` method.

```php
$agent->reply('Hi, how can I help?');
```

Then use `render()` to get response in array. All you have to do is to print the array as JSON,

```php
header('Content-type: application/json');
echo json_decode($agent->render());
```

or in Laravel,

```php
return response()->json($agent->render());
```

The response payload will be automatically formatted according to Agent Version of the request.

### Rich Message

#### Text

```php
$text = \Dialogflow\RichMessage\Text::create()
    ->text('This is text')
    ->ssml('<speak>This is <say-as interpret-as="characters">ssml</say-as></speak>')
;
$agent->reply($text);
```

#### Image

```php
$image = \Dialogflow\RichMessage\Image::create('https://www.example.com/image.png');
$agent->reply($image);
```

#### Card

```php
$card = \Dialogflow\RichMessage\Card::create()
    ->title('This is title')
    ->text('this is text body')
    ->image('https://www.example.com/image.png')
    ->button('This is a button', 'https://docs.dialogflow.com/')
;
$agent->reply($card);
```

#### Suggestion

```php
$suggestion = \Dialogflow\RichMessage\Suggestion::create(['Suggestion one', 'Suggestion two']);
$agent->reply($suggestion);
```

#### Custom payload

```php
if($agent->getRequestSource()=='google'){
    $agent->reply(\Dialogflow\RichMessage\Payload::create([
        'expectUserResponse' => false
    ]));
}
```
