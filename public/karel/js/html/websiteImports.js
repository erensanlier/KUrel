function importWebsiteHeader(selected) {
   var tabsData = {
      'learn.html':'Learn',
      'ide.html':'Karel IDE',
      'share.html':'Community',
   }
   var tabHtml = '';
   for (key in tabsData) {
      var className = (selected == key) ? "selectedtab" : "tab";
      var text = tabsData[key];
      tabHtml += '<a class='+className+' href="'+key+'" rel="nofollow">'+text+'</a>';
   }
   var html = '<div id="headerBackground">\
      <div id="header">        \
         <div class = "inner">\
            <a id="logo" href="learn.html" rel="nofollow"></a>  \
            <div id = "tabs"> ' + tabHtml + '\
               <span id = "social">\
               <iframe src="http://www.facebook.com/plugins/like.php?href=stanfordkarel.com&amp;layout=button_count&amp;show_faces=false&amp;width=90&amp;action=like&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:22px;" allowTransparency="true"></iframe>\
               </span>\
               <a class="smallLink" href="javascript:ReferenceDialog.createReferenceDialog()" rel="nofollow">Reference</a>\
            </div>\
         </div>\
      </div>\
   </div>';
   document.write(html);
}

function importCss() {
   var html = '<link rel="stylesheet" href="/karel/css/style.css" type="text/css" />';
   html += '<link rel="stylesheet" href="/karel/boxy/stylesheets/boxy.css" type="text/css" />';
   document.write(html);
}

/**
    * Function: Create Image Button
    * -------------
    * Makes a button with an image that lives in src. 
    * Returns the button
    */
   function createImageButton(parent, src, id, tooltip, specialClass) {
      var button = document.createElement('button');
      var buttonImage = document.createElement('img');
      buttonImage.setAttribute('src', src);
      buttonImage.setAttribute('height', 30);
      buttonImage.setAttribute('width', 30);
      button.appendChild(buttonImage);
      button.title = tooltip;
      button.id = id;
      button.className = 'interactor';
      if(specialClass){
         button.className = specialClass;
      }
      parent.appendChild(button);
      return button;
   }

   /**
    * Create Text Button
    * -------------
    * Makes a button with the given label 
    * Returns the button
    */
   function createTextButton(parent, label, id) {
      var button = document.createElement('button');
      button.innerHTML = label;
      button.id = id;
      parent.appendChild(button);
      return button;
   }

   function addText(parent, text) {
      parent.innerHTML += text;
   }

   function addSpace(parent) {
      addText(parent, '&nbsp;');
   }
   
   function addWorldDropDown(parent, specialId) {
      var worldDiv = document.createElement('div');
       worldDiv.setAttribute('style', 'margin-left: 510px');
      if (specialId) {
         worldDiv.id = specialId
      } else {
         worldDiv.id = 'worldDiv'
      }
      addText(worldDiv, 'World: '); 
      var worldSelector = document.createElement('select');
      
      worldSelector.id = 'worldSelector';
      worldSelector.setAttribute('name', 'world');
      worldSelector.setAttribute('size', 0);
      worldDiv.appendChild(worldSelector);
      parent.appendChild(worldDiv);

      for(var i = 0; i < WORLDS.length; i++ ) {
         worldName = WORLDS[i];
         var optionElem = document.createElement('option');
         optionElem.setAttribute('value', i);
         optionElem.innerHTML = worldName;
         if (worldName == INITIAL_WORLD) {
            optionElem.setAttribute('selected', 'yes');
         }
         worldSelector.appendChild(optionElem);
      }
      return worldSelector;
   }
   
function importEditor(id, parentId) {
   var code = document.createElement('div');
   code.innerHTML = STARTER_CODE;
   code.id        = id;
   var editorDiv = document.getElementById(parentId);
   editorDiv.appendChild(code); 
   var editor = ace.edit(id);
   editor.setTheme('ace/theme/jeremys');
   var JavaScriptMode = require("ace/mode/javascript").Mode;
   editor.getSession().setMode(new JavaScriptMode());
   editor.setReadOnly(false);
   // this line turns off automatic error detection
   editor.getSession().setUseWorker(false);
   code.style.fontSize='16px';
   window._editor = editor;
   return editor; 
}

function importButtonBar() {
   var buttonBar = document.getElementById('buttonBarInner');
   //addSpace(buttonBar);
   var playButton = createImageButton(buttonBar, '/karel/images/playButton.png', 'playButton', 'Run');
   //addSpace(buttonBar);
   var stopButton = createImageButton(buttonBar, '/karel/images/stopButton.png', 'stopButton', 'Reset');
   //addSpace(buttonBar);
   var worldSelector = addWorldDropDown(buttonBar, 'programWorldDrop');
}

function importScripts(list) {
   var html = '';
   for (var i = 0; i < list.length; i++) {
      html += list[i];
   }
   document.write(html);
}

function importJsLibraries() {
   var scripts = [
      '<script src="/karel/lib/jquery.js"></script>',
      '<script src="/karel/lib/browser_detect.js"></script>',
      '<script src="/karel/lib/util.js"></script>',
      '<script src="/karel/lib/tabs.js"></script>',
      '<script src="/karel/ace/ace-uncompressed.js"></script>',
      '<script src="/karel/ace/theme-jeremys.js"></script>',
      '<script src="/karel/ace/mode-javascript.js"></script>',
      '<script src="/karel/lib/curvycorners.js"></script>',
	  '<script src="/karel/lib/jquery.js"></script>',
      //'<script src="http://cdn.jquerytools.org/1.2.5/jquery.tools.min.js"></script>',
      '<script src="/karel/boxy/jquery.boxy.js"></script>',
   ]
   importScripts(scripts);
}


function importKarelIde() {
   var scripts = [
		'<script src="/karel/js/ide/karelImages.js"></script>',
		'<script src="/karel/js/ide/karelSingleton.js"></script>',
		'<script src="/karel/js/ide/karelConstants.js"></script>',
		'<script src="/karel/js/ide/action.js"></script>',
		'<script src="/karel/js/ide/beepers.js"></script>',
		'<script src="/karel/js/ide/walls.js"></script>',
		'<script src="/karel/js/ide/squareColors.js"></script>',
		'<script src="/karel/js/ide/canvasModel.js"></script>',
		'<script src="/karel/js/ide/karelModel.js"></script>',
		'<script src="/karel/js/ide/karelView.js"></script>',
		'<script src="/karel/js/ide/karel.js"></script>',
		'<script src="/karel/js/ide/karelCompiledEngine.js"></script>',
		'<script src="/karel/js/ide/karelEvalEngine.js"></script>',
		'<script src="/karel/js/ide/karelIde.js"></script>',
		'<script src="/karel/js/html/starterCode.js"></script>',
		'<!--<script src="./js/ide/mainIdeController.js"></script>-->',
	]
	importScripts(scripts);
		
}

function importCompiler() {
   var scripts = [ 
      '<script src="/karel/js/compiler/karelCompiler.js"></script>',
      '<script src="/karel/js/compiler/scanner/TokenScanner.js"></script>',
      '<script src="/karel/js/compiler/parser/Parser.js"></script>',
      '<script src="/karel/js/compiler/parser/XParser.js"></script>',
      '<script src="/karel/js/compiler/vm/VM.js"></script>',
      '<script src="/karel/js/compiler/vm/XVM.js"></script>',
      '<script src="/karel/js/compiler/karel/KarelParser.js"></script>',
      '<script src="/karel/js/compiler/karel/KarelVM.js"></script>'
   ]
   importScripts(scripts);	
}

function importLearnEngine() {
   var scripts = [

		'<script src="/karel/js/learn/makeAbsoluteDiv.js"></script>',
		'<script src="/karel/js/learn/unitProgress.js"></script>',
		'<script src="/karel/js/learn/progressModel.js"></script>',
		'<script src="/karel/js/learn/lessonsModel.js"></script>',
		'<script src="/karel/js/learn/homeScreen.js"></script>',
		'<script src="/karel/js/learn/textElement.js"></script>',
		'<script src="/karel/js/learn/textButton.js"></script>',
		'<script src="/karel/js/learn/unitBox.js"></script>',
		'<script src="/karel/js/learn/imageElement.js"></script>',
		'<script src="/karel/js/learn/unitTestElement.js"></script>',
		'<script src="/karel/js/learn/textBox.js"></script>',
		'<script src="/karel/js/learn/videoElement.js"></script>',
		'<script src="/karel/js/learn/karelCommandButton.js"></script>',
		'<script src="/karel/js/learn/karelEditorElement.js"></script>',
		'<script src="/karel/js/learn/karelStaticCanvasElement.js"></script>',
		'<script src="/karel/js/learn/karelCanvasElement.js"></script>',
		'<script src="/karel/js/learn/karelIdeMessage.js"></script>',
		'<script src="/karel/js/learn/karelIdeButtons.js"></script>',
		'<script src="/karel/js/learn/karelIdeElement.js"></script>',
		'<script src="/karel/js/learn/programElement.js"></script>',
		'<script src="/karel/js/learn/imageButton.js"></script>',
		'<script src="/karel/js/learn/content.js"></script>',
		'<script src="/karel/js/learn/centerArea.js"></script>',
		'<script src="/karel/js/learn/titleElement.js"></script>',
		'<script src="/karel/js/learn/header.js"></script>',
		'<script src="/karel/js/learn/progressBox.js"></script>',
		'<script src="/karel/js/learn/progressBar.js"></script>',
		'<script src="/karel/js/learn/karelLearnEngine.js"></script>',
	]
	importScripts(scripts);	
}

function importController() {
   var scripts = [
		'<script src="/karel/js/server/server.js"></script>',
	]
	importScripts(scripts);
}


function importJs() {
   importJsLibraries();
   importController();
   importCompiler();
   importKarelIde();
}
