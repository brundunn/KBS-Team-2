<!--    <!DOCTYPE html>-->
<!--        <html lang="en">-->
<!--    <head>-->
<!--        <meta charset="UTF-8">-->
<!--        <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--        <title>Mario Game</title>-->
<!--        <link rel="stylesheet" href="src/easteregg.css">-->
<!--    </head>-->
<!--        <body>-->
<!--            <div id="game">-->
<!--            <div id="mario"></div>-->
<!--            <div class="block"></div>-->
<!--            <div class="block"></div>-->
<!--        </div>-->
<!--        <script>-->
<!---->
<!--            document.addEventListener('DOMContentLoaded', function () {-->
<!--                const mario = document.getElementById('mario');-->
<!--                let isJumping = false;-->
<!---->
<!--                const blocks = document.querySelectorAll('.block');-->
<!---->
<!--                blocks.forEach(function (block) {-->
<!--                    block.addEventListener('click', function () {-->
<!--                        if (!isJumping) {-->
<!--                            block.style.background = 'transparent';-->
<!--                            spawnItem(block);-->
<!--                        }-->
<!--                    });-->
<!--                });-->
<!---->
<!--                document.addEventListener('keydown', function (event) {-->
<!--                    if (event.key === 'ArrowRight') {-->
<!--                        moveMario(10); // Beweeg naar rechts-->
<!--                    } else if (event.key === 'ArrowLeft') {-->
<!--                        moveMario(-10); // Beweeg naar links-->
<!--                    } else if (event.key === 'ArrowUp' && !isJumping) {-->
<!--                        jump(); // Spring als Mario niet al aan het springen is-->
<!--                    }-->
<!--                });-->
<!---->
<!--                function moveMario(distance) {-->
<!--                    const currentLeft = parseInt(window.getComputedStyle(mario).left);-->
<!--                    const newLeft = currentLeft + distance;-->
<!---->
<!--                    if (newLeft >= 0 && newLeft + mario.offsetWidth <= 800) {-->
<!--                        mario.style.left = newLeft + 'px';-->
<!--                    }-->
<!--                }-->
<!---->
<!--                function jump() {-->
<!--                    isJumping = true;-->
<!--                    let jumpHeight = 100;-->
<!--                    let jumpInterval = setInterval(function () {-->
<!--                        const currentBottom = parseInt(window.getComputedStyle(mario).bottom);-->
<!--                        if (currentBottom < jumpHeight) {-->
<!--                            mario.style.bottom = (currentBottom + 10) + 'px';-->
<!--                        } else {-->
<!--                            clearInterval(jumpInterval);-->
<!--                            // Terug naar de oorspronkelijke positie na het springen-->
<!--                            setTimeout(function () {-->
<!--                                let fallInterval = setInterval(function () {-->
<!--                                    const currentBottom = parseInt(window.getComputedStyle(mario).bottom);-->
<!--                                    if (currentBottom > 0) {-->
<!--                                        mario.style.bottom = (currentBottom - 10) + 'px';-->
<!--                                    } else {-->
<!--                                        mario.style.bottom = '0';-->
<!--                                        isJumping = false;-->
<!--                                        clearInterval(fallInterval);-->
<!--                                    }-->
<!--                                }, 20);-->
<!--                            }, 300); // Tijd voordat Mario begint te vallen-->
<!--                        }-->
<!--                    }, 20);-->
<!--                }-->
<!---->
<!--                function spawnItem(block) {-->
<!--                    const item = document.createElement('div');-->
<!--                    item.className = 'item';-->
<!--                    block.appendChild(item);-->
<!--                }-->
<!--            });-->
<!---->
<!--        </script>-->
<!--        </body>-->
<!--    </html>-->
