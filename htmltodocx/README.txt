Adding HTML to Word Documents using PHPWord and SimpleHTMLDom
==============================================================

version 0.5.2 alpha
============

These functions enable you to add HTML into a Word document using PHPWord.

The purpose of this software is to add HTML to Word documents in a form that is familiar to most people who use Word documents. The aim is not to give a faithful representation of web page layout, but rather to have an easy-to-use version, which people can easily edit for themselves.

Changes
=======

Revision: 11275
Author: SND\neilt17_cp
Date: 09 May 2012 15:37:52
* Added url encoding of spaces in urls - which can cause the Word document to be corrupt. Note, even with this, any space in a url where there isn't a '/' at some point before it will corrupt the Word document;
* Corrected bug in image source path creation for situations where the base path is empty.

Revision: 11257
Author: SND\neilt17_cp
Date: 08 May 2012 23:02:19
Update to documentation files.

Revision: 11250
Author: SND\neilt17_cp
Date: 08 May 2012 19:08:43
* Added support for HTML entities;
* Added support for cell widths styles (can be defined as a style as well as a width on the HTML td element);
* Added table of contents support: you can enable headings (h1..h6) to be converted to Word headings (heading 1..heading 6), and assign an id to a div element which will be replaced with a Word table of contents on conversion;
* New documentation at documentation/index.php (browse to it on your test server);
* Improved handling of image src - see: h2d_htmlconverter.php - lines 629 to 647 (work item 442).

Revision: 11242
Author: SND\neilt17_cp
Date: 07 May 2012 20:47:59
* Adjusted paragraph separation to work better with Word2007+ where no spacing is set in a style;
* Entire (pseudo) list elements can now be styled - e.g. to set spaceAfter;
* Can now add spaceAfter and spaceBefore on <ul> and <ol> elements for spacing before and after lists. Defaults to a single text break after a list if spaceAfter is not set;
* Added inheritance check so that only properties that are typically inherited in css are inherited here (e.g. font styling) - see function htmltodocx_inheritable_props().

Revision: 11235
Author: SND\neilt17_cp
Date: 07 May 2012 14:10:52
Corrected undefined index errors (work items 440 and 441).

Revision: 9791
Author: SND\neilt17_cp
Date: 19 March 2012 20:18:40
Added:
* Handling of th elements;
* Table cell styling (for td and th elements);
* Table styling (NB, using PHPWord styles on a table, styles all the cells within the table with that style)

Revision: 9738
Author: SND\neilt17_cp
Date: 18 March 2012 20:10:24
Corrected handling of utf-8 characters in h2d_htmlconverter.php in htmltodocx_clean_text().

Revision: 9669
Author: SND\neilt17_cp
Date: 16 March 2012 19:45:09
Added test folder - and subfolder for testing utf8 support in PHPWord.
Added clean up for simplehtmldom object in example.php.
