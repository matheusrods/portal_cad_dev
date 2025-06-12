<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var button = $("#addContent");
        var lorem = "<p>Proin cursus odio quis neque porttitor pretium. Duis cursus dolor mi, quis blandit eros dictum vitae. Mauris tempus turpis non leo commodo sagittis ac ac urna. Vivamus aliquet euismod posuere. Suspendisse at semper mauris. Phasellus blandit convallis tincidunt. Maecenas elementum ullamcorper risus, a vestibulum ex accumsan sed. Nulla facilisi.</p><p>Proin cursus odio quis neque porttitor pretium. Duis cursus dolor mi, quis blandit eros dictum vitae. Mauris tempus turpis non leo commodo sagittis ac ac urna. Vivamus aliquet euismod posuere. Suspendisse at semper mauris. Phasellus blandit convallis tincidunt. Maecenas elementum ullamcorper risus, a vestibulum ex accumsan sed. Nulla facilisi.</p><p>Proin cursus odio quis neque porttitor pretium. Duis cursus dolor mi, quis blandit eros dictum vitae. Mauris tempus turpis non leo commodo sagittis ac ac urna. Vivamus aliquet euismod posuere. Suspendisse at semper mauris. Phasellus blandit convallis tincidunt. Maecenas elementum ullamcorper risus, a vestibulum ex accumsan sed. Nulla facilisi.</p><p>Proin cursus odio quis neque porttitor pretium. Duis cursus dolor mi, quis blandit eros dictum vitae. Mauris tempus turpis non leo commodo sagittis ac ac urna. Vivamus aliquet euismod posuere. Suspendisse at semper mauris. Phasellus blandit convallis tincidunt. Maecenas elementum ullamcorper risus, a vestibulum ex accumsan sed. Nulla facilisi.</p>";
        button.click(function() {
            $("main button").before(lorem);
        });
    });   
</script>

<body>
    <header>
        <p>Just a sample header</p>
    </header>

    <main>
        <h3>Some sample content</h3>
        <p>Click on the <code>button</code> to see what i mean.</p>
        <p>When the <code>heigth</code> of the page dynamically changes, the <code>footer</code> will stay at its exact position.</p>
        <button id="addContent">Click to add more content</button>
    </main>

    <footer>
        <div class="rodape">
            <div class="topFooter">
                <img class="imgQrCode" src="/lib/img/qrCode.png"></img>
                <div class="textoRodape"><p>Converse com o nosso contatinho <br> (61) 4004-0001</p></div>
            </div>
            <div class="bottomFooter"><p>© Banco do Brasil S/A</p></div>
        </div>
    </footer>
</body>

<style>

/* Fonte BancoDoBrasilTextos */
@font-face { font-family: BancoDoBrasilTextos; font-style: normal; font-weight: normal; src: url('/lib/fonts/BancoDoBrasil/BancoDoBrasilTextos-Regular.ttf'); } 
@font-face { font-family: BancoDoBrasilTextos; font-weight: bold; src: url('/lib/fonts/BancoDoBrasil/BancoDoBrasilTextos-Bold.ttf');}
@font-face { font-family: BancoDoBrasilTextos; font-style: italic; src: url('/lib/fonts/BancoDoBrasil/BancoDoBrasilTextos-Italic.ttf');}
@font-face { font-family: BancoDoBrasilTextos; font-style: italic; font-weight: bold; src: url('/lib/fonts/BancoDoBrasil/BancoDoBrasilTextos-BoldIt.ttf');}

/* Fonte BancoDoBrasilTitulos */
@font-face { font-family: BancoDoBrasilTitulos; font-style: normal; font-weight: normal; src: url('/lib/fonts/BancoDoBrasil/BancoDoBrasilTitulos-Regular.ttf'); } 
@font-face { font-family: BancoDoBrasilTitulos; font-weight: bold; src: url('/lib/fonts/BancoDoBrasil/BancoDoBrasilTitulos-Bold.ttf');}
@font-face { font-family: BancoDoBrasilTitulos; font-style: italic; src: url('/lib/fonts/BancoDoBrasil/BancoDoBrasilTitulos-Italic.ttf');}
@font-face { font-family: BancoDoBrasilTitulos; font-style: italic; font-weight: bold; src: url('/lib/fonts/BancoDoBrasil/BancoDoBrasilTitulos-BoldIt.ttf');}


* {
  box-sizing: border-box;
}

body {
    margin: 0;
    position: relative;
}

header {
    background: #333;
    color: #fff;
    padding: 25px;
}

main {
    padding: 25px;
}

main h3 {
    margin-top: 0;
}

code {
    background: #f1f1f1;
    padding: 0 5px;
}

footer {
    /* position: absolute; */
    right: 0;
    top: 80vh;
    left: 0;
    transform: translateY(100%);
}

.topFooter {
    font-family: BancoDoBrasilTextos;
    background-color: #735cc6;
    color: #FFFFFF;
    height: 15vh;
    display:flex;
    justify-content: center;
}

.textoRodape {
    padding-top: 5.5vh;
}

.bottomFooter {
    font-family: BancoDoBrasilTextos;
    font-weight: bold;
    color: #1653fd;
    background-color: #fcfc30;
}

.topFooter p {
    text-align: center;
    margin-top: 0;
    margin-bottom: 0;
}

.bottomFooter p {
    text-align: center;
    margin-top: 0;
    margin-bottom: 0;
}

.imgQrCode {
    width: 120px;
    height: 120px;
    margin: 1vh;
}
</style>