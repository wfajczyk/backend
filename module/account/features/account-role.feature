Feature: Account module

  Background:
    Given I am Authenticated as "test@ergonode.com"
    And I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"

  Scenario Outline: Create role (<name>)
    When I send a POST request to "/api/v1/en_GB/roles" with body:
      """
      {
         "name": "Role_<name>(@@random_uuid@@)",
         "description": "Test role - <name>",
         "privileges": [<privilege>]
      }
      """
    Then the response status code should be 201
    And store response param "id" as "role_<name>"
    Examples:
      | name                      | privilege                                              |
      | ATTRIBUTE_CREATE          | "ATTRIBUTE_CREATE", "ATTRIBUTE_READ"                   |
      | ATTRIBUTE_DELETE          | "ATTRIBUTE_DELETE","ATTRIBUTE_READ"                    |
      | ATTRIBUTE_UPDATE          | "ATTRIBUTE_UPDATE", "ATTRIBUTE_READ"                   |
      | ATTRIBUTE_READ            | "ATTRIBUTE_READ"                                       |
      | ATTRIBUTE_GROUP_CREATE    | "ATTRIBUTE_GROUP_CREATE","ATTRIBUTE_GROUP_READ"        |
      | ATTRIBUTE_GROUP_DELETE    | "ATTRIBUTE_GROUP_DELETE", "ATTRIBUTE_GROUP_READ"       |
      | ATTRIBUTE_GROUP_READ      | "ATTRIBUTE_GROUP_READ"                                 |
      | ATTRIBUTE_GROUP_UPDATE    | "ATTRIBUTE_GROUP_UPDATE", "ATTRIBUTE_GROUP_READ"       |
      | CATEGORY_CREATE           | "CATEGORY_CREATE", "CATEGORY_READ"                     |
      | CATEGORY_DELETE           | "CATEGORY_DELETE", "CATEGORY_READ"                     |
      | CATEGORY_READ             | "CATEGORY_READ"                                        |
      | CATEGORY_UPDATE           | "CATEGORY_UPDATE", "CATEGORY_READ"                     |
      | CATEGORY_TREE_CREATE      | "CATEGORY_TREE_CREATE", "CATEGORY_TREE_READ"           |
      | CATEGORY_TREE_DELETE      | "CATEGORY_TREE_DELETE", "CATEGORY_TREE_READ"           |
      | CATEGORY_TREE_READ        | "CATEGORY_TREE_READ"                                   |
      | CATEGORY_TREE_UPDATE      | "CATEGORY_TREE_UPDATE","CATEGORY_TREE_READ"            |
      | CHANNEL_CREATE            | "CHANNEL_CREATE", "CHANNEL_READ"                       |
      | CHANNEL_DELETE            | "CHANNEL_DELETE", "CHANNEL_READ"                       |
      | CHANNEL_READ              | "CHANNEL_READ"                                         |
      | CHANNEL_UPDATE            | "CHANNEL_UPDATE", "CHANNEL_READ"                       |
      | IMPORT_CREATE             | "IMPORT_CREATE", "IMPORT_READ"                         |
      | IMPORT_DELETE             | "IMPORT_DELETE", "IMPORT_READ"                         |
      | IMPORT_READ               | "IMPORT_READ"                                          |
      | IMPORT_UPDATE             | "IMPORT_UPDATE", "IMPORT_READ"                         |
      | MULTIMEDIA_CREATE         | "MULTIMEDIA_CREATE", "MULTIMEDIA_READ"                 |
      | MULTIMEDIA_DELETE         | "MULTIMEDIA_DELETE", "MULTIMEDIA_READ"                 |
      | MULTIMEDIA_READ           | "MULTIMEDIA_READ"                                      |
      | MULTIMEDIA_UPDATE         | "MULTIMEDIA_UPDATE", "MULTIMEDIA_READ"                 |
      | PRODUCT_COLLECTION_CREATE | "PRODUCT_COLLECTION_CREATE", "PRODUCT_COLLECTION_READ" |
      | PRODUCT_COLLECTION_DELETE | "PRODUCT_COLLECTION_DELETE", "PRODUCT_COLLECTION_READ" |
      | PRODUCT_COLLECTION_READ   | "PRODUCT_COLLECTION_READ"                              |
      | PRODUCT_COLLECTION_UPDATE | "PRODUCT_COLLECTION_UPDATE", "PRODUCT_COLLECTION_READ" |
      | PRODUCT_CREATE            | "PRODUCT_CREATE", "PRODUCT_READ"                       |
      | PRODUCT_DELETE            | "PRODUCT_DELETE", "PRODUCT_READ"                       |
      | PRODUCT_READ              | "PRODUCT_READ"                                         |
      | PRODUCT_UPDATE            | "PRODUCT_UPDATE", "PRODUCT_READ"                       |
      | SEGMENT_CREATE            | "SEGMENT_CREATE", "SEGMENT_READ"                       |
      | SEGMENT_DELETE            | "SEGMENT_DELETE", "SEGMENT_READ"                       |
      | SEGMENT_READ              | "SEGMENT_READ"                                         |
      | SEGMENT_UPDATE            | "SEGMENT_UPDATE", "SEGMENT_READ"                       |
      | SETTINGS_CREATE           | "SETTINGS_CREATE", "SETTINGS_READ"                     |
      | SETTINGS_DELETE           | "SETTINGS_DELETE", "SETTINGS_READ"                     |
      | SETTINGS_READ             | "SETTINGS_READ"                                        |
      | SETTINGS_UPDATE           | "SETTINGS_UPDATE", "SETTINGS_READ"                     |
      | TEMPLATE_DESIGNER_CREATE  | "TEMPLATE_DESIGNER_CREATE", "TEMPLATE_DESIGNER_READ"   |
      | TEMPLATE_DESIGNER_DELETE  | "TEMPLATE_DESIGNER_DELETE", "TEMPLATE_DESIGNER_READ"   |
      | TEMPLATE_DESIGNER_READ    | "TEMPLATE_DESIGNER_READ"                               |
      | TEMPLATE_DESIGNER_UPDATE  | "TEMPLATE_DESIGNER_UPDATE", "TEMPLATE_DESIGNER_READ"   |
      | USER_CREATE               | "USER_CREATE", "USER_READ"                             |
      | USER_DELETE               | "USER_DELETE", "USER_READ"                             |
      | USER_READ                 | "USER_READ"                                            |
      | USER_UPDATE               | "USER_UPDATE", "USER_READ"                             |
      | USER_ROLE_CREATE          | "USER_ROLE_CREATE", "USER_ROLE_READ"                   |
      | USER_ROLE_DELETE          | "USER_ROLE_DELETE", "USER_ROLE_READ"                   |
      | USER_ROLE_READ            | "USER_ROLE_READ"                                       |
      | USER_ROLE_UPDATE          | "USER_ROLE_UPDATE", "USER_ROLE_READ"                   |
      | WORKFLOW_CREATE           | "WORKFLOW_CREATE", "WORKFLOW_READ"                     |
      | WORKFLOW_DELETE           | "WORKFLOW_DELETE", "WORKFLOW_READ"                     |
      | WORKFLOW_READ             | "WORKFLOW_READ"                                        |
      | WORKFLOW_UPDATE           | "WORKFLOW_UPDATE", "WORKFLOW_READ"                     |

  Scenario Outline: Create user (<name>)
    When I send a POST request to "/api/v1/en_GB/accounts" with body:
      """
      {
          "email": "<user_email>",
          "firstName": "<firstName>",
          "lastName": "<lastName>",
          "language": "en_GB",
          "password": 12345678,
          "passwordRepeat": 12345678,
          "roleId": "@role_<name>@",
          "isActive": true
      }
      """
    Then the response status code should be 201
    Examples:
      | name                      | firstName          | lastName        | user_email                             |
      | ATTRIBUTE_CREATE          | ATTRIBUTE          | CREATE          | attribute_create@ergonode.com          |
      | ATTRIBUTE_DELETE          | ATTRIBUTE          | DELETE          | attribute_delete@ergonode.com          |
      | ATTRIBUTE_UPDATE          | ATTRIBUTE          | UPDATE          | attribute_update@ergonode.com          |
      | ATTRIBUTE_READ            | ATTRIBUTE          | READ            | attribute_read@ergonode.com            |
      | ATTRIBUTE_GROUP_CREATE    | ATTRIBUTE_GROUP    | CREATE          | attribute_group_create@ergonode.com    |
      | ATTRIBUTE_GROUP_DELETE    | ATTRIBUTE_GROUP    | DELETE          | attribute_group_delete@ergonode.com    |
      | ATTRIBUTE_GROUP_READ      | ATTRIBUTE_GROUP    | READ            | attribute_group_read@ergonode.com      |
      | ATTRIBUTE_GROUP_UPDATE    | ATTRIBUTE_GROUP    | UPDATE          | attribute_group_update@ergonode.com    |
      | CATEGORY_CREATE           | CATEGORY           | CREATE          | category_create@ergonode.com           |
      | CATEGORY_DELETE           | CATEGORY           | DELETE          | category_delete@ergonode.com           |
      | CATEGORY_READ             | CATEGORY           | READ            | category_read@ergonode.com             |
      | CATEGORY_UPDATE           | CATEGORY           | UPDATE          | category_update@ergonode.com           |
      | CATEGORY_TREE_CREATE      | CATEGORY_TREE      | CREATE          | category_tree_create@ergonode.com      |
      | CATEGORY_TREE_DELETE      | CATEGORY_TREE      | DELETE          | category_tree_delete@ergonode.com      |
      | CATEGORY_TREE_READ        | CATEGORY_TREE      | READ            | category_tree_read@ergonode.com        |
      | CATEGORY_TREE_UPDATE      | CATEGORY_TREE      | UPDATE          | category_tree_update@ergonode.com      |
      | CHANNEL_CREATE            | CHANNEL            | CREATE          | channel_create@ergonode.com            |
      | CHANNEL_DELETE            | CHANNEL            | DELETE          | channel_delete@ergonode.com            |
      | CHANNEL_READ              | CHANNEL            | READ            | channel_read@ergonode.com              |
      | CHANNEL_UPDATE            | CHANNEL            | UPDATE          | channel_update@ergonode.com            |
      | IMPORT_CREATE             | IMPORT             | CREATE          | import_create@ergonode.com             |
      | IMPORT_DELETE             | IMPORT             | DELETE          | import_delete@ergonode.com             |
      | IMPORT_READ               | IMPORT             | READ            | import_read@ergonode.com               |
      | IMPORT_UPDATE             | IMPORT             | UPDATE          | import_update@ergonode.com             |
      | MULTIMEDIA_CREATE         | MULTIMEDIA         | CREATE          | multimedia_create@ergonode.com         |
      | MULTIMEDIA_DELETE         | MULTIMEDIA         | DELETE          | multimedia_delete@ergonode.com         |
      | MULTIMEDIA_READ           | MULTIMEDIA         | READ            | multimedia_read@ergonode.com           |
      | MULTIMEDIA_UPDATE         | MULTIMEDIA         | UPDATE          | multimedia_update@ergonode.com         |
      | PRODUCT_COLLECTION_CREATE | PRODUCT_COLLECTION | CREATE          | product_collection_create@ergonode.com |
      | PRODUCT_COLLECTION_DELETE | PRODUCT_COLLECTION | DELETE          | product_collection_delete@ergonode.com |
      | PRODUCT_COLLECTION_READ   | PRODUCT_COLLECTION | READ            | product_collection_read@ergonode.com   |
      | PRODUCT_COLLECTION_UPDATE | PRODUCT_COLLECTION | UPDATE          | product_collection_update@ergonode.com |
      | PRODUCT_CREATE            | PRODUCT            | CREATE          | product_create@ergonode.com            |
      | PRODUCT_DELETE            | PRODUCT            | DELETE          | product_delete@ergonode.com            |
      | PRODUCT_READ              | PRODUCT            | READ            | product_read@ergonode.com              |
      | PRODUCT_UPDATE            | PRODUCT            | UPDATE          | product_update@ergonode.com            |
      | SEGMENT_CREATE            | SEGMENT            | CREATE          | segment_create@ergonode.com            |
      | SEGMENT_DELETE            | SEGMENT            | DELETE          | segment_delete@ergonode.com            |
      | SEGMENT_READ              | SEGMENT            | READ            | segment_read@ergonode.com              |
      | SEGMENT_UPDATE            | SEGMENT            | UPDATE          | segment_update@ergonode.com            |
      | SETTINGS_CREATE           | SETTINGS           | CREATE          | settings_create@ergonode.com           |
      | SETTINGS_DELETE           | SETTINGS           | DELETE          | settings_delete@ergonode.com           |
      | SETTINGS_READ             | SETTINGS           | READ            | settings_read@ergonode.com             |
      | SETTINGS_UPDATE           | SETTINGS           | UPDATE          | settings_update@ergonode.com           |
      | TEMPLATE_DESIGNER_CREATE  | TEMPLATE_DESIGNER  | DESIGNER_CREATE | template_designer_create@ergonode.com  |
      | TEMPLATE_DESIGNER_DELETE  | TEMPLATE_DESIGNER  | DESIGNER_DELETE | template_designer_delete@ergonode.com  |
      | TEMPLATE_DESIGNER_READ    | TEMPLATE_DESIGNER  | DESIGNER_READ   | template_designer_read@ergonode.com    |
      | TEMPLATE_DESIGNER_UPDATE  | TEMPLATE_DESIGNER  | DESIGNER_UPDATE | template_designer_update@ergonode.com  |
      | USER_CREATE               | USER               | CREATE          | user_create@ergonode.com               |
      | USER_DELETE               | USER               | DELETE          | user_delete@ergonode.com               |
      | USER_READ                 | USER               | READ            | user_read@ergonode.com                 |
      | USER_UPDATE               | USER               | UPDATE          | user_update@ergonode.com               |
      | USER_ROLE_CREATE          | USER_ROLE          | CREATE          | user_role_create@ergonode.com          |
      | USER_ROLE_DELETE          | USER_ROLE          | DELETE          | user_role_delete@ergonode.com          |
      | USER_ROLE_READ            | USER_ROLE          | READ            | user_role_read@ergonode.com            |
      | USER_ROLE_UPDATE          | USER_ROLE          | UPDATE          | user_role_update@ergonode.com          |
      | WORKFLOW_CREATE           | WORKFLOW           | CREATE          | workflow_create@ergonode.com           |
      | WORKFLOW_DELETE           | WORKFLOW           | DELETE          | workflow_delete@ergonode.com           |
      | WORKFLOW_READ             | WORKFLOW           | READ            | workflow_read@ergonode.com             |
      | WORKFLOW_UPDATE           | WORKFLOW           | UPDATE          | workflow_update@ergonode.com           |
