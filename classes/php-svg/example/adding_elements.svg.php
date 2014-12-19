<?php
/**
 *
 * Description: Default example, show some usefull functions / adding elements
 *
 * Blog: http://trialforce.nostaljia.eng.br
 *
 * Started at Mar 11, 2011
 *
 * @author Eduardo Bonfandini
 *
 *-----------------------------------------------------------------------
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU Library General Public License as published
 *   by the Free Software Foundation; either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU Library General Public License for more details.
 *
 *   You should have received a copy of the GNU Library General Public
 *   License along with this program; if not, access
 *   http://www.fsf.org/licensing/licenses/lgpl.html or write to the
 *   Free Software Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
 *----------------------------------------------------------------------
 */
require_once "../svglib/svglib.php";

#start a svgDocument using apple.svg as base document
$svg = SVGDocument::getInstance( 'resource/apple.svg' );
#start a svgDocument using default (minimal) svg document
#$svg = SVGDocument::getInstance( ); //default

#some possible svg functions
#$svg->getWidth();
#$svg->getHeight();
#$svg->getVersion();

#example of criation of an svg style
#$style = 'fill:#f2f2f2;stroke:#e1a100;';
#create a new rect with, x and y position, id, width and heigth, and the style
$rect = SVGRect::getInstance( 0, 5, 'myRect', 228, 185, new SVGStyle( array('fill'=>'red', 'stroke' =>'blue' ) ) );
//$rect->style->setFill('#f2f2f2'); //still not work
//$rect->style->setStroke('#e1a100'); //still not work

$rect->setWidth( $svg->getWidth() ); #make the rect of the size of pages
$rect->skewX(5); #make a skew x transformation
$rect->rotate(1); #make a rotation
$svg->addShape( $rect ); #add the rect to svg

$style = new SVGStyle(); #create a style object
#set fill and stroke
$style->setFill('#f2f2f2');
$style->setStroke('#e1a100');

$svg->addShape( SVGText::getInstance( 22, 50, 'myText', 'This is a text', $style) ); #create a text
$svg->addShape( SVGPath::getInstance( array('m 58,480','639,1'), 'myPath', 'fill:none;stroke:#000000;stroke-width:1px;') );#create a path

#many types of output
$svg->asXML('output/output.svg'); #svg
$svg->export('/tmp/output.png'); #png
$svg->export('output/output.jpg'); #jpg
$svg->export('output/output.gif'); #gif
$svg->export('output/thumb16x16.png',16,16,true); #png resized using imagemagick
$svg->export('output/thumb32x32.png',32,32,true);
$svg->export('output/thumb64x64.png',64,64,true);

#output to browser
$svg->output(); //to browser, with
?>