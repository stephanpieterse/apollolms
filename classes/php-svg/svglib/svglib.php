<?php
/**
 *
 * Description: Implementation SVGDocument inlude all other libs
 *
 *
 * @link http://trialforce.nostaljia.eng.br
 * @link http://www.w3.org/TR/SVG/
 *
 * Started at Mar 11, 2010
 *
 * @version 0.1
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

include_once('xmlelement.php'); //extends SimpleXmlElement
include_once('svgstyle.php'); //generic shape
include_once('svgshape.php'); //generic shape
include_once('svgshapeex.php'); //extended shape
include_once('svgpath.php'); //path object
include_once('svgrect.php'); //rect object
include_once('svgtext.php'); //text object
include_once('svgimage.php'); //image object suports embed image
include_once('svglineargradient.php');
include_once('svgstop.php'); //one color/stop of


/**
 *
 * Needed to use:
 * SimpleXmlElement
 * gzip support (for compressed svg)
 * imagemagick to export to png
 * GD to use embed image
 *
 * Reference site:
 * http://www.leftontheweb.com/message/A_small_SimpleXML_gotcha_with_namespaces
 * http://blog.jondh.me.uk/2010/10/resetting-namespaced-attributes-using-simplexml/
 * http://www.w3.org/TR/SVG/
 */
class SVGDocument extends XMLElement
{
    const VERSION = '1.1';
    const XMLNS = 'http://www.w3.org/2000/svg';
    const EXTENSION = 'svg';
    const EXTENSION_COMPACT = 'svgz';
    const HEADER = 'image/svg+xml';


    /**
     * Return the extension of a filename
     * 
     * @param string $filename the filename to get the extension
     * @return string the filename to get the extension
     */
    protected static function getFileExtension($filename)
    {
        $explode = explode('.', $filename);
        return strtolower( $explode[ count( $explode ) -1 ]  );
    }

    /**
     * Return a SVGDocument
     *
     * If filename is not passed create a default svg.
     *
     * Supports gzipped content.
     *
     * @param $filename the file to load
     *
     * @return SVGDocument
     */
    public static function getInstance( $filename = null )
    {
        if ( $filename )
        {
            //if is svgz use compres.zlib to load the compacted SVG
            if ( SVGDocument::getFileExtension( $filename ) == self::EXTENSION_COMPACT )
            {
                //verify if zlib is installed
                if ( ! function_exists( 'gzopen' ) )
                {
                    throw new Exception('GZip support not installed.');
                    return false;
                }

                $filename = 'compress.zlib://'.$filename;
            }

            //get the content
            $content = file_get_contents($filename);

            //throw error if not found
            if ( !$content)
            {
                throw new Exception( 'Impossible to load content of file '. $filename);
            }

            $svg = new SVGDocument( $content );
        }
        else
        {
            //create clean SVG
            $svg = new SVGDocument( '<?xml version="1.0" encoding="UTF-8" standalone="no"?><svg></svg>' );

            //define the default parameters A4 pageformat
            $svg->setWidth( '210mm' );
            $svg->setHeight( '297mm' );
            $svg->setVersion( self::VERSION );
            $svg->setAttribute('xmlns', self::XMLNS );
        }

        return $svg;
    }

    /**
     * Out the file, used in browser situation,
     * because it changes the header to xml header
     *
     */
    public function output()
    {
        header( 'Content-type: '.self::HEADER );
        echo $this->asXML();
    }

    /**
     * Export the object as xml text, OR xml file.
     *
     * If the file extension is svgz, the function will save it correctely;
     *
     * @param string $filename the file to save, is optional, you can output to a var
     * @return string the xml string if filename is not passed
     */
    public function asXML( $filename = null )
    {
        //if is svgz use compres.zlib to load the compacted SVG
        if ( SVGDocument::getFileExtension( $filename ) == self::EXTENSION_COMPACT )
        {
            //verify if zlib is installed
            if ( ! function_exists( 'gzopen' ) )
            {
                throw new Exception('GZip support not installed.');
                return false;
            }

            $filename = 'compress.zlib://'.$filename;
        }

        $xml = $this->prettyXML( parent::asXML() );

        //need to do it, if pass a null filename it return an error
        if ( $filename )
        {
            return file_put_contents( $filename , $xml );
        }

        return $xml;
    }

    /**
     * Returns s formated xml
     * 
     * @param   string $xml the xml text to format
     * @param   boolean $debug set to get debug-prints of RegExp matches
     * @returns string formatted XML
     * @copyright TJ
     * @link kml.tjworld.net
     * @link http://forums.devnetwork.net/viewtopic.php?p=213989
     * @link http://recursive-design.com/blog/2007/04/05/format-xml-with-php/
     */
    protected function prettyXML($xml, $debug=false)
    {
        // add marker linefeeds to aid the pretty-tokeniser
        // adds a linefeed between all tag-end boundaries
        $xml = preg_replace('/(>)(<)(\/*)/', "$1\n$2$3", $xml);

        // now pretty it up (indent the tags)
        $tok = strtok($xml, "\n");
        $formatted = ''; // holds pretty version as it is built
        $pad = 0; // initial indent
        $matches = array(); // returns from preg_matches()

        /*
         * pre- and post- adjustments to the padding indent are made, so changes can be applied to
        * the current line or subsequent lines, or both
        */
        while($tok !== false)// scan each line and adjust indent based on opening/closing tags
        {
            // test for the various tag states
            if (preg_match('/.+<\/\w[^>]*>$/', $tok, $matches))// open and closing tags on same line
            {
                if($debug) echo " =$tok= ";
                $indent=0; // no change
            }
            else if (preg_match('/^<\/\w/', $tok, $matches)) // closing tag
            {
                if($debug) echo " -$tok- ";
                $pad--; //  outdent now
            }
            else if (preg_match('/^<\w[^>]*[^\/]>.*$/', $tok, $matches))// opening tag
            {
                if($debug) echo " +$tok+ ";
                $indent=1; // don't pad this one, only subsequent tags
            }
            else
            {
                if($debug) echo " !$tok! ";
                $indent = 0; // no indentation needed
            }

            // pad the line with the required number of leading spaces
            $prettyLine = str_pad($tok, strlen($tok)+$pad, ' ', STR_PAD_LEFT);
            $formatted .= $prettyLine . "\n"; // add to the cumulative result, with linefeed
            $tok = strtok("\n"); // get the next token
            $pad += $indent; // update the pad size for subsequent lines
        }

        return $formatted; // pretty format
    }

    /**
     * Export to a image file, consider file extension
     * Uses imageMagick
     *
     * @param string $filename
     * @param integer $width the width of exported image
     * @param integer $height the height of exported image
     * @param boolean $respectRatio respect the ratio, image proportion
     */
    public function export($filename, $width=null, $height=null, $respectRatio = false )
    {
        $image = new Imagick();

        $ok = $image->readImageBlob( $this->asXML() );

        if ( $ok )
        {
            if ( $width && $height )
            {
                $image->thumbnailImage( $width, $height, $respectRatio );
            }

            $image->writeImage( $filename );

            $ok = true;
        }

        return $ok;
    }

    /**
     * Define the version of SVG document
     *
     * @param string $version
     */
    public function setVersion( $version )
    {
        $this->setAttribute('version', $version);
    }
    
    /**
     * Get the version of SVG document
     *
     * @param string $version
     */
    public function getVersion()
    {
        return $this->getAttribute('version');
    }

    /**
     * Define the page dimension , width.
     * 
     * @example setWidth('350px');
     * @example setWidth('350mm');
     *
     * @param string $width
     */
    public function setWidth( $width )
    {
        $this->setAttribute('width', $width);
    }

    /**
     * Returns the width of page
     *
     * @return string the width of page
     */
    public function getWidth( )
    {
        return $this->getAttribute('width');
    }

    /**
     * Define the height of page.
     *
     * @param string $height
     * 
     * @example setHeight('350mm');
     * @example setHeight('350px');
     */
    public function setHeight( $height )
    {
        $this->setAttribute('height', $height);
    }

    /**
     * Returns the height of page
     *
     * @return string the height of page
     */
    public function getHeight( )
    {
        return $this->getAttribute('height');
    }

    /**
     * Add a shape to SVG graphics
     *
     * @param XMLElement $append the element to append
     */
    public function addShape( $append )
    {
        $this->append( $append );
    }

    public function addDefs( $element )
    {
        $this->createDefs();
        $this->defs->append( $element );
    }

    protected function createDefs()
    {
        if ( !$this->defs )
        {
            $defs = new XMLElement('<defs></defs>');
            $this->append( $defs );
        }
    }

    /**
     * Return the definitions of the document, normally has gradients.
     *
     * @return SVGElement
     */
    public function getDefs()
    {
        return $this->defs;
    }
}
?>