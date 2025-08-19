<style>
    .flatpickr-months .flatpickr-month {
        height: 45px !important;
    }

    html {
        scroll-behavior: smooth;
    }

    .flatpickr-current-month {
        height: 40px !important;
        font-size: 14px !important;
        display: flex !important;
        flex-direction: row !important;
        column-gap: 12px !important;
        justify-content: center !important;
    }

    .flatpickr-current-month .numInputWrapper {
        width: 9ch !important;
        height: 29px !important;
    }

    .flatpickr-current-month input.cur-year {
        padding: 6px 6px !important;
    }

    .multi_step_form #msform {
        width: 100% !important;
    }

    .multi_step_form input[type="radio"]+label,
    .action-button {
        background:
            <?php echo get_option('moversco_buttons_color', '#f1f1f1') ?>
            !important;
        color:
            <?php echo get_option('moversco_button_text_color', '#f1f1f1') ?>
            !important;
        border: 1px solid
            <?php echo get_option('moversco_border_color', '#000'); ?>
            !important;
    }


    .multi_step_form input[type="radio"]+label:hover,
    .action-button:hover {
        background:
            <?php echo get_option('moversco_buttons_hover_color', '#f1f1f1') ?>
            !important;
        color:
            <?php echo get_option('moversco_text_hover_color', '#f1f1f1') ?>
            !important;
        border: 1px solid
            <?php echo get_option('moversco_border_hover_color', '#000'); ?>
            !important;
    }

    .multi_step_form #msform #progressbar li.active {
        color:
            <?php echo get_option('moversco_border_hover_color', ' #D10028'); ?>
        ;
    }

    .multi_step_form #msform #progressbar li.active:before,
    .multi_step_form #msform #progressbar li.active:after {
        background:
            <?php echo get_option('moversco_form_background_color', ' #D10028'); ?>
        ;
        color: #fff;
    }

    .multi_step_form input[type="radio"]:checked+label {
        background:
            <?php echo get_option('moversco_border_hover_color', 'red') ?>
            !important;
        color:
            <?php echo get_option('moversco_text_hover_color', '#f1f1f1') ?>
            !important;
        border: 1px solid
            <?php echo get_option('moversco_border_hover_color', '#226fb7'); ?>
            !important;
        box-shadow: 0 0 0 1px
            <?php echo get_option('moversco_border_hover_color', '#226fb7'); ?>
            !important;
        color: #fff !important;
    }

    /* Radio Styles */

    .eng-button,
    input[type="checkbox"]:checked+label {
        background:
            <?php echo get_option('moversco_border_hover_color', 'red') ?>
            !important;
        color: #fff !important;
        border: 1px solid
            <?php echo get_option('moversco_border_hover_color', '#000'); ?>
            !important;
        border-radius: 8px;
    }

    .eng-button,
    input[type="checkbox"]+label,
    .action-button {
        background:
            <?php echo get_option('moversco_buttons_color', '#f1f1f1') ?>
            !important;
        color:
            <?php echo get_option('moversco_button_text_color', '#f1f1f1') ?>
            !important;
        border: 1px solid
            <?php echo get_option('moversco_border_color', '#000'); ?>
            !important;
    }

    .eng-button:hover,
    input[type="checkbox"]+label:hover,
    .action-button:hover {
        background:
            <?php echo get_option('moversco_buttons_hover_color', '#f1f1f1') ?>
            !important;
        color:
            <?php echo get_option('moversco_text_hover_color', '#f1f1f1') ?>
            !important;
        border: 1px solid
            <?php echo get_option('moversco_border_hover_color', '#226fb7'); ?>
            !important;

    }

    .eng-button,
    input[type="checkbox"]:checked+label {
        background:
            <?php echo get_option('moversco_border_hover_color', '#226fb7') ?>
            !important;
        color: #fff !important;
        border: 1px solid
            <?php echo get_option('moversco_border_hover_color', '#226fb7'); ?>
            !important;
    }

    /* Radio Styles */

    .multi_step_form #msform fieldset .mvco-form-control:hover,
    .multi_step_form #msform fieldset .mvco-form-control:focus,
    .multi_step_form #msform fieldset .product_select:hover,
    .multi_step_form #msform fieldset .product_select:focus {
        border-color:
            <?php echo get_option('moversco_border_hover_color', '#000'); ?>
            !important;
    }

    .flatpickr-input {
        background: #fff !important;
    }

    .flatpickr-current-month input.cur-year {
        background: #fff !important;
    }

    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange,
    .flatpickr-day.selected.inRange,
    .flatpickr-day.startRange.inRange,
    .flatpickr-day.endRange.inRange,
    .flatpickr-day.selected:focus,
    .flatpickr-day.startRange:focus,
    .flatpickr-day.endRange:focus,
    .flatpickr-day.selected:hover,
    .flatpickr-day.startRange:hover,
    .flatpickr-day.endRange:hover,
    .flatpickr-day.selected.prevMonthDay,
    .flatpickr-day.startRange.prevMonthDay,
    .flatpickr-day.endRange.prevMonthDay,
    .flatpickr-day.selected.nextMonthDay,
    .flatpickr-day.startRange.nextMonthDay,
    .flatpickr-day.endRange.nextMonthDay {
        background: #226FB7 !important;
        border-color: #226FB7 !important;
        border-radius: 8px !important;
    }

    .flatpickr-day.inRange,
    .flatpickr-day.prevMonthDay.inRange,
    .flatpickr-day.nextMonthDay.inRange,
    .flatpickr-day.today.inRange,
    .flatpickr-day.prevMonthDay.today.inRange,
    .flatpickr-day.nextMonthDay.today.inRange,
    .flatpickr-day:hover,
    .flatpickr-day.prevMonthDay:hover,
    .flatpickr-day.nextMonthDay:hover,
    .flatpickr-day:focus,
    .flatpickr-day.prevMonthDay:focus,
    .flatpickr-day.nextMonthDay:focus {
        border-radius: 8px !important;
    }

    .numInputWrapper span {
        top: 14px !important;
        right: 4px !important;
    }

    .numInputWrapper span.arrowUp {
        top: 4px !important;
    }

    span.flatpickr-weekday,
    .flatpickr-weekdays,
    .flatpickr-months .flatpickr-month {
        background: #226FB7 !important;
        color: #000;
    }

    .numInputWrapper span {
        background: #226FB7 !important;
        opacity: 1 !important;
    }

    .multi_step_form input,
    .multi_step_form textarea,
    .multi_step_form label {
        font-size:
            <?php echo get_option('moversco_font_size', ' 16px'); ?>
            px !important;
    }

    .mvco-form-check-label {
        font-weight: 400 !important;
    }

    .action-button {
        background: #226fb7 !important;
        color: #fff !important;
    }

    .action-button:hover {
        background: #fff !important;
        color: #226fb7 !important;
        border: 1px solid #226fb7;
    }

    input:hover,
    textarea:hover,
    select:hover,
    .select2-container .select2-selection--single:hover {
        border: 1px solid #226fb7 !important;
    }
 /* Set the size of the maps */
    .map-container {
        height: 350px;
        width: 100%;
        margin-bottom: 30px;
        /* Space between maps */
    }

    .select2-container {
        vertical-align: super !important;
    }

    #updatedAddressFields {
        display: flex;
        flex-direction: row;
        gap: 20px;
        flex-wrap: wrap;
        /* Use nowrap to ensure all items stay on one row */
        justify-content: flex-start;
    }

    /* Style each child element */
    #updatedAddressFields>.flex-item {
        flex: 0 0 30%;
        /* Each item occupies 33.33% of the container's width */
        /* Optionally, add some padding or margins if needed */
    }

    .mvco-form-row-two {
        display:grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 10px;
    }

</style>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_option('moversco_google_maps_api_key', ''); ?>"
    async></script>



<!-- partial:index.partial.html -->
<!-- Multi step form -->
<section class="multi_step_form" id="formSection" data-id="<?php echo $id; ?>"
    data-session-id="<?php echo $session_id; ?>" style=''>

    <form id="msform">

        <?php if ($id == '' && $session_id == '') {
            ?>

        </form>
    </section>
    <?php
    return;
        } ?>


<!-- progressbar -->
<ul id="progressbar">
    <li data-i18n="verhuisroute" class="active">  <?php esc_html_e('VERHUISROUTE', 'moversco'); ?> </li>
    <li data-i18n="verhuisvolume" ><?php esc_html_e('VERHUISVOLUME', 'moversco'); ?></li>
    <li data-i18n="contactgegevens" ><?php esc_html_e('CONTACTGEGEVENS', 'moversco'); ?></li>
</ul>

<!-- Now We Are Gonna Add Languages -->
<div class="moversco-ui">
    <label for="language-toggle">Select Language:</label>
    <select id="language-toggle">
        <option value="en">English</option>
        <option value="du">Dutch</option>
    </select>
</div>

<!-- fieldsets -->
<fieldset class="mvco-fieldset">

    <div class="wpformeng custom-padding-wpform">

        <h3 data-i18n="number_of_addresses" ><?php esc_html_e('Number of Addresses', 'moversco'); ?></h3>
        <input type="text" id="apiUrl" value="<?php echo get_option('moversco_api_endpoint', 'example.co'); ?>" hidden>
        <div class="mvco-form-row">
            <div class="mvco-form-row first-selection">
                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" data-form-name="1 address" value="form-1" type="radio" name="adressen"
                        id="1adres" <?php echo ($numberOfAddresses == '1 address' || $numberOfAddresses == '1 adres') ? 'checked' : ''; ?>>            
                    <label class="mvco-form-check-label" for="1adres" data-i18n="address_1">
                        <?php esc_html_e('1 address', 'moversco'); ?>
                    </label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" data-form-name="2 addresses" value="form-2" type="radio"
                        name="adressen" id="2-adressen" <?php echo ($numberOfAddresses == '2 addresses') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="2-adressen" data-i18n="address_2">
                             <?php esc_html_e('2 addresses', 'moversco'); ?>
                    </label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" data-form-name="3 addresses" value="form-3" type="radio"
                        name="adressen" id="3-adressen" <?php echo ($numberOfAddresses == '3 addresses') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="3-adressen" data-i18n="address_3">
                        <?php esc_html_e('3 addresses', 'moversco'); ?>
                    </label>
                </div>


                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" data-form-name="4 addresses" value="form-4" type="radio"
                        name="adressen" id="4-adressen" <?php echo ($numberOfAddresses == '4 addresses') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="4-adressen" data-i18n="address_4">
                        <?php esc_html_e('4 addresses', 'moversco'); ?>
                    </label>
                </div>
            </div>
        </div>

    </div>

    <div class="outerFormFow">

        <?php

        // 1) Fetch once, outside your forms loop
        $address_rows = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}addresses WHERE order_id = %d",
                $id
            ),
            ARRAY_A
        );

        // 2) Build a map: address_type → row
        $address_map = [];
        foreach ($address_rows as $row) {
            $address_map[$row['address_type']] = $row;
        }

        $forms = [
            [
                'title' => 'Start Address',
                'form_title' => 'start_address',
                'form-name' => 'startadres',
                'formIndex' => '1',
                'parent_class' => 'wpformeng form-eng form-1 form-2 form-3 form-4 form-5 form-6 ',
                'id' => 'form-1',
                'display' => 'flex',
                'countryName' => 'country-1',
                'fullAddressId' => 'Full-1',
                'mapId' => 'map1',
                'formname' => 'startadres',
                'address' => $address1,
                // ← pull the exact row from your map:
                'addressData' => isset($address_map['startadres'])
                    ? [
                        'fullAddress' => $address_map['startadres']['full_address'],
                        'propertyType' => $address_map['startadres']['property_type'],
                        'houseFloor' => maybe_unserialize($address_map['startadres']['house_floor']),
                        'lift' => $address_map['startadres']['lift'],
                        'distanceFromParkingToDoor' => $address_map['startadres']['distance_from_parking'],
                        'latitude' => $address_map['startadres']['latitude'],
                        'longitude' => $address_map['startadres']['longitude'],
                        'country' => $address_map['startadres']['country'],
                        'postal' => $address_map['startadres']['postal'],
                        'housenumber' => $address_map['startadres']['housenumber'],
                        'straat' => $address_map['startadres']['straat'],
                        'plaats' => $address_map['startadres']['plaats'],
                    ]
                    : [
                        'fullAddress' => '',
                        'propertyType' => '',
                        'houseFloor' => [],
                        'lift' => '',
                        'distanceFromParkingToDoor' => '',
                        'latitude' => '',
                        'longitude' => '',
                        'country' => '',
                        'postal' => '',
                        'housenumber' => '',
                        'straat' => '',
                        'plaats' => '',
                    ],
            ],
            [
                'title' => 'Intermediate Address 1',
                'form_title' => 'intermediate_address_1',
                'form-name' => 'tussenadres-1',
                'formIndex' => '3',
                'parent_class' => 'wpformeng form-eng form-3 form-4 form-5 form-6 ',
                'id' => 'form-2',
                'display' => 'flex',
                'countryName' => 'country-3',
                'fullAddressId' => 'Full-3',
                'mapId' => 'map6',
                'formname' => 'tussenadres',
                'address' => $address3,
                'addressData' => isset($address_map['tussenadres-1'])
                    ? [
                        'fullAddress' => $address_map['tussenadres-1']['full_address'],
                        'propertyType' => $address_map['tussenadres-1']['property_type'],
                        'houseFloor' => maybe_unserialize($address_map['tussenadres-1']['house_floor']),
                        'lift' => $address_map['tussenadres-1']['lift'],
                        'distanceFromParkingToDoor' => $address_map['tussenadres-1']['distance_from_parking'],
                        'latitude' => $address_map['tussenadres-1']['latitude'],
                        'longitude' => $address_map['tussenadres-1']['longitude'],
                        'country' => $address_map['tussenadres-1']['country'],
                        'postal' => $address_map['tussenadres-1']['postal'],
                        'housenumber' => $address_map['tussenadres-1']['housenumber'],
                        'straat' => $address_map['tussenadres-1']['straat'],
                        'plaats' => $address_map['tussenadres-1']['plaats'],
                    ]
                    : [
                        'fullAddress' => '',
                        'propertyType' => '',
                        'houseFloor' => [],
                        'lift' => '',
                        'distanceFromParkingToDoor' => '',
                        'latitude' => '',
                        'longitude' => '',
                        'country' => '',
                        'postal' => '',
                        'housenumber' => '',
                        'straat' => '',
                        'plaats' => '',
                    ],
            ],
            [
                'title' => 'Intermediate Address 2',
                'form_title' => 'intermediate_address_2',
                'form-name' => 'tussenadres-2',
                'formIndex' => '4',
                'parent_class' => 'wpformeng form-eng form-4 form-5 form-6 ',
                'id' => '',
                'countryName' => 'country-4',
                'fullAddressId' => 'Full-4',
                'mapId' => 'map3',
                'formname' => 'tussenadres-2',
                'address' => $address4,
                'addressData' => isset($address_map['tussenadres-2'])
                    ? [
                        'fullAddress' => $address_map['tussenadres-2']['full_address'],
                        'propertyType' => $address_map['tussenadres-2']['property_type'],
                        'houseFloor' => maybe_unserialize($address_map['tussenadres-2']['house_floor']),
                        'lift' => $address_map['tussenadres-2']['lift'],
                        'distanceFromParkingToDoor' => $address_map['tussenadres-2']['distance_from_parking'],
                        'latitude' => $address_map['tussenadres-2']['latitude'],
                        'longitude' => $address_map['tussenadres-2']['longitude'],
                        'country' => $address_map['tussenadres-2']['country'],
                        'postal' => $address_map['tussenadres-2']['postal'],
                        'housenumber' => $address_map['tussenadres-2']['housenumber'],
                        'straat' => $address_map['tussenadres-2']['straat'],
                        'plaats' => $address_map['tussenadres-2']['plaats'],
                    ]
                    : [
                        'fullAddress' => '',
                        'propertyType' => '',
                        'houseFloor' => [],
                        'lift' => '',
                        'distanceFromParkingToDoor' => '',
                        'latitude' => '',
                        'longitude' => '',
                        'country' => '',
                        'postal' => '',
                        'housenumber' => '',
                        'straat' => '',
                        'plaats' => '',

                    ],
            ],
            [
                'title' => 'End Address',
                'form_title' => 'end_address',
                'form-name' => 'eindadres',
                'formIndex' => '2',
                'parent_class' => 'wpformeng form-eng form-2 form-3 form-4 form-5 form-6 form-2 ',
                'id' => '',
                'countryName' => 'country-2',
                'fullAddressId' => 'Full-2',
                'mapId' => 'map2',
                'formname' => 'eindadres',
                'address' => $address2,
                'addressData' => isset($address_map['eindadres'])
                    ? [
                        'fullAddress' => $address_map['eindadres']['full_address'] ?? '',
                        'propertyType' => $address_map['eindadres']['property_type'] ?? '',
                        'houseFloor' => isset($address_map['eindadres']['house_floor']) ? maybe_unserialize($address_map['eindadres']['house_floor']) : '',
                        'lift' => $address_map['eindadres']['lift'] ?? '',
                        'distanceFromParkingToDoor' => $address_map['eindadres']['distance_from_parking'] ?? '',
                        'latitude' => $address_map['eindadres']['latitude'] ?? '',
                        'longitude' => $address_map['eindadres']['longitude'] ?? '',
                        'country' => $address_map['eindadres']['country'] ?? '',
                        'postal' => $address_map['eindadres']['postal'] ?? '',
                        'housenumber' => $address_map['eindadres']['housenumber'] ?? '',
                        'straat' => $address_map['eindadres']['straat'] ?? '',
                        'plaats' => $address_map['eindadres']['plaats'] ?? '',
                    ]
                    : [
                        'fullAddress' => '',
                        'propertyType' => '',
                        'houseFloor' => [],
                        'lift' => '',
                        'distanceFromParkingToDoor' => '',
                        'latitude' => '',
                        'longitude' => '',
                        'country' => '',
                        'postal' => '',
                        'housenumber' => '',
                        'straat' => '',
                        'plaats' => '',

                    ],
            ],

        ];

        foreach ($forms as $form) {

            if ((float) $form['addressData']['latitude'] >= 0 && (float) $form['addressData']['longitude'] > 0) {

                echo "<script>
                    document.addEventListener('DOMContentLoaded', function(){
                    setTimeout(function() {
                        showMap(" . $form['addressData']['latitude'] . ", " . $form['addressData']['longitude'] . ",'" . $form['mapId'] . "' , 'btn-1');
                    }, 3000);
                    });
                </script>";
            }

            ?>
            <div class="<?php echo $form['parent_class']; ?>" <?php if (!empty($form['id']))
                   echo 'id="' . $form['id'] . '"'; ?>     <?php echo isset($form['display']) ? 'style="display:' . $form['display'] . ' !important;"' : ''; ?>>
                <h3 data-i18n="<?php echo $form['form_title']; ?>"><?php echo $form['title']; ?></h3>

                <div class="mvco-form-gap">
                    <!-- Country select with flag options -->
                    <select class="select-flag" name="<?php echo $form['countryName']; ?>"
                        id="<?php echo $form['countryName']; ?>"
                        onchange="handleAddressChanged(event, '<?php echo $form['fullAddressId']; ?>', '.form-<?php echo $form['formIndex']; ?>-fileds', '<?php echo $form['fullAddressId']; ?>', '<?php echo $form['mapId']; ?>')">
                        <option data-i18n="netherlands" data-image="https://flagcdn.com/w40/nl.png" value="nethr" <?php echo (isset($form['addressData']['country']) && $form['addressData']['country'] === 'Netherlands') ? 'selected' : ''; ?>> <?php esc_html_e('Netherlands', 'moversco'); ?></option>
                        <option data-i18n="belgium" data-image="https://flagcdn.com/w40/be.png" value="belg" <?php echo (isset($form['addressData']['country']) && $form['addressData']['country'] === 'Belgium') ? 'selected' : ''; ?>><?php esc_html_e('Belgium', 'moversco'); ?></option>
                        <option data-i18n="germany" data-image="https://flagcdn.com/w40/de.png" value="germ" <?php echo (isset($form['addressData']['country']) && $form['addressData']['country'] === 'Germany') ? 'selected' : ''; ?>><?php esc_html_e('Germany', 'moversco'); ?></option>
                    </select>

                    <!-- Netherlands Fields -->
                    <span class="mvco-form-row-two form-<?php echo $form['formIndex']; ?>-fileds-netherlands mvco-input-group" <?php echo (isset($form['addressData']['country']) && $form['addressData']['country'] === 'Netherlands') ? '' : 'style="display:none"'; ?>>
                        <span class="mvco-input-field">
                            <label data-i18n="postal_code" ><?php esc_html_e('Postal Code', 'moversco'); ?></label>
                            <input id="<?php echo $form['fullAddressId']; ?>-nether-postal" type="text"
                                onchange="onHuisNummer(event, '<?php echo $form['fullAddressId']; ?>', '.form-<?php echo $form['formIndex']; ?>-fileds', '<?php echo $form['fullAddressId']; ?>', '<?php echo $form['mapId']; ?>')"
                                value="<?php echo htmlspecialchars($form['addressData']['postal'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        </span>
                        <span class="mvco-input-field">
                            <label data-i18n="house_number"><?php esc_html_e('House Number', 'moversco'); ?></label>
                            <input id="<?php echo $form['fullAddressId']; ?>-nether-housenumber" type="number"
                                onchange="onHuisNummer(event, '<?php echo $form['fullAddressId']; ?>', '.form-<?php echo $form['formIndex']; ?>-fileds', '<?php echo $form['fullAddressId']; ?>', '<?php echo $form['mapId']; ?>')"
                                value="<?php echo htmlspecialchars($form['addressData']['housenumber'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                        </span>
                        <span class="mvco-input-field">
                            <label data-i18n="street"><?php esc_html_e('Street', 'moversco'); ?></label>
                            <input id="<?php echo $form['fullAddressId']; ?>-nether-straat" type="text"
                                value="<?php echo htmlspecialchars($form['addressData']['straat'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                readonly>
                        </span>
                        <span class="mvco-input-field">
                            <label data-i18n="city"><?php esc_html_e('City', 'moversco'); ?></label>
                            <?php
                            $plaats = $form['addressData']['plaats'] ?? '';
                            $plaats = ltrim($plaats, "/\\"); // remove leading ' / or \    
                            ?>
                            <input id="<?php echo $form['fullAddressId']; ?>-nether-plaats" type="text"
                                value="<?php echo htmlspecialchars($plaats ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                        </span>
                    </span>

                    <!-- Belgium Fields -->
                    <span class="mvco-form-row-two form-<?php echo $form['formIndex']; ?>-fileds-belgium mvco-input-group" <?php echo (isset($form['addressData']['country']) && $form['addressData']['country'] === 'Belgium') ? '' : 'style="display:none"'; ?>>
                    <div class="mvco-input-field">   
                        <label for="street-autocomplete-<?php echo $form['formIndex']; ?>" data-i18n="country"><?php esc_html_e('Country', 'moversco'); ?></label>
                        <div class="select2Address mvco-input-field">
                            <select class="street-autocomplete select2"
                                id="belg-street-autocomplete-<?php echo $form['formIndex']; ?>"
                                data-address-select-id="belg-select-address-field-<?php echo $form['formIndex']; ?>"
                                data-postcode-id="belg-postcode-<?php echo $form['formIndex']; ?>"
                                data-housenumber-id="belg-housenumber-<?php echo $form['formIndex']; ?>"
                                data-city-id="belg-city-<?php echo $form['formIndex']; ?>"
                                data-plaats-id="belg-plaats-<?php echo $form['formIndex']; ?>"
                                data-street-id="belg-street-<?php echo $form['formIndex']; ?>"
                                data-address-id="<?php echo $form['fullAddressId']; ?>"
                                data-map-id="<?php echo $form['mapId']; ?>">
                                <!-- Populated via AJAX by Select2 -->
                            </select>
                            <span class="addressInp">
                                <select class="address-autocomplete select2"
                                    id="belg-select-address-field-<?php echo $form['formIndex']; ?>"
                                    style="display: none;"></select>
                            </span>
                        </div>
                    </div>

                        <div class="mvco-form-row-two mvco-input-group">
                            <div class="mvco-input-field">
                                <label data-i18n="postal_code"> <?php esc_html_e('Postal Code', 'moversco'); ?></label>
                                <input id="belg-postcode-<?php echo $form['formIndex']; ?>" type="text"
                                    value="<?php echo htmlspecialchars($form['addressData']['postal'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    readonly>
                            </div>
                            <div class="mvco-input-field">
                                <label data-i18n="house_number"> <?php esc_html_e('House Number', 'moversco'); ?></label>
                                <input id="belg-housenumber-<?php echo $form['formIndex']; ?>" type="text"
                                    value="<?php echo htmlspecialchars($form['addressData']['housenumber'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    readonly>
                            </div>
                            <div class="mvco-input-field">
                                <label data-i18n="street"> <?php esc_html_e('Street', 'moversco'); ?></label>
                                <input id="belg-street-<?php echo $form['formIndex']; ?>" type="text"
                                    value="<?php echo htmlspecialchars($form['addressData']['straat'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    readonly>
                            </div>

                            <div class="mvco-input-field">
                                <label data-i18n="city"> <?php esc_html_e('City', 'moversco'); ?></label>
                                <input id="belg-plaats-<?php echo $form['formIndex']; ?>" type="text"
                                    value="<?php echo htmlspecialchars($form['addressData']['plaats'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    readonly>
                            </div>
                        </div>
                    </span>

                    <!-- Germany Fields -->
                    <span class="mvco-form-row-two form-<?php echo $form['formIndex']; ?>-fileds-germ mvco-input-group" <?php echo (isset($form['addressData']['country']) && $form['addressData']['country'] === 'Germany') ? '' : 'style="display:none"'; ?>>
                        
                        <div class="mvco-input-field">
                            <label for="street-autocomplete-<?php echo $form['formIndex']; ?>" data-i18n="country"> <?php esc_html_e('Country', 'moversco'); ?></label>
                            <div class="select2Address">
                                <select class="germ-street-autocomplete select2"
                                    id="germ-street-autocomplete-<?php echo $form['formIndex']; ?>"
                                    data-address-select-id="germ-select-address-field-<?php echo $form['formIndex']; ?>"
                                    data-postcode-id="germ-postcode-<?php echo $form['formIndex']; ?>"
                                    data-housenumber-id="germ-housenumber-<?php echo $form['formIndex']; ?>"
                                    data-street-id="germ-street-<?php echo $form['formIndex']; ?>"
                                    data-plaats-id="germ-plaats-<?php echo $form['formIndex']; ?>"
                                    data-address-id="<?php echo $form['fullAddressId']; ?>"
                                    data-map-id="<?php echo $form['mapId']; ?>">
                                    <!-- Populated via AJAX by Select2 -->
                                </select>
                                <span class="addressInp">
                                    <select class="germ-address-autocomplete select2"
                                        id="germ-select-address-field-<?php echo $form['formIndex']; ?>"
                                        style="display: none;"></select>
                                </span>
                            </div>
                        </div>
                        <div class="mvco-input-group">
                            <div class="mvco-input-field">
                                <label data-i18n="postal_code"><?php esc_html_e('Postal Code', 'moversco'); ?></label>
                                <input id="germ-postcode-<?php echo $form['formIndex']; ?>" type="text"
                                    value="<?php echo htmlspecialchars($form['addressData']['postal'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    readonly>
                            </div>
                            <div class="mvco-input-field">
                                <label data-i18n="house_number"><?php esc_html_e('House Number', 'moversco'); ?></label>
                                <input id="germ-housenumber-<?php echo $form['formIndex']; ?>" type="text"
                                    value="<?php echo htmlspecialchars($form['addressData']['housenumber'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    readonly>
                            </div>
                            <div class="mvco-input-field">
                                <label data-i18n="street"><?php esc_html_e('Street', 'moversco'); ?></label>
                                <input id="germ-street-<?php echo $form['formIndex']; ?>" type="text"
                                    value="<?php echo htmlspecialchars($form['addressData']['straat'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    readonly>
                            </div>
                            <div class="mvco-input-field">
                                <label data-i18n="city"><?php esc_html_e('City', 'moversco'); ?></label>
                                <input id="germ-plaats-<?php echo $form['formIndex']; ?>" type="text"
                                    value="<?php echo htmlspecialchars($form['addressData']['plaats'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                                    readonly>
                            </div>
                        </div>
                    </span>

                    <!-- Map container (hidden until needed) -->
                    <div id="<?php echo $form['mapId']; ?>"
                        lat="<?php echo htmlspecialchars($form['addressData']['latitude'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        lng="<?php echo htmlspecialchars($form['addressData']['longitude'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        style="display:none;" class="map-container"></div>

                    <?php
                    $fullAddressRaw = $form['addressData']['fullAddress'] ?? '';
                    $fullAddressCleaned = stripslashes($fullAddressRaw); // remove ALL backslashes                        ?>

                    <!-- Hidden row with Full address and formname -->
                    <div class="mvco-form-row" style="display:none">
                        <label for="Full address"><?php esc_html_e('Full Address', 'moversco'); ?></label>
                        <input type="text" class="mvco-form-control" id="<?php echo $form['fullAddressId']; ?>"
                            name="<?php echo $form['fullAddressId']; ?>" data-city="city-<?php echo $form['formIndex']; ?>"
                            data-housenumber="housenumber-<?php echo $form['formIndex']; ?>"
                            data-map-id="<?php echo $form['mapId']; ?>"
                            data-post="postcode-<?php echo $form['formIndex']; ?>"
                            data-country="<?php echo $form['countryName']; ?>"
                            value="<?php echo htmlspecialchars($fullAddressCleaned ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            placeholder="<?php esc_html_e('Full Address', 'moversco'); ?>">
                        <input type="text" class="mvco-form-control" id="formname-<?php echo $form['formIndex']; ?>"
                            name="formname-<?php echo $form['formIndex']; ?>" placeholder="<?php echo $form['formname']; ?>"
                            value="<?php echo $form['formname']; ?>" hidden>
                    </div>
                </div>

                <div class="mvco-form-rows">
                    <label for="woning" data-i18n="type_of_property"><?php esc_html_e('Type of Property', 'moversco'); ?></label>
                    <div class="mvco-input-group  icon-selection four-cols">
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="Apartment" type="radio"
                                name="building-<?php echo $form['formIndex']; ?>"
                                id="Apartment-<?php echo $form['formIndex']; ?>" <?php echo ($form['addressData']['propertyType'] == 'Apartment') ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label"
                                for="Apartment-<?php echo $form['formIndex']; ?>" data-i18n="apartment"><?php esc_html_e('Apartment', 'moversco'); ?></label>
                        </div>
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="House" type="radio"
                                name="building-<?php echo $form['formIndex']; ?>"
                                id="House-<?php echo $form['formIndex']; ?>" <?php echo ($form['addressData']['propertyType'] == 'House') ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="House-<?php echo $form['formIndex']; ?>" data-i18n="house"><?php esc_html_e('House', 'moversco'); ?></label>
                        </div>
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="Storage" type="radio"
                                name="building-<?php echo $form['formIndex']; ?>"
                                id="Storage-<?php echo $form['formIndex']; ?>" <?php echo ($form['addressData']['propertyType'] == 'Storage') ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="Storage-<?php echo $form['formIndex']; ?>" data-i18n="storage"><?php esc_html_e('Storage', 'moversco'); ?></label>
                        </div>
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="Office Building" type="radio"
                                name="building-<?php echo $form['formIndex']; ?>"
                                id="Office-Building-<?php echo $form['formIndex']; ?>" <?php echo ($form['addressData']['propertyType'] == 'Office Building') ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label"
                                for="Office-Building-<?php echo $form['formIndex']; ?>" data-i18n="office_building"><?php esc_html_e('Office Building', 'moversco'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="mvco-form-rows">
                    <label for="Mijn" data-i18n="floors"><?php esc_html_e('Floor(s)', 'moversco'); ?></label>
                    <div class="mvco-input-group  icon-selection">
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="basement" type="checkbox"
                                name="floor-<?php echo $form['formIndex']; ?>[]"
                                id="basement-<?php echo $form['formIndex']; ?>" <?php echo in_array('basement', (array) $form['addressData']['houseFloor']) ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="basement-<?php echo $form['formIndex']; ?>" data-i18n="basement"><?php esc_html_e('Basement', 'moversco'); ?></label>
                        </div>
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="Ground floor" type="checkbox"
                                name="floor-<?php echo $form['formIndex']; ?>[]"
                                id="Ground-floor-<?php echo $form['formIndex']; ?>" <?php echo in_array('Ground floor', (array) $form['addressData']['houseFloor']) ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="Ground-floor-<?php echo $form['formIndex']; ?>" data-i18n="ground_floor"><?php esc_html_e('Ground floor', 'moversco'); ?></label>
                        </div>
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="1st floor" type="checkbox"
                                name="floor-<?php echo $form['formIndex']; ?>[]"
                                id="1st-floor-<?php echo $form['formIndex']; ?>" <?php echo in_array('1st floor', (array) $form['addressData']['houseFloor']) ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="1st-floor-<?php echo $form['formIndex']; ?>" data-i18n="1st_floor"><?php esc_html_e('1st floor', 'moversco'); ?></label>
                        </div>
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="2nd floor" type="checkbox"
                                name="floor-<?php echo $form['formIndex']; ?>[]"
                                id="2nd-floor-<?php echo $form['formIndex']; ?>" <?php echo in_array('2nd floor', (array) $form['addressData']['houseFloor']) ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="2nd-floor-<?php echo $form['formIndex']; ?>" data-i18n="2nd_floor"><?php esc_html_e('2nd floor', 'moversco'); ?></label>
                        </div>
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="3rd floor" type="checkbox"
                                name="floor-<?php echo $form['formIndex']; ?>[]"
                                id="3rd-floor-<?php echo $form['formIndex']; ?>" <?php echo in_array('3rd floor', (array) $form['addressData']['houseFloor']) ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="3rd-floor-<?php echo $form['formIndex']; ?>" data-i18n="3rd_floor"><?php esc_html_e('3rd floor', 'moversco'); ?></label>
                        </div>
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="4th floor or more" type="checkbox"
                                name="floor-<?php echo $form['formIndex']; ?>[]"
                                id="4th-floor-<?php echo $form['formIndex']; ?>" <?php echo in_array('4th floor or more', (array) $form['addressData']['houseFloor']) ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="4th-floor-<?php echo $form['formIndex']; ?>" data-i18n="4th_floor_or_more"><?php esc_html_e('4th floor or more', 'moversco'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="mvco-form-rows liftz-<?php echo $form['formIndex']; ?>">
                    <label for="lift" data-i18n="internal_lift"><?php esc_html_e('Internal Lift', 'moversco'); ?></label>
                    <div class="mvco-input-group  icon-selection">
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="Yes" type="radio"
                                name="lift-<?php echo $form['formIndex']; ?>" id="Yes-<?php echo $form['formIndex']; ?>"
                                <?php echo ($form['addressData']['lift'] == 'Yes') ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="Yes-<?php echo $form['formIndex']; ?>" data-i18n="yes"><?php esc_html_e('Yes', 'moversco'); ?></label>
                        </div>
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="No" type="radio"
                                name="lift-<?php echo $form['formIndex']; ?>" id="No-<?php echo $form['formIndex']; ?>"
                                <?php echo ($form['addressData']['lift'] == 'No') ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="No-<?php echo $form['formIndex']; ?>" data-i18n="no"><?php esc_html_e('No', 'moversco'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="mvco-form-rows">
                    <label for="Distance" data-i18n="distance_from_parking_to_front_door"><?php esc_html_e('Distance from Parking to Front Door', 'moversco'); ?></label>
                    <div class="mvco-input-group  icon-selection">
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="0-10" type="radio"
                                name="meter-<?php echo $form['formIndex']; ?>" id="ten-<?php echo $form['formIndex']; ?>"
                                <?php echo ($form['addressData']['distanceFromParkingToDoor'] == '0-10') ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="ten-<?php echo $form['formIndex']; ?>" data-i18n="0-10_meters"><?php esc_html_e('0 - 10 meters', 'moversco'); ?></label>
                        </div>
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="10-30" type="radio"
                                name="meter-<?php echo $form['formIndex']; ?>" id="thirty-<?php echo $form['formIndex']; ?>"
                                <?php echo ($form['addressData']['distanceFromParkingToDoor'] == '10-30') ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="thirty-<?php echo $form['formIndex']; ?>" data-i18n="10-30_meters"><?php esc_html_e('10 - 30 meters', 'moversco'); ?></label>
                        </div>
                        <div class="mvco-form-check">
                            <input class="mvco-form-check-input" value="30-100" type="radio"
                                name="meter-<?php echo $form['formIndex']; ?>" id="sixty-<?php echo $form['formIndex']; ?>"
                                <?php echo ($form['addressData']['distanceFromParkingToDoor'] == '30-100') ? 'checked' : ''; ?>>
                            <label class="mvco-form-check-label" for="sixty-<?php echo $form['formIndex']; ?>" data-i18n="30-100_meters"><?php esc_html_e('30 - 100 meters', 'moversco'); ?></label>
                        </div>
                    </div>
                </div>

            </div>
            <?php
        } // end foreach
        ?>

    </div>


    <!-- 2nd Section -->

    <div class="wpformeng">
        <h3 class="" data-i18n="move_details"><?php esc_html_e('Move Details', 'moversco'); ?></h3>

        <div class="mvco-form-rows" id="dateField">
            <label for="preferredDate" data-i18n="preferred_date"><?php esc_html_e('Preferred Date', 'moversco'); ?></label>
            <input type="date" name="preferredDate" id="preferredDate" class="mvco-form-control"
                placeholder="<?php esc_html_e('Preferred Date', 'moversco'); ?>">
        </div>

        <div class="mvco-form-rows ">
            <label for="packingInBoxes" data-i18n="packing_in_boxes"><?php esc_html_e('Packing in Boxes', 'moversco'); ?></label>
            <div class="mvco-input-group  icon-selection four-cols">
                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="no" type="radio" name="packing" id="packing-self" <?php echo ($packingOption == 'No') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="packing-self" data-i18n="no">
                        <?php esc_html_e('No', 'moversco'); ?>
                    </label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="Only packing" type="radio" name="packing"
                        id="only-packing" <?php echo ($packingOption == 'Only packing') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="only-packing" data-i18n="only_packing">
                        <?php esc_html_e('Only Packing', 'moversco'); ?>
                    </label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="Only unpacking" type="radio" name="packing"
                        id="only-unpacking" <?php echo ($packingOption == 'Only unpacking') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="only-unpacking" data-i18n="only_unpacking">
                        <?php esc_html_e('Only Unpacking', 'moversco'); ?>
                    </label>
                </div>


                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="Packing & Unpacking" type="radio" name="packing"
                        id="packing-unpacking" <?php echo ($packingOption == 'Packing & Unpacking') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="packing-unpacking" data-i18n="packing_unpacking">
                        <?php esc_html_e('Packing & Unpacking', 'moversco'); ?>
                    </label>
                </div>
            </div>
        </div>


        <div class="mvco-form-rows boxes-row">
            <label style="" for="house" data-i18n="number_of_boxes"> <?php esc_html_e('Number of Boxes', 'moversco'); ?> </label>
            <div class="mvco-input-group  icon-selection four-cols">
                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="0-20" type="radio" name="mover-boxes" id="20" <?php echo ($totalBoxes == '0-20') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="20" data-i18n="0-20">
                        <?php esc_html_e('0 - 20', 'moversco'); ?>
                    </label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="20-40" type="radio" name="mover-boxes" id="40" <?php echo ($totalBoxes == '20-40') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="40" data-i18n="20-40">
                        <?php esc_html_e('20 - 40', 'moversco'); ?>
                    </label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="40-60" type="radio" name="mover-boxes" id="mover-60" <?php echo ($totalBoxes == '40-60') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="mover-60" data-i18n="40-60">
                        <?php esc_html_e('40 - 60', 'moversco'); ?>
                    </label>
                </div>


                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="60-80" type="radio" name="mover-boxes" id="mover-80" <?php echo ($totalBoxes == '60-80') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="mover-80" data-i18n="60-80">
                        <?php esc_html_e('60 - 80', 'moversco'); ?>
                    </label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="80-100" type="radio" name="mover-boxes" id="mover-100" <?php echo ($totalBoxes == '80-100') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="mover-100" data-i18n="80-100">
                        <?php esc_html_e('80 - 100', 'moversco'); ?>
                    </label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="100-120" type="radio" name="mover-boxes" id="mover-120" <?php echo ($totalBoxes == '100-120') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="mover-120" data-i18n="100-120">
                        <?php esc_html_e('100 - 120', 'moversco'); ?>
                    </label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="120-150" type="radio" name="mover-boxes" id="mover-150" <?php echo ($totalBoxes == '120-150') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="mover-150" data-i18n="120-150">
                        <?php esc_html_e('120 - 150', 'moversco'); ?>
                    </label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="150-200" type="radio" name="mover-boxes" id="mover-200" <?php echo ($totalBoxes == '150-200') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="mover-200" data-i18n="150-200">
                        <?php esc_html_e('150 - 200', 'moversco'); ?>
                    </label>
                </div>
            </div>
        </div>

        <div class="mvco-form-rows">
            <label style="" for="house" data-i18n="dissassembly_work"><?php esc_html_e('(Dis)assembly Work', 'moversco'); ?></label>
            <div class="mvco-input-group  icon-selection four-cols">
                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="no" type="radio" name="disassemblywork" id="demonteren-no" <?php echo ($disassembly_work == 'No') ? 'checked' : ''; ?>>
                <label class="mvco-form-check-label" for="demonteren-no" data-i18n="no">
                    <?php esc_html_e('No', 'moversco'); ?>
                </label>
            </div>

            <div class="mvco-form-check">
                <input class="mvco-form-check-input" value="Only disassemble" type="radio" name="disassemblywork"
                    id="Only-disassemble" <?php echo ($disassembly_work == 'Only disassemble') ? 'checked' : ''; ?>>
                <label class="mvco-form-check-label" for="Only-disassemble" data-i18n="only_disassemble">
                    <?php esc_html_e('Only Disassemble', 'moversco'); ?>
                </label>
            </div>

            <div class="mvco-form-check">
                <input class="mvco-form-check-input" value="Only assemble" type="radio" name="disassemblywork"
                    id="Only-assemble" <?php echo ($disassembly_work == 'Only assemble') ? 'checked' : ''; ?>>
                <label class="mvco-form-check-label" for="Only-assemble" data-i18n="only_assemble">
                    <?php esc_html_e('Only Assemble', 'moversco'); ?>
                </label>
            </div>


            <div class="mvco-form-check">
                <input class="mvco-form-check-input" value="Disassemble & assemble" type="radio" name="disassemblywork"
                    id="Disassemble-assemble" <?php echo ($disassembly_work == 'Disassemble & assemble') ? 'checked' : ''; ?>>
                <label class="mvco-form-check-label" for="Disassemble-assemble" data-i18n="disassemble_assemble">
                    <?php esc_html_e('Disassemble & Assemble', 'moversco'); ?>
                </label>
            </div>
        </div>

      </div>
    <!--Some-->
    </div>
        <div class="wpformeng  products-row" style="padding:20px !important">

        <h3 class="" data-i18n="select_assembly_items"><?php esc_html_e('Select Assembly Items', 'moversco'); ?></h3>
        <div class="mvco-form-rows ">
            <label data-i18n="search_here"><?php esc_html_e('Search here', 'moversco'); ?></label>
            <input class="mvco-form-control" type="text" name="Search-here"
                data-products='<?php echo esc_attr(wp_json_encode($disassemblyProducts)); ?>' id="demonSearchInput">
            <label style="" for="house" data-i18n="select_items"><?php esc_html_e('Select items', 'moversco'); ?></label>
            <div class="mvco-input-group   icon-selection products-grid" id="demonProductList">
                <?php

                // Arguments to fetch all products
                $args = array(
                    'post_type' => 'form_products', // Custom post type name
                    'posts_per_page' => -1, // Retrieve all posts
                    'fields' => 'ids', // Only fetch post IDs for efficiency
                    'meta_query' => [
                        [
                            'key' => 'requires_disassembly',
                            'value' => '1',
                            'compare' => '=',
                            'type' => 'CHAR',
                        ]
                    ],
                );

                // Fetch all post IDs
                $post_ids = get_posts($args);


                // Loop through sorted posts and display
                if (!empty($post_ids)) {
                    foreach ($post_ids as $post_id) {
                        $product_position = get_post_meta($post_id, 'product_position', true);
                        if (empty($product_position)) {
                            $product_position = $post_id;
                        }
                        $product_quantity = 0;

                        // If disassemblyProducts is not empty, loop through it to set product quantity
                        $categories = wp_get_post_terms($post_id, 'product-category', ['fields' => 'names']);
                        $tags = wp_get_post_terms($post_id, 'product-tag', ['fields' => 'names']);
                        $keywords = array_merge($categories, $tags);

                        $product_quantity = 0;
                        if (!empty($disassemblyProducts)) {
                            foreach ($disassemblyProducts as $DisProducts) {
                                if ($post_id == $DisProducts['productID']) {
                                    $product_quantity = $DisProducts['quantity'];
                                }
                            }
                        }


                        ?>
                        <div class="mvco-form-check form-product-row w-100"
                            style="order: <?php echo esc_attr($product_position); ?>;"
                            data-tags="<?php echo esc_attr(implode(', ', $keywords)); ?>"
                            data-position="<?php echo esc_attr($product_position); ?>"
                            data-title="<?php echo esc_attr(get_the_title($post_id)); ?>">
                            <div>
                                <img class="form-product-image"
                                    src="<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'full')); ?>" alt="">
                            </div>
                            <div class="product-name">
                                <label class="mvco-form-check-label" for=""
                                    style="padding:0px !important; width:auto !important; max-width:115px; font-size:15px !important">
                                    <?php echo esc_html(get_the_title($post_id)); ?>
                                </label>
                            </div>
                            <div class="input-group-mvco">
                                <span class="mvco_inline_box minus">–</span>
                                <input type="number" class="mvco-form-control form-product-input"
                                    data-name="<?php echo esc_attr(get_the_title($post_id)); ?>"
                                    data-id="<?php echo esc_attr($post_id); ?>" value="<?php echo $product_quantity; ?>"
                                    name="selectedProduct" value="0" min="0" max="100" placeholder="0">
                                <span class="mvco_inline_box plus">+</span>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<span data-i18n="no_products_found">' . esc_html__('No products found.', 'moversco') . '</span>';
                }

                ?>

            </div>
        </div>
    </div>
    <!-- End of the second section actually -->


    <div class="wpformeng secondStep">
        <h3 data-i18n="requirements"><?php esc_html_e('Requirements', 'moversco'); ?></h3>

        <?php
        if (empty($Movers)) {
            $Movers = 'Yes';
        }
        if (empty($MovingTruck)) {
            $MovingTruck = 'Yes';
        }
        if (empty($movingLift)) {
            $movingLift = ['No'];
        }
        ?>

        <div class="mvco-form-rows">
            <label style="" for="lift" data-i18n="need_movers"><?php esc_html_e('Need Movers?', 'moversco'); ?></label>
            <div class="mvco-input-group  icon-selection ">
                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="Yes" type="radio" name="Movers" id="Yes-Movers" <?php echo ($Movers == 'Yes') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="Yes-Movers" data-i18n="yes">
                        <?php esc_html_e('Yes', 'moversco'); ?>
                    </label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="No" type="radio" name="Movers" id="No-Movers" <?php echo ($Movers == 'No') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="No-Movers" data-i18n="no">
                        <?php esc_html_e('No', 'moversco'); ?>
                    </label>
                </div>
            </div>
        </div>

        <!-- Yes No Ends -->

        <div class="mvco-form-rows">
            <label style="" for="lift" data-i18n="need_moving_truck"><?php esc_html_e('Need Moving Truck?', 'moversco'); ?></label>
            <div class="mvco-input-group  icon-selection ">
                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="Yes" type="radio" name="MovingTruck" id="Yes-MovingTruck"
                        <?php echo ($MovingTruck == 'Yes') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="Yes-MovingTruck" data-i18n="yes">
                        <?php esc_html_e('Yes', 'moversco'); ?>
                    </label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="No" type="radio" name="MovingTruck" id="No-MovingTruck"
                        <?php echo ($MovingTruck == 'No') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="No-MovingTruck" data-i18n="no">
                        <?php esc_html_e('No', 'moversco'); ?>
                    </label>
                </div>
            </div>
        </div>

        <!-- Other thing Ends  -->

        <div class="mvco-form-rows ">
            <label style="" for="house" data-i18n="need_moving_lift"><?php esc_html_e('Need Moving Lift?', 'moversco'); ?></label>
            <div class="mvco-input-group  icon-selection">
                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="No" type="checkbox" name="movingLift[]"
                        id="movingLift-no" <?php $movingLift = is_array($movingLift) ? $movingLift : explode(',', $movingLift);
                        echo in_array('No', $movingLift) ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="movingLift-no" data-i18n="no"><?php esc_html_e('No', 'moversco'); ?></label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="Start Address" type="checkbox" name="movingLift[]"
                        id="startAddress" <?php echo in_array('Start Address', $movingLift) ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="startAddress" data-i18n="start_address"><?php esc_html_e('Start Address', 'moversco'); ?></label>
                </div>

                <div class="mvco-form-check form-eng form-3 form-4 form-5 form-6">
                    <input class="mvco-form-check-input" value="Intermediate Address 1" type="checkbox" name="movingLift[]"
                        id="IntermediateAddress-1" <?php echo in_array('Intermediate Address 1', $movingLift) ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="IntermediateAddress-1" data-i18n="intermediate_address_1"><?php esc_html_e('Intermediate Address 1', 'moversco'); ?></label>
                </div>


                <div class="mvco-form-check form-eng form-4 form-5 form-6">
                    <input class="mvco-form-check-input" value="Intermediate Address 2" type="checkbox" name="movingLift[]"
                        id="IntermediateAddress-2" <?php echo in_array('Intermediate Address 2', $movingLift) ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="IntermediateAddress-2" data-i18n="intermediate_address_2">
                        <?php esc_html_e('Intermediate Address 2', 'moversco'); ?>
                    </label>
                </div>


                <div class="mvco-form-check form-eng form-5 form-6">
                    <input class="mvco-form-check-input" value="Intermediate Address 3" type="checkbox" name="movingLift[]"
                        id="IntermediateAddress-3" <?php echo in_array('Intermediate Address 3', $movingLift) ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="IntermediateAddress-3" data-i18n="intermediate_address_3">
                        <?php esc_html_e('Intermediate Address 3', 'moversco'); ?>
                    </label>
                </div>


                <div class="mvco-form-check form-eng form-6">
                    <input class="mvco-form-check-input" value="Intermediate Address 4" type="checkbox" name="movingLift[]"
                        id="IntermediateAddress-4" <?php echo in_array('Intermediate Address 4', $movingLift) ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="IntermediateAddress-4" data-i18n="intermediate_address_4">
                        <?php esc_html_e('Intermediate Address 4', 'moversco'); ?>
                    </label>
                </div>


                <div class="mvco-form-check form-eng form-2 form-3 form-4 form-5 form-6">
                    <input class="mvco-form-check-input" value="End Address" type="checkbox" name="movingLift[]"
                        id="endAddress" <?php echo in_array('End Address', $movingLift) ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="endAddress" data-i18n="end_address">
                        <?php esc_html_e('End Address', 'moversco'); ?>
                    </label>
                </div>

            </div>
        </div>

    </div>

    <!-- End of the second section actually -->
    <!-- 2nd Section End -->

    <div style="display:flex; flex-direction:row; column-gap:20px; justify-content:center">
        <button type="button" class="next moversco-action-button action-button" data-i18n="next"><?php esc_html_e('Next', 'moversco'); ?></button>
    </div>
</fieldset>


<fieldset class="mvco-fieldset">

    <div class="search-sticky wpformeng mvco-form-row-custom form-eng-style"
        style="margin:50px 0px; display:grid !important; padding: 25px 20px !important; max-height:100px !important;">
        <h3 class="" data-i18n="search_here"> <?php esc_html_e('Search', 'moversco'); ?> </h3>
        <div class="">
            <div class="mvco-form-rows " style="">
                <input type="text" class="mvco-form-control" name="Search-here"
                    data-products='<?php echo htmlspecialchars(json_encode($addedProducts), ENT_QUOTES, 'UTF-8'); ?>'
                   data-i18n="enter_product_name" data-i18n-attr="placeholder" id="totalSearchInput" placeholder="<?php esc_html_e('Search quickly and add', 'moversco'); ?>">
            </div>
        </div>
    </div>

    <div class="mvco-form-row-custom form-eng-style" id="products-section"
        style="display:grid !important;">

        <div class="">
            <div class="wpformeng" style="padding:26px !important">

                <h3 class="" data-i18n="inventory"> <?php esc_html_e('Inventory', 'moversco'); ?> </h3>
                <div class="mvco-form-rows ">

                    <label style="" for="items" data-i18n="select_items"> <?php esc_html_e('Select items', 'moversco'); ?> </label>
                    <div class="mvco-input-group icon-selection products-grid" id="totalProductList1">

                        <?php

                        $args = array(
                            'post_type' => 'form_products', 
                            'posts_per_page' => -1, 
                            'fields' => 'ids', 
                        );

                        $post_ids = get_posts($args);

                        if (!empty($post_ids)) {
                            foreach ($post_ids as $post_id) {
                                $product_position = get_post_meta($post_id, 'product_position', true);
                                if (empty($product_position)) {
                                    $product_position = $post_id;
                                }
                                $product_quantity = 0;

                                $categories = wp_get_post_terms($post_id, 'product-category', ['fields' => 'names']);
                                $tags = wp_get_post_terms($post_id, 'product-tag', ['fields' => 'names']);
                                $keywords = array_merge($categories, $tags);

                                $product_quantity = 0;

                                if (!empty($addedProducts) && is_array($addedProducts) && $addedProducts != NULL) {
                                    foreach ($addedProducts as $addedProduct) {
                                        if ((int) $post_id === (int) $addedProduct['ProductID']) {
                                            $product_quantity = (int) $addedProduct['ProductQuantity'];
                                        }
                                    }
                                }

                                $form_product_area = get_post_meta($post_id, 'form_product_area', true);


                                ?>
                                <div class="mvco-form-check form-product-row w-100"
                                    style="order: <?php echo esc_attr($product_position); ?>;"
                                    data-tags="<?php echo esc_attr(implode(', ', $keywords)); ?>"
                                    data-position="<?php echo esc_attr($product_position); ?>"
                                    data-title="<?php echo esc_attr(get_the_title($post_id)); ?>">
                                    <div>
                                        <img class="form-product-image"
                                            src="<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'full')); ?>" alt="">
                                    </div>
                                    <div class="product-name">
                                        <label class="mvco-form-check-label" for=""
                                            style="padding:0px !important; width:auto !important; max-width:115px; font-size:15px !important">
                                            <?php echo esc_html(get_the_title($post_id)); ?>
                                        </label>
                                    </div>
                                    <div class="input-group-mvco">
                                        <span class="mvco_inline_box minus">–</span>
                                        <input type="number" class="mvco-form-control form-product-input form-product-input-second"
                                            data-name="<?php echo esc_attr(get_the_title($post_id)); ?>"
                                            data-product-id="<?php echo esc_attr($post_id); ?>"
                                            data-title="<?php echo esc_attr(get_the_title($post_id)); ?>"
                                            data-area="<?php echo $form_product_area; ?>" id="product-<?php echo $post_id ?>"
                                            name="products" value="<?php echo $product_quantity; ?>" min="0" max="100"
                                            placeholder="0">
                                        <span class="mvco_inline_box plus">+</span>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                                echo '<span data-i18n="no_products_found">' . esc_html__('No products found.', 'moversco') . '</span>';
                        }
                        //ended
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wpformeng" id="formReciept" style="display:block !important;">
        <h3 class="" data-i18n="total"> <?php esc_html_e('Total', 'moversco'); ?> </h3>
        <div class="recieptArea bg-white" style="display:flex; justify-content:space-between; column-gap:40px">

            <div class=" justify-content-between mb-3"
                style="display: flex !important ;flex-direction: column; justify-content: center !important; align-items: flex-start;">
                <div class="itemName"  data-i18n="cubic_meters"><?php esc_html_e('Cubic meters (m³)', 'moversco'); ?></div>
                <div class="itemValue total-area"></div>
            </div>

            <div class=" justify-content-between mb-3"
                style="display: flex !important ;flex-direction: column; justify-content: center !important; align-items: flex-start; ">
                <div class="itemName" data-i18n="number_of_items"><?php esc_html_e('Number of Items', 'moversco'); ?> </div>
                <div class="itemValue total-products"></div>
            </div>
        </div>
    </div>
    <div style="display:flex; flex-direction:row; column-gap:20px; justify-content:center">
        <button type="button" class="action-button previous previous_button"  data-i18n="previous"><?php esc_html_e('Previous', 'moversco'); ?></button>
        <button type="button" class="next action-button"  data-i18n="next"><?php esc_html_e('Next', 'moversco'); ?></button>
    </div>
</fieldset>

<fieldset class="mvco-fieldset">
    <div class="wpformeng"
        style="display:flex; flex-direction:column; gap:20px; padding-bottom:40px;">
        <h3 class="" data-i18n="contant_details"> <?php esc_html_e('Contact Details', 'moversco'); ?> </h3>
        <span class="mvco-input-field">
            <label style="" for="heer" data-i18n="customer_type"> <?php esc_html_e('Customer Type', 'moversco'); ?> </label>
            <div class="mvco-input-group icon-selection four-two-cols" style="margin:0px !important">
                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="Individual" type="radio" name="customer-type"
                        id="customer-type-individual" <?php echo ($typeklant == 'Individual') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="customer-type-individual" data-i18n="individual"><?php esc_html_e('Individual', 'moversco'); ?></label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="Business" type="radio" name="customer-type"
                        id="customer-type-business" <?php echo ($typeklant == 'Business') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="customer-type-business"  data-i18n="business"><?php esc_html_e('Business', 'moversco'); ?></label>
                </div>
            </div>
        </span>

        <span id="showBusinessName" style="<?php echo ($typeklant == 'Business') ? '' : 'display: none;'; ?>" class="width-half-resp mvco-input-field" >
            <label for="businessName"  data-i18n="business_name"><?php esc_html_e('Business Name', 'moversco'); ?> *</label>
            <input type="text" value="<?php echo $businessname; ?>" id="businessName" class="mvco-form-control"
                data-i18n="enter_business_name" data-i18n-attr="placeholder" placeholder="<?php esc_html_e('Business Name', 'moversco'); ?> ">
        </span>
        <span class="mvco-input-field">
            <label style="" for="salutation"  data-i18n="salutation"><?php esc_html_e('Salutation', 'moversco'); ?> </label>
            <div class="mvco-input-group icon-selection four-two-cols" style="margin:0px !important">
                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="Mr" type="radio" name="salutation" id="mr" <?php echo ($salutation == 'mr') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="mr"  data-i18n="mr"><?php esc_html_e('Mr', 'moversco'); ?></label>
                </div>

                <div class="mvco-form-check">
                    <input class="mvco-form-check-input" value="Ms" type="radio" name="salutation" id="ms" <?php echo ($salutation == 'ms') ? 'checked' : ''; ?>>
                    <label class="mvco-form-check-label" for="ms"  data-i18n="ms"><?php esc_html_e('Ms', 'moversco'); ?></label>
                </div>
            </div>
        </span>
        <span class="mvco-input-field">
            <label for="firstName"  data-i18n="first_name"><?php esc_html_e('First Name', 'moversco'); ?> *</label>
            <span class="info-fields" style="">
                <input class="mvco-form-control" type="text" value="<?php echo $first_name; ?>" id="firstName" class="mvco-form-control"
                    data-i18n="enter_first_name" data-i18n-attr="placeholder" placeholder="<?php esc_html_e('First Name', 'moversco'); ?>">
                <input type="text" value="<?php echo $sur_name; ?>" id="lastName" class="mvco-form-control"
                    data-i18n="enter_last_name" data-i18n-attr="placeholder" placeholder="<?php esc_html_e('Last Name', 'moversco'); ?>">
            </span>
        </span>
        <span class="info-fields">
            <span class="mvco-input-field" style="">
                <label for="phone"  data-i18n="phone"><?php esc_html_e('Phone', 'moversco'); ?></label>
                <input type="text" value="<?php echo $telephone; ?>" id="phone" class="mvco-form-control"
                    data-i18n="enter_phone" data-i18n-attr="placeholder" placeholder="<?php esc_html_e('Phone', 'moversco'); ?>">
            </span>

            <span class="mvco-input-field" style="">
                <label for="email"  data-i18n="email"><?php esc_html_e('Email Address', 'moversco'); ?> *</label>
                <input type="email" value="<?php echo $email_address; ?>" id="email" class="mvco-form-control"
                    data-i18n="enter_email" data-i18n-attr="placeholder" placeholder="<?php esc_html_e('Email Address', 'moversco'); ?>">
            </span>

            <span class="mvco-input-field" style="">
                <label for="confirmEmail"  data-i18n="confirm_email"><?php esc_html_e('Confirm Email Address', 'moversco'); ?> *</label>
                <input type="email" value="<?php echo $email_address; ?>" id="confirmEmail" class="mvco-form-control"
                    data-i18n="enter_confirm_email" data-i18n-attr="placeholder" placeholder="<?php esc_html_e('Confirm Email Address', 'moversco'); ?>">
            </span>

        </span>

        <span class="mvco-input-field">
            <label for="comments"  data-i18n="comments"><?php esc_html_e('Questions or Comments', 'moversco'); ?></label>
            <textarea id="comments" class="mvco-form-control" name="comments" rows="4"
                cols="50"> <?php echo $commentz; ?> </textarea>
        </span>

        <!-- Consent section (Agreement & permissions) -->
        <span class="consent-section mvco-input-field">
            <label for="agreement"  data-i18n="agreement"><?php esc_html_e('Agreement & Permissions', 'moversco'); ?></label>
            <!-- Required: Privacy consent checkbox -->
            <span class="sm-font">
                <input type="checkbox" class="" id="privacyConsent" name="privacyConsent" <?php if ($privacyConsent === 'Yes')
                    echo 'checked'; ?> required>
                <span>
                    <?php echo get_option('privacyConsent', __('I agree to the processing of my personal data as described in the <a href="#" target="_blank" rel="noopener">privacy statement</a>.', 'moversco')); ?>
                </span> </span>
            <!-- Optional: General terms acknowledgment -->
            <span class="sm-font mt-3">
                <input type="checkbox" class="" <?php if ($termsAcknowledgment === 'Yes')
                    echo 'checked'; ?>
                    name="termsAcknowledgment">
                <span><?php echo get_option('termsAcknowledgment', __('I acknowledge that the general terms apply when receiving an offer <a href="#" target="_blank" rel="noopener">terms and conditions</a>.', 'moversco')); ?>
                </span></span>
        </span>
    </div>

    <div style="display:flex; flex-direction:row; column-gap:20px; justify-content:center">
        <button type="button" class="action-button previous previous_button"  data-i18n="previous"><?php esc_html_e('Previous', 'moversco'); ?></button>
        <button id="submit-movers" class="action-button"  data-i18n="submit"><?php esc_html_e('Submit', 'moversco'); ?></button>
    </div>
</fieldset>


</form>
</section>
</div>

</section>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/js/intlTelInput.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js'></script>

<script>


document.addEventListener('DOMContentLoaded', function () {



    document.querySelectorAll("input[id$='-nether-postal']").forEach(function (input) {
    input.addEventListener("input", function (e) {
        let value = e.target.value.replace(/\s+/g, ""); // Remove spaces
        let formattedValue = value;

        if (value.length > 4) {
        let firstPart = value.substring(0, 4);
        let secondPart = value.substring(4);

        if (isNaN(secondPart)) { // Check if the user is entering letters
            formattedValue = firstPart + " " + secondPart.toUpperCase();
        }
        }

        // Limit to max 7 characters including space
        if (formattedValue.length > 7) {
        formattedValue = formattedValue.substring(0, 7);
        }

        e.target.value = formattedValue;
    });
    });



    document.body.addEventListener('click', function (event) {
    let target = event.target;

    if (target.classList.contains('minus')) {
        let input = target.nextElementSibling; // Get the input field
        if (input && input.tagName === "INPUT") {
        let value = parseInt(input.value) || 0;
        input.value = Math.max(value - 1, 0); // Prevent negative values

        // Trigger the change event
        input.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }

    if (target.classList.contains('plus')) {
        let input = target.previousElementSibling; // Get the input field
        if (input && input.tagName === "INPUT") {
        let value = parseInt(input.value) || 0;
        input.value = value + 1;

        // Trigger the change event
        input.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }
    });
});




$(document).ready(function () {

    flatpickr("#voorkeursdatum", {
    locale: "nl",
    dateFormat: "d-m-Y",
    defaultDate: "<?php echo $preferred_date ?>",  // ← note the comma here
    onChange: function (selectedDates, dateStr) {
        $('#datepicker').val(dateStr).trigger('change');
    }
    });


    // Trigger the change event on the select on page load
    $("#country-1").trigger("change");
    $("#country-2").trigger("change");
    $("#country-3").trigger("change");
    $("#country-4").trigger("change");
    $("#country-5").trigger("change");
    $("#country-6").trigger("change");

    document.querySelectorAll(".select-flag").forEach(select => {

    // Function to apply the class based on selected value
    function applyFlagClass(selectElement) {
        // Remove previous classes
        selectElement.classList.remove("belg-flag", "germ-flag", "nethr-flag");

        // Add new class if a valid value is selected
        if (selectElement.value) {
        selectElement.classList.add(selectElement.value + "-flag");
        }
    }

    // Apply on page load
    applyFlagClass(select);

    // Apply on change
    select.addEventListener("change", function () {
        applyFlagClass(this);
    });

    });


});

function onHuisNummer(e, id, fieldsToShow, updateButton, map) {
    e.preventDefault();
    let postalCode = document.querySelector('#' + updateButton + '-nether-postal').value;
    let houseNumber = document.querySelector('#' + updateButton + '-nether-housenumber').value;

    if (houseNumber.trim() == '' || postalCode.trim() == '')
    return;

    let plaat = document.querySelector('#' + updateButton + '-nether-plaats');
    let straat = document.querySelector('#' + updateButton + '-nether-straat');


    // Create a FormData object to send POST data
    var formData = new FormData();
    formData.append('action', 'apicheck_lookup');
    formData.append('nonce', moversco_ajax.nonce);
    formData.append('postalcode', postalCode);
    formData.append('houseNumber', houseNumber);

    // Use fetch to make the AJAX call
    fetch(moversco_ajax.ajax_url, {
    method: 'POST',
    body: formData,
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        if (data.success) {
        let AddressData = data.data;
        if (!AddressData.error) {
            document.getElementById(id).value = AddressData.data.formattedAddress;
            plaat.value = AddressData.data.municipality;
            straat.value = AddressData.data.street;
            showMap(AddressData.data.Location.Coordinates.latitude, AddressData.data.Location.Coordinates.longitude, map, 'btn3')

        } else {
            Swal.fire({
            title: 'Adres niet gevonden',
            text: 'Er is geen adres gevonden met deze gegevens. Vul handmatig het juiste adres in.',
            icon: 'warning',
            confirmButtonText: 'Oké'
            });
            $("#" + map).css('display', 'none');
            $("#" + map).removeAttr("lat").removeAttr("lng");
            $("textarea").trigger("change");
        }

        } else {
        console.error('API Error:', data.data);
        }
    })
    .catch(function (error) {
        console.error('AJAX Request Error:', error);
    });
}


function handleAddressChanged(e, id, fieldsToShow, updateButton, map) {
    document.getElementById(map).style.display = "none";
    $("#" + map).removeAttr("lat").removeAttr("lng");
    $("textarea").trigger("change");

    if (e.target.value == 'nethr') {
    // 1) Update the target fields:
    document.querySelectorAll(fieldsToShow + '-netherlands').forEach(field => {
        field.style.display = 'grid';
    });

    document.querySelectorAll(fieldsToShow + "-belgium").forEach(field => {
        field.style.display = 'none';
    });

    document.querySelectorAll(fieldsToShow + "-germ").forEach(field => {
        field.style.display = 'none';
    });

    document.querySelectorAll(fieldsToShow + "-belgium input").forEach(field => {
        field.value = "";
    });

    document.querySelectorAll(fieldsToShow + "-germ input").forEach(field => {
        field.value = "";
    });

    } else if (e.target.value == 'belg') {

    document.querySelectorAll(fieldsToShow + "-belgium").forEach(field => {
        field.style.display = 'flex';
    });

    document.querySelectorAll(fieldsToShow + "-netherlands").forEach(field => {
        field.style.display = 'none';
    });

    document.querySelectorAll(fieldsToShow + "-germ").forEach(field => {
        field.style.display = 'none';
    });

    document.querySelectorAll(fieldsToShow + "-netherlands input").forEach(field => {
        field.value = "";
    });

    document.querySelectorAll(fieldsToShow + "-germ input").forEach(field => {
        field.value = "";
    });

    } else if (e.target.value == 'germ') {

    document.querySelectorAll(fieldsToShow + "-belgium").forEach(field => {
        field.style.display = 'none';
    });

    document.querySelectorAll(fieldsToShow + "-netherlands").forEach(field => {
        field.style.display = 'none';
    });


    document.querySelectorAll(fieldsToShow + "-germ").forEach(field => {
        field.style.display = 'flex';
    });

    document.querySelectorAll(fieldsToShow + "-netherlands input").forEach(field => {
        field.value = "";
    });

    document.querySelectorAll(fieldsToShow + "-belgium input").forEach(field => {
        field.value = "";
    });


    } else {
    document.querySelectorAll(fieldsToShow + "-netherlands").forEach(field => {
        field.style.display = 'none';
    });

    document.querySelectorAll(fieldsToShow + "-belgium").forEach(field => {
        field.style.display = 'none';
    });

    document.querySelectorAll(fieldsToShow + "-germ").forEach(field => {
        field.style.display = 'none';
    });
    }
}

</script>

<script type="text/javascript">

var $ = jQuery.noConflict();

jQuery(document).ready(function ($) {

    // 1) Turn all .street-autocomplete elements into Select2 with the same AJAX config
    $('.street-autocomplete').select2({
    placeholder: 'Vul straatadres in',
    allowClear: false,
    language: {
        noResults: function () {
        return "Geen resultaten gevonden"; // Change this text as needed
        },
        searching: function () {
        return "Zoeken..."; // Change "searching..." text
        }
    },
    ajax: {
        url: moversco_ajax.ajax_url,     // e.g. /wp-admin/admin-ajax.php
        dataType: 'json',
        delay: 250,
        data: function (params) {
        return {
            q: params.term,
            action: 'my_search_options'   // your WP AJAX action for searching
        };
        },
        processResults: function (data) {
        return { results: data };
        },
        cache: true
    }
    });

    // 1) Turn all .street-autocomplete elements into Select2 with the same AJAX config
    $('.germ-street-autocomplete').select2({
    placeholder: 'Vul straatadres in',
    allowClear: false,
    language: {
        noResults: function () {
        return "Geen resultaten gevonden"; // Change this text as needed
        },
        searching: function () {
        return "Zoeken..."; // Change "searching..." text
        }
    },
    ajax: {
        url: moversco_ajax.ajax_url,     // e.g. /wp-admin/admin-ajax.php
        dataType: 'json',
        delay: 250,
        data: function (params) {
        return {
            q: params.term,
            action: 'my_german_search_options'   // your WP AJAX action for searching
        };
        },
        processResults: function (data) {
        return { results: data };
        },
        cache: true
    }
    });

    // 1) Turn all .street-autocomplete elements into Select2 with the same AJAX config
    $('.address-autocomplete').select2({
    placeholder: 'Vul straatadres in',
    language: {
        noResults: function () {
        return "Geen resultaten gevonden"; // Change this text as needed
        },
        searching: function () {
        return "Zoeken..."; // Change "searching..." text
        }
    }
    });

    $('.germ-address-autocomplete').select2({
    placeholder: 'Vul straatadres in',
    language: {
        noResults: function () {
        return "Geen resultaten gevonden"; // Change this text as needed
        },
        searching: function () {
        return "Zoeken..."; // Change "searching..." text
        }
    }
    });

    //testing germany
    $(document).on('select2:select', '.germ-street-autocomplete', function (e) {
    var $this = $(this);
    var selected = e.params.data;  // the item the user chose
    var addressSelectID = $this.data('address-select-id');  // e.g. "select-address-field-1"
    var $addressSelect = $('#' + addressSelectID);
    var $select = $(this);

    // Clear out old options & show the address select
    $addressSelect.empty().show();
    $addressSelect.parent().show();

    // Prepare the POST data
    var formData = new FormData();
    formData.append('action', 'germ_address_lookup');  // your WP AJAX action for addresses
    formData.append('nonce', moversco_ajax.nonce);
    formData.append('cityID', selected.city_id);
    formData.append('streetID', selected.id);

    // Query the addresses from your address_lookup endpoint
    fetch(moversco_ajax.ajax_url, {
        method: 'POST',
        body: formData
    })
        .then(function (resp) { return resp.json(); })
        .then(function (data) {
        if (!data.success) {
            console.error('API error:', data.data);
            return;
        }

        // Insert a placeholder option:
        var placeholderOpt = $('<option>')
            .val('')
            .text('Select Address');
        $addressSelect.append(placeholderOpt);

        // If there's no error in data.data
        if (data.data && !data.data.error && data.data.data && data.data.data.Results) {
            data.data.data.Results.forEach(function (addressObj) {
            var fullJSON = JSON.stringify(addressObj);
            var $option = $('<option>')
                .val(fullJSON)
                .text(addressObj.formattedAddress);
            $addressSelect.append($option);
            });

            $addressSelect.focus();
            $addressSelect.select2('open');
        }

        })
        .catch(function (error) {
        console.error('Fetch error:', error);
        });
    });


    //end testing germany


    // 2) When user selects a street from any block
    $(document).on('select2:select', '.street-autocomplete', function (e) {
    var $this = $(this);
    var selected = e.params.data;  // the item the user chose
    var addressSelectID = $this.data('address-select-id');  // e.g. "select-address-field-1"
    var $addressSelect = $('#' + addressSelectID);
    var $select = $(this);

    // Clear out old options & show the address select
    $addressSelect.empty().show();
    $addressSelect.parent().show();

    // Prepare the POST data
    var formData = new FormData();
    formData.append('action', 'address_lookup');  // your WP AJAX action for addresses
    formData.append('nonce', moversco_ajax.nonce);
    formData.append('cityID', selected.city_id);
    formData.append('streetID', selected.id);

    // Query the addresses from your address_lookup endpoint
    fetch(moversco_ajax.ajax_url, {
        method: 'POST',
        body: formData
    })
        .then(function (resp) { return resp.json(); })
        .then(function (data) {
        if (!data.success) {
            console.error('API error:', data.data);
            return;
        }

        // Insert a placeholder option:
        var placeholderOpt = $('<option>')
            .val('')
            .text('Select Address');
        $addressSelect.append(placeholderOpt);

        // If there's no error in data.data
        if (data.data && !data.data.error && data.data.data && data.data.data.Results) {
            data.data.data.Results.forEach(function (addressObj) {
            var fullJSON = JSON.stringify(addressObj);
            var $option = $('<option>')
                .val(fullJSON)
                .text(addressObj.formattedAddress);
            $addressSelect.append($option);
            });

            $addressSelect.focus();
            $addressSelect.select2('open');
        }

        })
        .catch(function (error) {
        console.error('Fetch error:', error);
        });
    });



    // 3) When user picks a “specific address” from the second dropdown
    $(document).on('change', 'select[id^="belg-select-address-field-"]', function () {

    var $this = $(this);
    var rawValue = $this.val();
    if (!rawValue) return; // user might have chosen the placeholder

    var chosenObj;
    try {
        chosenObj = JSON.parse(rawValue);
    } catch (e) {
        return console.error('JSON parse error', e);
    }

    // Determine which block's fields to update
    // e.g. if `id="select-address-field-3"`, then suffix = 3
    var suffix = $this.attr('id').replace('belg-select-address-field-', '');

    // Find those data-IDs
    var $streetDropdown = $('#belg-street-autocomplete-' + suffix);
    var postcodeID = $streetDropdown.data('postcode-id');   // e.g. "postcode-3"
    var housenumberID = $streetDropdown.data('housenumber-id');
    var plaatsID = $streetDropdown.data('plaats-id');
    var streetID = $streetDropdown.data('street-id');
    var addressID = $streetDropdown.data('address-id');
    var mapID = $streetDropdown.data('map-id');


    // Now fill them in
    $('#' + postcodeID).val(chosenObj.postalcode || '');
    $('#' + housenumberID).val(chosenObj.number || '');
    $('#' + plaatsID).val(chosenObj.municipality || '');
    $('#' + streetID).val(chosenObj.street || '');
    $('#' + addressID).val(chosenObj.formattedAddress);

    $('#' + mapID).attr('lat', chosenObj.Location.Coordinates.latitude);
    $('#' + mapID).attr('lng', chosenObj.Location.Coordinates.longitude);


    // If you want to do a map preview, for example:
    showMap(chosenObj.Location.Coordinates.latitude, chosenObj.Location.Coordinates.longitude, mapID);
    });

    // 3.1) When user picks a “specific address” from the second dropdown
    $(document).on('change', 'select[id^="germ-select-address-field-"]', function () {
    var $this = $(this);
    var rawValue = $this.val();
    if (!rawValue) return; // user might have chosen the placeholder

    var chosenObj;
    try {
        chosenObj = JSON.parse(rawValue);
    } catch (e) {
        return console.error('JSON parse error', e);
    }

    // Determine which block's fields to update
    // e.g. if `id="select-address-field-3"`, then suffix = 3
    var suffix = $this.attr('id').replace('germ-select-address-field-', '');

    // Find those data-IDs
    var $streetDropdown = $('#germ-street-autocomplete-' + suffix);
    var postcodeID = $streetDropdown.data('postcode-id');   // e.g. "postcode-3"
    var housenumberID = $streetDropdown.data('housenumber-id');

    var plaatsID = $streetDropdown.data('plaats-id');
    var streetID = $streetDropdown.data('street-id');
    var addressID = $streetDropdown.data('address-id');
    var mapID = $streetDropdown.data('map-id');
    // Now fill them in
    $('#' + postcodeID).val(chosenObj.postalcode || '');
    $('#' + housenumberID).val(chosenObj.number || '');
    $('#' + plaatsID).val(chosenObj.city || '');
    $('#' + streetID).val(chosenObj.street || '');
    $('#' + addressID).val(chosenObj.formattedAddress);
    $('#' + mapID).attr('lat', chosenObj.Location.Coordinates.latitude);
    $('#' + mapID).attr('lng', chosenObj.Location.Coordinates.longitude);


    console.log(chosenObj.Location.Coordinates.latitude);
    showMap(chosenObj.Location.Coordinates.latitude, chosenObj.Location.Coordinates.longitude, mapID);
    });

}); // end document.ready
</script>

<script>

function computeHeading(fromLatLng, toLatLng) {
    return google.maps.geometry.spherical.computeHeading(fromLatLng, toLatLng);
}

function showMap(lat, lng, mapId, btnId) {
    const container = document.getElementById(mapId);
    container.style.display = "block";

    const latNumber = parseFloat(lat);
    const lngNumber = parseFloat(lng);

    document.getElementById(mapId).setAttribute('lat', latNumber);
    document.getElementById(mapId).setAttribute('lng', lngNumber);

    const location = new google.maps.LatLng(latNumber, lngNumber);

    const map = new google.maps.Map(container, {
    center: location,
    zoom: 14
    });

    const streetViewService = new google.maps.StreetViewService();
    const streetViewRadius = 150;

    streetViewService.getPanorama({ location: location, radius: streetViewRadius }, function (data, status) {
    if (status === google.maps.StreetViewStatus.OK) {
        const panoLocation = data.location.latLng;
        const heading = computeHeading(panoLocation, location); // Face toward the house

        const panorama = new google.maps.StreetViewPanorama(container, {
        position: panoLocation,
        pov: {
            heading: heading,
            pitch: 0
        },
        zoom: 1
        });
        map.setStreetView(panorama);
        $('textarea').trigger('change');

    } else {
        Swal.fire({
        title: 'Adres niet gevonden',
        text: 'Er is geen adres gevonden met deze gegevens. Vul handmatig het juiste adres in.',
        icon: 'warning',
        confirmButtonText: 'Oké'
        });
    }
    });
}
</script>

<script>

var $ = jQuery.noConflict();

$(document).ready(function () {
    function formatState(state) {
    if (!state.id) return state.text;
    var image = $(state.element).data('image');
    return $('<span><img src="' + image + '" width="20" height="15" style="object-fit: cover;"/> ' + state.text + '</span>');
    }

    $('.select-flag').select2({
    templateResult: formatState,
    templateSelection: formatState
    });
});
	
</script>

<?php
	
	//The code that was lost while updating the codebase:
