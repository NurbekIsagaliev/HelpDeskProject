<?php

class Passenger extends Model
{
    protected function content($content)
    {
        ?>
<table class="table table-bordered">
    <thead>
        <tr class="table-secondary">
            <th scope="col">Фамилия</th>
            <th scope="col">Имя</th>
            <th scope="col">Общее Количество броней</th>
            <th scope="col">Вылеты</th>
            <th scope="col">Вылеты Страна</th>
            <th scope="col">Прилеты</th>
            <th scope="col">Прилеты Страна</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $max = max([count($content['countryFrom']), count($content['countryTo'])]);

        for ($i = 0; $i < $max; $i++) {

            $stat = [
                'firstname' => $content['passenger']['firstname'],
                'lastname' => $content['passenger']['lastname'],
                'booking_count' => $content['passenger']['booking_count'],
                'booking_count_to' => $content['countryTo'][$i]['booking_count_to'] ?? '',
                'country_to' => $content['countryTo'][$i]['country_to'] ?? '',
                'booking_count_from' => $content['countryFrom'][$i]['booking_count_from'] ?? '',
                'country_from' => $content['countryFrom'][$i]['country_from'] ?? '',
            ];
            ?>
        <tr>
            <td>
                <?=$stat['firstname']?>
            </td>
            <td>
                <?=$stat['lastname']?>
            </td>
            <td>
                <?=$stat['booking_count']?>
            </td>
            <td>
                <?=$stat['booking_count_to']?>
            </td>
            <td>
                <?=$stat['country_to']?>
            </td>
            <td>
                <?=$stat['booking_count_from']?>
            </td>
            <td>
                <?=$stat['country_from']?>
            </td>
        </tr>

        <?php
}

        ?>
    </tbody>
</table>
<?php
}
}