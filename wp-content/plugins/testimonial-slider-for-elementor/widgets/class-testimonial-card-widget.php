<?php
/**
 * Testimonial Slider for Elementor widget class.
 *
 * @package TCW
 */
namespace TCW;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class Testimonial_Card_Widget extends Widget_Base {

    public function get_name()       { return 'tcw_testimonial_card'; }
    public function get_title()      { return __( 'Testimonial Card', 'testimonial-slider-for-elementor' ); }
    public function get_icon()       { return 'eicon-testimonial-carousel'; }
    public function get_categories() { return [ 'general' ]; }
    public function get_keywords()   { return [ 'testimonial', 'review', 'quote', 'card', 'slider', 'carousel' ]; }

    public function get_style_depends()  { return [ 'swiper' ]; }
    public function get_script_depends() { return [ 'swiper' ]; }

    /* ── CONTROLS ─────────────────────────────────── */

    protected function register_controls() {

        /* ═══════════════ CONTENT TAB ═══════════════ */

        // ── Testimonials Repeater
        $this->start_controls_section( 'section_testimonials', [
            'label' => __( 'Testimonials', 'testimonial-slider-for-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $repeater = new Repeater();

        $repeater->add_control( 'testimonial_text', [
            'label'       => __( 'Review Text', 'testimonial-slider-for-elementor' ),
            'type'        => Controls_Manager::TEXTAREA,
            'rows'        => 5,
            'default'     => __( 'Working with this team was an absolute game-changer for our business. The attention to detail and commitment to excellence is unmatched!', 'testimonial-slider-for-elementor' ),
            'label_block' => true,
        ] );

        $repeater->add_control( 'author_name', [
            'label'   => __( 'Name', 'testimonial-slider-for-elementor' ),
            'type'    => Controls_Manager::TEXT,
            'default' => __( 'Sarah Johnson', 'testimonial-slider-for-elementor' ),
        ] );

        $repeater->add_control( 'author_title', [
            'label'   => __( 'Job Title', 'testimonial-slider-for-elementor' ),
            'type'    => Controls_Manager::TEXT,
            'default' => __( 'CEO, Acme Corp', 'testimonial-slider-for-elementor' ),
        ] );

        $repeater->add_control( 'author_image', [
            'label'   => __( 'Photo', 'testimonial-slider-for-elementor' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
        ] );

        $repeater->add_control( 'rating_value', [
            'label'   => __( 'Stars (1–5)', 'testimonial-slider-for-elementor' ),
            'type'    => Controls_Manager::NUMBER,
            'min'     => 1, 'max' => 5, 'step' => 1,
            'default' => 5,
        ] );

        $this->add_control( 'testimonials', [
            'label'       => __( 'Testimonials', 'testimonial-slider-for-elementor' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [
                [
                    'author_name'      => 'Sarah Johnson',
                    'author_title'     => 'CEO, Acme Corp',
                    'testimonial_text' => 'Working with this team was an absolute game-changer. The attention to detail and commitment to excellence is unmatched!',
                    'rating_value'     => 5,
                ],
                [
                    'author_name'      => 'James Williams',
                    'author_title'     => 'Product Manager, TechCo',
                    'testimonial_text' => 'Incredible service from start to finish. They understood our needs perfectly and delivered beyond expectations.',
                    'rating_value'     => 5,
                ],
                [
                    'author_name'      => 'Maria Lopez',
                    'author_title'     => 'Founder, StartupXYZ',
                    'testimonial_text' => 'I have worked with many agencies but none compare. The quality, speed, and communication are absolutely top-notch.',
                    'rating_value'     => 4,
                ],
            ],
            'title_field' => '{{{ author_name }}}',
        ] );

        $this->end_controls_section();

        // ── Quote / Alignment
        $this->start_controls_section( 'section_quote', [
            'label' => __( 'Quote & Layout', 'testimonial-slider-for-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'quote_icon', [
            'label'       => __( 'Quote Icon', 'testimonial-slider-for-elementor' ),
            'type'        => Controls_Manager::ICONS,
            'default'     => [ 'value' => 'fas fa-quote-left', 'library' => 'fa-solid' ],
            'skin'        => 'inline',
            'label_block' => false,
        ] );

        $this->add_control( 'alignment', [
            'label'   => __( 'Alignment', 'testimonial-slider-for-elementor' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'left'   => [ 'title' => __( 'Left',   'testimonial-slider-for-elementor' ), 'icon' => 'eicon-text-align-left' ],
                'center' => [ 'title' => __( 'Center', 'testimonial-slider-for-elementor' ), 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => __( 'Right',  'testimonial-slider-for-elementor' ), 'icon' => 'eicon-text-align-right' ],
            ],
            'default' => 'center',
            'toggle'  => false,
        ] );

        $this->end_controls_section();

        // ── Rating global
        $this->start_controls_section( 'section_rating', [
            'label' => __( 'Rating', 'testimonial-slider-for-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'show_rating', [
            'label'        => __( 'Show Rating', 'testimonial-slider-for-elementor' ),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => __( 'Yes', 'testimonial-slider-for-elementor' ),
            'label_off'    => __( 'No', 'testimonial-slider-for-elementor' ),
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->add_control( 'rating_icon', [
            'label'       => __( 'Star Icon', 'testimonial-slider-for-elementor' ),
            'type'        => Controls_Manager::ICONS,
            'default'     => [ 'value' => 'fas fa-star', 'library' => 'fa-solid' ],
            'skin'        => 'inline',
            'label_block' => false,
            'condition'   => [ 'show_rating' => 'yes' ],
        ] );

        $this->end_controls_section();

        // ── Slider Settings
        $this->start_controls_section( 'section_slider', [
            'label' => __( 'Slider Settings', 'testimonial-slider-for-elementor' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'autoplay', [
            'label'        => __( 'Autoplay', 'testimonial-slider-for-elementor' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->add_control( 'autoplay_speed', [
            'label'     => __( 'Autoplay Speed (ms)', 'testimonial-slider-for-elementor' ),
            'type'      => Controls_Manager::NUMBER,
            'default'   => 4000,
            'min'       => 1000, 'max' => 10000, 'step' => 500,
            'condition' => [ 'autoplay' => 'yes' ],
        ] );

        $this->add_control( 'loop', [
            'label'        => __( 'Infinite Loop', 'testimonial-slider-for-elementor' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->add_control( 'show_dots', [
            'label'        => __( 'Show Dots', 'testimonial-slider-for-elementor' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->add_control( 'show_arrows', [
            'label'        => __( 'Show Arrows', 'testimonial-slider-for-elementor' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->end_controls_section();

        /* ═══════════════ STYLE TAB ═══════════════ */

        // Card
        $this->start_controls_section( 'style_card', [
            'label' => __( 'Card', 'testimonial-slider-for-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'card_background', [
            'label'     => __( 'Background Color', 'testimonial-slider-for-elementor' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [ '{{WRAPPER}} .tcw-card' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_responsive_control( 'card_padding', [
            'label'      => __( 'Padding', 'testimonial-slider-for-elementor' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'default'    => [ 'top'=>'32','right'=>'32','bottom'=>'32','left'=>'32','unit'=>'px','isLinked'=>true ],
            'selectors'  => [ '{{WRAPPER}} .tcw-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'card_border_radius', [
            'label'      => __( 'Border Radius', 'testimonial-slider-for-elementor' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default'    => [ 'top'=>'16','right'=>'16','bottom'=>'16','left'=>'16','unit'=>'px','isLinked'=>true ],
            'selectors'  => [ '{{WRAPPER}} .tcw-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ] );

        $this->add_group_control( Group_Control_Border::get_type(), [
            'name'     => 'card_border',
            'selector' => '{{WRAPPER}} .tcw-card',
        ] );

        $this->add_group_control( Group_Control_Box_Shadow::get_type(), [
            'name'     => 'card_shadow',
            'selector' => '{{WRAPPER}} .tcw-card',
        ] );

        $this->end_controls_section();

        // Quote Icon
        $this->start_controls_section( 'style_quote_icon', [
            'label' => __( 'Quote Icon', 'testimonial-slider-for-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'quote_icon_color', [
            'label'     => __( 'Color', 'testimonial-slider-for-elementor' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#6366f1',
            'selectors' => [ '{{WRAPPER}} .tcw-quote-icon' => 'color: {{VALUE}};' ],
        ] );

        $this->add_responsive_control( 'quote_icon_size', [
            'label'      => __( 'Size', 'testimonial-slider-for-elementor' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 16, 'max' => 80 ] ],
            'default'    => [ 'unit' => 'px', 'size' => 32 ],
            'selectors'  => [ '{{WRAPPER}} .tcw-quote-icon' => 'font-size: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->end_controls_section();

        // Testimonial Text
        $this->start_controls_section( 'style_text', [
            'label' => __( 'Testimonial Text', 'testimonial-slider-for-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'text_color', [
            'label'     => __( 'Color', 'testimonial-slider-for-elementor' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#374151',
            'selectors' => [ '{{WRAPPER}} .tcw-text' => 'color: {{VALUE}};' ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'text_typography',
            'selector' => '{{WRAPPER}} .tcw-text',
        ] );

        $this->add_responsive_control( 'text_spacing', [
            'label'      => __( 'Bottom Spacing', 'testimonial-slider-for-elementor' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 60 ] ],
            'default'    => [ 'unit' => 'px', 'size' => 24 ],
            'selectors'  => [ '{{WRAPPER}} .tcw-text' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->end_controls_section();

        // Author
        $this->start_controls_section( 'style_author', [
            'label' => __( 'Author', 'testimonial-slider-for-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_responsive_control( 'image_size', [
            'label'      => __( 'Photo Size', 'testimonial-slider-for-elementor' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 32, 'max' => 120 ] ],
            'default'    => [ 'unit' => 'px', 'size' => 56 ],
            'selectors'  => [ '{{WRAPPER}} .tcw-author-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'image_border_radius', [
            'label'      => __( 'Photo Border Radius', 'testimonial-slider-for-elementor' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 60 ], '%' => [ 'min' => 0, 'max' => 50 ] ],
            'default'    => [ 'unit' => '%', 'size' => 50 ],
            'selectors'  => [ '{{WRAPPER}} .tcw-author-image' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_control( 'author_name_color', [
            'label'     => __( 'Name Color', 'testimonial-slider-for-elementor' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#111827',
            'selectors' => [ '{{WRAPPER}} .tcw-author-name' => 'color: {{VALUE}};' ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'author_name_typography',
            'label'    => __( 'Name Typography', 'testimonial-slider-for-elementor' ),
            'selector' => '{{WRAPPER}} .tcw-author-name',
        ] );

        $this->add_control( 'author_title_color', [
            'label'     => __( 'Title Color', 'testimonial-slider-for-elementor' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#6b7280',
            'selectors' => [ '{{WRAPPER}} .tcw-author-title' => 'color: {{VALUE}};' ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'author_title_typography',
            'label'    => __( 'Title Typography', 'testimonial-slider-for-elementor' ),
            'selector' => '{{WRAPPER}} .tcw-author-title',
        ] );

        $this->end_controls_section();

        // Rating Stars
        $this->start_controls_section( 'style_rating', [
            'label'     => __( 'Rating Stars', 'testimonial-slider-for-elementor' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'show_rating' => 'yes' ],
        ] );

        $this->add_control( 'star_color', [
            'label'     => __( 'Star Color', 'testimonial-slider-for-elementor' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#f59e0b',
            'selectors' => [ '{{WRAPPER}} .tcw-star' => 'color: {{VALUE}};' ],
        ] );

        $this->add_responsive_control( 'star_size', [
            'label'      => __( 'Star Size', 'testimonial-slider-for-elementor' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 10, 'max' => 40 ] ],
            'default'    => [ 'unit' => 'px', 'size' => 18 ],
            'selectors'  => [ '{{WRAPPER}} .tcw-star' => 'font-size: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'star_gap', [
            'label'      => __( 'Gap Between Stars', 'testimonial-slider-for-elementor' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 16 ] ],
            'default'    => [ 'unit' => 'px', 'size' => 3 ],
            'selectors'  => [ '{{WRAPPER}} .tcw-rating' => 'gap: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->end_controls_section();

        // Navigation
        $this->start_controls_section( 'style_nav', [
            'label' => __( 'Navigation', 'testimonial-slider-for-elementor' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'dot_color_active', [
            'label'     => __( 'Active Dot Color', 'testimonial-slider-for-elementor' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#6366f1',
            'selectors' => [ '{{WRAPPER}} .tcw-dots .swiper-pagination-bullet-active' => 'background-color: {{VALUE}} !important;' ],
        ] );

        $this->add_control( 'dot_color_inactive', [
            'label'     => __( 'Inactive Dot Color', 'testimonial-slider-for-elementor' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#d1d5db',
            'selectors' => [ '{{WRAPPER}} .tcw-dots .swiper-pagination-bullet' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'arrow_color', [
            'label'     => __( 'Arrow Color', 'testimonial-slider-for-elementor' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#6366f1',
            'selectors' => [
                '{{WRAPPER}} .tcw-arrow'       => 'color: {{VALUE}}; border-color: {{VALUE}};',
                '{{WRAPPER}} .tcw-arrow:hover' => 'background-color: {{VALUE}}; color: #fff;',
            ],
        ] );

        $this->end_controls_section();
    }

    /* ── RENDER ──────────────────────────────────── */

    protected function render() {
        $s           = $this->get_settings_for_display();
        $items       = ! empty( $s['testimonials'] ) ? $s['testimonials'] : [];
        $show_rating = ! empty( $s['show_rating'] ) && $s['show_rating'] === 'yes';
        $show_dots   = ! empty( $s['show_dots'] )   && $s['show_dots']   === 'yes';
        $show_arrows = ! empty( $s['show_arrows'] ) && $s['show_arrows'] === 'yes';
        $autoplay    = ! empty( $s['autoplay'] )    && $s['autoplay']    === 'yes';
        $loop        = ! empty( $s['loop'] )        && $s['loop']        === 'yes';
        $speed       = (int) ( $s['autoplay_speed'] ?? 4000 );
        $alignment   = ! empty( $s['alignment'] ) ? esc_attr( $s['alignment'] ) : 'center';
        $widget_id   = $this->get_id();

        if ( empty( $items ) ) return;

        $opts = [
            'loop'          => $loop,
            'autoplay'      => $autoplay ? [ 'delay' => $speed, 'disableOnInteraction' => false ] : false,
            'pagination'    => $show_dots  ? [ 'el' => '#tcw-dots-'   . $widget_id, 'clickable' => true ] : false,
            'navigation'    => $show_arrows? [ 'nextEl' => '#tcw-next-' . $widget_id, 'prevEl' => '#tcw-prev-' . $widget_id ] : false,
            'slidesPerView' => 1,
            'spaceBetween'  => 0,
            'a11y'          => [ 'enabled' => true ],
        ];
        ?>

        <div class="tcw-slider-wrapper">

            <div class="swiper tcw-swiper" id="tcw-swiper-<?php echo esc_attr( $widget_id ); ?>">
                <div class="swiper-wrapper">

                    <?php foreach ( $items as $item ) :
                        $name    = esc_html( $item['author_name']      ?? '' );
                        $title   = esc_html( $item['author_title']     ?? '' );
                        $text    = esc_html( $item['testimonial_text'] ?? '' );
                        $rating  = (int) ( $item['rating_value'] ?? 5 );
                        $img_url = esc_url(  $item['author_image']['url'] ?? '' );
                    ?>
                    <div class="swiper-slide">
                        <div class="tcw-card tcw-align-<?php echo $alignment; ?>" style="text-align:<?php echo $alignment; ?>;">

                            <div class="tcw-quote-icon" aria-hidden="true">
                                <?php Icons_Manager::render_icon( $s['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </div>

                            <?php if ( $show_rating ) : ?>
                                <div class="tcw-rating" role="img" aria-label="<?php echo esc_attr( $rating ); ?> out of 5 stars">
                                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                                        <span class="tcw-star<?php echo $i > $rating ? ' tcw-star--empty' : ''; ?>">
                                            <?php Icons_Manager::render_icon( $s['rating_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </span>
                                    <?php endfor; ?>
                                </div>
                            <?php endif; ?>

                            <p class="tcw-text"><?php echo $text; ?></p>

                            <div class="tcw-author">
                                <?php if ( $img_url ) : ?>
                                    <img class="tcw-author-image" src="<?php echo $img_url; ?>" alt="<?php echo $name; ?>" loading="lazy" />
                                <?php endif; ?>
                                <div class="tcw-author-meta">
                                    <?php if ( $name )  : ?><span class="tcw-author-name"><?php echo $name; ?></span><?php endif; ?>
                                    <?php if ( $title ) : ?><span class="tcw-author-title"><?php echo $title; ?></span><?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php endforeach; ?>

                </div><!-- .swiper-wrapper -->
            </div><!-- .swiper -->

            <?php if ( $show_arrows ) : ?>
                <button class="tcw-arrow tcw-arrow--prev" id="tcw-prev-<?php echo esc_attr( $widget_id ); ?>" aria-label="<?php esc_attr_e( 'Previous', 'testimonial-slider-for-elementor' ); ?>">
                    <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M8.5 1.5L2 8L8.5 14.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button class="tcw-arrow tcw-arrow--next" id="tcw-next-<?php echo esc_attr( $widget_id ); ?>" aria-label="<?php esc_attr_e( 'Next', 'testimonial-slider-for-elementor' ); ?>">
                    <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M1.5 1.5L8 8L1.5 14.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            <?php endif; ?>

            <?php if ( $show_dots ) : ?>
                <div class="tcw-dots swiper-pagination" id="tcw-dots-<?php echo esc_attr( $widget_id ); ?>"></div>
            <?php endif; ?>

        </div><!-- .tcw-slider-wrapper -->

        <?php
        wp_enqueue_script( 'tcw-testimonial-card' );
        wp_add_inline_script( 'tcw-testimonial-card', '
        ( function() {
            function tcwInit_' . esc_js( $widget_id ) . '() {
                if ( typeof Swiper === \'undefined\' ) {
                    setTimeout( tcwInit_' . esc_js( $widget_id ) . ', 150 );
                    return;
                }
                new Swiper( \'#tcw-swiper-' . esc_js( $widget_id ) . '\', ' . wp_json_encode( $opts ) . ' );
            }
            if ( document.readyState === \'loading\' ) {
                document.addEventListener( \'DOMContentLoaded\', tcwInit_' . esc_js( $widget_id ) . ' );
            } else {
                tcwInit_' . esc_js( $widget_id ) . '();
            }
        } )();
        ' );
    }

    /* ── EDITOR LIVE PREVIEW ─────────────────────── */

    protected function content_template() {
        ?>
        <#
        var items      = settings.testimonials || [];
        var quoteIcon  = settings.quote_icon;
        var ratingIcon = settings.rating_icon;
        var alignment  = settings.alignment || 'center';
        var showRating = settings.show_rating === 'yes';
        #>
        <div class="tcw-slider-wrapper">
        <# if ( items.length > 0 ) {
            var item = items[0]; #>
            <div class="tcw-card tcw-align-{{ alignment }}" style="text-align:{{ alignment }};">

                <div class="tcw-quote-icon" aria-hidden="true">
                    <# if ( quoteIcon && quoteIcon.value ) { #>
                        <i class="{{ quoteIcon.value }}"></i>
                    <# } #>
                </div>

                <# if ( showRating ) { #>
                <div class="tcw-rating">
                    <# for ( var i = 1; i <= 5; i++ ) { #>
                    <span class="tcw-star <# if(i > item.rating_value){#>tcw-star--empty<#}#>">
                        <# if ( ratingIcon && ratingIcon.value ) { #><i class="{{ ratingIcon.value }}"></i><# } #>
                    </span>
                    <# } #>
                </div>
                <# } #>

                <p class="tcw-text">{{{ item.testimonial_text }}}</p>

                <div class="tcw-author">
                    <# if ( item.author_image && item.author_image.url ) { #>
                    <img class="tcw-author-image" src="{{ item.author_image.url }}" alt="{{ item.author_name }}" />
                    <# } #>
                    <div class="tcw-author-meta">
                        <# if ( item.author_name )  { #><span class="tcw-author-name">{{ item.author_name }}</span><# } #>
                        <# if ( item.author_title ) { #><span class="tcw-author-title">{{ item.author_title }}</span><# } #>
                    </div>
                </div>

            </div>
            <# if ( items.length > 1 ) { #>
            <p style="margin-top:10px;font-size:12px;color:#9ca3af;text-align:center;">
                ← Showing slide 1 of {{ items.length }} — full slider visible on frontend →
            </p>
            <# } #>
        <# } #>
        </div>
        <?php
    }
}
