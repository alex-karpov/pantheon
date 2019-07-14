<?php
/* ------------------------------------------------------------------
 * Generated by bin/rulesGen.php
 * DO NOT MODIFY BY HAND!
 * ------------------------------------------------------------------
 */

namespace Frey;

class InternalRules
{
    const IS_SUPER_ADMIN = 'IS_SUPER_ADMIN';
    const GET_PERSON_ACCESS = 'GET_PERSON_ACCESS';
    const GET_GROUP_ACCESS = 'GET_GROUP_ACCESS';
    const GET_ALL_PERSON_RULES = 'GET_ALL_PERSON_RULES';
    const GET_ALL_GROUP_RULES = 'GET_ALL_GROUP_RULES';
    const ADD_RULE_FOR_PERSON = 'ADD_RULE_FOR_PERSON';
    const ADD_RULE_FOR_GROUP = 'ADD_RULE_FOR_GROUP';
    const ADD_SYSTEM_WIDE_RULE_FOR_PERSON = 'ADD_SYSTEM_WIDE_RULE_FOR_PERSON';
    const ADD_SYSTEM_WIDE_RULE_FOR_GROUP = 'ADD_SYSTEM_WIDE_RULE_FOR_GROUP';
    const UPDATE_RULE_FOR_PERSON = 'UPDATE_RULE_FOR_PERSON';
    const UPDATE_RULE_FOR_GROUP = 'UPDATE_RULE_FOR_GROUP';
    const DELETE_RULE_FOR_PERSON = 'DELETE_RULE_FOR_PERSON';
    const DELETE_RULE_FOR_GROUP = 'DELETE_RULE_FOR_GROUP';
    const CLEAR_ACCESS_CACHE = 'CLEAR_ACCESS_CACHE';
    const CREATE_ACCOUNT = 'CREATE_ACCOUNT';
    const GET_PERSONAL_INFO_WITH_PRIVATE_DATA = 'GET_PERSONAL_INFO_WITH_PRIVATE_DATA';
    const UPDATE_PERSONAL_INFO = 'UPDATE_PERSONAL_INFO';
    const CREATE_GROUP = 'CREATE_GROUP';
    const UPDATE_GROUP = 'UPDATE_GROUP';
    const DELETE_GROUP = 'DELETE_GROUP';
    const ADD_PERSON_TO_GROUP = 'ADD_PERSON_TO_GROUP';
    const REMOVE_PERSON_FROM_GROUP = 'REMOVE_PERSON_FROM_GROUP';
    const CREATE_EVENT = 'CREATE_EVENT';
    const REGISTER_PERSON = 'REGISTER_PERSON';
    const EDIT_PERSON = 'EDIT_PERSON';
    const ADD_USER = 'ADD_USER';
    const ADMIN_EVENT = 'ADMIN_EVENT';
    const EDIT_EVENT = 'EDIT_EVENT';

    public static function isInternal(string $name)
    {
        return defined(__CLASS__ . '::' . $name);
    }

    public static function getNames()
    {
        return array_keys(self::getTranslations()); // ¯\_(ツ)_/¯
    }

    public static function getRules()
    {
        $translations = self::getTranslations();
        $defaults = self::_getDefaults();
        $types = self::_getTypes();
        
        return array_combine(array_keys($translations), array_map(function($key) use ($translations, $defaults, $types) {
            return [
                'default' => $defaults[$key],
                'type' => $types[$key],
                'title' => $translations[$key]
            ];
        }, array_keys($translations)));
    }

    protected static $_translations;
    protected static $_defaults;
    protected static $_types;
    
    public static function getTranslations()
    {
        if (empty(self::$_translations)) {
            self::$_translations = [
                self::GET_PERSON_ACCESS => _t('Get access rules for a single person'),
                self::GET_GROUP_ACCESS => _t('Get access rules for a single group'),
                self::GET_ALL_PERSON_RULES => _t('Get all access rules for a single person'),
                self::GET_ALL_GROUP_RULES => _t('Get all access rules for a single group'),
                self::ADD_RULE_FOR_PERSON => _t('Add new access rule for a person'),
                self::ADD_RULE_FOR_GROUP => _t('Add new access rule for a group'),
                self::ADD_SYSTEM_WIDE_RULE_FOR_PERSON => _t('Add new system-wide access rule for a person'),
                self::ADD_SYSTEM_WIDE_RULE_FOR_GROUP => _t('Add new system-wide access rule for a group'),
                self::UPDATE_RULE_FOR_PERSON => _t('Modify access rule value for a person'),
                self::UPDATE_RULE_FOR_GROUP => _t('Modify access rule value for a group'),
                self::DELETE_RULE_FOR_PERSON => _t('Delete access rule for a person'),
                self::DELETE_RULE_FOR_GROUP => _t('Delete access rule for a group'),
                self::CLEAR_ACCESS_CACHE => _t('Clear access rules cache for a single event'),
                self::CREATE_ACCOUNT => _t('Create new person account'),
                self::GET_PERSONAL_INFO_WITH_PRIVATE_DATA => _t('Get personal info including private data for ALL persons'),
                self::UPDATE_PERSONAL_INFO => _t('Update personal info of a single person'),
                self::CREATE_GROUP => _t('Create new group'),
                self::UPDATE_GROUP => _t('Update a group'),
                self::DELETE_GROUP => _t('Delete a group'),
                self::ADD_PERSON_TO_GROUP => _t('Add person to a group'),
                self::REMOVE_PERSON_FROM_GROUP => _t('Remove person from a group'),
                self::CREATE_EVENT => _t('Create new event'),
                self::REGISTER_PERSON => _t('Register new person in the system'),
                self::EDIT_PERSON => _t('Edit personal data (non-private)'),
                self::ADD_USER => _t('Invite person to event'),
                self::ADMIN_EVENT => _t('Use games administration features in event'),
                self::EDIT_EVENT => _t('Edit event settings'),
            ];
        }
        return self::$_translations;
    }
    
    protected static function _getDefaults()
    {
        if (empty(self::$_defaults)) {
            self::$_defaults = [
                self::IS_SUPER_ADMIN => '0',
                self::GET_PERSON_ACCESS => '0',
                self::GET_GROUP_ACCESS => '0',
                self::GET_ALL_PERSON_RULES => '0',
                self::GET_ALL_GROUP_RULES => '0',
                self::ADD_RULE_FOR_PERSON => '0',
                self::ADD_RULE_FOR_GROUP => '0',
                self::ADD_SYSTEM_WIDE_RULE_FOR_PERSON => '0',
                self::ADD_SYSTEM_WIDE_RULE_FOR_GROUP => '0',
                self::UPDATE_RULE_FOR_PERSON => '0',
                self::UPDATE_RULE_FOR_GROUP => '0',
                self::DELETE_RULE_FOR_PERSON => '0',
                self::DELETE_RULE_FOR_GROUP => '0',
                self::CLEAR_ACCESS_CACHE => '0',
                self::CREATE_ACCOUNT => '0',
                self::GET_PERSONAL_INFO_WITH_PRIVATE_DATA => '0',
                self::UPDATE_PERSONAL_INFO => '0',
                self::CREATE_GROUP => '0',
                self::UPDATE_GROUP => '0',
                self::DELETE_GROUP => '0',
                self::ADD_PERSON_TO_GROUP => '0',
                self::REMOVE_PERSON_FROM_GROUP => '0',
                self::CREATE_EVENT => '0',
                self::REGISTER_PERSON => '0',
                self::EDIT_PERSON => '0',
                self::ADD_USER => '0',
                self::ADMIN_EVENT => '0',
                self::EDIT_EVENT => '0',
            ];
        }
        return self::$_defaults;
    }
    
    protected static function _getTypes()
    {
        if (empty(self::$_types)) {
            self::$_types = [
                self::IS_SUPER_ADMIN => 'bool',
                self::GET_PERSON_ACCESS => 'bool',
                self::GET_GROUP_ACCESS => 'bool',
                self::GET_ALL_PERSON_RULES => 'bool',
                self::GET_ALL_GROUP_RULES => 'bool',
                self::ADD_RULE_FOR_PERSON => 'bool',
                self::ADD_RULE_FOR_GROUP => 'bool',
                self::ADD_SYSTEM_WIDE_RULE_FOR_PERSON => 'bool',
                self::ADD_SYSTEM_WIDE_RULE_FOR_GROUP => 'bool',
                self::UPDATE_RULE_FOR_PERSON => 'bool',
                self::UPDATE_RULE_FOR_GROUP => 'bool',
                self::DELETE_RULE_FOR_PERSON => 'bool',
                self::DELETE_RULE_FOR_GROUP => 'bool',
                self::CLEAR_ACCESS_CACHE => 'bool',
                self::CREATE_ACCOUNT => 'bool',
                self::GET_PERSONAL_INFO_WITH_PRIVATE_DATA => 'bool',
                self::UPDATE_PERSONAL_INFO => 'bool',
                self::CREATE_GROUP => 'bool',
                self::UPDATE_GROUP => 'bool',
                self::DELETE_GROUP => 'bool',
                self::ADD_PERSON_TO_GROUP => 'bool',
                self::REMOVE_PERSON_FROM_GROUP => 'bool',
                self::CREATE_EVENT => 'bool',
                self::REGISTER_PERSON => 'bool',
                self::EDIT_PERSON => 'bool',
                self::ADD_USER => 'bool',
                self::ADMIN_EVENT => 'bool',
                self::EDIT_EVENT => 'bool',
            ];
        }
        return self::$_types;
    }
}
