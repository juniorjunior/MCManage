<?php

require '../header.php';
require_login();
require_ACL(ACL_PLAYERS, BASICHTML);

// 39219b8f-01b6-4b2d-8e2f-3d86b2a58764

/* <?xml version="1.0" encoding="UTF-8" ?> */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>NBT Editor</title>
    
    <script type="text/javascript" src="src/TagLibrary.js"></script>
    <script type="text/javascript" src="src/HighlightedString.js"></script>
    <script type="text/javascript" src="src/App.js"></script>
    
    <link rel="stylesheet" href="style/app.css" />
    
    <link rel="stylesheet" href="lib/jstree/dist/themes/default/style.min.css" />
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="lib/jstree/dist/jstree.min.js"></script>
    
    <script type="text/javascript" src="lib/FileSaver.min.js"></script>
    <script type="text/javascript" src="loadplayer.js"></script>
    
    <script type="text/javascript">
    //<![CDATA[
      
      var testInterval; // Hard to tell when Emscripten will be ready.
      function testEmscripten() {
        if(Module.Tag === undefined) return;
        clearInterval(testInterval);
        
        Module.TOTAL_MEMORY = 64 * 1024 * 1024;
        Dependencies.handleLoaded(DEP_EMSCRIPTEN);
      }
      
      var Module = { preRun:[] };
      Module['preRun'].push(function() {
        testInterval = setInterval(testEmscripten, 50);
      });
      
      window.addEventListener('load', function() {
        Dependencies.handleLoaded(DEP_WINDOW);
      });
      
    //]]>
    </script>
    <script type="text/javascript" src="NBT.js"></script>
  </head>
  <body>
    <div id="drop_zone">
      <span>Drop file here</span>
      <div id="contact" style="font-size:12px;position:fixed;bottom:10px;right:20px;opacity:0.8;">
        Feedback? <a href="http://irath96.github.io/contact/">Contact me</a>
      </div>
    </div>
    <script>
      
      function handleFileSelect(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        
        var files = evt.dataTransfer.files; // FileList object.
        for (var i = 0, f; f = files[i]; ++i) {
          var reader = new FileReader();
          
          // Closure to capture the file information.
          reader.onload = (function(file) {
            lastFilename = file.name;
            return function(e) {
              loadData(e.target.result);
            };
          })(f);
          
          // Read in the image file as a data URL.
          reader.readAsBinaryString(f);
        }
          
        document.querySelector('#drop_zone').style.display = 'none';
      }
      
      function handleDragOver(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
      }
      
      // Setup the dnd listeners.
      var dropZone = document.getElementById('drop_zone');
      dropZone.addEventListener('dragover', handleDragOver, false);
      dropZone.addEventListener('drop', handleFileSelect, false);
      
    </script>
    <div id="topbar">
      <div id="buttons">
        <input id="open_btn" type="button" value="Open" onclick="javascript:location.href = location.href;" />
        <input id="save_btn" type="button" value="Save" onclick="javascript:App.save();" />
        <input id="toggle_hexview_btn" type="button" value="&gt;" onclick="javascript:App.toggleHexview(this);" />
      </div>
      <div id="search_bar">
        <input type="text" id="search_field" placeholder="Search..." />
      </div>
    </div>
    <div id="screen">
      <div id="tree"></div>
    </div>
    <pre id="hexview">data</pre>
  </body>
</html>
