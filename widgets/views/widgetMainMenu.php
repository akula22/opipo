<?php
use yii\helpers\Html;
use yii\widgets\Menu;
?>


<section id="mainmenu-container">
    <a class="toggleMenu" href="#">Menu</a>
        <nav>
<?=
Menu::widget([
	'encodeLabels' => false,
    // 'itemOptions' => [
    //     'tag' => 'strong',
    // ],
    'options' => [
        // 'class' => 'navbar-nav nav',
        'id'=>'mainmenu',
        // 'style'=>'font-size: 14px;',
        // 'tag'=>'span',
    ],
    'activateParents' => true,
    'items' => [
        [
            'label' => '<span>' . Yii::t('main', 'Main') . '</span>', 
            'url' => ['/site/default/index']
        ],
        [
            'label' => '<span>' . Yii::t('main', 'Signup') . '</span>', 
            'url' => ['/user/signup/signup'],

            'items' => [
                [
                    'label' => '<span>' . Yii::t('main', 'Signup') . '</span>', 
                    'url' => ['/user/signup/signup'],
                ],
            ],
        ],
        [
            'label' => '<span>' . Yii::t('main', 'Users') . '</span>', 
            'url' => ['/user/default/index'],

            'items' => [
                [
                    'label' => '<span>' . Yii::t('main', 'Signup') . '</span>', 
                    'url' => ['/user/signup/signup'],
                ],
            ],
        ],

        [
            'label' => '<span>' . Yii::t('main', 'Feedback') . '</span>', 
            'url' => ['/site/default/index']
        ],
    ],
]);
?>
    </nav>
</section>
<!-- <section id="mainmenu-container">
            <a class="toggleMenu" href="#">Menu</a>
            <nav>
                <ul id="mainmenu">
                    <li>
                        <a href="/">
                            <span>Homepage</span>
                        </a>
                        <ul>
                            <li>
                                <a href="/site/default/board">
                                    <span>Доска</span>
                                </a>
                            </li>
                            <li>
                                <a href="index2.html">
                                    <span>You Tube TV</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>

                        <a href="/user/default/index">
                            <span>Игроки</span>
                        </a>
                        <ul>
                            <li>
                                <a href="club.html">
                                    <span>Our Club</span>
                                </a>
                            </li>
                            <li>
                                <a href="team.html">
                                    <span>Our Team</span>
                                </a>
                            </li>
                            <li>
                                <a href="features.html">
                                    <span>Features</span>
                                </a>
                            </li>
                            <li>
                                <a href="layout.html">
                                    <span>Layout</span>
                                </a>
                            </li>
                            <li>
                                <a href="fixtures.html">
                                    <span>Fixtures</span>
                                </a>
                            </li>
                            <li>
                                <a href="result.html">
                                    <span>Match Result</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span>Dropdown</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="#">
                                            <span>Item 1</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span>Item 2</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span>Item 3</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span>Item 4</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="galleries.html">
                            <span>Gallery</span>
                        </a>
                        <ul>
                            <li>
                                <a href="galleries.html">
                                    <span>Galleries</span>
                                </a>
                            </li>
                            <li>
                                <a href="single-gallery.html">
                                    <span>Single Gallery</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/post/default/index">
                            <span>Blog</span>
                        </a>
                        <ul>
                            <li>
                                <a href="blog.html">
                                    <span>Blog</span>
                                </a>
                            </li>
                            <li>
                                <a href="single-post.html">
                                    <span>Single Post</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="contact.html">
                            <span>Contact</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </section> -->