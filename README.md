# Nagios Plugin: check_joomla

check_joomla is a nagios's plugin to check joomla's version.

It is a work in progress and is tested against version 3.* of Joomla.

## How it works

- Copy the check_joomla script in nagios's plugin folder (eg: */usr/lib/nagios/plugins/*).
- Change its mode *chmod +x check_joomla*
- Update nrpe config file
  - Find the command's section
  - Add the line ```command[check_joomla]=/usr/lib/nagios/plugins/check_joomla <path_to_joomla>```
  - Change the <path_to_joomla> to fit your needs
- Restart nrpe service (*sudo service nagios-nrpe-server restart*)
- Add the command to your service definition:

```
 check_command                   check_nrpe!check_joomla
```

## Requirements

This plugin requires that:

- you have installed a PHP interpreter
- the shebang is correctly handled from your system
- the SimpleXML extension is loaded and available
- (probably) that SimpleXML is able to access the internet and retrieve the update instractions from joomla

## References

Joomla update: http://update.joomla.org/core/sts/list_sts.xml  
Nagios: https://www.nagios.org/  
Shebang: https://en.wikipedia.org/wiki/Shebang_(Unix)  
SimpleXML: http://php.net/manual/en/book.simplexml.php