<?php
?>
<!DOCTYPE HTML>
<html>

<!-- Added by HTTrack -->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Unicode to Bamini - UC - Tamil Unicode Converter</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
<![endif]--> 
<!--[if lt IE 9]>
    <script src="https://tamillexicon.com/static/js/html5-init.js"></script>
<![endif]-->
<link rel="canonical" href="unicode-bamini.html" />
<meta property="og:image" content="../../tamillexicon.com/static/uc/img/unicode-to-bamini-converter.jpg" />
<meta property="og:image:secure_url" content="../../tamillexicon.com/static/uc/img/unicode-to-bamini-converter.jpg" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:image:alt" content="Unicode to Bamini converter" />
<meta name="description" content="Tamil Unicode converter supports to convert the words or document into Unicode to Bamini. This appliction is user-friendly and the user can use very easily." />
<link rel="stylesheet" type="text/css" href="../../tamillexicon.com/static/uc/css/uce67d.css?v=1.3">
<script src="../../tamildi.com/assets/tl/uc/js/new-jet-engine.min.js"></script> 
<script src="../../tamildi.com/assets/tl/uc/js/trans.minc924.js?v=1.0.6"></script> 
<script type="text/javascript">
	  const product = urlParams.get('text')
	  console.log(product);
    var jet = new JetDocument();
    jet( document ).ready( function () {
      var $text = jet("#doc-textarea"), $tmpText = jet("#tmp-text"), text;
//      var $text = urlParams.get( 'text' ),
//        $tmpText = urlParams.get( 'text' ),
//        text;
      jet( "#covert" ).click( function () {
        $tmpText.val( $text.val() );
        $text.val( ConvertToo( 'UniBamini', $tmpText.val() ) );
      } );

      jet( "#source-text" ).keyup( function () {
        text = jet( this ).val();
        jet( "#target-text" ).val( ConvertToo( 'UniBamini', text ) );
      } );
      var navHandle = false;
      jet( "#menu-toggle" ).click( function ( e ) {
        if ( !navHandle ) {
          jet( "#main-menu ul .item" ).css( {
            display: 'block'
          } );
          navHandle = true;
        } else {
          jet( "#main-menu ul .item" ).css( {
            display: 'none'
          } );
          navHandle = false;
        }
        e.preventDefault();
      } );

      var tt = null;
      jet( ".action-bar .copy-btn" ).click( function ( e ) {
        var text = jet( "#doc-textarea" ).val();
        if ( text ) {
          var $btn = this;
          CopyTextToClipboard( text, "doc-textarea" ).then( function () {
            jet( $btn ).html( 'Copied' );
            clearTimeout( tt );
            tt = setTimeout( function () {
              jet( $btn ).html( 'Copy Text' );
              clearTimeout( tt );
            }, 1500 )

          } );
        }
        e.preventDefault();
      } );
    } );

    function CopyTextToClipboard( text, textareaID ) {
      var Error = null,
        Success = false,
        fallback = false;
      var textArea = document.getElementById( textareaID );
      var _fallback = function () {
        fallback = true;

        if ( textArea != null ) {
          textArea.focus();
          textArea.select();

          try {
            if ( document.execCommand( 'copy' ) ) {
              Success = true;
            } else {
              Error = 'Fallback: Copying text command was unsuccessful';
            }
          } catch ( err ) {
            Error = 'Fallback: Oops, unable to copy' + err;
          }
        } else Error = 'Fallback: Oops, unable to copy';

      };

      var ToClipboard = function ( text ) {
        if ( !navigator.clipboard ) _fallback();
      };
      var callbacks = function ( completeCallback, errorCallback ) {
        if ( typeof ( completeCallback ) == 'function' && Success ) completeCallback.call( this );
        else if ( typeof ( errorCallback ) == 'function' && Error ) errorCallback.call( this, Error );
      }

      ToClipboard( text );

      return {
        then: function ( completeCallback, errorCallback ) {
          if ( fallback ) callbacks( completeCallback, errorCallback );
          else {
            navigator.clipboard.writeText( text ).then( function () {
              if ( textArea ) {
                textArea.focus();
                textArea.select();
              }
              Success = true;
              callbacks( completeCallback, null );
              //Error = 'Async: Copying to clipboard was successful!';
            }, function ( err ) {
              Error = 'Async: Could not copy text: ' + err;
              callbacks( null, errorCallback );
            } );
          }
        }
      };
    }
    var Copi = ( function ( d ) {
      var copiObject, isReady = false;
      window.onload = function () {
        copiObject = document.getElementById( 'copiEmbed' );
        if ( !copiObject ) copiObject = document.getElementById( 'copiObject' );
        if ( copiObject )
          if ( copiObject.init() == 'v.tamil.lexicon.0.0.2' ) isReady = true;
      }
      this.getTextById = function ( id ) {
        if ( isReady ) {
          var txt = document.getElementById( id ).value,
            out = '';
          if ( txt && typeof ( txt ) == 'string' ) out = txt;
          return out;
        }
      }
      this.button = function ( swfSrc, elementID, width, height ) {
        var SWFHTML = '<div class="copi-button"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' + width + '" height="' + height + '" id="copiObject" title="Copi"><param name="movie" value="' + swfSrc + '"><param name="quality" value="high"><param name="wmode" value="opaque"><param name="swfversion" value="6.0.65.0"><param name="flashvars" value="elementID=' + elementID + '"><!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. --><!--[if !IE]>--><object type="application/x-shockwave-flash" data="' + swfSrc + '" width="' + width + '" height="' + height + '" id="copiEmbed"><!--<![endif]--><param name="flashvars" value="elementID=' + elementID + '"><param name="quality" value="high"><param name="wmode" value="opaque"><param name="swfversion" value="6.0.65.0"><!--[if !IE]>--></object><!--<![endif]--></object></div>';
        document.write( SWFHTML );
      };
      return this;
    } )( document );
  </script>
</head>

<body>
<div id="page">
  <main>
    <div id="doc-text">
      <h1>Unicode to Bamini</h1>
      <form>
        <textarea id="doc-textarea" placeholder="here" class="texta" value='கவிதை'></textarea>
        <textarea id="tmp-text" placeholder="" class="texta"></textarea>
        <div class="action-bar">
          <div class="inner-control">
            <button id="covert" type="button" class="green-btn">Convert</button>
            <button type="reset">Clear</button>
            <a href="#!" class="btn copy-btn white-btn">Copy Text</a> </div>
        </div>
      </form>
    </div>
  </main>
</div>
</body>
</html>
?>