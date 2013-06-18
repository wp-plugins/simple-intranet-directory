===  Simple Intranet Directory  ===
Contributors: charlwood
Donate link: http://www.simpleintranet.org/
Tags: intranet, extranet, employee, user photo, company, directory, profile, staff, out of office
Requires at least: 3.0.1
Tested up to: 3.5.1
Stable tag: 1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple employee directory with photos for your intranet or business.

== Description ==

*Simple Intranet Directory* is an easy to use employee directory listing of your users that includes extended profile information, user photos and a search function.  We have also added custom fields and an out of office alert function. Credit is given to Peter Sterling from http://www.sterling-adventures.co.uk/blog/ for his contribution to the Avatar portion of this code.

Upgrade to the full version of our Simple Intranet (http://www.simpleintranet.org) plugin and get these features;

* secure intranet site-wide password protection and Google/Active Directory SSO
* out of office expiry date and custom text options and widget
* employee of the month and employee birthdays widget
* drill-down detailed employee biography profiles
* branded login and admin panels with your logo
* Facebook-like real-time activity feed for employee communication
* Dropbox-like drag and drop file management with user permissions by folder or file
* front-end user edited Wiki for group editing and collaboration
* employee online survey poll widget and archive
* an upcoming events calendar/listing page and widget with e-mail notifications
* contact and HR forms with downloads on the backend
* most popular content sidebar widget (records views of all pages/posts)
* appointment and conference room bookings
* Question & Answer page function like Quora, Yahoo Answers, StackOverflow

NOTE: To upgrade you will need to deactivate and delete this Simple Intranet Directory plugin from your server.  Don't worry, your photos and employee data will however be saved and accessible in your the full version of the Simple Intranet plugin.

== Installation ==

Thank you for downloading our Simple Intranet Directory plugin.  Here is a quick primer on the installation and setup for installing our plugin-in.  

1. Download and unzip the plugin and copy/extract the "simple-intranet-directory" folder and all of its child files to the "wp-content/plugins" directory of your WordPress.org installation.  

2. You will then need to activate the Simple Intranet Directory plugin in the "Plugins" area of the Dashboard. 

3. Set up your employee directory by uploading employee photos via either the "Users/Employee Photos" or "Users/Your Employee Profile" menus.

4. Add a searchable employee directory listing by inserting the [employees] shortcode into a post or page.

5. View these and more options at the "Simple Intranet" menu item in your Dashboard or visit http://www.simpleintranet.org.

== Frequently Asked Questions ==

= How do I add the directory? =

Simply add the [employees] shortcode into any post or page.  Then update users profile information if you are an admin, or have your users update their own profiles under "Users / Your Employee Profile" when they login.

= How can I change the look of my employee directory? =

You can edit the style sheet file called "si_employees.css" found in the /css folder.  This includes classes for the "employeephoto" and "employeebio" and "outofoffice" areas of the employee directory.

= How can I change the size of the employee photos? =

Click on "Users / Employee Photos" and down the page under "Photo Options" you will see the third option is for the size of the photos in pixels.

= I'm uploading employee photos but they are not appearing or saving? =

This is typically caused by a folder or a permission issue.  First ensure you are uploading to the right folder, and test the image URL in a separate browser to see if it has uploaded.  Also, under "Users / Employee Photos" and down the page under "Photo Options" your will see an option for "User Uploads" where you can manually set the Avatar upload directory.  Be sure you have "write" privileges and not just "read" privileges.  You may have to use a FTP or HTML editor to "CHMOD" the folder to change permissions to allow "write" access.

= Where do I add custom fields? =

In the "Users / Your Employee Profile" under the Country field you can add up to 3 custom fields.  Admins can edit the labels and all other roles can add content next to these labels.

= How does the Out of Office alert function work? =
In "Users / Your Employee Profile" at the top of the page you will see "Out of office notification is OFF. | Turn ON.".  Click "Turn ON" to activate a message above your employee listing in the Employee Directory.   Go down to the bottom of your profile page, and edit the "Out of office text" field. Enter custom out of office notification text here, and it will show above your user photo in the Employee Directory, assuming you have activated the out of office alert at the top of the page.

= Can Admins change the out of office status for other users? =
Yes, they can edit any users profile information and just update the pull-down menu "Update out of office status" further down a user's profile page.  Just remember that when logged in as an Admin or other user, if you click to "Turn On or Off" the out of office alert at the top of the user profile page, that will only affect the logged in user out of office status (and not the user which you are editing).

== Screenshots ==

1. This screen shot shows the Simple Intranet Directory with employee extended profile information and user photos/avatars.

== Changelog ==
= 1.4 =
* Optimized the CSS formatting of the employee directory layout for select Internet Explorer versions.

= 1.3 =
* Added 3 new custom fields where the administrator can edit the labels, and employees can fill in their data.
* Added an "Out of Office" alert system, which shows above the Employee Directory listings.  Text can be customized for the alert in the "Users / Your Profile" area.
* Optimized and tested for version 3.51 and the 3.6 beta version.

= 1.21 =
* Optimized speed of search function, added pull down menu for name, title, department.

= 1.2 =
* Updated phone numbers to make them clickable via all smart phones including iPhone and Android.
* Expanded employee search to title and departments as well as by name.

= 1.1 =
* Updated pagination formatting for over 25 records.

= 1.0 =
* First version of plugin.