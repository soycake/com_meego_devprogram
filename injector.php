<?php
/**
 * @package com_meego_devprogram
 * @author Ferenc Szekely, http://www.nemein.com
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
 class com_meego_devprogram_injector
{
    var $component = 'com_meego_devprogram';
    var $mvc = null;

    public function __construct()
    {
        $this->mvc = midgardmvc_core::get_instance();
        $this->mvc->i18n->set_translation_domain($this->component);

        $default_language = $this->mvc->configuration->default_language;

        if (! isset($default_language))
        {
            $default_language = 'en_US';
        }

        $this->mvc->i18n->set_language($default_language, false);
    }

    /**
     * @todo: docs
     */
    public function inject_process(midgardmvc_core_request $request)
    {
        // We inject the template to provide MeeGo styling
        $request->add_component_to_chain($this->mvc->component->get($this->component), true);
        // Default title
        $this->mvc->head->set_title($this->mvc->i18n->get('title_welcome'));
    }

    /**
     * Some template hack
     */
    public function inject_template(midgardmvc_core_request $request)
    {
        $this->add_head_elements();
    }

    /**
     * Add CSS and JS to HTML head
     */
    private function add_head_elements()
    {
        $this->mvc->head->add_link
        (
            array
            (
                'rel' => 'stylesheet',
                'type' => 'text/css',
                'href' => MIDGARDMVC_STATIC_URL . '/' . $this->component . '/css/devprogram.css'
            )
        );
    }
}
?>
