<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */
namespace Mage2\Ecommerce\Models\Database;

class Attribute extends BaseModel
{

    protected $fillable = ['type', 'name', 'identifier', 'field_type','use_as' ,'sort_order'];


    public static function variationOptions() {
        $model = new static;
        return $model->whereUseAs('VARIATION')->get()->pluck('name','id');
    }

    public static function specificationOptions() {
        $model = new static;
        return $model->whereUseAs('SPECIFICATION')->get()->pluck('name','id');
    }

    public function getDropdownSubProduct($option) {
        $attributeValue  = ProductAttributeValue::whereAttributeId($this->attributes['id'])->whereValue($option->id)->first();

        if(null != $attributeValue) {
            return Product::findorfail($attributeValue->product_id);
        }
        
        return null;

    }


    public function products() {
        return $this->hasMany(Product::class);
    }

    public function attributeDropdownOptions() {
        return $this->hasMany(AttributeDropdownOption::class);
    }

    public function getOptionsList($productAttributevalues) {
        dd($productAttributevalues);
    }

}


