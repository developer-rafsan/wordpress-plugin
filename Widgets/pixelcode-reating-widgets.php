<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class PixelCode_Reating_Widgets extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'star_rating_badge';
	}

	public function get_title(): string {
		return esc_html__( 'Star Rating', 'pixelcode' );
	}

	public function get_icon(): string {
		return 'eicon-rating';
	}

	public function get_categories(): array {
		return [ 'pixelcode' ];
	}

	protected function register_controls(): void {

        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'pixelcode' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		// Icon picker
		$this->add_control(
			'star_icon',
			[
				'label'   => __( 'Icon', 'pixelcode' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		// Typography control
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'badge_typography',
				'label' => __( 'Typography', 'pixelcode' ),
				'selector' => '{{WRAPPER}} .pixelcode-badge',
			]
		);

		// Text color
		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text Color', 'pixelcode' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .pixelcode-badge' => 'color: {{VALUE}};',
				],
			]
		);

		// Background color
		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background Color', 'pixelcode' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .pixelcode-badge' => 'background-color: {{VALUE}};',
				],
			]
		);

		// Badge width
		$this->add_responsive_control(
			'badge_width',
			[
				'label'      => __( 'Width', 'pixelcode' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 1000],
					'%'  => [ 'min' => 0, 'max' => 100 ],
					'rem'  => [ 'min' => 0, 'max' => 100 ],
					'vw'  => [ 'min' => 0, 'max' => 100 ],
				],
				'size_units' => [ 'px', '%', 'rem', 'vw' ],
				'selectors'  => [
					'{{WRAPPER}} .pixelcode-badge' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Badge height
		$this->add_responsive_control(
			'badge_height',
			[
				'label'      => __( 'Height', 'pixelcode' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 1000],
					'%'  => [ 'min' => 0, 'max' => 100 ],
					'rem'  => [ 'min' => 0, 'max' => 100 ],
					'vh'  => [ 'min' => 0, 'max' => 100 ],
				],
				'size_units' => [ 'px', '%', 'rem', 'vh' ],
				'selectors'  => [
					'{{WRAPPER}} .pixelcode-badge' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Padding control
		$this->add_responsive_control(
			'badge_padding',
			[
				'label'      => __( 'Padding', 'pixelcode' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .pixelcode-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Border radius control
		$this->add_responsive_control(
			'badge_border_radius',
			[
				'label'      => __( 'Border Radius', 'pixelcode' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 100 ],
					'%' => [ 'min' => 0, 'max' => 100 ],
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pixelcode-badge' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Border control
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'badge_border',
				'label' => __( 'Border', 'pixelcode' ),
				'selector' => '{{WRAPPER}} .pixelcode-badge',
			]
		);

		// Box Shadow control
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'badge_shadow',
				'label' => __( 'Box Shadow', 'pixelcode' ),
				'selector' => '{{WRAPPER}} .pixelcode-badge',
			]
		);

		$this->end_controls_section();
	}

	protected function render(): void {
		global $product;

		if ( ! is_a( $product, 'WC_Product' ) ) {
			$product = wc_get_product( get_the_ID() );
		}

		$rating = $product ? $product->get_average_rating() : 0;
		if ( ! $rating ) return;

		// Get all settings
		$settings = $this->get_settings_for_display();

		// Extract settings
		$icon = $settings['star_icon']['value'];

		// Inline style
		$style = "display:inline-flex;align-items:center;justify-content: center;";

		echo '<div class="pixelcode-badge" style="' . esc_attr( $style ) . '">';
		if ( $icon ) {
			echo '<i class="' . esc_attr( $icon ) . '" style="margin-right:5px;"></i>';
		}
		echo esc_html( number_format( $rating, 1 ) );
		echo '</div>';
	}
}
?>
