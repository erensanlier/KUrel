
<html>
<head>
    <title>Karel IDE</title>
    <script src="/karel/js/html/websiteImports.js"></script>
    <script>importCss();</script>
    <script>importJs();</script>
    <script src="/karel/lib/analytics.js"></script>
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-25118186-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex" href="{{ url('/') }}">
                <div class="pt-1"><img src="/img/karel.png" style="height: 20px; border-right: 1px solid #333333" class="pr-3"></div>
                <div class="pl-3">KUrel</div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="/karel/images/reference.png" target="_blank">Reference</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</div>

<div id ='mainIde' class = "inner">
    <div id="buttonBar">
        <div id = "buttonBarInner">
            <script>importButtonBar();</script>
        </div>
    </div>
    <div id = "mainIdeCenter" >
        <div id = 'mainIdeEditorDiv'>
            <script>importEditor('mainIdeEditor','mainIdeEditorDiv');</script>
        </div>
        <div id = 'mainIdeCanvasDiv' class = 'orange'>
            <canvas id = 'mainIdeCanvas' class = 'red'></canvas>
        </div>
    </div>
</div>

<div class="pl-5" style="margin-bottom: 50px">All rights belong to its rightful owner, Chris Piech. </div>

<script>
    function init() {
        var karelIde = null;

        var onReadyCalled = false;

        document.onready = function() {
            if (onReadyCalled) return;
            onReadyCalled = true;
            $("[title]").tooltip({ position: "bottom center", opacity: 0.9});

            initTabs();
            var canvas = document.getElementById('mainIdeCanvas');
            karelIde = KarelIde(window._editor, canvas, INITIAL_WORLD);

            $('#playButton').click(function(){karelIde.playButton()});
            $('#stopButton').click(function(){karelIde.stopButton()});
            $('#uploadButton').click(function(){deploy()});
            $('#worldSelector').change(
                function() {
                    var worldName = $("#worldSelector option:selected").text();
                    karelIde.changeWorld(worldName);
                }
            );
            window.onresize();
            var programKey = Server.getProgramKey();
            if (programKey) {
                var loadingScreen = new Boxy("<p>Loading</p>", {title: "Loading", closeable: false, modal:true});
                Server.loadProgramFromHash(function(data) {
                    loadingScreen.hideAndUnload();
                    programLoaded(data);
                });
            }
        }

        function deploy() {
            DeployDialog.createDeployDialog(karelIde)
        }

        function programLoaded(data) {
            var programObject = JSON.parse(data);
            var startWorld = programObject.world;
            var code = programObject.code;
            karelIde.setCode(code);
            karelIde.changeWorld(startWorld);
            var worldSelector = document.getElementById('worldSelector');
            for(var i = 0; i < worldSelector.length; i++) {
                if(worldSelector[i].text == startWorld) {
                    worldSelector.selectedIndex = i;
                }
            }
        }

        window.onhashchange = function() {
            Server.loadProgramFromHash(programLoaded);
        }

        window.onresize = function() {
            var windowHeight = $(window).height() - 1;
            var windowWidth = $(window).width() - 1;
            var ide = document.getElementById('mainIde');
            var editorDiv = document.getElementById('mainIdeEditorDiv');
            var canvas = document.getElementById('mainIdeCanvasDiv');
            var center = document.getElementById('mainIdeCenter');

            var ideHeight = windowHeight - Const.HEADER_HEIGHT;
            ide.style.height = (ideHeight -10)+ 'px';

            var centerHeight = ideHeight - Const.BUTTON_BAR_HEIGHT - Const.PADDING;
            var centerTop = Const.HEADER_HEIGHT + Const.BUTTON_BAR_HEIGHT;
            center.style.height = centerHeight + 'px';
            center.style.top = centerTop + 'px';

            var availibleWidth = windowWidth - 2 * Const.PADDING;
            var elementSpacing = 12;
            availibleWidth -= elementSpacing;

            var editorWidth = Math.max(Const.MIN_IDE_WIDTH, availibleWidth) / 2;

            editorDiv.style.width = editorWidth + 'px';
            ide.style.width = availibleWidth + 'px';
            center.style.width = availibleWidth - 10+ 'px';

            var canvasWidth = editorWidth;
            canvas.style.width = canvasWidth + 'px';
            canvas.style.left = (editorWidth + elementSpacing) + 'px';

            if (karelIde) {
                karelIde.resizeCanvas(canvasWidth, centerHeight);
            }
            if (window._editor) {
                window._editor.renderer.onResize();
            }
            ReferenceDialog.resize();
            DeployDialog.resize();
        }


    }
    init();
</script>

</body>
</html>
