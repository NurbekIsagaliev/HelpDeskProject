<?php

class Schedule extends Model
{
    protected function content($content)
    {
        ?>

<div class="text-center fs-3 pt-5">Сетка расписания</div>

<table class="table table-bordered">
    <thead>
        <tr class="table-secondary">
            <th scope="col">Номер рейса</th>
            <th scope="col">Страна вылета</th>
            <th scope="col">Город вылета</th>
            <th scope="col">Страна прилета</th>
            <th scope="col">Город прилета</th>
            <th scope="col">Пн</th>
            <th scope="col">Вт</th>
            <th scope="col">Ср</th>
            <th scope="col">Чт</th>
            <th scope="col">Пт</th>
            <th scope="col">Сб</th>
            <th scope="col">Вс</th>
        </tr>
    </thead>
    <tbody>

        <?php
foreach ($content['flights'] as $flight) {
            ?>
        <tr>
            <td>
                <?=$flight["flightno"]?>
            </td>
            <td>
                <?=$flight["country_from"]?>
            </td>
            <td>
                <a href="?filter=from&city=<?=$flight["city_from"]?>">
                    <?=$flight["city_from"]?>
                </a>
            </td>
            <td>
                <?=$flight["country_to"]?>
            </td>
            <td>
                <a href="?filter=to&city=<?=$flight["city_to"]?>">
                    <?=$flight["city_to"]?>
                </a>
            </td>
            <?php
$bool = boolval($flight['monday']);

            $output = $bool ? '<td class="table-success">Да</td>' : '<td class="table-danger">Нет</td>';

            echo $output;
            ?>
            <?php
$bool = boolval($flight['tuesday']);

            $output = $bool ? '<td class="table-success">Да</td>' : '<td class="table-danger">Нет</td>';

            echo $output;
            ?>
            <?php
$bool = boolval($flight['wednesday']);

            $output = $bool ? '<td class="table-success">Да</td>' : '<td class="table-danger">Нет</td>';

            echo $output;
            ?>
            <?php
$bool = boolval($flight['thursday']);

            $output = $bool ? '<td class="table-success">Да</td>' : '<td class="table-danger">Нет</td>';

            echo $output;
            ?>
            <?php
$bool = boolval($flight['friday']);

            $output = $bool ? '<td class="table-success">Да</td>' : '<td class="table-danger">Нет</td>';

            echo $output;
            ?>
            <?php
$bool = boolval($flight['saturday']);

            $output = $bool ? '<td class="table-success">Да</td>' : '<td class="table-danger">Нет</td>';

            echo $output;
            ?>
            <?php
$bool = boolval($flight['sunday']);

            $output = $bool ? '<td class="table-success">Да</td>' : '<td class="table-danger">Нет</td>';

            echo $output;
            ?>
        </tr>
        <?php
}
        ?>
    </tbody>
</table>
<?php
if (count($content['flights']) >= 10) {
            $content['pagination']->render();
        }
    }
}