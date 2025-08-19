// This file is intentionally left blank.
var $ = jQuery.noConflict();

$(document).ready(function () {
    "use strict";

    // Show loader function
    function showLoader() {
        if (document.getElementById('custom-loader-overlay')) return; // prevent duplicate
    
        const overlay = document.createElement('div');
        overlay.id = 'custom-loader-overlay';
    
        const spinner = document.createElement('div');
        spinner.className = 'custom-spinner';
    
        overlay.appendChild(spinner);
        document.body.appendChild(overlay);
      }
    
    // Hide loader function
    function hideLoader() {
        const loader = document.getElementById('custom-loader-overlay');
        if (loader) {
          loader.remove();
        }
      }

    //Scroll to Top when clicked on search bar
    $('#totalSearchInput').on('click', function(){
        var productsSectionTop = $('#products-section').offset().top;
        console.log('The top offset is right now '+ productsSectionTop);
        $('html, body').animate({
        scrollTop: productsSectionTop-40 
        }, 500); // 500ms duration for smooth effect
    });

    //Search Scroll Setup
    function setupSearchScroll(){
        var searchBar = $('.search-sticky');
        var bottomSection = $('#totalProductList1');
        var formSection = $('#formSection');
        
        // Only run on mobile devices
        if (1 == 1) {
        
            var originalOffsetTop = searchBar.offset().top;
        
            function updateBottomLimit() {
                return bottomSection.offset().top + bottomSection.outerHeight();
            }
        
            var bottomLimit = updateBottomLimit();
        
            $(window).on('scroll', function () {
                var scrollTop = $(window).scrollTop();
                var searchBarHeight = searchBar.outerHeight();
                var sectionTop = bottomSection.offset().top;
                var sectionBottom = sectionTop + bottomSection.outerHeight();
        
                if (scrollTop > originalOffsetTop && (scrollTop + searchBarHeight) < sectionBottom) {
                    // Stick to top of screen while within section
                    searchBar
                        .addClass('sticky')
                        .css({
                            position: 'fixed',
                            top: '0',
                            width: formSection.outerWidth()
                        });
                } else if ((scrollTop + searchBarHeight) >= sectionBottom) {
                    // Stick bottom of search bar to bottom of section
                    var offsetWithinSection = bottomSection.outerHeight() - searchBarHeight;
        
                    searchBar
                        .addClass('sticky')
                        .css({
                            position: 'absolute',
                            top: offsetWithinSection + 'px',
                            width: '100%'
                        });
                } else {
                    // Reset when above original point
                    searchBar
                        .removeClass('sticky')
                        .css({
                            position: 'static',
                            width: 'auto'
                        });
                }
            });
        }
}

    try {
        /***********************************/
        /***   FORM, ANIMATION, & SETUP  ***/
        /***********************************/   
        function verificationForm() {
            
            
            var animating = false;
        
            $(".next").on("click", function () {
                $('html, body').animate({
                    scrollTop: 100 // Adjust this value to control how far from the top you scroll
                }, 500); // 500ms duration for smooth effect
        
        
                if (animating) return false;
                animating = true;
                

                var current_fs = $(this).parent().parent();
                var next_fs = current_fs.next();
                
               setTimeout(function() {
                    var currentIndex =  $("fieldset").index(current_fs);
                    if (currentIndex == 0)
                        setupSearchScroll();
                }, 1000); // 1000 milliseconds = 1 second
        
                // Show next fieldset
                current_fs.hide();
                next_fs.css('display', 'flex');
        
                // Update progress bar
                var nextIndex = $("fieldset").index(next_fs);
                $("#progressbar li").eq(nextIndex).addClass("active");
        
                animating = false;
            });
        
            $(".previous").on("click", function () {
                
                $('html, body').animate({
                    scrollTop: 100 // Adjust this value to control how far from the top you scroll
                }, 500); // 500ms duration for smooth effect
                
                if (animating) return false;
                animating = true;

                
                var current_fs = $(this).parent().parent();
                var previous_fs = current_fs.prev();
        
                // Show previous fieldset
                current_fs.hide();
                previous_fs.css('display', 'flex');

        
                // Update progress bar
                var currentIndex = $("fieldset").index(current_fs);
                $("#progressbar li").eq(currentIndex).removeClass("active");
        
                animating = false;
            });
        
            $(".submit").on("click", function () {
                return false;
            });
        
            // Allow click on previous or current steps only
            $("#progressbar li").on("click", function () {
                
                $('html, body').animate({
                    scrollTop: 0 // Adjust this value to control how far from the top you scroll
                }, 0); // 500ms duration for smooth effect
        
                
                var stepIndex = $(this).index();
                var currentIndex = $("fieldset:visible").index();
                

                // Allow navigation only to current or previous steps
                // Show the selected fieldset
                $("fieldset").hide();
                $("fieldset").eq(stepIndex).css('display', 'flex');        
                // Update progress bar
                $("#progressbar li").removeClass("active");
                $("#progressbar li:lt(" + (stepIndex + 1) + ")").addClass("active");
                if(currentIndex == 1)
                setupSearchScroll();
                
    // Update positions on resize
    $(window).on('resize', function () {
        originalOffsetTop = searchBar.offset().top;
        bottomLimit = updateBottomLimit();
        if (searchBar.hasClass('sticky')) {
            searchBar.css('width', formSection.outerWidth() - 25);
        }
    });
                });
            
            }
        // function phoneNoselect() {
        //     if ($('#msform').length) {
        //         $("#phone").intlTelInput();
        //         $("#phone").intlTelInput("setNumber", "+880");
        //     }
        // }

        function nice_Select() {
            try {
                if ($('.product_select').length) {
                    $('select').niceSelect();
                }
            } catch (error) {
                console.error("Error in nice_Select function:", error);
            }
        }

        // Call the main form functions
        verificationForm();
        // phoneNoselect(); // commented out by default
        nice_Select();

        /***********************************************/
        /*** DISPLAY FORM & AJAX: generate_new_form  ***/
        /***********************************************/
        try {
            var $formSection = $('#formSection');
            if ($formSection.length) {
                var DisplayForm = $formSection.attr('data-id');
                var DisplaySession = $formSection.attr('data-session-id');

                if (DisplayForm !== "" && DisplaySession !== "") {
                    $formSection.css('display', 'flex');
                } else {
                    // Make the AJAX request
                    $.ajax({
                        url: moversco_ajax.ajax_url,
                        type: 'POST',
                        data: { action: 'generate_new_form', nonce: moversco_ajax.nonce},
                        success: function (response) {
                            try {
                                if (response.success) {
                                    var currentUrl = window.location.href;
                                    var nextUrl = currentUrl + '?id=' + response.data.id + '&session_id=' + response.data.session_id;
                                    window.location.replace(nextUrl);
                                } else {
                                    console.error('Error:', response.data.message);
                                }
                            } catch (err) {
                                console.error("Error handling generate_new_form response:", err);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                        }
                    });
                }
            } else {
                console.error("#formSection not found in DOM.");
            }
        } catch (error) {
            console.error("Error in form display logic:", error);
        }

        /******************************************************/
        /*** DYNAMIC UPDATES: Save form progress via change ***/
        /******************************************************/
        try {
            
    // Helper function to build the address data for a given form number.
    function buildAddressFor(i) {
        // Get the selected country value for this address.
        let selectedCountryType = $("#country-"+i).val();
        // Alternatively, if you use a select, you could use: 
        
        // Define an empty object to hold the address.
        let addressData = {};
    
        // Get common elements.
        let $formElem = $("#Full-" + i);
        let completeAddress = ($formElem.val() || '').replace(/^[/\\]+/, '');
        let mapID = $formElem.attr('data-map-id');
        let propertyType =  '';
        let houseFloor = '';
        let Lift = '';
        let distanceFromParking = '';

        
        //Data About The Address
    
        let mapLat = parseFloat($("#" + mapID).attr('lat')) || 0;
        let mapLong = parseFloat($("#" + mapID).attr('lng')) || 0;
        

        // Build the address object based on the selected country.
        if (selectedCountryType === 'nethr') {
            addressData = {
                country: 'Netherland',
                postal: $("#Full-" + i + "-nether-postal").val(),
                housenumber: $("#Full-" + i + "-nether-housenumber").val(),
                straat: ($("#Full-" + i + "-nether-straat").val() || '').replace(/^['\/\\\r\n\t\s]+/, ''),
                plaats: $("#Full-" + i + "-nether-plaats").val()
            };
        } else if (selectedCountryType === 'belg') {
            // Retrieve the IDs for Belgium-specific fields from data attributes.
            let $belgElement  = $("#Full-" + i);
            let belgPostalID  = $('#belg-postcode-'+i);
            let belgHouseNoID = $('#belg-housenumber-'+i);
            let belgCityID    = $('#belg-city-'+i);
            let belgStreetID    = $('#belg-street-'+i);
            let belgPlaatsID    = $('#belg-plaats-'+i);
            
            addressData = {
                country: 'Belgium',
                postal: belgPostalID.val(),
                housenumber: belgHouseNoID.val(),
                straat:belgStreetID.val(),
                plaats: belgPlaatsID.val()
            };
        } else if (selectedCountryType === 'germ') {
            // For German fields, assume IDs are built using a "germ-" prefix.
            let $belgElement  = $("#Full-" + i);
            let belgPostalID  = $('#germ-postcode-'+i);
            let belgHouseNoID = $('#germ-housenumber-'+i);
            let belgCityID    = $('#germ-city-'+i);
            let belgStreetID    = $('#germ-street-'+i);
            let belgPlaatsID    = $('#germ-plaats-'+i);
            addressData = {
                country: 'Germany',
                postal: belgPostalID.val(),
                housenumber: belgHouseNoID.val(),
                straat:belgStreetID.val(),
                plaats: belgPlaatsID.val()
            };
        } else {
            // Default case: if no country selected, you might want to assign empty values
            addressData = {
                country: 'Netherland',
                postal: '',
                housenumber: '',
                straat: '',
                plaats: ''
            };
        }
        
        let addressType = "";

        // pick the enum value
        switch (i) {
            case 1:
                addressType = 'startadres';
                propertyType = $("input[name='building-1']:checked").val() || '';
                houseFloor = $.map($("input[name='floor-1[]']:checked"), function(el) { return el.value; });
                Lift = $("input[name='lift-1']:checked").val() || '';
                distanceFromParking = $("input[name='meter-1']:checked").val() || '';
                break;
                
            case 2:
                addressType = 'eindadres';
                propertyType = $("input[name='building-2']:checked").val() || '';
                houseFloor = $.map($("input[name='floor-2[]']:checked"), function(el) { return el.value; });
                Lift = $("input[name='lift-2']:checked").val() || '';
                distanceFromParking = $("input[name='meter-2']:checked").val() || '';
                break;
                
            case 3:
                addressType = 'tussenadres-1';
                propertyType = $("input[name='building-3']:checked").val() || '';
                houseFloor = $.map($("input[name='floor-3[]']:checked"), function(el) { return el.value; });
                Lift = $("input[name='lift-3']:checked").val() || '';
                distanceFromParking = $("input[name='meter-3']:checked").val() || '';
                break;
            case 4:
                addressType = 'tussenadres-2';
                propertyType = $("input[name='building-4']:checked").val() || '';
                houseFloor = $.map($("input[name='floor-4[]']:checked"), function(el) { return el.value; });
                Lift = $("input[name='lift-4']:checked").val() || '';
                distanceFromParking = $("input[name='meter-4']:checked").val() || '';
                break; // <-- this was missing
            default:
                addressType = 'unsupported';
        }
    
        // Attach common values.
        addressData.mapLat = mapLat;
        addressData.mapLong = mapLong;
        addressData.order_id = $('#formSection').attr('data-id');
        addressData.address_type = addressType;
        addressData.full_address = completeAddress;
        addressData.distance_from_parking = distanceFromParking;
        addressData.Lift = Lift;
        addressData.house_floor = houseFloor;
        addressData.property_type = propertyType;
    
        return addressData;
        
    }
    
            $('input, textarea').on('change', function() {
                let selectedtype = document.querySelector('input[name="customer-type"]:checked');
				if(selectedtype){
                if (selectedtype && selectedtype.value === "Business") {
                    document.getElementById('showBusinessName').style.display = "flex";
                } else {
                    document.getElementById('showBusinessName').style.display = "none";
                }
				}

                try {
                    var selectedRadio = document.querySelector('input[name="adressen"]:checked');
                    let numForms = 1;
                    let parentFormName = "1 adres";
                    if(selectedRadio){
                        numForms = parseInt(selectedRadio.value.split('-')[1]);
                        parentFormName = selectedRadio.getAttribute('data-form-name');
                    }

                    let formData = {
                        formID: $('#formSection').attr('data-id'),
                        sessionID: $('#formSection').attr('data-session-id'),
                        numberOfAddresses: parentFormName,
                        disassemblyWork: '',
                        disassemblyProducts: [],
                        packingBoxes: '',
                        totalBoxes: '',
                        Verhuizers:'',
                        Verhuiswagen:'',
                        verhuislift:[],
                        movingLift: '',
                        PreferredDate: '',
                        totalProducts: 0,
                        products: [],
                        numberOfItems: 0,
                        totalArea: 0,
                        salutation: '',
                        firstName: '',
                        surName: '',
                        telephone: '',
                        emailAddress: '',
                        Comments: '',
                        businessname: '',
                        typeklant: '',
                        privacy_toestemming:'',
                        voorwaarden_kennisname:''
                    };
                    
                    let buildAddress = "";

                    for (let i = 1; i <= numForms; i++) {
                        
                        let belgElement = $("#Full-" + i);
                        let belgPostalID = belgElement.attr('data-post');
                        let belgHouseNoID = belgElement.attr('data-housenumber');
                        let belgCityID = belgElement.attr('data-city');
                    
                        
                        let addressData = buildAddressFor(i);
                        updateAddress(addressData);

                        let finalAddressArray = [
                        ];
                        


                        let childFormData = {
                            formTitle: $("#formname-" + i).val() || '',
                            fullAddress: finalAddressArray,
                            propertyType: $("input[name='building-" + i + "']:checked").val() || '',
                            houseFloor: $.map($("input[name='floor-" + i + "[]']:checked"), function(el){return el.value;}),
                            lift: $("input[name='lift-" + i + "']:checked").val() || '',
                            distanceFromParkingToDoor: $("input[name='meter-" + i + "']:checked").val() || ''
                        };


                        // Check floors to show/hide .liftz-i
                        var SelectedGround = childFormData.houseFloor;
                        var valuesToCheck = ["1st floor", "2nd floor", "3rd floor", "4th floor or more"];
                        var hasAnyValue = valuesToCheck.some(function(val){return SelectedGround.includes(val);});
                        if(hasAnyValue){
                            $(".liftz-" + i).show();
                            console.log('Has any value:', hasAnyValue);
                        } else {
                            $(".liftz-" + i).hide();
                            console.log('Has no value:', hasAnyValue);
                        }

                        // Update UI
                        $(".Full-" + i).text($("#Full-" + i).val() || '');
                        $(".building-" + i).text($("input[name='building-" + i + "']:checked").val() || '');
                        $(".lift-" + i).text(childFormData.lift);
                        $(".afstand-" + i).text(childFormData.distanceFromParkingToDoor);
                    }

                    // Disassembly
                    let Demontagewerks = $("input[name='disassemblywork']:checked").val() || '';
                    $(".disassemblywork").text(Demontagewerks);
                    formData.disassemblyWork = Demontagewerks;
                    let dissasmg = [];
                    if (Demontagewerks !== "no") {
                        $("input[name='selectedProduct']").each(function(){
                            if ($(this).val() > 0) {
                                let productName = $(this).attr('data-name');
                                let productID = $(this).attr('data-id');
                                formData.disassemblyProducts.push({
                                    productName: productName,
                                    productID: productID,
                                    quantity: $(this).val()
                                });
                                dissasmg.push(productName);
                            }
                        });
                    }
                    $(".disassemblywork-products").text(dissasmg);
                    $(".disassemblywork-values").text(Demontagewerks);

                    // Inpakken
                    let inpakkenValue = $("input[name='packing']:checked").val() || '';
                    formData.packingBoxes = inpakkenValue;
                    $(".packing-dozen").text(inpakkenValue);

                    // Verhuizers
                    let VerhuizersValue = $("input[name='Movers']:checked").val() || '';
                    formData.Verhuizers = VerhuizersValue;
                    $(".Movers").text(VerhuizersValue);

                    // Verhuislift array
                    let verhuisliftValues = $.map($("input[name='movingLift[]']:checked"), function(el){return el.value;});
                    formData.verhuislift = verhuisliftValues;
                    $(".verhuislift-values").text(verhuisliftValues);

                    // Verhuiswagen
                    let VerhuiswagenValue = $("input[name='MovingTruck']:checked").val() || '';
                    formData.Verhuiswagen = VerhuiswagenValue;
                    $(".MovingTruck").text(VerhuiswagenValue);

                    // Boxes
                    if (inpakkenValue !== 'no') {
                        formData.totalBoxes = $("input[name='mover-boxes']:checked").val() || '';
                        $(".inpakken-nos").text(formData.totalBoxes);
                    }

                    // Additional fields
                    formData.movingLift = $("input[name='movingLift']:checked").val() || '';
                    formData.PreferredDate = $("#preferredDate").val() || '';
                    
                    console.log($("#preferredDate").val());

                    // Products
                    let prodctsInfo = [];
                    $("input[name='products']").each(function(){
                        if ($(this).val() > 0) {
                            formData.totalProducts++;
                            let productarea = parseFloat(
                              (parseFloat($(this).val()) * parseFloat($(this).attr('data-area'))).toFixed(2)
                            );
                            
                            formData.products.push({
                                ProductID: $(this).attr('data-product-id'),
                                ProductName: $(this).attr('data-product-name'),
                                ProductQuantity: $(this).val(),
                                ProductArea: productarea
                            });
                            prodctsInfo.push($(this).attr('data-product-name'));
                        }
                    });

                    $(".products-infos").text(prodctsInfo);

                    // Update UI
                    $(".aantal").text($(".total-products").text());
                    $(".Kubieke").text($(".total-area").text());

                    const privacyCheckbox = document.querySelector('input[name="privacyConsent"]');
                    const voorwaardenCheckbox = document.querySelector('input[name="termsAcknowledgment"]');
                    
                    const privacyConsent = privacyCheckbox.checked ? 'Yes' : 'No';
                    const voorwaardenConsent = voorwaardenCheckbox.checked ? 'Yes' : 'No';

                    formData.privacy_toestemming = privacyConsent;
                    formData.voorwaarden_kennisname = voorwaardenConsent;

                    formData.totalArea = parseFloat($(".total-area").text()) || 0;
                    formData.numberOfItems = parseInt($(".total-products").text()) || 0;
                    formData.salutation = $("input[name='Aanhef']:checked").val() || '';
                    formData.firstName = $("#firstName").val() || '';
                    formData.surName = $("#lastName").val() || '';
                    formData.telephone = $("#phone").val() || '';
                    formData.emailAddress = $("#email").val() || '';
                    formData.Comments = $("#comments").val() || '';
                    formData.businessname = $("#businessName").val() || '';
                    formData.typeklant = $("input[name='customer-type']:checked").val() || '';
                    formData.form_link = window.location.href;
                    // Save form progress AJAX
                    $.ajax({
                        url: moversco_ajax.ajax_url,
                        type: 'POST',
                        data: { action: 'save_form_progress', nonce: moversco_ajax.nonce, formData: formData },
                        success: function (response) {
                            if (response.success) {
                            hideLoader();
                                
                            } else {
                                console.error('Error:', response.data.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                        }
                    });
                } catch (e) {
                    console.error("Error in dynamic change handler:", e);
                }
            });
        } catch (error) {
            console.error("Error attaching onChange:", error);
        }

        /**************************************************************/
        /*** RADIOS & UI: demontage, inpakken, verhuislift, adressen ***/
        /**************************************************************/
        try {
            // demonRadios
            var demonRadios = document.querySelectorAll('input[name="adressen"]');
            demonRadios.forEach(function (radio) {
                radio.addEventListener('change', function () {
                    if (this.checked) {
                    }
                });
            });
        } catch (error) {
            console.error("Error in demonRadios handling:", error);
        }

        try {
            // Inpakken
            $("input[name='packing']").each(function(){
                var radio = this;
                if(radio.checked){
                    if(radio.value !== 'no') {
                        $('.boxes-row').show();
                    } else {
                        $('.boxes-row').hide();
                    }
                }

                $(radio).on('change', function(event){
                    if(event.target.checked){
                        if(event.target.value !== 'no') {
                            $('.boxes-row').show();
                        } else {
                            $('.boxes-row').hide();
                        }
                    }
                });
            });
        } catch (error) {
            console.error("Error in inpakken logic:", error);
        }

        try {
            // Demontagewerk
            $("input[name='disassemblywork']").each(function(){
                var radio = this;
                if(radio.checked){
                    if(radio.value !== 'no') {
                        $('.products-row').show();
                    } else {
                        $('.products-row').hide();
                    }
                }

                $(radio).on('change', function(event){
                    if(event.target.checked){
                        if(event.target.value !== 'no') {
                            $('.products-row').show();
                        } else {
                            $('.products-row').hide();
                        }
                    }
                });
            });
        } catch (error) {
            console.error("Error in demontagewerk logic:", error);
        }

        try {
            // Additional simple watchers
            $("input[name='disassemblywork']").on('change', function(event){
                if(event.target.checked){
                    $(".disassemblywork").text(event.target.value);
                }
            });

            $("input[name='inpakken']").on('change', function(event){
                if(event.target.checked){
                    $(".inpakken").text(event.target.value);
                }
            });

            $("input[name='movingLift']").on('change', function(event){
                if(event.target.checked){
                    $(".movingLift").text(event.target.value);
                }
            });
        } catch (error) {
            console.error("Error setting watchers:", error);
        }

        try {
            // Adressen
            $("input[name='adressen']").each(function(){
                var radio = this;

                // On load, if checked
                if(radio.checked){
                    $("input[name='movingLift']").prop('checked', false);

                    var forms = document.querySelectorAll('.' + radio.value);
                    var otherForms = document.querySelectorAll('.form-eng');

                    otherForms.forEach(function(others){
                        others.style.display = 'none';
                    });

                    forms.forEach(function(form){
                        form.style.display = 'flex';
                    });
                }

                // On change
                $(radio).on('change', function(event){
                    if(event.target.checked){
                        
                        var forms = document.querySelectorAll('.' + event.target.value);
                        var otherForms = document.querySelectorAll('.form-eng');

                        otherForms.forEach(function(others){
                            others.style.display = 'none';
                        });

                        forms.forEach(function(form){
                            form.style.display = 'flex';
                        });
                    }
                });
            });
        } catch (error) {
            console.error("Error in adressen logic:", error);
        }

        /*************************************************************/
        /*** PRODUCT CALCS & UI: total area, total products, etc.  ***/
        /*************************************************************/
        try {
            var Products = document.querySelectorAll('input.form-product-input-second');
            
            var totalProducts = {};
            // on change
            Products.forEach(function (product){
                product.addEventListener('change', function () {
                    try {
                        if (this.value > 0) {
                            var productId = this.getAttribute('data-product-id');

                            // Check if the product ID exists in totalProducts, if not, initialize it
                            if (!totalProducts[productId]) {
                                totalProducts[productId] = [];
                            }

                            // Store the values in the array
                            totalProducts[productId][0] = this.value;
                            totalProducts[productId][1] = this.getAttribute('data-area');
                        } else if (this.value == 0) {
                            var productId = this.getAttribute('data-product-id');
                            delete totalProducts[productId];
                        }

                        // Recalculate
                        var totalArea = 0;
                        var tProducts = 0;
                        for (var key in totalProducts) {
                            totalArea += parseFloat(totalProducts[key][0]) * parseFloat(totalProducts[key][1]);
                            tProducts += parseInt(totalProducts[key][0]);
                        }

                        document.querySelector('.total-area').innerText = parseFloat(totalArea).toFixed(2);
                        document.querySelector('.total-products').innerText = tProducts;
                    } catch (err) {
                        console.error("Error in product onChange calculation:", err);
                    }
                });
            });

            // Auto Update on Load
            Products.forEach(function (product){
                try {
                    if (product.value > 0) {
                        var productId = product.getAttribute('data-product-id');

                        if (!totalProducts[productId]) {
                            totalProducts[productId] = [];
                        }

                        totalProducts[productId][0] = product.value;
                        totalProducts[productId][1] = product.getAttribute('data-area');

                    } else if (product.value == 0) {
                        var productId = product.getAttribute('data-product-id');
                        delete totalProducts[productId];
                    }
                } catch (err) {
                    console.error("Error in product auto-load calculation:", err);
                }
            });

            // Final tally after load
            try {
                var totalAreaInit = 0;
                var tProductsInit = 0;
                for (var key in totalProducts) {
                    totalAreaInit += parseFloat(totalProducts[key][0]) * parseFloat(totalProducts[key][1]);
                    tProductsInit += parseInt(totalProducts[key][0]);
                }

                $(".total-area").text(parseFloat(totalAreaInit).toFixed(2));
                $(".total-products").text(tProductsInit);

            } catch (err) {
                console.error("Error in final tally:", err);
            }

        } catch (error) {
            console.error("Error in product calculations block:", error);
        }
        

        /*******************************************************/
        /*** SUBMIT HANDLER: Form_moversco_submit AJAX call  ***/
        /*******************************************************/
            
            function isValidEmail(email) {
              const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
              return pattern.test(email);
            }
        
            $('#submit-movers').on('click', function(){
                event.preventDefault();
                    showLoader();
                    const email = document.getElementById('email');
                    const confirmEmail = document.getElementById('confirmEmail');
				    const privacy = document.getElementById('privacyConsent');
                    const emailVal = email.value.trim();
				    const Voornaam = document.getElementById('firstName');
                    const confirmEmailVal = confirmEmail.value.trim();
                    if (!isValidEmail(emailVal)) {
                        hideLoader();
                        Swal.fire({
                            title: 'Ongeldig e-mailadres',
                            text: 'Voer een geldig e-mailadres in.',
                            icon: 'warning',
                            confirmButtonText: 'Oké'
                        });
                    }
				
				if(Voornaam.value.trim() === ""){
					hideLoader();
                    Swal.fire({
                        title: 'Naam ontbreekt',
                        text: 'Vul alstublieft uw naam in.',
                        icon: 'warning',
                        confirmButtonText: 'Oké'
                      });
					return;
				}
				
                    if (emailVal !== confirmEmailVal && emailVal !== '' ) {
                    hideLoader();
                    Swal.fire({
                        title: 'E-mail mismatch',
                        text: 'E-mailadressen komen niet overeen.',
                        icon: 'warning',
                        confirmButtonText: 'Oké'
                      });
                      confirmEmail.focus();
                      return;
                    }else if (emailVal.trim() === '') {
                        hideLoader();
                        Swal.fire({
                            title: 'E-mailadres ontbreekt',
                            text: 'Voer een e-mailadres in.',
                            icon: 'warning',
                            confirmButtonText: 'Oké'
                        });
                        return;
                    }
				
					if (!privacy.checked) { 
						hideLoader();
						Swal.fire({
							title: 'Verwerking persoonsgegevens',
							text: ' U moet akkoord geven op de verwerking van uw gegevens.',
							icon: 'warning',
							confirmButtonText: 'Oké'
						});
						return;
					}
                    
                    let formData = {
                        formID: $('#formSection').attr('data-id')
                        };
                    // Submit AJAX
                    $.ajax({
                        url: moversco_ajax.ajax_url,
                        type: 'POST',
                        data: { action: 'Form_moversco_submit', formData: formData },
                        success: function (response) {
                            if (response.success) {
                                hideLoader();

                                setTimeout(() => {
                                     window.location.href = response.data.checkoutURL;
                                }, 3000);

                                Swal.fire({
                                    title: 'Succes!',
                                    text: 'Het formulier is succesvol verzonden!',
                                    icon: 'success',
                                    confirmButtonText: 'Verder'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect only when OK is clicked
                                        window.location.href = response.data.checkoutURL;
                                    }
                                });
                                
                            } else {
                                console.error('Error:', response.data.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                        }
                    });
            });



        /***************************************/
        /*** Additional DOMContentLoaded code ***/
        /***************************************/
        try {
            // final DOMContentLoaded for receipt doc
            $('#close-btn-eng').on('click', function(){
                try {
                    $('.eng-modal').css('display', 'none');
                } catch (err){
                    console.error("Error closing modal:", err);
                }
            });

            $('#reciept-document').on('click', function(e){
                try {
                    e.preventDefault();
                    $('.eng-modal').css('display', 'block');
                } catch (err){
                    console.error("Error opening receipt modal:", err);
                }
            });
        } catch (error) {
            console.error("Error in additional DOMContentLoaded code:", error);
        }

    } catch (globalError) {
        console.error("Error in main script:", globalError);
    }
});


window.onload = function () {
  setTimeout(function () {
    $('textarea').trigger('change');
  }, 1000); // 2000ms = 2 seconds
};


jQuery(document).ready(function($) {
    
    let selectedtype = document.querySelector('input[name="customer-type"]:checked');
    console.log('Comes Here');
	if(selectedtype){
    console.log(selectedtype.value);
    if (selectedtype && selectedtype.value === "Business") {
        document.getElementById('showBusinessName').style.display = "flex";
    } else {
        document.getElementById('showBusinessName').style.display = "none";
    }
    }

//Checked

const searchInput = document.getElementById("demonSearchInput");  // Updated ID for the search input
console.log('The Search INput is ' + searchInput);
const productList = document.getElementById("demonProductList");  // Get the product list container
const productRows = productList.querySelectorAll(".form-product-row");  // Select all product rows inside the container

searchInput.addEventListener("input", function() {
	console.log('Something Got Inoutteed');
    const searchTerm = searchInput.value.toLowerCase();

    productRows.forEach(function(row) {
        // Get the title and keywords of the product (from data attributes)
        const title = row.getAttribute("data-title").toLowerCase();
        const tags = row.getAttribute("data-tags").toLowerCase();
        
        // If the search term is empty, show all rows
        if (searchTerm === "") {
            row.style.setProperty('display', 'grid', 'important');  // Show the product row
        } else {
            // Check if the search term matches title or tags
            if (title.includes(searchTerm) || tags.includes(searchTerm)) {
                row.style.setProperty('display', 'grid', 'important');  // Show the product row
            } else {
                row.style.setProperty('display', 'none', 'important');  // Hide the product row
            }
        }
    });
});

const searchInputProducts = document.getElementById("totalSearchInput");  // Updated ID for the search input
const productListProducts = document.getElementById("totalProductList1");  // Get the product list container
const productRowsProducts = productListProducts.querySelectorAll(".form-product-row");  // Select all product rows inside the container

searchInputProducts.addEventListener("input", function() {
    const searchTerm = searchInputProducts.value.toLowerCase();

    productRowsProducts.forEach(function(row) {
        // Get the title and keywords of the product (from data attributes)
        const title = row.getAttribute("data-title").toLowerCase();
        const tags = row.getAttribute("data-tags").toLowerCase();
        
        // If the search term is empty, show all rows
        if (searchTerm === "") {
            row.style.setProperty('display', 'grid', 'important');  // Show the product row
        } else {
            // Check if the search term matches title or tags
            if (title.includes(searchTerm) || tags.includes(searchTerm)) {
                row.style.setProperty('display', 'grid', 'important');  // Show the product row
            } else {
                row.style.setProperty('display', 'none', 'important');  // Hide the product row
            }
        }
    });
});


});

function updateAddress(address){
    $.ajax({
      url: moversco_ajax.ajax_url, // URL for the AJAX request
      type: 'POST',
      data: {
        action: 'update_address_fields',
        addressObject: address,
        },
      success: function(response) {
      },
      error: function(xhr, status, error) {
        console.log('AJAX Error:', error);
      }
    });
}


jQuery(document).ready(function($) {
  // Function to load products via AJAX with optional search term
  function loadFormProducts(searchTerm = '') {
    $.ajax({
      url: moversco_ajax.ajax_url, // URL for the AJAX request
      type: 'POST',
      data: {
        action: 'get_form_products',
        search: searchTerm,
        products: JSON.parse($('#totalSearchInput').attr('data-products')),

        // You can also pass additional parameters like disassemblyProducts if needed
      },
      success: function(response) {
        // Insert the returned HTML into your desired section
        $('#totalProductList1').html(response);
      },
      error: function(xhr, status, error) {
        console.log('AJAX Error:', error);
      }
    });
  }
  
  
  // Trigger the AJAX search on keyup event on the search input field
  $('#totalSearchInput').on('keyup', function() {
    var searchTerm = $(this).val();
    loadFormProducts(searchTerm);
  });
  
  // Initially load products with an empty search term
  loadFormProducts();
  
  
});

document.addEventListener('DOMContentLoaded', () => {
    
``
    var Products = document.querySelectorAll('input.form-product-input-second');
    var totalProducts = {};
    
     document.addEventListener('change', function (event) {
            
            if (event.target.classList.contains('form-product-input-second')) {

            if (event.target.value > 0) {
                var productId = event.target.getAttribute('data-product-id');
                // Check if the product ID exists in totalProducts, if not, initialize it as an array
                if (!totalProducts[productId]) {
                    totalProducts[productId] = [];
                }
            
                // Store the values in the array
                totalProducts[productId][0] = event.target.value;
                totalProducts[productId][1] = parseFloat (event.target.getAttribute('data-area'));
            } else if (event.target.value == 0) {
                var productId = event.target.getAttribute('data-product-id');
                
                // Remove the product from totalProducts if its value is 0
                delete totalProducts[productId];
            }
            
            // Calculate total area and total products after updating/removing products
            var totalArea = 0;
            var tProducts = 0;
            for (var key in totalProducts) {
                totalArea += parseFloat(totalProducts[key][0]) * parseFloat(totalProducts[key][1]);
                tProducts += parseInt(totalProducts[key][0]);
            }
            
            // Update the total area and total products in the UI
            document.querySelector('.total-area').innerText = parseFloat(totalArea).toFixed(2);
            document.querySelector('.total-products').innerText = tProducts;
            
            }
     
     });




    //Auto Update on Load

    Products.forEach(function (product) {
        
            if (product.value > 0) {
                var productId = product.getAttribute('data-product-id');
            
                // Check if the product ID exists in totalProducts, if not, initialize it as an array
                if (!totalProducts[productId]) {
                    totalProducts[productId] = [];
                }
            
                // Store the values in the array
                totalProducts[productId][0] = product.value;
                totalProducts[productId][1] = product.getAttribute('data-area');
            
            } else if (product.value == 0) {
                var productId = product.getAttribute('data-product-id');
                
                // Remove the product from totalProducts if its value is 0
                delete totalProducts[productId];
            }
            
            // Calculate total area and total products after updating/removing products
            var totalArea = 0;
            var tProducts = 0;
            for (var key in totalProducts) {
                totalArea += parseFloat(totalProducts[key][0]) * parseFloat(totalProducts[key][1]);
                tProducts += parseInt(totalProducts[key][0]);
            }
            
            // Update the total area and total products in the UI
            document.querySelector('.total-area').innerText = parseFloat(totalArea).toFixed(2);
            document.querySelector('.total-products').innerText = tProducts;
            
    });
    
    
    

    //End of Update on Load

});

$(document).ready(function () {
    $("#movingLift-no").change(function () {
        if ($(this).is(":checked")) {
            $("input[name='movingLift[]']").not(this).prop("checked", false);
        }
    });

    $("input[name='movingLift[]']").not("#movingLift-no").change(function () {
        $("#movingLift-no").prop("checked", false);
    });
    
    $("textarea").trigger("change");

    
});



