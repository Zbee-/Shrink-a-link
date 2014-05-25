#Shrink-a-link
A Link shrinker made in PHP, which is very light and easy to use.
Make sure you model your instalment of SaL after the included demo file.

If you minify the [PHP](http://labs.builtbyprime.com/tinyphp/) and the [CSS](http://cssminifier.com/), it'll be even faster and lighter, and safely minified versions of the code are included.

##Features
* Self-Growing - When the maximum amount of URLs have been generated with the configured length, it will generate a shrunken URL that is 1 character longer.
* URL Comparison - If there's already a shrunken link with the URL the user just input, it simply returns the shrunken URL.
* Shrink Comparison - If there's already a shrunken link with the shrink the system just generated, it regenerates the shrink.
* URL Variety - ~60 million possible shrunken URLs with the default 5 character shrink code
* Simple Configuration file - Has simple variables that are easy to understand and edit, it also explains what they are, and saves the default.
* Simplicity - Takes the user's URL, stores it, generates a code, and returns it as a link; simple as that
* Input Sanitization - Sanitizes user inputs by removing nasty SQL code such as DELETE and DROP, keeping your table(s) safe
* Error Detection - Checks to make sure that the user input something so you don't wind up with a table half empty
* Self Cleansing - When a user visits a shrunken url (example.com/uqtn2, per se) and that link doesn't have a redirect url attached to it, the shrinker deletes the shrink
* Themed - Comes with a basic theme compatible with major modern browsers
* Free - It's made by me, and therefore free :)
* Non-space consuming - Only requires 4 files
* Tiny - Coded in less than 300 lines of code

##Set-up
The set-up is incredibly simple.
Once you deploy the system, just set up config.php with your desired settings and navigate to setup.php which will then set up your databases according to your preferences.

##Use
To use it, you can simply download Shrink-a-Link as a .zip and replace all the ***REPLACE ME***'s in the config file with your circumstance-specific settings.

## License
Copyright (c) 2014 Ethan Henderson See the LICENSE file for license rights and limitations (MIT).