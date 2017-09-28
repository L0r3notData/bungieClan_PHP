// ##########################################
// ###                                ###
// ###  CLAN MEMBERS FROM BUNGIE API  ###
// ###  v1.4                          ###
// ###  @L0r3notData                  ###
// ###                                ###
// ######################################


# WHAT IS THIS THING? #
Set PHP files that reads pages of users from bungie.net API for a specified group
Note: You specify the clan number and put your personal bungie.net API key in apiKeys.php

# WHAT EVERYTHING DOES #

# apiKeys.php #
Contains group ID
Contains users API key

# apiBungieClanMembers.php #
Calls "apiKeys.php"
Curls down page of clan members from bungie API
Builds a string containing all gamer tags from the member pages
Writes the unix date/time to the cache file
Writes the URL to the clans page to the cache file
Writes the string of gamertags to the file
Calls "cacheBungieClan.php" to read cache file and output to web page

# cacheBungieClan.php #
Gets the contents of the cache file (clan.htm)
Removes the first line (unix time)
Converts the first line to standard date/time
Prints standard date/time and user list to page

# cache/clan.htm #
This path and file are auto created
Contains:
	1st Line: Unix time cache was created
	2nd Line: 
	3rd Line:
	4th and all following files: List of members of bungie clan


------ CHANGE LOG ------

# CHANGES 0.0 --> 1.0 #
Based off my "api100members" project 1.3
Changed API call and json parsing to bungie specific
Other bungie specific minor adjustments

# CHANGES 1.0 --> 1.1 #
Removed caching mechanism (not needed due to speed of live loading)

# CHANGES 1.1 --> 1.4 #
Skipped versioning from 1.1 to 1.4 to be inline with versioning of api100members project







