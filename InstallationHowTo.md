(Jan 2015) This program doesn’t work in PHP 5 since mysql extension is removed. Additional installation comments by Nenad Smolović

# Introduction #

This page explains the steps required to install a working version of maintenancedB on your own PHP+mySQL server.

# Details #

**Step 0:**
a) Extract program files to the server folder you are going to use as root folder. Use the same directory structure on the compressed file.

The contents of the root\_folder.tar.gz file should go directly to www.yourwebsite.com root, not www.yourwebsite.com/root\_folder/!

**Step 1:**
a) Open the file config/config.php and edit the $root\_dir variable to show your root installation folder (Use only the folder name, not its full path: use "/maintenancedb" instead of "http://localhost/maintenancedb").
b) Go to http://www.php.net/manual/en/timezones.php and find your time zone. Copy and paste the exact text of your time zone to $default\_time\_zone variable.
c) set the $admin\_email variable to a valid email address. This address will show as the "sent from:" address on all emails sent by the system.
d) Do not change the $session\_timeout variable at this point.

**Step 2:**
a) Find the file db.php on the root folder
b) Change the following variables to match your environment:

&lt;BR /&gt;



$db\_server //this is the server name, usually localhost

&lt;BR /&gt;


$db\_name //The name of your mySQL database

&lt;BR /&gt;


$db\_user //the dB username

&lt;BR /&gt;


$db\_pass //finally the db password

&lt;BR /&gt;



**Step 3:**
a) Open phpmyAdmin and go to the database where the data is going to be stored and that you specified above in Step 2.
b) Import the database structure (upload the maintdb\_struct.sql file). The database structure file is on the root folder of the distribution.
c) Confirm the db structure has been imported successfully.
d) Open the users table on phpmyadmin and insert a new user as follows:
user\_id - empty
username - admin
dptid - 0
userpass - empty
useremail - must be valid email so you can retrieve the password that will allow you to start using the system.
usergroup - 1
receiveemails - Y
mainadmin - Y
does\_orders - Y
receivesreports - N
timezone - leave empty
is\_site\_admin - Y
is\_plant\_admin - Y
is\_dpt\_admin - Y
is\_system\_admin - Y
plantid - 0

save this information.

e) open the usergroups table and add two entries as follows (make sure you copy exactly the following:
#1:
usergroups\_id - 1
usergroups\_name - admin
usergroups\_description - Admin User

#2:
usergroups\_id - 2
usergroups\_name - level1
usergroups\_description - Level 1 User


**Step 4**
a) Go to location where you installed the software: e.g. localhost/maintenancedB
b) you should see a page that asks you to login. Click login.
c) click forgot password
d) enter username: admin and the email address you used as this user address on the previous step.
e) password is sent to your account via email. It also shows on the landing page after you reset the password. Follow the instructions to remove that line from the code on resetpass.php so you do not show the password everytime resetpass.php is ran.
f) login in the system using username admin and the password just assigned to you.

**Step 5**
a) you will have quite a lot of errors. This is because there's still a few things to fix.
b) lets start by configuring department: go to the "site config" link at the top right of the page. Click "Organization Departments". Enter Department name (e.g. MTC) and description (e.g. maintenance department). It should give a "all good message".
c) Create your first user:
on the config pages go to create new user.
make sure you use a valid email address as this is going to be used to reset the password in the future if required. Choose admin user if this user is going to have admin rights. Level 1 users can only add work orders, and process work orders assigned to them. It is best to start with an admin user for each department.

**Step 6**
You are almost ready to go.
Now there's a few more entries to the database that you need to add directly on the db:
a) open mpperiodicity table and import the mpperiodicity.sql file (on the root folder) you can delete this file after a successful import.
b) open wopriority tsable and import the wopriority.sql file (on the root folder) you can delete this file after a successful import.
c) open wostatus tsable and import the wostatus.sql file (on the root folder) you can delete this file after a successful import.
d) open wotype table and import the wotype.sql file (on the root folder) you can delete this file after a successful import.

Now use the config site options available to the admin user to configure the equipment level codes. Some pages may not be fully functional until you have entered data on all fields.

Note: at this point, after the creation of a user, you still need to do some low level configuration directly on the database. Open the new user you just added using phpmyadmin. go through the options inside the table for that user. You may have to add some info with "Y" or "N". Namely change does\_orders to Y, receivesreports to N, is site\_admin to N, is\_plant\_admin to N, is\_dpt\_admin to N, is system\_admin to N.

**Step 7**
a) run the file scheduler.php every 15 minutes. Use crontab with linux or similar with windows (sorry not familiar with options under windows):
/usr/bin/wget -O -- -q http://your_root_folder/scheduler.php

**Step 8**
If you see messages like the following:
Notice: Undefined variable: root\_dir in /home/diieg/public\_html/maintenancedB/spares.php on line 14

go to your php.ini file and disable printing errors. Everything works fine anyway.

Good luck.