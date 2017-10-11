# NiceHash RSS Feeder v1.01

Credits: Kaan Doğan Twitter: @mkaand
Date: 07.10.2017

This PHP scripts uses NiceHashMiner public API.
It supports NiceHashMiner's all supported algoritmas.
Basically, It pulls your miner's current situation and
it generates RSS Feed. You can use this RSS feed for sending yourself a notification
or email. I use ifttt.com and Telegram service for getting notification.
Both are free. I hope you will like this script.

***************************************************************************
**DONATION REQUEST PLEASE READ BEFORE YOU USE THIS SCRIPT**
Before you start using this script, please respect my work. 
I share this script as FREE OF CHARGE,
But if you want to show your appreciation please make DONATION..

<b>DONATION BTC: 1LaZG8XELxs9JCzzVJaWyhxQG6tCcswJnx</b>

THANKS
****************************************************************************

Requirements :
<br>PHP Hosting (Write permission for this file)
<br>Brain

Usage:
Just change Settings and upload this script to your hosting.
This script generates RSS feed for your NiceHash Miner. 
You can integrate with ifttt.com (free service). 
In my case ifttt.com checks this RSS feed, if miner is working,
it sends me Telegram messages like:

Miner is online
Currently, NiceHashMiner is online and working with 
Sia [0.06 GH/s | 0.00000003 BTC] Blake2s [8.02 GH/s | 0.00008200 BTC]

(Default ifttt.com checks RSS feeds every 15 minutes)

If miner goes offline RSS entry changes:

Miner is offline
Currently, NiceHashMiner is offline

Screenshots:

![Screenshot #1](/screenshot1.png?raw=true "Screenshot #1")
![Screenshot #2](/screenshot2.png?raw=true "Screenshot #2")
