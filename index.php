<?php
/**** START CONFIG ***************************************/

// The correct answers, in the order that you want them displayed.
$answers = array(
    'bulbasaur',
    'squirtle',
    'charmander',
    'pikachu'
);

// Answers hints. Keep the same order as the answers.
$hints = array(
    '#1 - Hint for card 1 goes here',
    '#2 - A hint for card 2',
    '#3 - Hint for card 3',
    '#4 - Pikaaaaa!'
);

// Cards to display when answered correctly. Same order as the answers.
$cards = array(
    '<i class="fa fa-check fa-3x"></i>',
    '<i class="fa fa-check fa-3x"></i>',
    '<i class="fa fa-check fa-3x"></i>',
    '<i class="fa fa-check fa-3x"></i>'
);

// Placeholder cards to display when no guess has been made or guessed incorrectly. Same order as the answers.
$placeholders = array(
    '<i class="fa fa-question-circle fa-3x"></i>',
    '<i class="fa fa-question-circle fa-3x"></i>',
    '<i class="fa fa-question-circle fa-3x"></i>',
    '<i class="fa fa-question-circle fa-3x"></i>'
);

/**** END CONFIG ***************************************/

function clean($data) { $data = trim(htmlentities(strip_tags($data))); return $data; }

$win = true;

foreach ( $answers as $key=>$answer ) {
    if ( isset($_POST['guesses'][$key]) && $_POST['guesses'][$key] !== '' ) {
        $guesses[$key] = clean($_POST['guesses'][$key]); 
    }
    if ( $answer !== $guesses[$key] ) {
        $win = false;
    }
}
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Guess the Card | Filler00</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div class="container">
        
            <h1>Guess the Card</h1>
            <p>Hover over the cards for hints!</p>
            
            <div class="f00-gtc-container">
                <?php
                foreach ( $answers as $key=>$answer ) {
                    if ( isset($guesses[$key]) && $guesses[$key] == $answer ) { ?>
                        <div class="f00-solved-card">
                            <?php echo $cards[$key]; ?>
                        </div>
                    <?php } else { ?>
                        <div class="f00-mystery-card <?php if ( isset($guesses[$key]) ) { echo 'warning'; } ?>" data-toggle="tooltip" title="<?php echo $hints[$key]; ?>">
                            <?php echo $placeholders[$key]; ?>
                        </div>
                    <?php }
                } 
                ?>

                <?php if ( $win == false ) { ?>
                
                <h2>Do you know the answer?</h2>
                <p>
                    Submit your answers below!
                    <br>(<em>bulbasaur, squirtle, charmander, pikachu</em>)
                </p>
                <form class="form-group col-md-6 col-md-offset-3" id="guess-the-card">
                    <?php foreach( $answers as $key=>$answer ) { ?>
                    <input type="text" name="guess<?php echo $key + 1; ?>" placeholder="Guess Card #<?php echo $key + 1; ?>" <?php if ( isset($guesses[$key]) ) { echo 'value="' . $guesses[$key] . '"'; } ?> class="form-control f00-gtc-guess <?php if ( isset($guesses[$key]) && $guesses[$key] !== $answer ) { echo 'f00-input-error'; } else if ( $guesses[$key] == $answer ) { echo 'f00-input-success'; } ?>">
                    <?php } ?>
                    
                    <input type="submit" name="submit" value="Guess!"class="btn btn-primary btn-lg btn-block">
                </form>
                
                <div class="clearfix"></div>
                
                <?php } else if ( $win == true ) { ?>
                
                    <p class="text-success">You won - nice work!</p>
                
                <?php } ?>
                
            </div> 
            
            <footer>
                <p>
                    Guess the Card by Bloo @ <a href="http://filler00.com">Filler00.com</a>.
                    <br>Free &amp; Open Source. Licensed under the <a href="http://opensource.org/licenses/MIT">MIT license</a>.
                    <br>View this project on <a href="https://github.com/tooblue/filler00-guess-the-card">GitHub</a> &amp; <a href="https://codio.com/tooblue/filler00-guess-the-card">Codio</a>. &hearts;
                </p>
            </footer>
        
        </div> <!-- /container -->
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
