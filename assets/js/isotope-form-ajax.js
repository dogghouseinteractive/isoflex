/**
 * Isotope Form AJAX Handler
 * Handles cascading dropdown population for Gravity Forms
 */

jQuery(document).ready(function($) {
    var formId = isotopeFormData.formId;
    var fields = isotopeFormData.fieldIds;
    
    // Build field selectors
    var elementField = '#input_' + formId + '_' + fields.element;
    var isotopeField = '#input_' + formId + '_' + fields.isotope;
    var chemicalFormField = '#input_' + formId + '_' + fields.chemicalForm;
    var physicalFormField = '#input_' + formId + '_' + fields.physicalForm;
    var enrichmentField = '#input_' + formId + '_' + fields.enrichment;
    var qtyUnitField = '#input_' + formId + '_' + fields.qtyUnit;
    
    // Debug: Log the field IDs
    console.log('Form ID:', formId);
    console.log('Field IDs:', fields);
    console.log('Element Field Selector:', elementField);
    console.log('Isotope Field Selector:', isotopeField);
    
    /**
     * Initialize ALL fields to empty on page load
     */
    // Force element field to empty (don't disable it though)
    $(elementField).val('').trigger('change.select2');
    
    // Reset all dependent fields
    resetField(isotopeField);
    resetField(chemicalFormField);
    resetField(physicalFormField);
    resetField(enrichmentField);
    resetField(qtyUnitField);
    
    /**
     * When Element is selected, load Isotopes
     */
    $(document).on('change', elementField, function() {
        var elementId = $(this).val();
        
        console.log('Element changed:', elementId);
        
        // Reset dependent fields
        resetField(isotopeField);
        resetField(chemicalFormField);
        resetField(physicalFormField);
        resetField(enrichmentField);
        resetField(qtyUnitField);
        
        if (!elementId) {
            console.log('No element selected, returning');
            return;
        }
        
        // Show loading state
        $(isotopeField).prop('disabled', true);
        
        console.log('Making AJAX request for element:', elementId);
        
        // AJAX request to get isotopes
        $.ajax({
            url: isotopeFormData.ajaxUrl,
            type: 'POST',
            data: {
                action: 'get_isotopes_by_element',
                element_id: elementId
            },
            success: function(response) {
                console.log('AJAX Response:', response);
                
                if (response.success) {
                    console.log('Isotopes data:', response.data);
                    populateDropdown(isotopeField, response.data);
                    $(isotopeField).prop('disabled', false);
                } else {
                    console.log('AJAX returned success=false');
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error:', status, error);
                console.log('Response:', xhr.responseText);
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
        
        console.log('Isotope changed:', isotopeId);
        
        // Reset dependent fields
        resetField(chemicalFormField);
        resetField(physicalFormField);
        resetField(enrichmentField);
        resetField(qtyUnitField);
        
        if (!isotopeId) {
            return;
        }
        
        // Show loading state
        $(chemicalFormField).prop('disabled', true);
        $(physicalFormField).prop('disabled', true);
        $(enrichmentField).prop('disabled', true);
        $(qtyUnitField).prop('disabled', true);
        
        console.log('Making AJAX request for isotope:', isotopeId);
        
        // AJAX request to get variant options
        $.ajax({
            url: isotopeFormData.ajaxUrl,
            type: 'POST',
            data: {
                action: 'get_isotope_variants',
                isotope_id: isotopeId
            },
            success: function(response) {
                console.log('Variants Response:', response);
                
                if (response.success) {
                    var data = response.data;
                    
                    // Populate each dropdown if it has options
                    if (data.chemical_forms && data.chemical_forms.length > 0) {
                        populateDropdown(chemicalFormField, data.chemical_forms);
                        $(chemicalFormField).prop('disabled', false);
                    }
                    
                    if (data.physical_forms && data.physical_forms.length > 0) {
                        populateDropdown(physicalFormField, data.physical_forms);
                        $(physicalFormField).prop('disabled', false);
                    }
                    
                    if (data.enrichment_levels && data.enrichment_levels.length > 0) {
                        populateDropdown(enrichmentField, data.enrichment_levels);
                        $(enrichmentField).prop('disabled', false);
                    }
                    
                    if (data.qty_units && data.qty_units.length > 0) {
                        populateDropdown(qtyUnitField, data.qty_units);
                        $(qtyUnitField).prop('disabled', false);
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log('Variants AJAX Error:', status, error);
                alert('Error loading options. Please try again.');
                $(chemicalFormField).prop('disabled', false);
                $(physicalFormField).prop('disabled', false);
                $(enrichmentField).prop('disabled', false);
                $(qtyUnitField).prop('disabled', false);
            }
        });
    });
    
    /**
     * Helper: Populate dropdown with choices
     * Ensures no option is pre-selected
     */
    function populateDropdown(selector, choices) {
        var $field = $(selector);
        
        console.log('Populating dropdown:', selector, 'with', choices.length, 'choices');
        
        $field.empty();
        
        // Add empty placeholder option first
        $field.append('<option value="">Select an option</option>');
        
        // Add each choice
        $.each(choices, function(index, choice) {
            $field.append(
                $('<option></option>')
                    .val(choice.value)
                    .text(choice.text)
            );
        });
        
        // Explicitly set the field to the empty value
        $field.val('');
        
        // Trigger change to update Gravity Forms if needed
        $field.trigger('change.select2'); // For Chosen/Select2 compatibility
        
        console.log('Dropdown populated, total options:', $field.find('option').length);
    }
    
    /**
     * Helper: Reset dropdown to empty state
     */
    function resetField(selector) {
        var $field = $(selector);
        
        $field.empty();
        
        // Add empty placeholder option
        $field.append('<option value="">Select an option</option>');
        
        // Explicitly set to empty value
        $field.val('');
        
        // Disable the field until populated
        $field.prop('disabled', true);
        
        // Trigger change for compatibility
        $field.trigger('change.select2');
    }
});