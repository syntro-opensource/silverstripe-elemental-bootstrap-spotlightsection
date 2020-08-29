<?php

namespace Syntro\SilverStripeElementalBootstrapSpotlightSection\Elements;

use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Syntro\SilverStripeElementalBaseitems\Elements\BootstrapSectionBaseElement;
use Syntro\SilverStripeElementalBootstrapSpotlightSection\Model\Spotlight;


/**
 *  Bootstrap based Spotlight section
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class SpotlightSection extends BootstrapSectionBaseElement
{

    private static $icon = 'elemental-icon-spotlight';
    /**
     * This defines the block name in the CSS
     *
     * @config
     * @var string
     */
    private static $block_name = 'testimonial-section';

    /**
     * @var bool
     */
    private static $inline_editable = false;

    private static $styles = [
        'default' => 'Default style',
    ];

    /**
     * @var string
     */
    // private static $icon = 'font-icon-attention';

    /**
     * @var string
     */
    private static $table_name = 'ElementSpotlightSection';

    /**
     * set to false if image option should not show up
     *
     * @config
     * @var bool
     */
    private static $allow_image_background = true;

    /**
     * Available background colors for this Element
     *
     * @config
     * @var array
     */
    private static $background_colors = [];

    private static $text_colors = [];

    /**
     * Color mapping from background color. This is mainly intended
     * to set a default color on the section-level, ensuring text is readable.
     * Colors of subelementscan be added via templates
     *
     * @config
     * @var array
     */
    private static $text_colors_by_background = [];

    private static $db = [
        'Content' => 'Text',
    ];

    private static $has_many = [
        'Spotlights' => Spotlight::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Spotlights'
    ];

    /**
     * fieldLabels - apply labels
     *
     * @param  boolean $includerelations = true
     * @return array
     */
    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['Spotlights'] = _t(__CLASS__ . '.SPOTLIGHTS', 'Items');
        $labels['Content'] = _t(__CLASS__ . '.CONTENT', 'Content');
        return $labels;
    }


    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {

            $fields->dataFieldByName('Content')->setTitle($this->fieldLabel('Content'));

            if ($this->ID) {
                /** @var GridField $spotlights */
                $spotlights = $fields->dataFieldByName('Spotlights');
                $spotlights->setTitle($this->fieldLabel('Spotlights'));

                $fields->removeByName('Spotlights');

                $config = $spotlights->getConfig();
                $config->addComponent(new GridFieldOrderableRows('Sort'));
                $config->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
                $config->removeComponentsByType(GridFieldDeleteAction::class);

                $fields->addFieldToTab('Root.Main', $spotlights);
            }

        });

        return parent::getCMSFields();
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return sprintf(
            '%s: "%s"',
            _t(
                __CLASS__ . '.SUMMARY',
                'one item|{count} items',
                ['count' => $this->Spotlights()->count()]
            ),
            implode('", "', $this->Spotlights()->map('Title')->keys())
        );
    }

    /**
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Spotlight Section');
    }
}
