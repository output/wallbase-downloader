Wallbase Downloader
===================
This is a simple script I use together with a cron job to pull pics for my lockscreen.

For the scraping part of it I use [ultimate-web-scraper](https://github.com/cubiclesoft/ultimate-web-scraper) to find pics from wallbase.cc

##Sort of how to

###KDE
In short, symlink the default wallpaper located in `/usr/share/wallpapers/Elarun/contents/images/` to the static downloaded one.
I found info about the lockscreen wallpaper here, http://forum.kde.org/viewtopic.php?t=110039.

###Gnome
For starter, I use this script together with [Gnome](http://www.gnome.org/), but you can obviously use it how ever you like.

To get this running with Gnome you first need to specify where Gnome picks up the background image. This can be done in differet ways. I have choosent to accomplish it by following [this](http://fabhax.com/technology/change-wallpapers-in-gnome-3.4/) guide, which specifies a xml-resource for gnome. In the xml I point to a static picture which then the downloader overwrites.

To run the script you need a PHP runtime, then just setup a cronjob to run the script perodicly.

##License
[MIT](https://github.com/victorhaggqvist/wallbase-downloader/blob/master/LICENSE.txt), Use it for whatever you want! Just be aware of that it will most likely break if wallbase changes their layout.
