<?php
/*
Plugin Name:	WP Meetups deutschsprachig
Plugin URI: 	https://github.com/wpFRA/wpmg-widget
Description: 	Alle deutschsprachigen WP Meetups - in einem Widget.

Author:         wpFRA
Author URI: 	https://wpfra.de

Version:        0.2
Tested up to: 	4.3

License: 		GPL2

GitHub Plugin URI: https://github.com/wpFRA/wpmg-widget
GitHub Branch: master
*/


/*
Copyright 2015 WP Meetup Frankfurt (wpfra.de) (e-mail: kontakt@wpfra.de)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class wpmg_list extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => __( 'Liste deutschsprachiger WP Meetups', 'wpmg-widget' ) );
		parent::__construct( false, __( 'WP Meetups deutschsprachig', 'wpmg-widget' ), $widget_ops );
	}

	public function get_meetups() {
		$meetups = array(
			'https://wpmeetup-berlin.de' => array( 'title' => 'Berlin', 'url' => 'https://wpmeetup-berlin.de/' ),
			'http://wpbern.ch' => array( 'title' => 'Bern', 'url' => 'http://wpbern.ch/' ),
			'http://wpmeetup-dresden.de' => array( 'title' => 'Dresden', 'url' => 'http://wpmeetup-dresden.de/' ),
			'http://www.wpmeetup-eifel.de' => array( 'title' => 'Eifel', 'url' => 'http://www.wpmeetup-eifel.de/' ),
			'http://wpmeetup-franken.de' => array( 'title' => 'Franken', 'url' => 'http://wpmeetup-franken.de/' ),
			'http://wpmeetup-frankfurt.de' => array( 'title' => 'Frankfurt', 'url' => 'http://wpmeetup-frankfurt.de/' ),
			'http://wpmeetup-hamburg.de' => array( 'title' => 'Hamburg', 'url' => 'http://wpmeetup-hamburg.de/' ),
			'http://www.wpmeetup-hannover.de' => array( 'title' => 'Hannover', 'url' => 'http://www.wpmeetup-hannover.de/' ),
			'http://wpmeetup-karlsruhe.de' => array( 'title' => 'Karlsruhe', 'url' => 'http://wpmeetup-karlsruhe.de/' ),
			'http://wpcgn.de' => array( 'title' => 'Köln', 'url' => 'http://wpcgn.de/' ),
			'http://wpmeetup-muenchen.org' => array( 'title' => 'München', 'url' => 'http://wpmeetup-muenchen.org/' ),
			'http://www.wpmeetup-osnabrueck.de' => array( 'title' => 'Osnabrück/Münster/Emsland', 'url' => 'http://www.wpmeetup-osnabrueck.de/' ),
			'http://wpmeetup-potsdam.de' => array( 'title' => 'Potsdam', 'url' => 'http://wpmeetup-potsdam.de/' ),
			'http://wpmeetup-region38.de' => array( 'title' => 'Region 38', 'url' => 'http://wpmeetup-region38.de/' ),
			'http://wpmeetup-rheinruhr.de' => array( 'title' => 'Rhein-Ruhr', 'url' => 'http://wpmeetup-rheinruhr.de/' ),
			'http://wpmeetup-stuttgart.de' => array( 'title' => 'Stuttgart', 'url' => 'http://wpmeetup-stuttgart.de/' ),
			'http://www.meetup.com/de/wordpress-zurich' => array( 'title' => 'Zürich', 'url' => 'http://www.meetup.com/de/wordpress-zurich/' ),
		);

		$siteurl = site_url();

		if ( array_key_exists( $siteurl, $meetups ) ) {
			unset( $meetups[ $siteurl ] );
		}

		return $meetups;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = $instance['title'];

		$meetups = $this->get_meetups();

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		?>

		<div class="wpmg_widget widget_nav_menu">
			<ul class="menu">
				<?php foreach ( $meetups as $meetup ) : ?>
					<li class="menu-item">
						<a href="<?php echo esc_attr( $meetup['url'] ); ?>" title="WP Meetup <?php echo esc_attr( $meetup['title'] ); ?>" target="_blank" rel="nofollow">WP Meetup <?php echo esc_attr( $meetup['title'] ); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>

		</div><!-- end .wpmg_widget -->

		<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	function form( $instance ) {
		$title = esc_attr( $instance['title'] );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Titel:', 'wpmg-widget' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" />
		</p>

		<?php
	}

} // end class wpmg_list

function wpmg_list_widget_init() {
	register_widget( 'wpmg_list' );
}
add_action( 'widgets_init', 'wpmg_list_widget_init' );