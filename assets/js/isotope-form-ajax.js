/**
 * Isotope Form AJAX Handler with Cart Functionality
 * Handles cascading dropdown population and "Add to Quote" cart
 */

jQuery(document).ready(function($) {
    console.log('Isotope Form Data:', isotopeFormData);

    var formId = isotopeFormData.formId;
    var fields = isotopeFormData.fieldIds;
    
    // Build field selectors
    var elementField = '#input_' + formId + '_' + fields.element;
    var isotopeField = '#input_' + formId + '_' + fields.isotope;
    var chemicalFormField = '#input_' + formId + '_' + fields.chemicalForm;
    var physicalFormField = '#input_' + formId + '_' + fields.physicalForm;
    var enrichmentField = '#input_' + formId + '_' + fields.enrichment;
    var qtyUnitField = '#input_' + formId + '_' + fields.qtyUnit;
    var quantityField = '#input_' + formId + '_' + fields.quantity;
    var unitsField = '#input_' + formId + '_' + fields.units;
    var commentsField = '#input_' + formId + '_' + fields.comments;
    var cartDataField = '#input_' + formId + '_' + fields.cartData;
    
    // Get field container selectors for show/hide
    var chemicalFormContainer = '#field_' + formId + '_' + fields.chemicalForm;
    var physicalFormContainer = '#field_' + formId + '_' + fields.physicalForm;
    
    // Track whether physical form should be available
    var physicalFormAvailable = false;
    
    // Cart array to store items
    var cartItems = [];

    // Load cart from localStorage OR hidden field on page load
    function loadCartFromStorage() {
        // First, check if the hidden field has data (from a failed submission)
        var hiddenFieldValue = $(cartDataField).val();
        
        console.log('Loading cart - Hidden field value:', hiddenFieldValue);
        
        if (hiddenFieldValue) {
            try {
                cartItems = JSON.parse(hiddenFieldValue);
                console.log('Loaded cart from hidden field:', cartItems);
                updateCartDisplay();
                saveCartToStorage();
                return;
            } catch (e) {
                console.error('Error parsing hidden field cart data:', e);
            }
        }
        
        // If hidden field is empty, try localStorage
        var storedCart = localStorage.getItem('isotope_cart_form_' + formId);
        console.log('Loading cart - localStorage value:', storedCart);
        
        if (storedCart) {
            try {
                cartItems = JSON.parse(storedCart);
                console.log('Loaded cart from localStorage:', cartItems);
                updateCartDisplay();
                $(cartDataField).val(JSON.stringify(cartItems));
            } catch (e) {
                console.error('Error loading cart from storage:', e);
            }
        }
    }

    // Save cart to localStorage
    function saveCartToStorage() {
        localStorage.setItem('isotope_cart_form_' + formId, JSON.stringify(cartItems));
    }

    // Clear cart from localStorage (call this on successful form submission)
    function clearCartFromStorage() {
        localStorage.removeItem('isotope_cart_form_' + formId);
    }

    
    /**
     * Initialize ALL fields to empty on page load
     */
    $(elementField).val('').trigger('change.select2');

    resetField(isotopeField);
    resetField(chemicalFormField);
    resetField(physicalFormField);
    resetField(enrichmentField);
    resetField(qtyUnitField);

    hideField(chemicalFormContainer);
    hideField(physicalFormContainer);

    addSkeletonStyles();

    // Wait for Gravity Forms to fully render, then load cart
    $(document).on('gform_post_render', function(event, form_id, current_page){
        if (form_id == formId) {
            // Only load cart once per page load
            if (!window.isotopeCartLoaded) {
                console.log('Loading cart via gform_post_render');
                loadCartFromStorage();
                window.isotopeCartLoaded = true;
            }
        }
    });

    // Backup: Also try loading after a delay in case gform_post_render doesn't fire
    setTimeout(function() {
        if (!window.isotopeCartLoaded) {
            loadCartFromStorage();
            window.isotopeCartLoaded = true;
        }
    }, 500);
    
    /**
     * When Element is selected, load Isotopes
     */
    $(document).on('change', elementField, function() {
        var elementId = $(this).val();
        
        resetField(isotopeField);
        resetField(chemicalFormField);
        resetField(physicalFormField);
        resetField(enrichmentField);
        resetField(qtyUnitField);
        
        hideField(chemicalFormContainer);
        hideField(physicalFormContainer);
        physicalFormAvailable = false;
        
        validateAddToQuoteButton();
        
        if (!elementId) {
            return;
        }
        
        var elementContainer = '#field_' + formId + '_' + fields.element;
        showSkeletonLoader(elementContainer);
        
        $(isotopeField).prop('disabled', true);
        
        $.ajax({
            url: isotopeFormData.ajaxUrl,
            type: 'POST',
            data: {
                action: 'get_isotopes_by_element',
                element_id: elementId
            },
            success: function(response) {
                removeSkeletonLoader(elementContainer);
                
                if (response.success) {
                    populateDropdown(isotopeField, response.data);
                    $(isotopeField).prop('disabled', false);
                }
            },
            error: function() {
                removeSkeletonLoader(elementContainer);
                alert('Error loading isotopes. Please try again.');
                $(isotopeField).prop('disabled', false);
            }
        });
    });
    
    /**
     * When Isotope is selected, load variant options
     */
    $(document).on('change', isotopeField, function() {
        var isotopeId = $(this).val();
        
        resetField(chemicalFormField);
        resetField(physicalFormField);
        resetField(enrichmentField);
        resetField(qtyUnitField);
        
        hideField(chemicalFormContainer);
        hideField(physicalFormContainer);
        physicalFormAvailable = false;
        
        validateAddToQuoteButton();
        
        if (!isotopeId) {
            return;
        }
        
        var isotopeContainer = '#field_' + formId + '_' + fields.isotope;
        showSkeletonLoader(isotopeContainer);
        
        $(chemicalFormField).prop('disabled', true);
        $(physicalFormField).prop('disabled', true);
        $(enrichmentField).prop('disabled', true);
        $(qtyUnitField).prop('disabled', true);
        
        $.ajax({
            url: isotopeFormData.ajaxUrl,
            type: 'POST',
            data: {
                action: 'get_isotope_variants',
                isotope_id: isotopeId
            },
            success: function(response) {
                removeSkeletonLoader(isotopeContainer);
                
                if (response.success) {
                    var data = response.data;
                    
                    if (data.has_chemical_form && data.chemical_forms.length > 0) {
                        populateDropdown(chemicalFormField, data.chemical_forms);
                        $(chemicalFormField).prop('disabled', false);
                        
                        setTimeout(function() {
                            showField(chemicalFormContainer);
                        }, 50);
                    } else {
                        hideField(chemicalFormContainer);
                    }
                    
                    if (data.has_physical_form && data.physical_forms.length > 0) {
                        physicalFormAvailable = true;
                        console.log('Physical form IS available, set flag to true');
                        populateDropdown(physicalFormField, data.physical_forms);
                        $(physicalFormField).prop('disabled', false);
                        hideField(physicalFormContainer);
                    } else {
                        physicalFormAvailable = false;
                        console.log('Physical form NOT available');
                        $(physicalFormField).prop('disabled', true);
                        hideField(physicalFormContainer);
                    }
                    
                    if (data.enrichment_levels && data.enrichment_levels.length > 0) {
                        populateDropdown(enrichmentField, data.enrichment_levels);
                        $(enrichmentField).prop('disabled', false);
                    }
                    
                    if (data.qty_units && data.qty_units.length > 0) {
                        populateDropdown(qtyUnitField, data.qty_units);
                        $(qtyUnitField).prop('disabled', false);
                    }
                    
                    validateAddToQuoteButton();
                }
            },
            error: function() {
                removeSkeletonLoader(isotopeContainer);
                alert('Error loading options. Please try again.');
                $(chemicalFormField).prop('disabled', false);
                $(physicalFormField).prop('disabled', false);
                $(enrichmentField).prop('disabled', false);
                $(qtyUnitField).prop('disabled', false);
            }
        });
    });
    
    /**
     * Validate fields when they change
     */
    $(document).on('change', chemicalFormField + ',' + physicalFormField + ',' + enrichmentField + ',' + qtyUnitField + ',' + quantityField, function() {
        validateAddToQuoteButton();
    });

    /**
     * When Chemical Form is selected, show Physical Form if available
     */
    $(document).on('change', chemicalFormField, function() {
        console.log('Chemical form changed, physicalFormAvailable:', physicalFormAvailable);
        
        if (physicalFormAvailable && $(this).val()) {
            console.log('Showing physical form field');
            setTimeout(function() {
                showField(physicalFormContainer);
            }, 50);
        } else {
            console.log('Hiding physical form field');
            hideField(physicalFormContainer);
        }
    });

    /**
     * When Physical Form is selected, show enrichment field
     */
    $(document).on('change', physicalFormField, function() {
        console.log('Physical form changed to:', $(this).val());
        
        if ($(this).val()) {
            console.log('Showing Enrichment field');
            showField('#field_' + formId + '_' + fields.enrichment);
        }
    });

    /**
     * When Enrichment is selected, show quantity/units fields
     */
    $(document).on('change', enrichmentField, function() {
        console.log('Physical form changed to:', $(this).val());
        
        if ($(this).val()) {
            console.log('Showing quantity and units fields');
            showField('#field_' + formId + '_' + fields.quantity);
            showField('#field_' + formId + '_' + fields.qtyUnit);
            showField('#field_' + formId + '_' + fields.units);
        }
    });

    
    /**
     * Monitor for Gravity Forms trying to show/hide physical form
     */
    initPhysicalFormObserver();
    
    /**
     * Add to Quote button click handler
     */
    $(document).on('click', '#add-to-quote-btn', function() {
        if ($(this).prop('disabled')) {
            return;
        }
        
        // Get current form values
        var item = {
            element: {
                id: $(elementField).val(),
                text: $(elementField + ' option:selected').text()
            },
            isotope: {
                id: $(isotopeField).val(),
                text: $(isotopeField + ' option:selected').text()
            },
            chemicalForm: $(chemicalFormField).val() || null,
            physicalForm: $(physicalFormField).val() || null,
            enrichment: $(enrichmentField).val() || null,
            qtyUnit: $(qtyUnitField).val() || null,
            quantity: $(quantityField).val() || null,
            units: $(unitsField).val() || null,
            comments: $(commentsField).val() || null
        };
        
        // Add to cart
        cartItems.push(item);
        
        // Save to localStorage
        saveCartToStorage();
        
        // Update cart display
        updateCartDisplay();
        
        // Update hidden field with JSON data
        $(cartDataField).val(JSON.stringify(cartItems));
        
        // Reset form fields for next item
        resetFormForNewItem();
        
        // Show success message
        showNotification('Item added to quote request!');
    });
    
    /**
     * Remove item from cart
     */
    $(document).on('click', '.remove-cart-item', function() {
        var index = $(this).data('index');
        cartItems.splice(index, 1);
        
        // Save to localStorage
        saveCartToStorage();
        
        updateCartDisplay();
        $(cartDataField).val(JSON.stringify(cartItems));
        
        showNotification('Item removed from quote request.');
    });
    
    /**
     * Validate if Add to Quote button should be enabled
     */
    function validateAddToQuoteButton() {
        var isValid = true;
        
        // Element and Isotope are required
        if (!$(elementField).val() || !$(isotopeField).val()) {
            isValid = false;
        }
        
        // Chemical form is required if visible
        if ($(chemicalFormContainer).is(':visible') && !$(chemicalFormField).val()) {
            isValid = false;
        }
        
        $('#add-to-quote-btn').prop('disabled', !isValid);
    }

    physicalFormAvailable = false;
    validateAddToQuoteButton();

    // Reinitialize the physical form observer for the reloaded form
    initPhysicalFormObserver();
    
    /**
     * Update cart display
     */
    function updateCartDisplay() {
    var $cartWrapper = $('#isotope-quote-cart');
    var $cartItems = $('#isotope-cart-items');
    
    if (cartItems.length === 0) {
        $cartWrapper.hide();
        return;
    }
    
    // Make sure wrapper is visible
    $cartWrapper.show();
    $cartItems.empty();
    
    var html = '<table class="isotope-cart-table">';
    html += '<thead><tr>';
    html += '<th>Isotope</th>';
    html += '<th>Chemical Form</th>';
    html += '<th>Physical Form</th>';
    html += '<th>Enrichment</th>';
    html += '<th>Qty</th>';
    html += '<th>Units</th>';
    html += '<th>Comments</th>';
    html += '<th></th>';
    html += '</tr></thead><tbody>';
    
    $.each(cartItems, function(index, item) {
        html += '<tr>';
        html += '<td>' + item.isotope.text + '</td>';
        html += '<td>' + (item.chemicalForm || '—') + '</td>';
        html += '<td>' + (item.physicalForm || '—') + '</td>';
        html += '<td>' + (item.enrichment || '—') + '</td>';
        html += '<td>' + (item.quantity || '—') + ' ' + (item.qtyUnit || '') + '</td>';
        html += '<td>' + (item.units || '—') + '</td>';
        html += '<td>' + (item.comments ? item.comments.substring(0, 30) + '...' : '—') + '</td>';
        html += '<td><button type="button" class="remove-cart-item button" data-index="' + index + '">Remove</button></td>';
        html += '</tr>';
    });
    
    html += '</tbody></table>';
    
    $cartItems.html(html);
}
    
    /**
     * Reset form for new item
     */
    function resetFormForNewItem() {
        $(elementField).val('').trigger('change');
        $(quantityField).val('');
        $(unitsField).val('');
        $(commentsField).val('');
        
        resetField(isotopeField);
        resetField(chemicalFormField);
        resetField(physicalFormField);
        resetField(enrichmentField);
        resetField(qtyUnitField);
        
        hideField(chemicalFormContainer);
        hideField(physicalFormContainer);
        
        validateAddToQuoteButton();
    }
    
    /**
     * Show notification message
     */
    function showNotification(message) {
        var $notification = $('<div class="isotope-notification">' + message + '</div>');
        $('body').append($notification);
        
        setTimeout(function() {
            $notification.addClass('show');
        }, 10);
        
        setTimeout(function() {
            $notification.removeClass('show');
            setTimeout(function() {
                $notification.remove();
            }, 300);
        }, 3000);
    }
    
    /**
     * Helper: Add skeleton loader styles to the page
     */
    function addSkeletonStyles() {
        if ($('#isotope-skeleton-styles').length === 0) {
            var styles = `
                <style id="isotope-skeleton-styles">
                    .isotope-skeleton-loader {
                        margin: 15px 0;
                        padding: 15px;
                        background: #f5f5f5;
                        border-radius: 4px;
                        animation: isotope-skeleton-pulse 1.5s ease-in-out infinite;
                    }
                    
                    .isotope-skeleton-line {
                        height: 12px;
                        background: #e0e0e0;
                        border-radius: 4px;
                        margin-bottom: 10px;
                    }
                    
                    .isotope-skeleton-line:last-child {
                        margin-bottom: 0;
                        width: 60%;
                    }
                    
                    @keyframes isotope-skeleton-pulse {
                        0%, 100% {
                            opacity: 1;
                        }
                        50% {
                            opacity: 0.5;
                        }
                    }
                    
                    .isotope-cart-table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 10px;
                    }
                    
                    .isotope-cart-table th,
                    .isotope-cart-table td {
                        padding: 10px;
                        border: 1px solid #ddd;
                        text-align: left;
                    }
                    
                    .isotope-cart-table th {
                        background: #f5f5f5;
                        font-weight: bold;
                    }
                    
                    .isotope-cart-table .remove-cart-item {
                        padding: 5px 10px;
                        font-size: 12px;
                    }
                    
                    .isotope-notification {
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        background: #4CAF50;
                        color: white;
                        padding: 15px 20px;
                        border-radius: 4px;
                        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                        opacity: 0;
                        transform: translateY(-20px);
                        transition: all 0.3s ease;
                        z-index: 10000;
                    }
                    
                    .isotope-notification.show {
                        opacity: 1;
                        transform: translateY(0);
                    }
                    
                    #add-to-quote-btn:disabled {
                        opacity: 0.5;
                        cursor: not-allowed;
                    }
                </style>
            `;
            $('head').append(styles);
        }
    }
    
    function showSkeletonLoader(containerSelector) {
        var $container = $(containerSelector);
        removeSkeletonLoader(containerSelector);
        
        var skeletonHtml = `
            <div class="isotope-skeleton-loader" data-skeleton-for="${containerSelector}">
                <div class="isotope-skeleton-line"></div>
                <div class="isotope-skeleton-line"></div>
                <div class="isotope-skeleton-line"></div>
            </div>
        `;
        
        $container.after(skeletonHtml);
    }

    function initPhysicalFormObserver() {
        // Disconnect any existing observer
        if (window.physicalFormObserverInstance) {
            window.physicalFormObserverInstance.disconnect();
        }
        
        // Create new observer
        window.physicalFormObserverInstance = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (!physicalFormAvailable) {
                    var $container = $(physicalFormContainer);
                    if (!$container.hasClass('gform_hidden') || $container.is(':visible')) {
                        hideField(physicalFormContainer);
                    }
                }
            });
        });
        
        var physicalFormElement = document.querySelector(physicalFormContainer);
        if (physicalFormElement) {
            window.physicalFormObserverInstance.observe(physicalFormElement, {
                attributes: true,
                attributeFilter: ['class', 'style']
            });
        }
    }
    
    function removeSkeletonLoader(containerSelector) {
        $('[data-skeleton-for="' + containerSelector + '"]').remove();
    }
    
    function populateDropdown(selector, choices) {
        var $field = $(selector);
        
        $field.empty();
        $field.append('<option value="">Select an option</option>');
        
        $.each(choices, function(index, choice) {
            $field.append(
                $('<option></option>')
                    .val(choice.value)
                    .text(choice.text)
            );
        });
        
        $field.val('');
        $field.trigger('change.select2');
    }
    
    function resetField(selector) {
        var $field = $(selector);
        
        $field.empty();
        $field.append('<option value="">Select an option</option>');
        $field.val('');
        $field.prop('disabled', true);
        $field.trigger('change.select2');
    }
    
    function hideField(containerSelector) {
        var $container = $(containerSelector);
        $container.addClass('gform_hidden');
        $container.hide();
        
        $container.find('input, select, textarea').each(function() {
            $(this).removeClass('gfield_error');
        });
        $container.removeClass('gfield_error gfield_contains_required');
    }
    
    function showField(containerSelector) {
        var $container = $(containerSelector);
        $container.removeClass('gform_hidden');
        $container.show();
    }

    // Also clear cart when form is successfully submitted (backup method)
    $(document).bind('gform_post_render', function(event, form_id, current_page){
        if (form_id == formId) {
            // Check if we're on a confirmation page (no form visible)
            if ($('#gform_' + form_id).length === 0 || $('#gform_confirmation_wrapper_' + form_id).length > 0) {
                clearCartFromStorage();
                cartItems = [];
            }
        }
    });

    // Clear cart from storage on successful form submission
    $(document).on('gform_confirmation_loaded', function(event, formId) {
        if (formId == isotopeFormData.formId) {
            clearCartFromStorage();
            cartItems = [];
        }
    });

    // Handle AJAX form reloads (validation errors)
    $(document).on('gform_post_render', function(event, form_id, current_page) {
        if (form_id == formId) {
            console.log('gform_post_render fired - checking for cart data');
            // Reset the flag so we can reload
            window.isotopeCartLoaded = false;
            
            // Give Gravity Forms time to populate the hidden field via AJAX
            setTimeout(function() {
                console.log('Delayed load - Hidden field now has:', $(cartDataField).val());
                loadCartFromStorage();
                window.isotopeCartLoaded = true;
                
                // Reset form fields to initial state after cart loads
                resetField(isotopeField);
                resetField(chemicalFormField);
                resetField(physicalFormField);
                resetField(enrichmentField);
                resetField(qtyUnitField);
                
                // Hide all isotope-related field containers
                hideField(chemicalFormContainer);
                hideField(physicalFormContainer);
                hideField('#field_' + formId + '_' + fields.enrichment);
                hideField('#field_' + formId + '_' + fields.qtyUnit);
                hideField('#field_' + formId + '_' + fields.quantity);
                hideField('#field_' + formId + '_' + fields.units);
                hideField('#field_' + formId + '_' + fields.comments);
                
                // Clear the element dropdown selection
                $(elementField).val('').trigger('change');
                
                // Clear quantity and other input fields
                $(quantityField).val('');
                $(unitsField).val('mg');
                $(commentsField).val('');
                
                physicalFormAvailable = false;
                validateAddToQuoteButton();
            }, 500);
        }
    });
});