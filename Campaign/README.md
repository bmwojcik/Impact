# Impact_Campaign module

<font color='red'>**The following example is a complete README for a module Magento_Default:** </font>

# Impact_Campaign module

The Impact_Campaign module enables you to add the Campaign Labels to existing store. For my personal notes

Configuration is available on `Content > Impact > Campaign Management`
![img.png](img.png)

We can add and configure multiple campaigns - details and #TODO are described in `Personal Notes`

![img_1.png](img_1.png)
![img_2.png](img_2.png)

Module enables customized label on product preview in Product Page and Category Listing
![img_3.png](img_3.png)
![img_4.png](img_4.png)

## Installation details

Enable this module with `bin/magento module:enable Impact_Campaign && bin/magento s:up` commands.

## Test

Test is enabled with `vendor/phpunit/phpunit/phpunit -c dev/tests/unit/phpunit.xml.dist app/code/Impact/Campaign/Test/Unit/` command.
![img_6.png](img_6.png)
### Layouts

The module introduces layout handles in the `view/adminhtml/layout` directory.

Layouts introduced:
    - `campaign_campaign_edit`
    - `campaign_campaign_index`
    - `campaign_campaign_new`

For more information about a layout in Magento 2, see the [Layout documentation](https://devdocs.magento.com/guides/v2.4/frontend-dev-guide/layouts/layout-overview.html).

### UI components

Introduced ui_components
    - `campaign_form`
    - `camapign_listing`

For information about a UI component in Magento 2, see [Overview of UI components](https://devdocs.magento.com/guides/v2.4/ui_comp_guide/bk-ui_comps.html).

### Database

Table `impact_campaign` created with fields:
- `campaign_id`
- `status`
- `title`
- `description`
- `url`
- `products`


For information about a UI component in Magento 2, see [Overview of UI components](https://devdocs.magento.com/guides/v2.4/ui_comp_guide/bk-ui_comps.html).




