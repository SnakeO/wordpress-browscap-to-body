# Browscap to Body
This plugin will inject the following properties into the &lt;body&gt; class:

- browser (chrome, firefox, safari, etc)
- version (10.1, 11.2, etc)
- majorver (10, 11, etc)
- minorver (1, 2, etc)
- platform (macosx, android, ios, windows)
- is-phone **is only injected if viewing from tablet**
- is-tablet **is only injected if viewing from tablet**
- is-mobile **is injected if viewing from phone or tablet**

## Composer
This plugin requires composer. Download it from:
[https://getcomposer.org/](https://getcomposer.org/)

## Installation
Once composer is installed, one must execute the following commands from the command line (Applications/Utilities/Terminal in OSX):

`$ cd (paste the path to the plugin directory here)`

`$ composer selfupdate`

`$ composer update`

Allow that to finish. Now, one needs to install browscap.:

`$ cd (paste the path to the plugin directory here)`

`$ ./vendor/bin/browscap-php browscap:fetch`

`$ ./vendor/bin/browscap-php browscap:convert`

Browscap should now be installed on your system.

To read more about browscap, visit their github:
[https://github.com/browscap/browscap-php](https://github.com/browscap/browscap-php)

## Usage

After activating the plugin, you may use css selectors to target combinations of browsers, versions, and operating systems. A few examples:

`body.is-mobile { /* all tablets & phones */ }`

`body.chrome.macosx { /* chrome on osx */ }`

`body.android.firefox.is-phone { /* firefox mobile on android */ }`

