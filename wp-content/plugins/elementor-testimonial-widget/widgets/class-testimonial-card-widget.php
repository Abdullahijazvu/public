<?php
namespace TCW;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Testimonial_Card_Widget extends Widget_Base {

    /* ─────────────────────────────────────────
     * Identity
     * ───────────────────────────────────────── */

    public function get_name()        { return 'tcw_testimonial_card'; }
    public function get_title()       { return __( 'Testimonial Card', 'testimonial-widget' ); }
    public function get_icon()        { return 'eicon-testimonial'; }
    public function get_categories()  { return [ 'general' ]; }
    public function get_keywords()    { return [ 'testimonial', 'review', 'quote', 'card' ]; }

    /* ─────────────────────────────────────────
     * Controls
     * ───────────────────────────────────────── */

    protected function register_controls() {

        /* ── CONTENT TAB ─────────────────────── */

        // Section: Quote
        $this->start_controls_section( 'section_quote', [
            'label' => __( 'Quote', 'testimonial-widget' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'quote_icon', [
            'label'       => __( 'Quote Icon', 'testimonial-widget' ),
            'type'        => Controls_Manager::ICONS,
            'default'     => [
                'value'   => 'fas fa-quote-left',
                'library' => 'fa-solid',
            ],
            'skin'        => 'inline',
            'label_block' => false,
        ] );

        $this->add_control( 'testimonial_text', [
            'label'       => __( 'Testimonial Text', 'testimonial-widget' ),
            'type'        => Controls_Manager::TEXTAREA,
            'rows'        => 6,
            'default'     => __( 'Working with this team was an absolute game-changer for our business. The attention to detail and commitment to excellence is unmatched. I couldn\'t be happier with the results!', 'testimonial-widget' ),
            'placeholder' => __( 'Enter your testimonial text…', 'testimonial-widget' ),
            'dynamic'     => [ 'active' => true ],
        ] );

        $this->add_control( 'alignment', [
            'label'   => __( 'Alignment', 'testimonial-widget' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'left'   => [ 'title' => __( 'Left', 'testimonial-widget' ),   'icon' => 'eicon-text-align-left' ],
                'center' => [ 'title' => __( 'Center', 'testimonial-widget' ), 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => __( 'Right', 'testimonial-widget' ),  'icon' => 'eicon-text-align-right' ],
            ],
            'default' => 'center',
            'toggle'  => false,
        ] );

        $this->end_controls_section();

        // Section: Author
        $this->start_controls_section( 'section_author', [
            'label' => __( 'Author', 'testimonial-widget' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'author_image', [
            'label'   => __( 'Author Photo', 'testimonial-widget' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
            'dynamic' => [ 'active' => true ],
        ] );

        $this->add_control( 'author_name', [
            'label'       => __( 'Name', 'testimonial-widget' ),
            'type'        => Controls_Manager::TEXT,
            'default'     => __( 'Sarah Johnson', 'testimonial-widget' ),
            'placeholder' => __( 'Full name', 'testimonial-widget' ),
            'dynamic'     => [ 'active' => true ],
        ] );

        $this->add_control( 'author_title', [
            'label'       => __( 'Job Title', 'testimonial-widget' ),
            'type'        => Controls_Manager::TEXT,
            'default'     => __( 'CEO, Acme Corp', 'testimonial-widget' ),
            'placeholder' => __( 'Job title / company', 'testimonial-widget' ),
            'dynamic'     => [ 'active' => true ],
        ] );

        $this->end_controls_section();

        // Section: Rating
        $this->start_controls_section( 'section_rating', [
            'label' => __( 'Rating', 'testimonial-widget' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'show_rating', [
            'label'        => __( 'Show Rating', 'testimonial-widget' ),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => __( 'Yes', 'testimonial-widget' ),
            'label_off'    => __( 'No', 'testimonial-widget' ),
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->add_control( 'rating_value', [
            'label'      => __( 'Stars (1–5)', 'testimonial-widget' ),
            'type'       => Controls_Manager::NUMBER,
            'min'        => 1,
            'max'        => 5,
            'step'       => 1,
            'default'    => 5,
            'condition'  => [ 'show_rating' => 'yes' ],
        ] );

        $this->add_control( 'rating_icon', [
            'label'      => __( 'Star Icon', 'testimonial-widget' ),
            'type'       => Controls_Manager::ICONS,
            'default'    => [ 'value' => 'fas fa-star', 'library' => 'fa-solid' ],
            'skin'       => 'inline',
            'label_block'=> false,
            'condition'  => [ 'show_rating' => 'yes' ],
        ] );

        $this->end_controls_section();

        /* ── STYLE TAB ───────────────────────── */

        // Section: Card
        $this->start_controls_section( 'style_card', [
            'label' => __( 'Card', 'testimonial-widget' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'card_background', [
            'label'     => __( 'Background Color', 'testimonial-widget' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [ '{{WRAPPER}} .tcw-card' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_responsive_control( 'card_padding', [
            'label'      => __( 'Padding', 'testimonial-widget' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'default'    => [
                'top' => '32', 'right' => '32', 'bottom' => '32', 'left' => '32',
                'unit' => 'px', 'isLinked' => true,
            ],
            'selectors'  => [
                '{{WRAPPER}} .tcw-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ] );

        $this->add_responsive_control( 'card_border_radius', [
            'label'      => __( 'Border Radius', 'testimonial-widget' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'default'    => [ 'top'=>'16','right'=>'16','bottom'=>'16','left'=>'16','unit'=>'px','isLinked'=>true ],
            'selectors'  => [
                '{{WRAPPER}} .tcw-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
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

        // Section: Quote Icon
        $this->start_controls_section( 'style_quote_icon', [
            'label' => __( 'Quote Icon', 'testimonial-widget' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'quote_icon_color', [
            'label'     => __( 'Color', 'testimonial-widget' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#6366f1',
            'selectors' => [ '{{WRAPPER}} .tcw-quote-icon' => 'color: {{VALUE}};' ],
        ] );

        $this->add_responsive_control( 'quote_icon_size', [
            'label'      => __( 'Size', 'testimonial-widget' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 16, 'max' => 80 ] ],
            'default'    => [ 'unit' => 'px', 'size' => 32 ],
            'selectors'  => [ '{{WRAPPER}} .tcw-quote-icon' => 'font-size: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->end_controls_section();

        // Section: Testimonial Text
        $this->start_controls_section( 'style_text', [
            'label' => __( 'Testimonial Text', 'testimonial-widget' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'text_color', [
            'label'     => __( 'Color', 'testimonial-widget' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#374151',
            'selectors' => [ '{{WRAPPER}} .tcw-text' => 'color: {{VALUE}};' ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'text_typography',
            'selector' => '{{WRAPPER}} .tcw-text',
        ] );

        $this->add_responsive_control( 'text_spacing', [
            'label'      => __( 'Bottom Spacing', 'testimonial-widget' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 60 ] ],
            'default'    => [ 'unit' => 'px', 'size' => 24 ],
            'selectors'  => [ '{{WRAPPER}} .tcw-text' => 'margin-bottom: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->end_controls_section();

        // Section: Author
        $this->start_controls_section( 'style_author', [
            'label' => __( 'Author', 'testimonial-widget' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_responsive_control( 'image_size', [
            'label'      => __( 'Photo Size', 'testimonial-widget' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 32, 'max' => 120 ] ],
            'default'    => [ 'unit' => 'px', 'size' => 56 ],
            'selectors'  => [
                '{{WRAPPER}} .tcw-author-image' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ] );

        $this->add_responsive_control( 'image_border_radius', [
            'label'      => __( 'Photo Border Radius', 'testimonial-widget' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 60 ], '%' => [ 'min' => 0, 'max' => 50 ] ],
            'default'    => [ 'unit' => '%', 'size' => 50 ],
            'selectors'  => [ '{{WRAPPER}} .tcw-author-image' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_control( 'author_name_color', [
            'label'     => __( 'Name Color', 'testimonial-widget' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#111827',
            'selectors' => [ '{{WRAPPER}} .tcw-author-name' => 'color: {{VALUE}};' ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'author_name_typography',
            'label'    => __( 'Name Typography', 'testimonial-widget' ),
            'selector' => '{{WRAPPER}} .tcw-author-name',
        ] );

        $this->add_control( 'author_title_color', [
            'label'     => __( 'Title Color', 'testimonial-widget' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#6b7280',
            'selectors' => [ '{{WRAPPER}} .tcw-author-title' => 'color: {{VALUE}};' ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'author_title_typography',
            'label'    => __( 'Title Typography', 'testimonial-widget' ),
            'selector' => '{{WRAPPER}} .tcw-author-title',
        ] );

        $this->end_controls_section();

        // Section: Rating Stars
        $this->start_controls_section( 'style_rating', [
            'label'     => __( 'Rating Stars', 'testimonial-widget' ),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [ 'show_rating' => 'yes' ],
        ] );

        $this->add_control( 'star_color', [
            'label'     => __( 'Star Color', 'testimonial-widget' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#f59e0b',
            'selectors' => [ '{{WRAPPER}} .tcw-star' => 'color: {{VALUE}};' ],
        ] );

        $this->add_responsive_control( 'star_size', [
            'label'      => __( 'Star Size', 'testimonial-widget' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 10, 'max' => 40 ] ],
            'default'    => [ 'unit' => 'px', 'size' => 18 ],
            'selectors'  => [ '{{WRAPPER}} .tcw-star' => 'font-size: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'star_gap', [
            'label'      => __( 'Gap Between Stars', 'testimonial-widget' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 16 ] ],
            'default'    => [ 'unit' => 'px', 'size' => 3 ],
            'selectors'  => [ '{{WRAPPER}} .tcw-rating' => 'gap: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->end_controls_section();
    }

    /* ─────────────────────────────────────────
     * Render (front-end + editor preview)
     * ───────────────────────────────────────── */

    protected function render() {
        $s = $this->get_settings_for_display();

        $name         = ! empty( $s['author_name'] )      ? esc_html( $s['author_name'] )  : '';
        $title        = ! empty( $s['author_title'] )     ? esc_html( $s['author_title'] ) : '';
        $text         = ! empty( $s['testimonial_text'] ) ? esc_html( $s['testimonial_text'] ) : '';
        $show_rating  = ! empty( $s['show_rating'] ) && $s['show_rating'] === 'yes';
        $rating_value = isset( $s['rating_value'] ) ? (int) $s['rating_value'] : 5;
        $img_url      = ! empty( $s['author_image']['url'] ) ? esc_url( $s['author_image']['url'] ) : '';
        $alignment    = ! empty( $s['alignment'] ) ? esc_attr( $s['alignment'] ) : 'center';

        ?>
        <div class="tcw-card tcw-align-<?php echo $alignment; ?>" style="text-align: <?php echo $alignment; ?>;">

            <?php /* Quote icon */ ?>
            <div class="tcw-quote-icon" aria-hidden="true">
                <?php Icons_Manager::render_icon( $s['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </div>

            <?php /* Rating */ ?>
            <?php if ( $show_rating ) : ?>
                <div class="tcw-rating" role="img" aria-label="<?php printf( esc_attr__( '%d out of 5 stars', 'testimonial-widget' ), $rating_value ); ?>">
                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                        <span class="tcw-star<?php echo $i > $rating_value ? ' tcw-star--empty' : ''; ?>">
                            <?php Icons_Manager::render_icon( $s['rating_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </span>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>

            <?php /* Testimonial text */ ?>
            <p class="tcw-text"><?php echo $text; ?></p>

            <?php /* Author row */ ?>
            <div class="tcw-author">
                <?php if ( $img_url ) : ?>
                    <img
                        class="tcw-author-image"
                        src="<?php echo $img_url; ?>"
                        alt="<?php echo esc_attr( $name ); ?>"
                        loading="lazy"
                    />
                <?php endif; ?>
                <div class="tcw-author-meta">
                    <?php if ( $name )  : ?><span class="tcw-author-name"><?php echo $name; ?></span><?php endif; ?>
                    <?php if ( $title ) : ?><span class="tcw-author-title"><?php echo $title; ?></span><?php endif; ?>
                </div>
            </div>

        </div>
        <?php
    }

    /* ─────────────────────────────────────────
     * Content template (JS live-preview)
     * ───────────────────────────────────────── */

    protected function content_template() {
        ?>
        <#
        var quoteIcon  = settings.quote_icon;
        var ratingIcon = settings.rating_icon;
        var imgUrl     = settings.author_image.url;
        var alignment  = settings.alignment || 'center';
        #>
        <div class="tcw-card tcw-align-{{ alignment }}" style="text-align: {{ alignment }};">

            <div class="tcw-quote-icon" aria-hidden="true">
                <# if ( quoteIcon.value ) { #>
                    <i class="{{ quoteIcon.value }}"></i>
                <# } #>
            </div>

            <# if ( settings.show_rating === 'yes' ) { #>
                <div class="tcw-rating">
                    <# for ( var i = 1; i <= 5; i++ ) { #>
                        <span class="tcw-star <# if ( i > settings.rating_value ) { #>tcw-star--empty<# } #>">
                            <# if ( ratingIcon.value ) { #>
                                <i class="{{ ratingIcon.value }}"></i>
                            <# } #>
                        </span>
                    <# } #>
                </div>
            <# } #>

            <p class="tcw-text">{{{ settings.testimonial_text }}}</p>

            <div class="tcw-author">
                <# if ( imgUrl ) { #>
                    <img class="tcw-author-image" src="{{ imgUrl }}" alt="{{ settings.author_name }}" />
                <# } #>
                <div class="tcw-author-meta">
                    <# if ( settings.author_name )  { #><span class="tcw-author-name">{{ settings.author_name }}</span><# } #>
                    <# if ( settings.author_title ) { #><span class="tcw-author-title">{{ settings.author_title }}</span><# } #>
                </div>
            </div>

        </div>
        <?php
    }
}
