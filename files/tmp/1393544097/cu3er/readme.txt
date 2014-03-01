Cu3er slideshow block for Concrete5
http://c5extras.com/add-ons/cu3er-slideshow/

This Flash-based slideshow block gives your images a flexible 3D animated transition. It's easy to use.

A FEW KEY FEATURES:

* Add individual images to the slideshow (from the File Manager) with granular control over animations.
* Or simply select a File Set and default transition options for a quick animation.
* Selection of a "fallback" banner image (from the File Manager) when the user does not have Flash installed - much better than a "download Flash now" button.
* Supports multiple Cu3er blocks on the same page.


HOW IT WORKS:

The block generates XML data as the block is created/edited (and saved into the db). This XML data stores configuration info about the Cu3er animation.
The config XML data is based on several XML template files called "configTemplate.xml", "buttonTemplate.xml" and "descriptionTemplate.xml", so if you know Cu3er well and want to fine-tune it, simply edit this file as required.
You can find the fully doco at:
http://www.progressivered.com/cu3er/docs/



ADVANCED TIPS:

A couple tips on advanced customisation in "configTemplate.xml":
* Edit the text overlay colours
* Change the timer symbol (currently a circle) to a rectangle, and change the opacity and position of the timer symbol.

A couple tips on advanced customisation in "buttonTemplate.xml":
* Edit the previous/next button symbols with one of the other built-on options (from 1 to 10): http://www.progressivered.com/cu3er/docs/src/img/navigation_symbols.gif
* Edit the previous/next button colours and transparency

Other advanced customisations:
* Replace the included font with your own Flash-based font (this is used for overlay headings and body text).
* Add a shadow background image to a DIV tag surrounding the Cu3er animation - this gives the impression that the block is "floating". See: http://www.progressivered.com/cu3er/