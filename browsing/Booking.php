<?php

class Booking extends Model
{
    protected function content($content)
    {
        ?>
<div class="text-center fs-3 py-5">Список броней</div>
<table class="table table-bordered">
    <thead>
        <tr class="table-secondary">
            <th scope="col">Номер паспорта</th>
            <th scope="col">Имя</th>
            <th scope="col">Фамилия</th>
            <th scope="col">Страна вылета</th>
            <th scope="col">Город вылета</th>
            <th scope="col">Страна прилета</th>
            <th scope="col">Город прилета</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach ($content['bookings'] as $booking) {
            ?>
        <tr>
            <td>
                <?=$booking["passportno"]?>
            </td>
            <td>
                <a href="/passenger.php?id=<?=$booking['passenger_id']?>">
                    <?=$booking["lastname"];?>
                </a>
            </td>
            <td>
                <a href="/passenger.php?id=<?=$booking['passenger_id']?>">
                    <?=$booking["firstname"];?>
                </a>
            </td>
            <td>
                <?=$booking["country_from"];?>
            </td>
            <td>
                <a href="/schedule.php?filter=from&city=<?=$booking["city_from"];?>">
                    <?=$booking["city_from"];?>
                </a>
            </td>
            <td>
                <?=$booking["country_to"];?>
            </td>
            <td>
                <a href="/schedule.php?filter=to&city=<?=$booking["city_to"];?>">
                    <?=$booking["city_to"];?>
                </a>
            </td>
        </tr>
        <?php
}
        ?>
    </tbody>
</table>
<?php
$content['pagination']->render();
    }
}