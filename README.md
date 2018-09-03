# Dialogflow Fulfillment PHP Library

[![Latest Version on Packagist](https://img.shields.io/packagist/v/eristemena/dialogflow-fulfillment-webhook-php.svg?style=flat-square)](https://packagist.org/packages/eristemena/dialogflow-fulfillment-webhook-php)
[![Build Status](https://travis-ci.org/eristemena/dialogflow-fulfillment-webhook-php.svg?branch=master)](https://travis-ci.org/eristemena/dialogflow-fulfillment-webhook-php)
[![codecov](https://codecov.io/gh/eristemena/dialogflow-fulfillment-webhook-php/branch/master/graph/badge.svg)](https://codecov.io/gh/eristemena/dialogflow-fulfillment-webhook-php)
[![StyleCI](https://styleci.io/repos/132703866/shield?branch=master)](https://styleci.io/repos/132703866)
[![Monthly Downloads](https://img.shields.io/packagist/dm/eristemena/dialogflow-fulfillment-webhook-php.svg?style=flat-square)](https://packagist.org/packages/eristemena/dialogflow-fulfillment-webhook-php)

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
      - [Carousel](#carousel)
      - [Browsing Carousel](#browsing-carousel)
      - [Suggestion Chip](#suggestion-chip)
      - [Media Responses](#media-responses)
    - [Helpers](#helpers)
      - [User information](#user-information)
      - [Date and Time](#date-and-time)
      - [Place and Location](#place-and-location)
      - [Confirmation](#confirmation)
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

Please see the documentation [here](https://developers.google.com/actions/assistant/responses#list).

> The single-select list presents the user with a vertical list of multiple items and allows the user to select a single one. Selecting an item from the list generates a user query (chat bubble) containing the title of the list item.

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

##### Carousel 

Please see the documentation [here](https://developers.google.com/actions/assistant/responses#carousel).

> The carousel scrolls horizontally and allows for selecting one item. Compared to the list selector, it has large tiles-allowing for richer content. The tiles that make up a carousel are similar to the basic card with image. Selecting an item from the carousel will simply generate a chat bubble as the response just like with list selector.

```php
use Dialogflow\Action\Questions\Carousel;
use Dialogflow\Action\Questions\Carousel\Option;

$conv->ask('Please choose below');

$conv->ask(
    Carousel::create()
    ->Option(
        Option::create()
        ->key('OPTION_1')
        ->title('Option 1')
        ->synonyms(['option one', 'one'])
        ->description('Select option 1')
        ->image('https://picsum.photos/300/300')
    )
    ->Option(
        Option::create()
        ->key('OPTION_2')
        ->title('Option 2')
        ->synonyms(['option two', 'two'])
        ->description('Select option 2')
        ->image('https://picsum.photos/300/300')
    )
    ->Option(
        Option::create()
        ->key('OPTION_3')
        ->title('Option 3')
        ->synonyms(['option three', 'three'])
        ->description('Select option 3')
        ->image('https://picsum.photos/300/300')
    )
    ->Option(
        Option::create()
        ->key('OPTION_4')
        ->title('Option 4')
        ->synonyms(['option four', 'four'])
        ->description('Select option 4')
        ->image('https://picsum.photos/300/300')
    )
);
```

To check if the user granted you the information and then access the data, create a Dialogflow intent with the `actions_intent_OPTION` event. Assuming you name the intent as `Get Option`, you can get the argument as follow,

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

        case 'OPTION_3':
            $conv->close('You choose option 3');
            break;

        case 'OPTION_4':
            $conv->close('You choose option 4');
            break;

        default:
            $conv->close('Sorry, i do not understand');
            break;
    }
}
```

##### Browsing Carousel 

Please see the documentation [here](https://developers.google.com/actions/assistant/responses#browsing_carousel).

> A browsing carousel is a rich response, similar to the carousel response as it scrolls horizontally and allows users to select a tile. Browsing carousels are designed specifically for web content by opening the selected tile in a web browser (or an AMP browser if all tiles are AMP-enabled). The browsing carousel will also persist on the user's Assistant surface for browsing later.

```php
use Dialogflow\Action\Responses\BrowseCarousel;
use Dialogflow\Action\Responses\BrowseCarousel\Option;

$conv->ask('Please choose below');

$conv->ask(
    BrowseCarousel::create()
    ->imageDisplayOptions('CROPPED')
    ->addOption(
        Option::create()
        ->title('Title of item 1')
        ->description('Description of item 1')
        ->footer('Item 1 footer')
        ->url('http://www.example.com')
        ->image('https://picsum.photos/300/300')
    )
    ->addOption(
        Option::create()
        ->title('Title of item 2')
        ->description('Description of item 2')
        ->footer('Item 2 footer')
        ->url('http://www.example.com')
        ->image('https://picsum.photos/300/300')
    )
    ->addOption(
        Option::create()
        ->title('Title of item 3')
        ->description('Description of item 3')
        ->footer('Item 3 footer')
        ->url('http://www.example.com')
        ->image('https://picsum.photos/300/300')
    )
    ->addOption(
        Option::create()
        ->title('Title of item 4')
        ->description('Description of item 4')
        ->footer('Item 4 footer')
        ->url('http://www.example.com')
        ->image('https://picsum.photos/300/300')
    )
);
```

No follow-up fulfillment is necessary for user interactions with browse carousel items, since the carousel handles the browser handoff.

##### Suggestion Chip 

Please see the documentation [here](https://developers.google.com/actions/assistant/responses#suggestion_chip).

```php
use Dialogflow\Action\Responses\LinkOutSuggestion;
use Dialogflow\Action\Responses\Suggestions;

$conv->ask('Please choose');
$conv->ask(new Suggestions(['Suggestion 1', 'Suggestion 2']));
$conv->ask(new Suggestions('Suggestion 3'));
$conv->ask(new LinkOutSuggestion('Website', 'http://www.example.com'));
```

##### Media Responses 

Please see the documentation [here](https://developers.google.com/actions/assistant/responses#media_responses).

> Media responses let your Actions play audio content with a playback duration longer than the 120-second limit of SSML. The primary component of a media response is the single-track card. 

```php
use Dialogflow\Action\Responses\MediaObject;
use Dialogflow\Action\Responses\MediaResponse;
use Dialogflow\Action\Responses\Suggestions;

$conv->ask('Here you go');
$conv->ask(
    new MediaResponse(
        MediaObject::create('http://storage.googleapis.com/automotive-media/Jazz_In_Paris.mp3')
        ->name('Jazz in Paris')
        ->description('A funky Jazz tune')
        ->icon('http://storage.googleapis.com/automotive-media/album_art.jpg')
        ->image('http://storage.googleapis.com/automotive-media/album_art.jpg')
    )
);
$conv->ask(new Suggestions(['Pause', 'Stop', 'Start over']));
```

#### Helpers

##### User information

Please see the documentation [here](https://developers.google.com/actions/assistant/helpers#user_information).

```php
use Dialogflow\Action\Questions\Permission;

$conv->ask(Permission::create('To address you by name and know your location', ['NAME', 'DEVICE_PRECISE_LOCATION']));
```

To check if the user granted you the information and then access the data, create a Dialogflow intent with the `actions_intent_PERMISSION` event. Assuming you name the intent as `Get Permission`, you can get the information as follow,

```php
if ('Get Permission'==$agent->getIntent()) {
    $conv = $agent->getActionConversation();
    $approved = $conv->getArguments()->get('PERMISSION');

    if ($approved) {
        $name = $conv->getUser()->getName()->getDisplay();
        $latlng = $conv->getDevice()->getLocation()->getCoordinates();
        $lat = $latlng->getLatitude();
        $lng = $latlng->getLongitude();

        $conv->close('Got it, your name is ' . $name . ' and your coordinates are ' . $lat . ', ' . $lng);
    } else {
        $conv->close('Never mind then');
    }
}
```

##### Date and Time

Please see the documentation [here](https://developers.google.com/actions/assistant/helpers#date_and_time).

```php
use Dialogflow\Action\Questions\DateTime;

$conv->ask(new DateTime('When do you want to come in?', 'What is the best date to schedule your appointment?', 'What time of day works best for you?'));
```

To check if the user granted access and then access the data, create a Dialogflow intent with the `actions_intent_DATETIME` event. Assuming you name the intent as `Get Date Time`, you can get the information as follow,

```php
if ('Get Date Time'==$agent->getIntent()) {
    $conv = $agent->getActionConversation();
    $date = $conv->getArguments()->get('DATETIME');

    if ($date) {
        $conv->close('Ok, got it, i will see you at ' . $date->format('r'));
    } else {
        $conv->close('Never mind then');
    }
}
```

##### Place and Location

Please see the documentation [here](https://developers.google.com/actions/assistant/helpers#place_and_location).

```php
use Dialogflow\Action\Questions\Place;

$conv->ask(new Place('Where do you want to have lunch?', 'To find lunch locations'));
```

To check if the user granted access and then access the data, create a Dialogflow intent with the `actions_intent_PLACE` event. Assuming you name the intent as `Get Place`, you can get the information as follow,

```php
if ('Get Place'==$agent->getIntent()) {
    $conv = $agent->getActionConversation();
    $place = $conv->getArguments()->get('PLACE');

    if ($place) {
        $conv->close('Ok, got it, we\'ll meet at ' . $place->getFormattedAddress());
    } else {
        $conv->close('Never mind then');
    }
}
```

##### Confirmation

Please see the documentation [here](https://developers.google.com/actions/assistant/helpers#confirmation).

```php
use Dialogflow\Action\Questions\Confirmation;

$conv->ask(new Confirmation('Can you confirm?'));
```

To check if the user confirmed or not, create a Dialogflow intent with the `actions_intent_CONFIRMATION` event. Assuming you name the intent as `Get Confirmation`, you can get the information as follow,

```php
if ('Get Confirmation'==$agent->getIntent()) {
    $conv = $agent->getActionConversation();
    $confirmed = $conv->getArguments()->get('CONFIRMATION');

    if ($confirmed) {
        $conv->close('Ok, it is confirmed');
    } else {
        $conv->close('Alright then, it is canceled');
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
