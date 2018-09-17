<?php

namespace Dunkers\Controller;

class SingleEvent extends \Municipio\Controller\SingleEvent
{
    public function init()
    {
        global $post;
        $this->data['occasion'] = method_exists('\EventManagerIntegration\Helper\SingleEventData', 'singleEventDate') ? \EventManagerIntegration\Helper\SingleEventData::singleEventDate() : null;
        $this->data['location'] = get_post_meta($post->ID, 'location', true);
        $this->data['occations'] = $this->getOccations($post->ID);

        $this->data['layout']['content']  = 'grid-xs-12 grid-md-auto';
        $this->data['layout']['sidebarRight']  = 'grid-xs-12 grid-lg-4';


        $this->getSingleHeroImage();
    }

    public function getSingleHeroImage()
    {
        $attachmentId = get_post_thumbnail_id(get_queried_object_id());
        $image = wp_get_attachment_image_src($attachmentId, 'original');
        if (isset($image[0])) {
            $this->data['singleHeroImage'] = $image[0];
        }
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
