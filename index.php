<!--<link rel="stylesheet" type="text/css" href="/public/css/comments.css">-->
<?php //if (isset($_SESSION['user']) && $_SESSION['user']['activate'] === '0') $_SESSION['error'] = 'For comment and like images, you need to activate your account'; ?>
<!--<center>-->
<!--    <div class="gallery">-->
<!--        --><?php //if (!empty($images)): ?>
<!--            <div class="container">-->
<!--                --><?php //foreach ($images as $image): ?>
<!--                    --><?php //if (file_exists(ROOT . '/public/images/'. $image['image'])): ?>
<!--                        <div class="item">-->
<!--                            <label class="invisible" for="title">User picture --><?//=$image['login']?><!--</label>-->
<!--                            <a href="#modal">-->
<!--                                <img class="front" width="300" src="--><?//= '/public/images/'. $image['image']; ?><!--" alt="">-->
<!--                                <span class="back"></span>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                    --><?php //endif; ?>
<!--                --><?php //endforeach; ?>
<!--            </div>-->
<!--        --><?php //else: ?>
<!--            <p>No images yet</p>-->
<!--        --><?php //endif; ?>
<!---->
<!--        <div class="clear"></div>-->
<!--        --><?php //if ($pagination->countPages > 1): ?>
<!--            --><?//= $pagination ?>
<!--        --><?php //endif; ?>
<!--    </div>-->
<!--</center>-->
<!--<script src="/public/js/modal.js"></script>-->
<!--<div class="modal" id="modal"></div>-->

<!--<form method="get" action="/main/findBooking">-->
<!--    <div>-->
<!--        <input name="city" placeholder="Where are you going?" type="text">-->
<!--    </div>-->
<!--    <div>-->
<!--        <input type="date">-->
<!--    </div>-->
<!--    <button type="submit" name="submit" value="OK">Check booking</button>-->
<!--</form>-->

<?php

$city = '&ss=' . urlencode('киев');
$group_adults = '&group_adults=2'; // 1 - 30 // Кількість дорослих
$group_children = '&group_children=0'; // 0 - 10 // Кількість діте
$no_rooms = '&no_rooms=1'; // Кількість номерів 1 - 30
$age = '&age='; // на кожну дитину
$checkin_year = '&checkin_year=2019';
$checkin_month = '&checkin_month=03';
$checkin_monthday = '&checkin_monthday=24';
$checkout_year = '&checkout_year=2019';
$checkout_month = '&checkout_month=03';
$checkout_monthday = '&checkout_monthday=25';
$sb_travel_purpose = '&sb_travel_purpose=leisure'; // business || leisure

$language = '.uk'; // .uk .ru .en-gb

$res = array();

$site = 'https://www.booking.com/searchresults' . $language . '.html?' . $city . $group_adults . $group_children . $no_rooms . $checkin_year . $checkin_month . $checkin_monthday . $checkout_year . $checkout_month . $checkout_monthday . $sb_travel_purpose;

echo '<a href="' . $site . '">Booking</a>';

$data = file_get_html($site);
foreach ($data->find('a.hotel_name_link.url') as $hotels) {
    foreach ($hotels->find('span.sr-hotel__name') as $name) {
        $href = str_replace(' ', '', str_replace(';', '&', str_replace('html;', 'html?', $hotels->href)));
        $res[] = '<a href="https://www.booking.com' . $href . '">' . $name->plaintext . '</a>';
    }
}
debug($res);
$data->clear();
unset($data);