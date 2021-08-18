<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página não encontrada</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./dist/css/404.css">
</head>

<body>
    <div id="wrap">
        <div id="wordsearch">
            <ul>
                <li>k</li>

                <li>z</li>

                <li>a</li>

                <li>f</li>

                <li>l</li>

                <li>o</li>

                <li>s</li>

                <li>v</li>

                <li>w</li>

                <li>k</li>

                <li class="one">4</li>

                <li class="two">0</li>

                <li class="three">4</li>

                <li>k</li>

                <li>k</li>

                <li>v</li>

                <li>n</li>

                <li>z</li>

                <li>i</li>

                <li>x</li>

                <li>i</li>

                <li>f</li>

                <li>g</li>

                <li>a</li>

                <li>x</li>

                <li>l</li>

                <li>y</li>

                <li>y</li>

                <li class="four">p</li>

                <li class="five">a</li>

                <li class="six">g</li>

                <li class="seven">e</li>

                <li>q</li>

                <li>b</li>

                <li>p</li>

                <li>h</li>

                <li>a</li>

                <li>z</li>

                <li>v</li>

                <li>w</li>

                <li>i</li>

                <li class="eight">n</li>

                <li class="nine">o</li>

                <li class="ten">t</li>

                <li>r</li>

                <li>e</li>

                <li>u</li>

                <li>s</li>

                <li>c</li>

                <li>e</li>

                <li>w</li>

                <li>v</li>

                <li>x</li>

                <li>e</li>

                <li>p</li>

                <li>c</li>

                <li>f</li>

                <li>h</li>

                <li>q</li>

                <li class="eleven">f</li>

                <li class="twelve">o</li>

                <li class="thirteen">u</li>

                <li class="fourteen">n</li>

                <li class="fifteen">d</li>

                <li>z</li>

                <li>s</li>

                <li>w</li>

                <li>q</li>

                <li>v</li>

                <li>o</li>

                <li>s</li>

                <li>m</li>
            </ul>
        </div>

        <div id="main-content">
            <h1>Não foi possível encontrar o que procurava.</h1>

            <p>Infelizmente, a página que procurava não foi encontrada. Ela pode estar temporariamente indisponível, movido ou não existir mais.</p>

            <p>Verifique se há erros no URL inserido e tente novamente. Alternativamente, pesquise o que está faltando ou dê uma olhada no resto do nosso site.</p>


            <div id="navigation">
                <a class="navigation" href="./user/materiais.php">Início</a>
            </div>
        </div>
    </div>

    <!-- Jquery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        $(function() {
            var liWidth = $("li").css("width");
            $("li").css("height", liWidth);
            $("li").css("lineHeight", liWidth);
            var totalHeight = $("#wordsearch").css("width");
            $("#wordsearch").css("height", totalHeight);
        });
        causeRepaintsOn = $("h1, h2, h3, p");
        $(window).resize(function() {
            causeRepaintsOn.css("z-index", 1);
        });
        $(window).on("resize", function() {
            var liWidth = $(".one").css("width");
            $("li").css("height", liWidth);
            $("li").css("lineHeight", liWidth);
            var totalHeight = $("#wordsearch").css("width");
            $("#wordsearch").css("height", totalHeight);
        });

        $(function() {
            /* 4 */
            $(this)
                .delay(1500)
                .queue(function() {
                    $(".one").addClass("selected");
                    $(this).dequeue();
                })
                /* 0 */
                .delay(500)
                .queue(function() {
                    $(".two").addClass("selected");
                    $(this).dequeue();
                })
                /* 4 */
                .delay(500)
                .queue(function() {
                    $(".three").addClass("selected");
                    $(this).dequeue();
                })
                /* P */
                .delay(500)
                .queue(function() {
                    $(".four").addClass("selected");
                    $(this).dequeue();
                })
                /* A */
                .delay(500)
                .queue(function() {
                    $(".five").addClass("selected");
                    $(this).dequeue();
                })
                /* G */
                .delay(500)
                .queue(function() {
                    $(".six").addClass("selected");
                    $(this).dequeue();
                })
                /* E */
                .delay(500)
                .queue(function() {
                    $(".seven").addClass("selected");
                    $(this).dequeue();
                })
                /* N */
                .delay(500)
                .queue(function() {
                    $(".eight").addClass("selected");
                    $(this).dequeue();
                })
                /* O */
                .delay(500)
                .queue(function() {
                    $(".nine").addClass("selected");
                    $(this).dequeue();
                })
                /* T */
                .delay(500)
                .queue(function() {
                    $(".ten").addClass("selected");
                    $(this).dequeue();
                })
                /* F */
                .delay(500)
                .queue(function() {
                    $(".eleven").addClass("selected");
                    $(this).dequeue();
                })
                /* O */
                .delay(500)
                .queue(function() {
                    $(".twelve").addClass("selected");
                    $(this).dequeue();
                })
                /* U */
                .delay(500)
                .queue(function() {
                    $(".thirteen").addClass("selected");
                    $(this).dequeue();
                })
                /* N */
                .delay(500)
                .queue(function() {
                    $(".fourteen").addClass("selected");
                    $(this).dequeue();
                })
                /* D */
                .delay(500)
                .queue(function() {
                    $(".fifteen").addClass("selected");
                    $(this).dequeue();
                });
        });
    </script>
</body>

</html>