For navigation bar and footer:
Copy everything in the nav.html and footer.html and paste it into your page.html, pull style.css to the latest version and everything should work fine.

----
For division bar and end button:

Paste <div class="yel_bar_section"></div> into every space between your sections except for the last one to footer (because I already put margin for end buton section)

Give your end button's holder the id="end_button" and the links inside it the class="button" and remove every styling you gave them except for text styling.

----
Synchroization Notice:
Since I set the <body></body>'s margin already, you should not set your section's margin or padding intro anything other than 0px unless you intentionally want more space.