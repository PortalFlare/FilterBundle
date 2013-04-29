<?php
namespace PortalFlare\FilterBundle;

use \Doctrine\ORM\EntityManager;

/**
 * Class Filter
 * @package PortalFlare\FilterBundle
 *
 * Filter manager for data forms
 */

class Filter {
  protected $em; // Entity manager
  protected $entities; // Array of entities in the filter
  protected $englishfilter; // English description of the current filter
  protected $conditions; // Array of conditions
  protected $where; // DQL where clause

  /**
   * Constructor
   *
   * @param EntityManager $em
   */
  public function __construct(EntityManager $em) {
    $this->em = $em;
  }

  /**
   * Add an entity
   *
   * @param $entity
   */
  public function addEntity($entity) {
    $this->entities[$entity] = $this->em->getClassMetadata($entity);
  }

  /**
   * Get all the filterable fields
   *
   * @return array
   */
  public function getFilterableFields() {

    $fieldlist = array();

    foreach ($this->entities as $entity) {
      var_dump($entity); die;
      var_dump($this->em->getClassMetadata($entity)); die;


      $tablename             = $entity->table['options']['displayname'];
      $fieldlist[$tablename] = array();
      foreach ($entity->fieldMappings as $field) {
        if (array_key_exists('options', $field)) {
          if (array_key_exists('filterable', $field['options'])) {
            if ($field['options']['filterable'] == true) {
              $fieldname = $field['fieldName'];
              $fieldlist[$tablename][$fieldname] = $field;
              if (array_key_exists('formname', $field['options'])) {
                $fieldlist[$tablename][$fieldname]['displayname'] = $field['options']['formname'];
              } else {
                $fieldlist[$tablename][$fieldname]['displayname'] = ucfirst(str_replace("_", " ", $field['fieldName']));
              }
            }
          }
        }
      }
    }

    var_dump($fieldlist);
    die;
    return $fieldlist;
  }


}