<?php

namespace Syntro\SilverStripeElementalBootstrapSpotlightSection\Model;

use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\FieldList;
use SilverStripe\AssetAdmin\Forms\UploadField;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use Syntro\SilverStripeElementalBaseitems\Model\BaseItem;
use Syntro\SilverStripeElementalBootstrapSpotlightSection\Elements\SpotlightSection;
use Syntro\SilverStripeElementalBootstrapSpotlightSection\Elements\IllustratedSpotlightSection;

/**
 * Spotlight
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class Spotlight extends BaseItem
{
    private static $singular_name = 'Item';
    private static $plural_name = 'Items';
    /**
     * @var string
     */
    private static $table_name = 'ElementalBootstrapSpotlight';

    /**
     * @var array
     */
    private static $db = [
        'Sort' => 'Int',
        'SubTitle' => 'Varchar(255)',
        'Content' => 'Text',

    ];

    private static $default_sort = ['Sort' => 'ASC'];

    /**
     * @var array
     */
    private static $has_one = [
        'Section' => SpotlightSection::class,
        'Image' => Image::class,
        'CTALink' => Link::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Image',
        'CTALink'
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Image.StripThumbnail',
        'Title',
        'Content.FirstSentence',
        'CTALink.Title'
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
        $labels['Image.StripThumbnail'] = _t(__CLASS__ . '.IMAGE', 'Image');
        $labels['Image'] = _t(__CLASS__ . '.IMAGE', 'Image');
        $labels['Title'] = _t(__CLASS__ . '.TITLE', 'Title');
        $labels['SubTitle'] = _t(__CLASS__ . '.SUBTITLE', 'Subtitle');
        $labels['Content.FirstSentence'] = _t(__CLASS__ . '.SUMMARY', 'Summary');
        $labels['Caption'] = _t(__CLASS__ . '.CAPTION', 'Caption');
        $labels['CTALink'] = _t(__CLASS__ . '.CALLTOACTIONLINK', 'Call to action Link');
        $labels['CTALink.Title'] = _t(__CLASS__ . '.CALLTOACTIONLINK', 'Call to action Link');
        return $labels;
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            /** @var FieldList $fields */
            $fields->removeByName([
                'Sort',
                'SectionID',
                'CTALinkID'
            ]);

            $fields->dataFieldByName('Content')->setTitle($this->fieldLabel('Caption'));

            // Add Image Upload Field
            $fields->addFieldToTab(
                'Root.Main',
                $imageField = UploadField::create(
                    'Image',
                    $this->fieldLabel('Image')
                ),
                'SubTitle'
            );
            $imageField->setFolderName('Uploads/Spotlights');

            $fields->addFieldToTab(
                'Root.Main',
                LinkField::create(
                    'CTALink',
                    $this->fieldLabel('CTALink'),
                    $this
                )
            );
        });

        return parent::getCMSFields();
    }
}
