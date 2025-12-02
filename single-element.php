<?php
/**
 * The template for displaying all element single posts
 *
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
        <section class="post-content">
            <div class="container">
                <?php $post_slug = get_post_field( 'post_name' ); ?>
                <?php $atomic_number = get_field('atomic_number'); ?>
                <?php $atomic_mass = get_field('atomic_mass'); ?>
                <?php $hyphen_pos = strpos($post_slug, '-'); ?>
                <?php $atomic_symbol = '';
                    if ($hyphen_pos !== false) {
                        $stringAfterHyphen = substr($post_slug, $hyphen_pos + 1);
                        $atomic_symbol = ucfirst($stringAfterHyphen);     
                    } 
                    $radioactive_elements = array(
                        'technetium-tc','promethium-pm', 'polonium-po', 'astatine-at',
                        'radon-rn', 'francium-fr', 'radium-ra', 'actinium-ac', 'thorium-th',
                        'protactinium-pa', 'uranium-u', 'neptunium-np', 'plutonium-pu',
                        'americium-am', 'curium-cm', 'berkelium-bk', 'californium-cf',
                        'einsteinium-es', 'fermium-fm', 'mendelevium-md', 'nobelium-no',
                        'lawrencium-lr', 'rutherfordium-rf', 'dubnium-db', 'seaborgium-sg',
                        'bohrium-bh', 'hassium-hs', 'meitnerium-mt', 'darmstadtium-ds',
                        'roentgenium-rg', 'copernicium-cn', 'nihonium-nh', 'flerovium-fl',
                        'moscovium-mc', 'livermorium-lv', 'tennessine-ts', 'oganesson-og'
                    ); ?>
                <div class="breadcrumbs"><a href="/periodic-table"><i class="fa fa-chevron-left"></i> Back to All Elements</a></div>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="pt-element-holder flex flex-row gap-x-5 mt-[2em] mb-[3em]">
                        <div class="pt-element <?php echo $post_slug; ?>" id="<?php echo $post_slug; ?>">
                            <a href="/element/<?php echo $post_slug; ?>">
                                <div class="pt-element-number"><?php echo $atomic_number; ?></div>
                                <h2 class="pt-element-symbol"><?php echo $atomic_symbol; ?></h2>
                                <div class="pt-element-name"><?php echo get_the_title(); ?></div>
                                <div class="pt-element-weight">
                                    <?php if (in_array($post_slug, $radioactive_elements)) {
                                        echo '(' . $atomic_mass . ')';
                                    } else {
                                        echo $atomic_mass;
                                    } ?>
                                </div>
                            </a>
                        </div>
                        <h1 class="post-title"><?php echo get_the_title(); ?></h1>
                    </div>
                    <?php
                        $element_id = get_the_ID();
                        $isotopes = get_posts(array(
                            'post_type' => 'isotope',
                            'posts_per_page' => -1,
                            'orderby' => 'title',
                            'order' => 'ASC',
                            'meta_query' => array(
                                array(
                                    'key' => 'associated_element',
                                    'value' => '"' . $element_id . '"',
                                    'compare' => 'LIKE',
                                ),
                            ),
                        ));
                    ?>
                    <?php if($isotopes) { 
                        $loop_count = 0;

                        // --- 1. PRE-CALCULATE ALL NECESSARY HEADERS ---
                        $available_headers = array(
                            'isotope_title' => false,
                            'chemical_form' => false,
                            'physical_form' => false,
                            'z_protons' => false,
                            'n_neutrons' => false,
                            'atomic_mass' => false,
                            'natural_abundance' => false,
                            'enrichment_level' => false,
                            'nuclear_spin' => false,
                            'nuclear_magnetic_moment' => false,
                            'specific_activity' => false,
                            'half_life' => false,
                            'mode_of_decay' => false,
                        );

                        // Loop through all isotopes and their variants to check for existing fields
                        foreach($isotopes as $isotope) {
                            $isotope_title = $isotope->post_title;
                            if ($isotope_title) {
                                $available_headers['isotope_title'] = true;
                            }

                            if (have_rows('isotope_variants', $isotope->ID)) {
                                while (have_rows('isotope_variants', $isotope->ID)) {
                                    the_row();

                                    // Use a function to check if a value exists (handle '0' case explicitly)
                                    $check_field = function($field) {
                                        $value = get_sub_field($field);
                                        return !empty($value) || (string)$value === '0';
                                    };

                                    if ($check_field('chemical_form')) $available_headers['chemical_form'] = true;
                                    if ($check_field('physical_form')) $available_headers['physical_form'] = true;
                                    if ($check_field('z_protons')) $available_headers['z_protons'] = true;
                                    if ($check_field('n_neutrons')) $available_headers['n_neutrons'] = true;
                                    if ($check_field('atomic_mass')) $available_headers['atomic_mass'] = true;
                                    if ($check_field('natural_abundance')) $available_headers['natural_abundance'] = true;
                                    if ($check_field('enrichment_level')) $available_headers['enrichment_level'] = true;
                                    if ($check_field('nuclear_spin')) $available_headers['nuclear_spin'] = true;
                                    if ($check_field('nuclear_magnetic_moment')) $available_headers['nuclear_magnetic_moment'] = true;
                                    if ($check_field('specific_activity')) $available_headers['specific_activity'] = true;
                                    if ($check_field('half-life')) $available_headers['half_life'] = true;
                                    if ($check_field('mode_of_decay')) $available_headers['mode_of_decay'] = true;
                                }
                            }
                        }
                        // Reset the ACF row data pointer after the pre-loop
                        wp_reset_postdata();

                        // --- 2. DEFINE FIELD MAPPINGS FOR EASY USE ---
                        $field_map = [
                            'isotope_title' => ['label' => 'Isotope', 'key' => 'post_title', 'is_post_field' => true],
                            'chemical_form' => ['label' => 'Chemical Form', 'key' => 'chemical_form'],
                            'physical_form' => ['label' => 'Physical Form', 'key' => 'physical_form'],
                            'z_protons' => ['label' => 'Z (Protons)', 'key' => 'z_protons'],
                            'n_neutrons' => ['label' => 'N (Neutrons)', 'key' => 'n_neutrons'],
                            'atomic_mass' => ['label' => 'Atomic Mass', 'key' => 'atomic_mass'],
                            'natural_abundance' => ['label' => 'Natural Abundance', 'key' => 'natural_abundance'],
                            'enrichment_level' => ['label' => 'Enrichment Level', 'key' => 'enrichment_level'],
                            'nuclear_spin' => ['label' => 'Nuclear Spin', 'key' => 'nuclear_spin'],
                            'nuclear_magnetic_moment' => ['label' => 'Nuclear Magnetic Moment', 'key' => 'nuclear_magnetic_moment'],
                            'specific_activity' => ['label' => 'Specific Activity', 'key' => 'specific_activity'],
                            'half_life' => ['label' => 'Half Life', 'key' => 'half-life'], // Note: ACF key uses hyphen
                            'mode_of_decay' => ['label' => 'Mode of Decay', 'key' => 'mode_of_decay'],
                        ];

                    ?>
                        <h2>Isotopes of <?php echo get_the_title(); ?></h2>
                        <div class="available-isotopes flex flex-col border-l border-b border-[#CCC] mt-5 mb-10">

                            <?php if (in_array(true, $available_headers)) { ?>
                                <div class="isotope-variants-table-heading flex flex-row font-bold">
                                    <?php foreach ($available_headers as $field_name => $is_available) {
                                        if ($is_available) { 
                                            $label = $field_map[$field_name]['label']; ?>
                                            <div class="variant-heading flex-1 p-2 bg-[#EAEAEA] border-t border-r border-[#CCC]">
                                                <?php echo $label; ?>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                            <?php } ?>

                            <?php foreach($isotopes as $isotope) { 
                                $isotope_title = $isotope->post_title;
                            ?>
                                <?php if(have_rows('isotope_variants', $isotope->ID)) {
                                    while(have_rows('isotope_variants', $isotope->ID)) {
                                        the_row();
                                        $loop_count++; // $loop_count is now only used as a generic counter

                                        // Retrieve all sub-fields in a single pass
                                        $sub_fields = [];
                                        foreach ($field_map as $key => $map) {
                                            if (isset($map['is_post_field']) && $map['is_post_field']) {
                                                // Handled below for the title
                                            } elseif ($key === 'half_life') {
                                                $sub_fields[$key] = get_sub_field('half-life'); // Use the actual ACF key
                                            } else {
                                                $sub_fields[$key] = get_sub_field($map['key']);
                                            }
                                        }

                                        // Function to check if a specific field has a value in the current row
                                        $check_current_field = function($value) {
                                             return !empty($value) || (string)$value === '0';
                                        };

                                        ?>
                                        <div class="variant flex flex-row">

                                            <?php foreach ($available_headers as $field_name => $is_available) {
                                                if ($is_available) {
                                                    $cell_content = '';
                                                    $has_content = false;

                                                    if ($field_name === 'isotope_title') {
                                                        $cell_content = '<a href="/isotope/' . $isotope->post_name . '">' . $isotope_title . '</a>';
                                                        $has_content = !empty($isotope_title);
                                                    } else {
                                                        $value = $sub_fields[$field_name] ?? '';
                                                        $cell_content = $value;
                                                        $has_content = $check_current_field($value);
                                                    }

                                                    // Print the cell: either with content or as an empty placeholder
                                                    ?>
                                                    <div class="variant-data flex-1 p-2 border-t border-r border-[#CCC]">
                                                        <?php echo $has_content ? $cell_content : '&nbsp;'; ?> 
                                                    </div>
                                                <?php }
                                            } ?>
                                        </div>
                                    <?php }
                                }
                            } 
                            wp_reset_postdata(); // Good practice to reset postdata after a custom query/loop
                            ?>
                        </div>
                    <?php } ?>
                    <?php the_content(); ?>
                </article>

                <div class="clear"></div>
            </div>
        </section>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();