<?php

/*  
 *    Laragon index.php
 *    Author: Jaro Kurimsky
 *    Github: https://github.com/WpSpeedDoctor/
 *
 *    In http://localhost/ it displays all websites created in Laragon local WordPress environment
 *    If PHPMyAdmin is installed in folder phpmyadmin, it will add direct database access next for each website
 *
 *    Installation: Replace original index.php in laragon/www folder and change $domain for your local domain
 */

$domain = '.local';

$server = ($_SERVER['SERVER_SOFTWARE']);

$document_root = $_SERVER['DOCUMENT_ROOT'];

$folders = array_filter(glob('*' , GLOB_ONLYDIR)); 

$is_phpmyadmin_present = (in_array('phpmyadmin', $folders) ? true: false);

$url_lenght=0;

$url_longest=0;

$i=0;

$l='';

if (!empty($_GET['q']) and $_GET['q'] == 'info') {

    phpinfo(); 
    die;
}

if ( ! function_exists( 'get_websites_names_array' )){
    function get_websites_names_array( $folders ) {

        $letter = '';

        $result = array();

        foreach ($folders as $key => $value) {

            if ($value == 'phpmyadmin') continue;

            if ( $letter != $value['0'] )  $letter = $value['0'];

            $result[$letter][]= $value;

        }
    return $result;
    }
}

if ( ! function_exists( 'the_db_link' )){
    function the_db_link( $name ) {
        global $domain; 

        echo 'http://phpmyadmin'.$domain.'/db_structure.php?server=1&db='.$name;

    }
}

if ( ! function_exists( 'the_website_url' )){
    function the_website_url($name) {
        global $domain;
        
        echo 'http://'.strtolower($name).$domain.'/';
    
    }
}

$websites_names_array = get_websites_names_array( $folders );

?>
<!DOCTYPE html>
<html>
    <head>
    <title>Laragon</title>

        <!-- <link href="https://fonts.googleapis.com/css?family=Karla:400" rel="stylesheet" type="text/css"> -->

    <style>

    html,body {
        height:100%;
        width: 100%;
    }

    body {
        width:100%;
        display:block;
        font-weight:100;
        font-family:Verdana;
        background:linear-gradient(45deg,#405de6,#5851db,#833ab4,#c13584,#e1306c,#fd1d1d);
        margin:0;
        padding:0;
    }

    h2 {
        margin:0 0 5px;
    }

    .container {
        text-align:center;
        width:fit-content;
        margin:auto;
        padding: 0 2% 0 2%;
    }

    .content {
        line-height:1.3;
    }

    .title {
        font-size:70px;
        color:#F5DEB3;
    }

    a, a:visited {
        color: blue;
    }

    a:hover {
        color:#FFF;
        text-shadow:#000 1px 1px 6px;
    }

    .websites {
        text-align:left;
        margin-top:29px;
        display:inline;
    }

    .letter-wrap {
        display:inline-block;
        vertical-align:text-top;
        background-color:rgba(255,255,255,0.49);
        border-radius:20px;
        margin:1% 1% 1% 0;
        padding:15px;
    }

    .letter-column {
        display:grid;
        margin-right: 10px;
    }
    
    .letter-column:last-child {
        margin-right: 0;
    }

    .column-wrap {
        display: flex;
    }

    .title {
        width: -webkit-fit-content;
        width: -moz-fit-content;
        width: fit-content;
        margin: auto;
        align-items: center;
    }
    
    .info {
        line-height: 1.7;
    }
    
    svg{
        margin-right: 20px;
    }

    </style>
    
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="column-wrap title">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="60px" height="60px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                    <g>
                        <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="12.0835" y1="1.7188" x2="12.0835" y2="22.5">
                            <stop  offset="0.0181" style="stop-color:#3BB6FF"/>
                            <stop  offset="0.3023" style="stop-color:#39AFFF"/>
                            <stop  offset="0.5519" style="stop-color:#36A3FF"/>
                            <stop  offset="0.7173" style="stop-color:#359FFF"/>
                            <stop  offset="0.8316" style="stop-color:#3398FF"/>
                            <stop  offset="0.9639" style="stop-color:#3297FF"/>
                        </linearGradient>
                        <path fill="url(#SVGID_1_)" d="M0.838,8.631c0.041-0.123,1.769-6.05,8.613-6.133c0,0,2.87-3.246,6.78,0
                            c0,0,1.061,0.872,1.643,2.682c0,0,5.134,0.779,5.965,5.022c0,0,1.732,6.987-4.133,11.896c0,0-0.826,0.661-1.376,0.968
                            c0,0-1.22,0.002-1.472,0c-0.537-0.004-0.876,0-1.364,0c0,0-0.75-0.268-0.781-1.125c0,0-0.063-2.98-0.046-3.495
                            c0,0,0.015-0.482-0.687-0.452c0,0-0.67-0.077-0.765,0.499c0,0-0.016,3.074-0.031,3.619c0,0-0.047,0.907-1.061,0.951
                            c0,0-3.635,0.11-4.118-0.062c0,0-0.842-0.156-0.905-0.952c0,0-0.687-4.056-0.811-5.318c0,0-2.309-1.28-2.777-1.623
                            c0,0,0.156,4.133,1.591,5.881c0,0,0.25,0.219-0.25,0.53c0,0-0.187,0.156-0.375,0.064c0,0-6.155-3.438-3.888-12.213"/>
                        <path fill="#006699" d="M7.728,14.285c0,0,5.37,3.061,8.619-1.853c0,0,2.631-3.436,1.583-7.101c0,0,1.845,3.08-1.725,7.859
                            C16.206,13.191,13.178,17.451,7.728,14.285z"/>
                        <path fill="#CEE6FF" d="M5.603,13.563c0,0,0.383,1.773-0.795,2.331c0,0-2.68-1.104-2.409-3.143c0,0,0.084-0.509,0.583-0.197
                            c0,0,1.186,0.645,2.122,0.831C5.103,13.385,5.579,13.429,5.603,13.563z"/>
                        <path fill="#006699" d="M4.859,10.566c0,0,0.404-1.727,1.929-1.618c0,0,1.296,0.035,1.342,1.817
                            C8.13,10.766,7.109,8.1,4.859,10.566z"/>
                    </g>
                    </svg>
                    <div class="title" title="Laragon">Laragon</div>
                </div>
                <div class="info">
                      <?php echo $server; ?><br>
                      <a href="/?q=info">PHP version: <?php echo phpversion(); ?> info here</a><br>
                      Document Root: <?php echo $document_root; ?><br>
                </div>
            </div>

            <div class="websites">
            <?php

            foreach ( $websites_names_array as $first_letter => $websites_letter ) {
               ?>
                <div class="letter-wrap">
                    
                    <h2><?php echo strtoupper($first_letter); ?></h2>
                    
                    <div class="column-wrap">
                        <div class="letter-column">

                            <?php
                            foreach ($websites_letter as $key => $value) {
                                ?>

                                <a href="<?php the_website_url($value); ?>">

                                    <?php the_website_url($value) ?>
                                
                                </a>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="letter-column db-column">
                            <?php

                            foreach ($websites_letter as $key => $value) {
                                ?>

                                <a href="<?php the_website_url($value); echo 'wp-admin/' ?>">Admin</a>
                                
                                <?php
                            }

                            ?>
                        </div>
                        <?php
                        if ($is_phpmyadmin_present) {
                            ?>
                            <div class="letter-column db-column">
                                <?php

                                foreach ($websites_letter as $key => $value) {
                                    ?>

                                    <a href="<?php the_db_link( $value ); ?>">DB</a>
                                    
                                    <?php
                                }

                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
               <?php

            }
            ?>
            </div>
        </div>
    </body>
</html>
