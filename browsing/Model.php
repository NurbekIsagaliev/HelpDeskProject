<?php

class Model
{

    private $menuItems = [

        [
            'link' => '/booking.php',
            'title' => 'Bookings',
        ],
        [
            'link' => '/passenger.php',
            'title' => 'Passenger',
        ],
        [
            'link' => '/schedule.php',
            'title' => 'Schedules',
        ],
    ];

    private $currUrl = '/';

    public function __construct()
    {
        $this->currUrl = $_SERVER['PHP_SELF'] ?? '/';
    }

    public function render($content = null)
    {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
            <title>rc_irlines</title>
        </head>

        <body>

            <div class="container-fluid my-5 mx-auto background-success">

                <?php

                $this->renderNav();

                if ($content !== null) {
                    $this->content($content);
                }
                ?>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        </body>

        </html>

    <?php
    }

    protected function content($content)
    {
        echo $content;
    }

    protected function renderNav()
    {
    ?>
        <nav class="nav  nav-pills nav-fill">
            <?php
            foreach ($this->menuItems as $value) {
            ?>
                <?php if ($this->currUrl === $value['link']) : ?>
                    <a class="nav-link active" href="<?= $value['link'] ?>"><?= $value['title'] ?></a>
                <?php else : ?>
                    <a class="nav-link" href="<?= $value['link'] ?>"><?= $value['title'] ?></a>
                <?php endif ?>
            <?php
            }
            ?>
        </nav>
<?php
    }
}
?>