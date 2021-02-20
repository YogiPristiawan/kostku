<?php

function count_order($user_id)
{
	$CI = &get_instance();
	$CI->load->model('Booking_model', 'booking');

	return count($CI->booking->getByUser($user_id));
}
