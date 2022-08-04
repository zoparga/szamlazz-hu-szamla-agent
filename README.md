# Számlázz.hu Számla Agent package

## Description

Számlázz.hu Számla Agent PHP API is a thing, it is zipped.
However there is not a single package, which knows everything, what the Agent PHP can.

Please note, this package requires a lot of modification.
It is under construction!

So use it on your own responsibility.

## Install

`composer require zoparga/szamlazz-hu-szamla-agent`


## Goal

Maintain this package, so every Laravel developer can work with it.

Make variables like `agentApiKey` editeable in a published config file.
Create a custom storage, as in the similar package.


## Origin

Origin from:
https://docs.szamlazz.hu/#basics-2


## Examples

You can find the examples under `examples` folder.

Please note, you create the agent as the following:

```php
$agent = SzamlaAgentAPI::create('agentApiKey');
```

In the future, you don't have to provide `agentApiKey` every time, the goal is to publish the config file, where you can set it.


## Credits

- [zoparga](https://github.com/zoparga)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
