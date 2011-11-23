Adding HTML to Word Documents using PHPWord and SimpleHTMLDom
==============================================================

These functions enable you to add HTML into a Word document using PHPWord.

As of version 0.5.0

The purpose of this software is to add HTML to Word documents in a form that is familiar to most people who use Word documents. The aim is not to give a faithful representation of web page layout, but rather to have an easy-to-use version, which people can easily edit for themselves.

It supports a core set of HTML elements (p, a, em, strong, ul, ol, li, img, tbody, table, tr, td, br, span, div), if it finds an element it doesn't know about, it simply pulls out the html from that element, strips the tags, and inserts what's left into the document.

The html converter - docx_insert_html - makes some decisions about how to deal with elements.

p, div tags
Both treated the same - and created as a text run, followed by a text break: i.e. how many people actually create paragraphs in Word;
list elements


TO DO
=====

Add in support for heading elements (at the moment it does the default - adds the text to the page - in a new run if necessary);
Create "style sheets" for finer setting of styles according to tags and associated classes.