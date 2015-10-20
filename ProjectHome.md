Online CMMS written in php and using a mySQL database. This software has been developed to run on my company and after one year of continuous use, I decided to release it to the public under a GNU license.

It works pretty well at this point but there's some levels of configuration that still cannot happen on the front-end mostly because I had no time to implement them (hence also the open source release to see if anyone can assist me with this). These levels of configuration need to be done directly on the database using, among others, phpMyAdmin.

It includes a working work order flow system from manual work requests to final reports. It also implements a basic but functional maintenance plan system where orders are issued automatically based on time cycles.

The software as-is assumes knowledge of php and mySQL administration for you to install and use it. It is also essentially not secure with a lot of the input fields not performing input validation, so take care if you plan to install this online and not on a LAN.



&lt;H1&gt;

maintenancedb is the project that originated the development of <a href='http://www.commacmms.com'>comma CMMS</a> a free professional-grade online cloud-based CMMS. Use comma CMMS for free <a href='http://www.commacmms.com/'>here</a>

&lt;/H1&gt;



ASSOCIATED PROJECT: sensorNETv2. The development of hardware capable to issue automatic maintenance orders on the maintenancedB system depending on pre-set rules (for example if the temperature inside an electrical cabinet goes above a certain level).

See project page here:
<a href='http://supertechman.blogspot.com/2012/10/sensornet-change-of-plans.html'><a href='http://supertechman.blogspot.com/2012/10/sensornet-change-of-plans.html'>http://supertechman.blogspot.com/2012/10/sensornet-change-of-plans.html</a></a>

**PRINT SCREENS:**

&lt;BR /&gt;


CREATE MAINTENANCE PLAN:
<img src='http://commacmms.com/wp-content/uploads/2013/10/download.jpg'>