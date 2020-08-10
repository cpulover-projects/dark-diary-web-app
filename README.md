# Issues
- Frontend: 
  - Right topbar
  - Mobile responsive
  - Fixed sidebar
  - Remember me checkbox
- Prevent parsing html code (fixed)
- Popover not working properly
- Could not save image

# Notes - Tips
- Create hidden fields in the forms to distinguish between signing up and signing in
- Hash password when signing up
- Use ```isset()``` to check availability of a key
- Add important style using jQuery: ```attr('style', function(i,s) { return (s || '') + 'background-color: aquamarine !important;' });```
- Select child element of "this" with jQuery: ```$(this).find('<element>')```
- Select parent element of "this" with jQuery: ```$(this).parent()```
- Use ```event.stopPropagation()``` to avoid triggering parent's event when triggering child's event
- To include css and js to another php pages: 
```
<link rel="stylesheet" href="resources/css/style.css?<?php echo time(); ?>">
```
- Check session befor starting a session to avoiding error 
```
<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
```
- Reserve an a blank line to make cookie works in webserver 
```
<?php

//code starts from here...
?>
```
- Use absolute path to include php file in parent directory in webserver: ```include "/home/sites/11a/2/2148d4b421/public_html/the-dark-diary/properties.php"; //import database properties from secured file```
- Select elements other than this: ```$("<class>").not(this)```
- Access PHP variable in JavaScript 