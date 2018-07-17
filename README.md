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
    - [Text](#text)
    - [Image](#image)
    - [Card](#card)
    - [Suggestion](#suggestion)
    - [Custom payload](#custom-payload)
  - [Actions on Google](#actions-on-google)
    - [Send Reply](#send-reply-1)
    - [Responses](#responses)
      - [Simple Response](#simple-response)
      - [Image](#image-1)
      - [Basic Card](#basic-card)
      - [List](#list)
    - [Surface Capabilities](#surface-capabilities)

## Installation

Install via composer: `composer require eristemena/dialogflow-fulfillment-webhook-php`.

## Usage

### Initiate Agent

To initiate agent, use `\Dialogflow\WebhookClient` constructor with input parameter as array of request coming from Dialogflow. 

In Vanilla PHP, this can be done as follow,

```php
use Dialogflow\WebhookClient;

$agent = new WebhookClient(json_decode(file_get_contents('php://input'),true));

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

- [Request Source]() (ex: `google`, `facebook`, `slack`, etc)

```php
$originalRequest = $agent->getRequestSource();
```

- [Original Request](https://github.com/eristemena/dialog-fulfillment-webhook-php/blob/master/docs/WebhookClient.md#webhookclientgetoriginalrequest), platform specific payload

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
echo json_encode($agent->render());
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
if ($agent->getRequestSource()=='google') {
    $agent->reply(\Dialogflow\RichMessage\Payload::create([
        'expectUserResponse' => false
    ]));
}
```

### Actions on Google

This library also supports [Actions on Google](https://developers.google.com/actions/assistant/basics) specific functionalities. It's still under development, so more features will be added in the future.

To use Actions on Google Dialogflow Conversation object, you must first need to ensure the `requestSource` is coming from Google Assistant,

```php
if ($agent->getRequestSource()=='google') {
    $conv = $agent->getActionConversation();
    
    // here you can use the rest of Actions on Google responses and helpers
    
    $agent->reply($conv);
}
```

or you can just call `getActionConversation()` method, and it will return `null` if the request doesn't come from Google Assistant.

```php
$conv = $agent->getActionConversation();

if ($conv) {
	// here you can use the rest of Actions on Google responses and helpers
} else {
	// the request does not come from Google Assistant
}
```

#### Send Reply

Using Dialogflow Conversation object, you can send a reply in two ways,

1. Send a reply and close the conversation

```php
$conv->close('Have a nice day!');
```

2. Send a reply and wait for user's response

```php
$conv->ask('Hi, how can I help?');
```

#### Responses

##### Simple Response

Please see the documentation [here](https://developers.google.com/actions/assistant/responses#simple_responses).

```php
use Dialogflow\Action\Responses\SimpleResponse;

$conv->ask(SimpleResponse::create()
     ->displayText('Hello, how can i help?')
     ->ssml('<speak>Hello,<break time="0.5s"/> <prosody rate="slow">how can i help?</prosody></speak>')
);
```

##### Image

```php
use Dialogflow\Action\Responses\Image;

$conv->close(Image::create('https://picsum.photos/400/300'));
```

##### Basic Card

Please see the documentation [here](https://developers.google.com/actions/assistant/responses#basic_card).

```php
use Dialogflow\Action\Responses\BasicCard;

$conv->close(BasicCard::create()
    ->title('This is a title')
    ->formattedText('This is a subtitle')
    ->image('https://picsum.photos/400/300')
    ->button('This is a button', 'https://docs.dialogflow.com/')
);
```

##### List

The single-select list presents the user with a vertical list of multiple items and allows the user to select a single one. Selecting an item from the list generates a user query (chat bubble) containing the title of the list item.

Please see the documentation [here](https://developers.google.com/actions/assistant/responses#list).

```php
use Dialogflow\Action\Questions\ListCard;
use Dialogflow\Action\Questions\ListCard\Option;

$conv->ask('Please choose below');

$conv->ask(ListCard::create()
    ->title('This is a title')
    ->addOption(Option::create()
        ->key('OPTION_1')
        ->title('Option 1')
        ->synonyms(['option one','one'])
        ->description('Select option 1')
        ->image('https://picsum.photos/48/48')
    )
    ->addOption(Option::create()
        ->key('OPTION_2')
        ->title('Option 2')
        ->synonyms(['option two','two'])
        ->description('Select option 2')
        ->image('https://picsum.photos/48/48')
    )
);
```

To capture the option selected by user, create a Dialogflow intent with the `actions_intent_OPTION` event. Assuming you name the intent as `Get Option`, you can get the argument as follow,

```php
if ('Get Option'==$agent->getIntent()) {
    $conv = $agent->getActionConversation();
    $option = $conv->getArguments()->get('OPTION');

    switch ($option) {
        case 'OPTION_1':
            $conv->close('You choose option 1');
            break;
        
        case 'OPTION_2':
            $conv->close('You choose option 2');
            break;
        
        default:
            $conv->close('Sorry, i do not understand');
            break;
    }
}
```

#### Surface Capabilities

Google Assistant can be used on a variety of surfaces such as mobile devices that support audio and display experiences or a Google Home device that supports audio-only experiences.

To design and build conversations that work well on all surfaces, use [surface capabilities](https://developers.google.com/actions/assistant/surface-capabilities) to control and scope your conversations properly.

```php
$surface = $conv->getSurface();

if ($surface->hasScreen()) {
	// surface has screen
} elseif ($surface->hasAudio()) {
	// surface has audio
} elseif ($surface->hasMediaPlayback()) {
	// surface can play audio
} elseif ($surface->hasWebBrowser()) {
	// user can interact with the content in a web browser
}
```
