<?php
/**
 * ---------------------------------------------------------------------
 * Formcreator is a plugin which allows creation of custom forms of
 * easy access.
 * ---------------------------------------------------------------------
 * LICENSE
 *
 * This file is part of Formcreator.
 *
 * Formcreator is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Formcreator is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Formcreator. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 * @copyright Copyright © 2011 - 2020 Teclib'
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @link      https://github.com/pluginsGLPI/formcreator/
 * @link      https://pluginsglpi.github.io/formcreator/
 * @link      http://plugins.glpi-project.org/#/plugin/formcreator
 * ---------------------------------------------------------------------
 */

namespace GlpiPlugin\Formcreator\Field;

use PluginFormcreatorAbstractField;
use Session;
use GlpiPlugin\Formcreator\Exception\ComparisonException;

class DescriptionField extends PluginFormcreatorAbstractField
{
   public function isPrerequisites() {
      return true;
   }

   public function getDesignSpecializationField() {
      $common = parent::getDesignSpecializationField();
      $additions = $common['additions'];

      return [
         'label' => '',
         'field' => '',
         'additions' => $additions,
         'may_be_empty' => false,
         'may_be_required' => false,
      ];
   }

   public function getRenderedHtml($canEdit = true) {
      return nl2br(html_entity_decode($this->question->fields['description']));
   }

   public function serializeValue() {
      return '';
   }

   public function deserializeValue($value) {
      $this->value = '';
   }

   public function getValueForDesign() {
      return '';
   }

   public function getValueForTargetText($richText) {
      $text = $this->question->fields['description'];
      if (!$richText) {
         $text = nl2br(strip_tags(html_entity_decode($text)));
      }

      return $text;
   }

   public function moveUploads() {}

   public function getDocumentsForTarget() {
      return [];
   }

   public function isValid() {
      return true;
   }

   public function isValidValue($value) {
      return true;
   }

   public static function getName() {
      return __('Description');
   }

   public function prepareQuestionInputForSave($input) {
      if (isset($input['description'])) {
         if (strlen($input['description']) < 1) {
            Session::addMessageAfterRedirect(
               __('A description field should have a description:', 'formcreator') . ' ' . $input['name'],
               false,
               ERROR);
            return [];
         }
      }
      $this->value = '';

      return $input;
   }

   public function hasInput($input) {
      return false;
   }

   public static function canRequire() {
      return false;
   }

   public function equals($value) {
      throw new ComparisonException('Meaningless comparison');
   }

   public function notEquals($value) {
      throw new ComparisonException('Meaningless comparison');
   }

   public function greaterThan($value) {
      throw new ComparisonException('Meaningless comparison');
   }

   public function lessThan($value) {
      throw new ComparisonException('Meaningless comparison');
   }

   public function parseAnswerValues($input, $nonDestructive = false) {
      return true;
   }

   public function isAnonymousFormCompatible() {
      return true;
   }

   public function getHtmlIcon() {
      return '<i class="fas fa-align-left" aria-hidden="true"></i>';
   }

   public function isVisibleField()
   {
      return true;
   }

   public function isEditableField()
   {
      return false;
   }
}
