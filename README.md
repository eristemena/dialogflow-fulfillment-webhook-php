# Dialogflow Fulfillment PHP Library

This Library is inspired by [dialogflow/dialogflow-fulfillment-nodejs](https://github.com/dialogflow/dialogflow-fulfillment-nodejs).

It supports Dialogflow's fulfillment webhook JSON requests and responses for v1 and v2 agents.

## Installation

Install via composer: `composer require eristemena/dialogflow-fulfillment-webhook-php`.

## Usage

### Initiate Agent

To initiate agent, use `\Dialogflow\WebhookClient` constructor with input parameter as array of request coming from Dialogflow. In Vanilla PHP, this can be done as follow,

```
use \Dialogflow\WebhookClient;

$agent = new \Dialogflow\WebhookClient($_POST);
```

or if you're using Laravel,

```
$agent = \Dialogflow\WebhookClient::fromData($request->json()->all());
```

### Get Request Info

Get intent name

```
$intent = $agent->getIntent();
```



