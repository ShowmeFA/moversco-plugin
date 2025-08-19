<div class="wrap">
    <h1><?php _e('Form Settings', 'moversco-form'); ?></h1>
    <form method="post" action="options.php">
        <?php
        // Register settings
        settings_fields('moversco_form_settings_group');
        do_settings_sections('moversco_form_settings_group');

        // Email for Customer Editor
        ?>
        
        <h2><?php _e('Checkout Page URL', 'moversco-form'); ?></h2>
        <input 
            type="text" 
            name="checkout_page_url" 
            value="<?php echo esc_attr(get_option('checkout_page_url')); ?>" 
            style="width: 100%; max-width: 600px;" 
            placeholder="<?php _e('Checkout Page URL', 'moversco-form'); ?>"
        />
        
        <h2><?php _e('Enter Email Subject', 'moversco-form'); ?></h2>
        <input 
            type="text" 
            name="moversco_email_subject_for_customer" 
            value="<?php echo esc_attr(get_option('moversco_email_subject_for_customer')); ?>" 
            style="width: 100%; max-width: 600px;" 
            placeholder="<?php _e('Recieved Form', 'moversco-form'); ?>"/>
        
        <h2><?php _e('Enter Email Subject For Staff', 'moversco-form'); ?></h2>
        <input 
            type="text" 
            name="moversco_email_subject_for_staff" 
            value="<?php echo esc_attr(get_option('moversco_email_subject_for_staff')); ?>" 
            style="width: 100%; max-width: 600px;" 
            placeholder="<?php _e('Admin, Please Proceed the order', 'moversco-form'); ?>"/>
        
        <h2><?php _e('Enter Emails with Comma For Notifications', 'moversco-form'); ?></h2>
        <input 
            type="text" 
            name="moversco_emails_for_notifications" 
            value="<?php echo esc_attr(get_option('moversco_emails_for_notifications')); ?>" 
            style="width: 100%; max-width: 600px;" 
            placeholder="<?php _e('Enter emails separated...', 'moversco-form'); ?>"/>
        
        <h2><?php _e('Email for Customer', 'moversco-form'); ?></h2>
        <p>Use The Following Placeholders for the forms data to be sent inside email</p>
        <ul>
        <li>Order Fields
            <ul>
            <li>{order_id} — Uniek bestelnummer</li>
            <li>{form_link} — Form Link</li>
            <li>{first_name} — Klant voornaam</li>
            <li>{sur_name} — Klant achternaam</li>
            <li>{telephone} — Telefoonnummer</li>
            <li>{email_address} — E-mail adres</li>
            <li>{salutation} — Aanhef (bijv. “Dhr.” of “Mevr.”)</li>
            <li>{typeklant} — Type klant</li>
            <li>{businessname} — Bedrijfsnaam</li>
            <li>{preferred_date} — Voorkeursverhuisdatum</li>
            <li>{comments} — Vragen of opmerkingen</li>
            <li>{verhuislift} — Verhuislift nodig?</li>
            <li>{Verhuizers} — Verhuiswagen nodig?</li>
            <li>{Verhuiswagen} — Verhuizers nodig?</li>
            <li>{packing_boxes} — Inpakken in dozen?</li>
            <li>{total_boxes} — Aantal dozen</li>
            <li>{disassembly_work} — (De)montagewerk</li>
            <li>{products} — Inventarislijst</li>
            <li>{disassembly_products} — (De)montagewerk items</li>
            <li>{number_of_addresses} — Aantal adresstops</li>
            <li>{total_products} — Totaal aantal producten</li>
            <li>{number_of_items} — Aantal artikelen</li>
            <li>{total_area} — Kubieke meters (m³)</li>
            <li>{submission_date} — Datum van aanvraag</li>
            <li>{privacy_toestemming} — Privacy Toestemming</li>
            <li>{voorwaarden_kennisname} — Voorwaarden Kennisname</li>
                
            </ul>
        </li>
        <li>Address Fields (use as <code>{addressType_fieldName}</code>)
            <ul>
            <li><strong>Address types:</strong> startadres, tussenadres-1, tussenadres-2, eindadres</li>
            <li><strong>Field names:</strong>
                <ul>
                <li>full_address — Volledig adres</li>
                <li>property_type — Type woning</li>
                <li>house_floor — Verdieping(en)</li>
                <li>lift — Interne lift aanwezig?</li>
                <li>distance_from_parking — Afstand parkeerplek–voordeur</li>
                <li>latitude — GPS breedtegraad</li>
                <li>longitude — GPS lengtegraad</li>
                <li>country — Land</li>
                <li>postal — Postcode</li>
                <li>housenumber — Huisnummer</li>
                <li>plaats — Plaatsnaam</li>
                <li>straat — Straatnaam</li>
                </ul>
            </li>
            </ul>
        </li>
        <li>Voorbeeld:
            <ul>
            <li>{startadres_full_address} → het volledige “startadres”</li>
            <li>{eindadres_postal} → de postcode van het “eindadres”</li>
            </ul>
        </li>
        </ul>
        <?php
        wp_editor(get_option('moversco_email_for_customer'), 'moversco_email_for_customer', [
            'textarea_name' => 'moversco_email_for_customer',
            'textarea_rows' => 10,
        ]);
        
        submit_button();
        ?>
    </form>
</div>

