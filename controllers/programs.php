<?php
/**
 * @package com_meego_devprogram
 * @author Ferenc Szekely, http://www.nemein.com
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class com_meego_devprogram_controllers_programs extends midgardmvc_core_controllers_baseclasses_crud
{
    var $mvc = null;
    var $request = null;

    /**
     * Contructor
     *
     * @param object request is a midgardmvc_core_request object
     */
    public function __construct(midgardmvc_core_request $request)
    {
        $this->request = $request;
        $this->mvc = midgardmvc_core::get_instance();
        $this->data['programs'] = false;
        $this->data['my_programs'] = false;
    }

    /**
     * Loads a program
     */
    public function load_object(array $args)
    {
        $this->object = com_meego_devprogram_utils::get_program_by_name($args['program_name']);

        if (is_object($this->object))
        {
            midgardmvc_core::get_instance()->head->set_title($this->object->title);
        }
    }

    /**
     * Prepare a new program
     */
    public function prepare_new_object(array $args)
    {
        $this->object = new com_meego_devprogram_program();
    }

    /**
     * Returns a read url for a program
     */
    public function get_url_read()
    {
        return midgardmvc_core::get_instance()->dispatcher->generate_url
        (
            'program_details',
            array
            (
                'program_name' => $this->object->name
            ),
            $this->request
        );
    }

    /**
     * Returns an update url for a program
     */
    public function get_url_update()
    {
        return midgardmvc_core::get_instance()->dispatcher->generate_url
        (
            'my_program_update', array
            (
                'program_name' => $this->object->name
            ),
            $this->request
        );
    }

    /**
     * Loads a form
     */
    public function load_form()
    {
        $this->form = midgardmvc_helper_forms_mgdschema::create($this->object, false);
    }

    /**
     * Prepares and shows the program list page (cmd-my-programs)
     *
     * @param array args (not used)
     */
    public function get_my_programs_list(array $args)
    {
        // check if is logged in
        if (! $this->mvc->authentication->is_user())
        {
            return;
        }

        $myprograms = array(
            'name' => 'test1',
            'title' => 'test program',
            'projectid' => 1,
            'projectidea' => 'blablabla',
            'details_url' =>  $this->mvc->dispatcher->generate_url
            (
                'program_details',
                array('program_name' => 'test'),
                $this->request
            )
        );
        $this->data['my_programs'][] = $myprograms;
    }

    /**
     * Prepares and shows the program details page (cmd-program-details)
     *
     * Access: anyone can read the program details
     *         owners will get extra options on the page
     *
     * @param array args (not used)
     */
    public function get_program_details(array $args)
    {
        // set owner flag
        // @todo
    }

    /**
     * Prepares and shows the program list page (cmd-list-programs)
     *
     * Access: anyone can list open programs
     *
     * @param array args (not used)
     */
    public function get_open_programs_list(array $args)
    {
    }

    /**
     * Prepares and shows the program list page (cmd-list-programs)
     *
     * Access: anyone can list closed programs
     *
     * @param array args (not used)
     */
    public function get_closed_programs_list(array $args)
    {
    }

    /**
     * Prepares and shows the list of application for a certain program (cmd-list-application)
     *
     * Access: only owners of the program can list the applications
     *
     * @param array args (not used)
     */
    public function get_applications_for_program(array $args)
    {
        // check if is logged in
        if (! $this->mvc->authentication->is_user())
        {
            return;
        }
        // check if user owns the program
        // @todo
    }

    /**
     * Prepares and shows an application details page (cmd-application-details)
     *
     * Access: only owners of the program can see details of the application
     *
     * @param array args (not used)
     */
    public function get_application_details(array $args)
    {
        // check if is logged in
        if (! $this->mvc->authentication->is_user())
        {
            return;
        }
        // check if user owns the program
        // @todo
    }
}

?>