# Issues
- Frontend: 
  - Right topbar
  - Mobile responsive
  - Fixed sidebar
- Could not display PHP errors on the browser properly
- Could not link images in CSS from other directories
- Prevent parsing html code

# Notes - Tips
- Create hidden fields in the forms to distinguish between signing up and signing in
- Hash password when signing up
- Use ```isset()``` to check availability of a key
- Add important style using jQuery: ```attr('style', function(i,s) { return (s || '') + 'background-color: aquamarine !important;' });```
- Select child element of "this" with jQuery: ```$(this).find('<element>')```
- Use ```event.stopPropagation()``` to avoid triggering parent's event when triggering child's event

