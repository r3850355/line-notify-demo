

## About

this is a simple demo of `LineNotify` and `LineLogin`

[DEMO Website](https://line-notify-demo.renzhou.dev)

## Before Setup

### This project build via Laravel

before clone this project, make sure you has been install `PHP7.4` and `composer`

and register those account below

### Create LINE Login Channel

[LINE developer console](https://developers.line.biz/console/)

*Requied `LINE CLIENT ID` and `LINE CLIENT SECRET`

### Create LINE Notify Channel

[LINE Notify](https://notify-bot.line.me/zh_TW/)

*Required `LINE NOTIFY ID` and `LINE NOTIFY SECRET`

After created, then fill that ID and secret to the `.env`

## Setup


```
composer install

cp .env.example .env

// before migrate, need to create database `line_notify_demo` first
php artisan migrate

// start
php artisan serve

```