<?php

namespace SunlightExtend\DarkTheme;

use Sunlight\Plugin\ExtendPlugin;
use Sunlight\Plugin\PluginManager;

/**
 * Admin DarkTheme
 *
 * @author Jirka Daněk <jdanek.eu>
 */
class DarkThemePlugin extends ExtendPlugin
{
    private $background = '#222222';
    private $dark_color = '#181818';
    private $border_color = '#343434';
    private $hover_color = '#202020';
    private $hover_border_color = '#484848';
    private $text_color = '#c0c0c0';
    private $link_color = '#4183c4';
    private $hint_color = '#7b7b7b';
    private $control_bg = 'linear-gradient(#202020, #181818)';
    private $control_bg_hover = 'linear-gradient(#303030, #282828)';
    private $menu_tab_text_act = '#e2e2e2';

    public function __construct(array $data, PluginManager $manager)
    {
        parent::__construct($data, $manager);
    }

    /**
     * @param array $args
     */
    public function onAdminHead(array $args)
    {
        // vynuceni tmaveho designu pro code mirror
        $args['css']['codemirror_theme'] = $basePath = $this->getWebPath() . '/../codemirror/Resources/theme/ambiance.css';
    }

    /**
     * @param array $args
     */
    public function changes(array $args)
    {
        $scheme = array(
            'dark' => true,
            'scheme_text' => $this->text_color,
            'scheme_link' => $this->link_color,
            'scheme_smoke_text' => $this->hint_color,
            'scheme_smoke' => $this->border_color,
            'scheme_smoke_med' => $this->border_color,
            'scheme_bar' => $this->dark_color,
            'scheme_smoke_lightest_colored' => $this->hover_color,
        );

        foreach ($scheme as $n => $c) {
            $GLOBALS[$n] = $c;
        }
    }

    public function addStyles($args)
    {
        $args['output'] .= "\n/* DarkTheme Plugin */\n";

        // zmena codemirror
        $args['output'] .= "div.CodeMirror {border: 1px solid {$this->border_color};}\n";

        // nahrazeni obrazku
        $args['output'] .= ".sortable-handle {background: url({$this->getWebPath()}/Resources/drag-handle.png) left top no-repeat;}\n";
        $args['output'] .= "body.login-layout #top {background: url({$this->getWebPath()}/Resources/logo.png) center 50px no-repeat;}\n";

        // odkazy
        $args['output'] .= "table.page-list a, #footer a, a {color: {$this->link_color};}\n";

        // zpravy
        $args['output'] .= ".message {border: 1px solid; margin: 10px 0px; padding:15px 10px 15px 50px;}\n";
        $args['output'] .= ".message-ok {color:  #ffffff; background-color: #10263d; border-color: #004080;}\n";
        $args['output'] .= ".message-warn {color:  #ffffff; background-color: #512b15; border-color: #a33c00;}\n";
        $args['output'] .= ".message-err {color: #ffffff; background-color: #4d1919; border-color: #a30000;}\n";

        // hlavni menu
        $args['output'] .= "#menu a span {color: {$this->hint_color}; border: 1px solid {$this->dark_color}; border-bottom: none;}\n";
        $args['output'] .= "#menu a:hover span, #menu a.act span {color: {$this->menu_tab_text_act}; background-color: {$this->background}; border: 1px solid {$this->border_color}; border-bottom: none;}\n";

        // obsah
        $args['output'] .= "body, .wrapper {background-image: url(data:image/gif;base64,R0lGODlhBAAEAKECABERESQkJP///////yH5BAEKAAIALAAAAAAEAAQAAAIFhB6nhlIAOw==) !important; background-repeat: repeat !important; background-color: {$this->dark_color} !important;}\n";
        $args['output'] .= "#content {background-color: {$this->background};}\n";

        // admin login table
        $args['output'] .= "body.login-layout #content {border: 1px solid {$this->border_color};}\n";

        // tabulky
        $args['output'] .= "#fman-list tr td, tr td tr.even td, tr.odd td {border-bottom: 1px solid {$this->border_color}; background-color: {$this->background};}\n";

        $args['output'] .= "#index-table > tbody > tr > td, #index-messages, #contenttable, .two-columns, table.list, #fman-list, #settingsnav, .formtable {background-color: {$this->background}; border: 1px solid {$this->border_color};}\n";
        $args['output'] .= "#settingsnav ul {background-color: inherit;}\n";
        $args['output'] .= "#settingsnav ul a {border-bottom: 1px solid {$this->border_color};}\n";
        $args['output'] .= "#settingsnav a, #settingsnav li a {color: {$this->hint_color};}\n";
        $args['output'] .= "#settingsnav a:hover, #settingsnav li.active a {color: {$this->menu_tab_text_act}; background-color: {$this->dark_color};}\n";
        $args['output'] .= "#fman-list tr:hover td, table.page-list tr:hover:not(.page-separator) td {background-color: {$this->hover_color};}\n";
        $args['output'] .= "table.page-list td {border-left: 1px solid {$this->border_color};}\n";
        $args['output'] .= "table.page-list tr.page-separator td {border-top: 24px solid {$this->background}; background-color:{$this->dark_color}; border-left: 1px solid {$this->border_color};}\n";
        $args['output'] .= "td.page-actions a {background: {$this->control_bg}; outline: 1px solid {$this->border_color};}";
        $args['output'] .= "td.page-actions a:hover {background: {$this->control_bg_hover}; outline: 1px solid {$this->hover_border_color};}";
        $args['output'] .= "table.page-list tr:hover td.page-actions a {outline: 1px solid {$this->hover_border_color};}";
        $args['output'] .= "fieldset table.list thead td, fieldset table.list thead th {background-color: {$this->border_color};}\n";

        // inputy
        $args['output'] .= "input[type='submit'], input[type=submit].button {color: #e2e2e2; background: linear-gradient(#407045, #305530); border-color: #008833;}\n";
        $args['output'] .= "input[type='submit']:hover, input[type=submit].button:hover {background: linear-gradient(#508055, #407045);  border-color: #008833;}\n";
        $args['output'] .= "input[type=text], input[type=password], input[type=email], input[type=number], input[type=text], input[type=file], textarea, select {color: {$this->text_color}; background-color: {$this->dark_color}; border: 1px solid {$this->border_color};}";
        $args['output'] .= "a.button, input.button, input[type=reset], input[type=submit][name=reset], button {color: #e2e2e2; background: {$this->control_bg}; border-color: #343434;}\n";
        $args['output'] .= "a.button:hover, input.button:hover, input[type=reset]:hover, input[type=submit][name=reset]:hover, button:hover {background: {$this->control_bg_hover}; border-color: {$this->hover_border_color};}\n";

        // ruzne
        $args['output'] .= "table.page-list.page-list-full-tree td.page-title > :not(.node-level-p0) span.page-list-title {border-left: 1px solid {$this->border_color};}\n";
        $args['output'] .= "ul.page-list-breadcrumbs {border-bottom: 2px solid {$this->border_color}; background-color: inherit;}\n";
        $args['output'] .= "fieldset, fieldset fieldset {background-color: inherit;}\n";
        $args['output'] .= "fieldset table.list td {border-color: inherit;}\n";
        $args['output'] .= ".hr {background-image: none; border-bottom: 1px solid {$this->border_color};}\n";
        $args['output'] .= "div.radio-group {border: none; background-color: {$this->background};}";
        $args['output'] .= "div.radio-group label {background-color: {$this->dark_color}; border: 1px solid {$this->border_color}; border-left: none;}\n";
        $args['output'] .= "#fman-list tr:first-child td, #fman-list tr:not(:nth-child(2)) td[colspan='3'] {background-color: {$this->dark_color};}\n";
        $args['output'] .= "#fman-list td {border: none;}\n";
        $args['output'] .= "#settingseditform table td {border-bottom: 1px solid {$this->border_color};}\n";
        $args['output'] .= ".well {background-color: transparent;}\n";

        $args['output'] .= "pre.exception {background-color: transparent; border: 1px solid {$this->border_color}; background-color: {$this->dark_color};}\n";
    }
}
