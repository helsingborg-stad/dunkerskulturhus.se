<?php

namespace Dunkers\Controller;

class SingleEvent extends \Municipio\Controller\BaseController
{
    public function init()
    {
        global $post;
        $this->data['occasion'] = $this->singleEventDate($post->ID);
        $this->data['location'] = get_post_meta($post->ID, 'location', true);
        $this->data['occations'] = $this->getOccations($post->ID);
    }

    /**
     * Get single event date
     * @return array
     */
    public function singleEventDate($post_id)
    {
        $singleOccasion = array();
        $get_date = (! empty(get_query_var('date'))) ? get_query_var('date') : false;
        $occasions = self::getEventOccasions($post_id);
        if (is_array($occasions) && count($occasions) == 1) {
            $singleOccasion = $occasions[0];
            $singleOccasion['date_parts'] = self::dateParts($occasions[0]['start_date']);
        } elseif (is_array($occasions) && $get_date != false) {
            foreach ($occasions as $occasion) {
                $event_date = preg_replace('/\D/', '', $occasion['start_date']);
                if ($get_date == $event_date) {
                    $singleOccasion = $occasion;
                    $singleOccasion['date_parts'] = self::dateParts($occasion['start_date']);
                }
            }
        }

        return $singleOccasion;
    }

    /**
     * Get date parts as array
     * @param  string $start_date event start date
     * @return array              date values
     */
    public function dateParts($start_date)
    {
        $start = date('Y-m-d H:i:s', strtotime($start_date));
        $date  = array(
                    'date'  => mysql2date('j', $start, true),
                    'month' => mysql2date('F', $start, true),
                    'year'  => mysql2date('Y', $start, true),
                    'time'  => mysql2date('H:i', $start, true),
                );

        return $date;
    }

    /**
     * Get event occasions
     * @param  int $post_id post id
     * @return array        object with occasions
     */
    public function getEventOccasions($post_id)
    {
        global $wpdb;
        $db_table = $wpdb->prefix . "integrate_occasions";

        $query = "
        SELECT      *
        FROM        {$db_table}
        WHERE       {$db_table}.event_id = %d
        ";
        $query .= "ORDER BY {$db_table}.start_date ASC";

        $completeQuery = $wpdb->prepare($query, $post_id);
        $occasions = $wpdb->get_results($completeQuery, ARRAY_A);

        return $occasions;
    }


    /**
     * Gets all occations of the event (except current occation)
     * @return object
     */
    public function getOccations($postID)
    {
        if (!class_exists('\EventManagerIntegration\Helper\QueryEvents')) {
            return array();
        }

        $occations = \EventManagerIntegration\Helper\QueryEvents::getEventOccasions($postID);

        if (is_array($occations) && !empty($occations)) {
            foreach ($occations as $key => $occasion) {
                if (strtotime($occasion->start_date) == strtotime($this->data['occasion']['start_date'])) {
                    unset($occations[$key]);
                }
            }

            return $occations;
        }

        return array();
    }
}
