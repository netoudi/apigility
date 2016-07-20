<?php
return array(
    'router' => array(
        'routes' => array(
            'code-orders.rest.ptypes' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/ptypes[/:ptypes_id]',
                    'defaults' => array(
                        'controller' => 'CodeOrders\\V1\\Rest\\Ptypes\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'code-orders.rest.ptypes',
        ),
    ),
    'zf-rest' => array(
        'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => array(
            'listener' => 'CodeOrders\\V1\\Rest\\Ptypes\\PtypesResource',
            'route_name' => 'code-orders.rest.ptypes',
            'route_identifier_name' => 'ptypes_id',
            'collection_name' => 'ptypes',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'CodeOrders\\V1\\Rest\\Ptypes\\PtypesEntity',
            'collection_class' => 'CodeOrders\\V1\\Rest\\Ptypes\\PtypesCollection',
            'service_name' => 'ptypes',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => array(
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => array(
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'CodeOrders\\V1\\Rest\\Ptypes\\PtypesEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.ptypes',
                'route_identifier_name' => 'ptypes_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'CodeOrders\\V1\\Rest\\Ptypes\\PtypesCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.ptypes',
                'route_identifier_name' => 'ptypes_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-apigility' => array(
        'db-connected' => array(
            'CodeOrders\\V1\\Rest\\Ptypes\\PtypesResource' => array(
                'adapter_name' => 'DbAdapter',
                'table_name' => 'ptypes',
                'hydrator_name' => 'Zend\\Hydrator\\ArraySerializable',
                'controller_service_name' => 'CodeOrders\\V1\\Rest\\Ptypes\\Controller',
                'entity_identifier_name' => 'id',
            ),
        ),
    ),
    'zf-content-validation' => array(
        'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => array(
            'input_filter' => 'CodeOrders\\V1\\Rest\\Ptypes\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'CodeOrders\\V1\\Rest\\Ptypes\\Validator' => array(
            0 => array(
                'name' => 'name',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => '45',
                        ),
                    ),
                ),
                'description' => 'Name of payment type.',
                'error_message' => 'The name field is invalid.',
            ),
        ),
    ),
);
