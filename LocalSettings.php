<?php
# This file was automatically generated by the MediaWiki 1.17.0
# installer. If you make manual changes, please keep track in case you
# need to recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# http://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
        exit;
}

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;
$wgSitename      = "RENAME";
$wgMetaNamespace = "RENAME";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs please see:
## http://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "";
$wgScriptExtension  = ".php";

## The relative URL path to the skins directory
$wgStylePath        = "$wgScriptPath/skins";
require_once "$IP/skins/Vector/Vector.php";

## The relative URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo             = "$wgScriptPath/images/logo.png";

## UPO means: this is also a user preference option

$wgEnableEmail      = true;
$wgEnableUserEmail  = true; # UPO

$wgEmergencyContact = "user@example.com";
$wgPasswordSender   = "user@example.com";

$wgEnotifUserTalk      = false; # UPO
$wgEnotifWatchlist     = false; # UPO
$wgEmailAuthentication = true;

## Database settings
$wgDBtype           = "mysql";
$wgDBserver         = "localhost:3306";
$wgDBname           = "bitnami_mediawiki";
$wgDBuser           = "bn_mediawiki";
$wgDBpassword       = "bfb0c55363";

# MySQL specific settings
$wgDBprefix         = "";

# MySQL table options to use during installation or update
$wgDBTableOptions   = "ENGINE=InnoDB, DEFAULT CHARSET=utf8";

# Experimental charset support for MySQL 4.1/5.0.
$wgDBmysql5 = false;

## Shared memory settings
$wgMainCacheType    = CACHE_NONE;
$wgMemCachedServers = array();

# Image Converter
$wgSVGConverter = 'ImageMagick';

# Image converter path
$wgSVGConverterPath = '/opt/bitnami/common/bin';

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads  = true;
## Add array to enable pdf uploads
$wgFileExtensions[]= 'pdf';
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/opt/bitnami/common/bin/convert";

# Path to jpegtran utility
$wgJpegTran = '/opt/bitnami/common/bin/';

# Path to tidy utility binary
$wgTidyBin = '/opt/bitnami/common/bin/';

# InstantCommons allows wiki to use images from http://commons.wikimedia.org
$wgUseInstantCommons  = false;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "en_US.utf8";

## If you want to use image uploads under safe mode,
## create the directories images/archive, images/thumb and
## images/temp, and make them all writable. Then uncomment
## this, if it's not already uncommented:
#$wgHashedUploadDirectory = false;

## If you have the appropriate support software installed
## you can enable inline LaTeX equations:
$wgUseTeX           = false;

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of ./languages/Language(.*).php
$wgLanguageCode = "en";

$wgSecretKey = "REPLACE";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "REPLACE";

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'standard', 'nostalgia', 'cologneblue', 'monobook', 'vector':
$wgDefaultSkin = "vector";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
#$wgEnableCreativeCommonsRdf = true;
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl  = "";
$wgRightsText = "";
$wgRightsIcon = "";
# $wgRightsCode = ""; # Not yet used

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# Query string length limit for ResourceLoader. You should only set this if
# your web server has a query string length limit (then set it to that limit),
# or if you have suhosin.get.max_value_length set in php.ini (then set it to
# that value)
$wgResourceLoaderMaxQueryLength = -1;

# End of automatically generated settings.
# Add more configuration options below.

#Set Default Timezone for the wiki, so the edit times are displayed correct
$wgLocaltimezone = "UTC";
$dtz = new DateTimeZone($wgLocaltimezone);
$dt = new DateTime('now', $dtz);
$wgLocalTZoffset = $dtz->getOffset($dt) / 60;
unset($dtz);
unset($dt);

#Makes the articles prefixed with /wiki/
$wgArticlePath = "/wiki/$1";
$wgUsePathInfo = true;
$wgPhpCli = "/opt/bitnami/php/bin/php";
#Open external links in a new page
$wgExternalLinkTarget = '_blank';

##Preventing Access
#Disable reading by anonymous users
$wgGroupPermissions['*']['read'] = false;

#But allow them to access the login page or else there will be no way to log in!
# (You also might want to add access to "Main Page", "Help:Contents", etc.)
$wgWhitelistRead = array ("Special:Userlogin");

#Disable anonymous editing
$wgGroupPermissions['*']['edit'] = false;

#Prevent new user registrations except by sysops
$wgGroupPermissions['*']['createaccount'] = false;

#Additional namespaces
//define constants for additional namespaces
define("NS_KB",3000); // This MUST be even.
define("NS_KB_TALK",3001); // This MUST be the following odd integer

//Add extra namespaces
$wgExtraNamespaces[NS_KB] = "KB";
$wgExtraNamespaces[NS_KB_TALK] = "KB_Talk"; //Note underscores in the namespace.

//Allow subpages in the KB namespace
$wgNamespacesWithSubpages = array(
        NS_KB   => true,
);

// Enable MultiMediaViewer for everyone
$wgDefaultUserOptions['multimediaviewer-enable'] = 1;

// Load extensions
wfLoadExtension( 'SyntaxHighlight_GeSHi' );
$wgPygmentizePath = "$IP/extensions/SyntaxHighlight_GeSHi/pygments/pygmentize";
wfLoadExtension( 'WikiEditor' );
wfLoadExtension( 'Cite' );
wfLoadExtension( 'LabeledSectionTransclusion' );
wfLoadExtension ( 'VisualEditor' );
wfLoadExtension( 'TemplateData' );
wfLoadExtension ( 'ParserFunctions' );
require_once "$IP/extensions/Scribunto/Scribunto.php";
wfLoadExtension( 'Kartographer' );
wfLoadExtension( 'MultiBoilerplate' );
wfLoadExtension( 'BetaFeatures' );
require_once "$IP/extensions/MultimediaViewer/MultimediaViewer.php";
require_once "$IP/extensions/DynamicPageList/DynamicPageList.php";
require_once "$IP/extensions/Variables/Variables.php";


// VisualEditor configuration //
// Enable by default for everybody
$wgDefaultUserOptions['visualeditor-enable'] = 1;
// Optional: Set VisualEditor as the default for anonymous users
// otherwise they will have to switch to VE
// $wgDefaultUserOptions['visualeditor-editor'] = "visualeditor";
// Don't allow users to disable it
$wgHiddenPrefs[] = 'visualeditor-enable';

// OPTIONAL: Enable VisualEditor's experimental code features
#$wgDefaultUserOptions['visualeditor-enable-experimental'] = 1;

//Linking Parsoid
$wgVirtualRestConfig['modules']['parsoid'] = array(
        // URL to the Parsoid instance
        // Use port 8142 if you use the Debian package
        'url' => 'http://localhost:8142',
        // Parsoid "domain", see below (optional)
        'domain' => 'localhost',
        // Parsoid "prefix", see below (optional)
        'prefix' => 'localhost'
);

// This feature requires a non-locking session store. The default session store will not work and
// will cause deadlocks (connection timeouts from Parsoid) when trying to use this feature.
$wgSessionsInObjectCache = true;

// Forward users' Cookie: headers to Parsoid. Required for private wikis (login required to read).
// If the wiki is not private (i.e. $wgGroupPermissions['*']['read'] is true) this configuration
// variable will be ignored.
//
// WARNING: ONLY enable this on private wikis and ONLY IF you understand the SECURITY IMPLICATIONS
// of sending Cookie headers to Parsoid over HTTP. For security reasons, it is strongly recommended
// that $wgVirtualRestConfig['modules']['parsoid']['url'] be pointed to localhost if this setting is enabled.
$wgVirtualRestConfig['modules']['parsoid']['forwardCookies'] = true;

// E-mail configuration (for outgoing/ingoing mail)
$wgSMTP = array(
 'host'     => "REPLACE",
 'IDHost'   => "REPLACE",
 'port'     => REPLACE,
 'auth'     => false,
);
