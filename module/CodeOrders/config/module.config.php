<?php
return array(
    'router' => array(
        'routes' => array(
            'code-orders.rest.users' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/users[/:users_id]',
                    'defaults' => array(
                        'controller' => 'CodeOrders\\V1\\Rest\\Users\\Controller',
                    ),
                ),
            ),
            'code-orders.rest.products' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/products[/:products_id]',
                    'defaults' => array(
                        'controller' => 'CodeOrders\\V1\\Rest\\Products\\Controller',
                    ),
                ),
            ),
            'code-orders.rest.orders' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/orders[/:orders_id]',
                    'defaults' => array(
                        'controller' => 'CodeOrders\\V1\\Rest\\Orders\\Controller',
                    ),
                ),
            ),
            'code-orders.rest.clients' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/clients[/:clients_id]',
                    'defaults' => array(
                        'controller' => 'CodeOrders\\V1\\Rest\\Clients\\Controller',
                    ),
                ),
            ),
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
            1 => 'code-orders.rest.users',
            3 => 'code-orders.rest.products',
            4 => 'code-orders.rest.orders',
            5 => 'code-orders.rest.clients',
            0 => 'code-orders.rest.ptypes',
        ),
    ),
    'zf-rest' => array(
        'CodeOrders\\V1\\Rest\\Users\\Controller' => array(
            'listener' => 'CodeOrders\\V1\\Rest\\Users\\UsersResource',
            'route_name' => 'code-orders.rest.users',
            'route_identifier_name' => 'users_id',
            'collection_name' => 'users',
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
            'page_size' => '25',
            'page_size_param' => null,
            'entity_class' => 'CodeOrders\\V1\\Rest\\Users\\UsersEntity',
            'collection_class' => 'CodeOrders\\V1\\Rest\\Users\\UsersCollection',
            'service_name' => 'users',
        ),
        'CodeOrders\\V1\\Rest\\Products\\Controller' => array(
            'listener' => 'CodeOrders\\V1\\Rest\\Products\\ProductsResource',
            'route_name' => 'code-orders.rest.products',
            'route_identifier_name' => 'products_id',
            'collection_name' => 'products',
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
            'entity_class' => 'CodeOrders\\V1\\Rest\\Products\\ProductsEntity',
            'collection_class' => 'CodeOrders\\V1\\Rest\\Products\\ProductsCollection',
            'service_name' => 'products',
        ),
        'CodeOrders\\V1\\Rest\\Orders\\Controller' => array(
            'listener' => 'CodeOrders\\V1\\Rest\\Orders\\OrdersResource',
            'route_name' => 'code-orders.rest.orders',
            'route_identifier_name' => 'orders_id',
            'collection_name' => 'orders',
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
            'entity_class' => 'CodeOrders\\V1\\Rest\\Orders\\OrdersEntity',
            'collection_class' => 'CodeOrders\\V1\\Rest\\Orders\\OrdersCollection',
            'service_name' => 'orders',
        ),
        'CodeOrders\\V1\\Rest\\Clients\\Controller' => array(
            'listener' => 'CodeOrders\\V1\\Rest\\Clients\\ClientsResource',
            'route_name' => 'code-orders.rest.clients',
            'route_identifier_name' => 'clients_id',
            'collection_name' => 'clients',
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
            'entity_class' => 'CodeOrders\\V1\\Rest\\Clients\\ClientsEntity',
            'collection_class' => 'CodeOrders\\V1\\Rest\\Clients\\ClientsCollection',
            'service_name' => 'clients',
        ),
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
            'CodeOrders\\V1\\Rest\\Users\\Controller' => 'HalJson',
            'CodeOrders\\V1\\Rest\\Products\\Controller' => 'HalJson',
            'CodeOrders\\V1\\Rest\\Orders\\Controller' => 'HalJson',
            'CodeOrders\\V1\\Rest\\Clients\\Controller' => 'HalJson',
            'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'CodeOrders\\V1\\Rest\\Users\\Controller' => array(
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'CodeOrders\\V1\\Rest\\Products\\Controller' => array(
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'CodeOrders\\V1\\Rest\\Orders\\Controller' => array(
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'CodeOrders\\V1\\Rest\\Clients\\Controller' => array(
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => array(
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'CodeOrders\\V1\\Rest\\Users\\Controller' => array(
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/json',
                2 => 'application/x-www-form-urlencoded',
            ),
            'CodeOrders\\V1\\Rest\\Products\\Controller' => array(
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/json',
                2 => 'application/x-www-form-urlencoded',
            ),
            'CodeOrders\\V1\\Rest\\Orders\\Controller' => array(
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/json',
                2 => 'application/x-www-form-urlencoded',
            ),
            'CodeOrders\\V1\\Rest\\Clients\\Controller' => array(
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/json',
                2 => 'application/x-www-form-urlencoded',
            ),
            'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => array(
                0 => 'application/vnd.code-orders.v1+json',
                1 => 'application/json',
                2 => 'application/x-www-form-urlencoded',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'CodeOrders\\V1\\Rest\\Users\\UsersEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.users',
                'route_identifier_name' => 'users_id',
                'hydrator' => 'Zend\\Hydrator\\ClassMethods',
            ),
            'CodeOrders\\V1\\Rest\\Users\\UsersCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.users',
                'route_identifier_name' => 'users_id',
                'is_collection' => true,
            ),
            'CodeOrders\\V1\\Rest\\Products\\ProductsEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.products',
                'route_identifier_name' => 'products_id',
                'hydrator' => 'Zend\\Hydrator\\ClassMethods',
            ),
            'CodeOrders\\V1\\Rest\\Products\\ProductsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.products',
                'route_identifier_name' => 'products_id',
                'is_collection' => true,
            ),
            'CodeOrders\\V1\\Rest\\Orders\\OrdersEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.orders',
                'route_identifier_name' => 'orders_id',
                'hydrator' => 'Zend\\Hydrator\\ClassMethods',
            ),
            'CodeOrders\\V1\\Rest\\Orders\\OrdersCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.orders',
                'route_identifier_name' => 'orders_id',
                'is_collection' => true,
            ),
            'CodeOrders\\V1\\Rest\\Clients\\ClientsEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.clients',
                'route_identifier_name' => 'clients_id',
                'hydrator' => 'Zend\\Hydrator\\ClassMethods',
            ),
            'CodeOrders\\V1\\Rest\\Clients\\ClientsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.clients',
                'route_identifier_name' => 'clients_id',
                'is_collection' => true,
            ),
            'CodeOrders\\V1\\Rest\\Ptypes\\PtypesEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'code-orders.rest.ptypes',
                'route_identifier_name' => 'ptypes_id',
                'hydrator' => 'Zend\\Hydrator\\ClassMethods',
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
        'db-connected' => array(),
    ),
    'zf-content-validation' => array(
        'CodeOrders\\V1\\Rest\\Users\\Controller' => array(
            'input_filter' => 'CodeOrders\\V1\\Rest\\Users\\Validator',
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
        'CodeOrders\\V1\\Rest\\Users\\Validator' => array(),
        'CodeOrders\\V1\\Rest\\Clients\\Validator' => array(
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
                            'max' => '60',
                        ),
                    ),
                ),
            ),
            1 => array(
                'name' => 'document',
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
            ),
            2 => array(
                'name' => 'address',
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
                            'max' => '200',
                        ),
                    ),
                ),
            ),
            3 => array(
                'name' => 'zipcode',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            4 => array(
                'name' => 'city',
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
                            'max' => '60',
                        ),
                    ),
                ),
            ),
            5 => array(
                'name' => 'state',
                'required' => true,
                'filters' => array(),
                'validators' => array(),
            ),
            6 => array(
                'name' => 'responsible',
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
                            'max' => '60',
                        ),
                    ),
                ),
            ),
            7 => array(
                'name' => 'email',
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
                            'max' => '100',
                        ),
                    ),
                ),
            ),
            8 => array(
                'name' => 'phone',
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
                            'max' => '15',
                        ),
                    ),
                ),
            ),
            9 => array(
                'name' => 'obs',
                'required' => false,
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
                            'max' => '65535',
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'CodeOrders\\V1\\Rest\\Auth\\AuthService' => 'CodeOrders\\V1\\Rest\\Auth\\AuthServiceFactory',
            'CodeOrders\\V1\\Rest\\Users\\UsersResource' => 'CodeOrders\\V1\\Rest\\Users\\UsersResourceFactory',
            'CodeOrders\\V1\\Rest\\Users\\UsersRepository' => 'CodeOrders\\V1\\Rest\\Users\\UsersRepositoryFactory',
            'CodeOrders\\V1\\Rest\\Products\\ProductsResource' => 'CodeOrders\\V1\\Rest\\Products\\ProductsResourceFactory',
            'CodeOrders\\V1\\Rest\\Products\\ProductsRepository' => 'CodeOrders\\V1\\Rest\\Products\\ProductsRepositoryFactory',
            'CodeOrders\\V1\\Rest\\Orders\\OrdersResource' => 'CodeOrders\\V1\\Rest\\Orders\\OrdersResourceFactory',
            'CodeOrders\\V1\\Rest\\Orders\\OrdersRepository' => 'CodeOrders\\V1\\Rest\\Orders\\OrdersRepositoryFactory',
            'CodeOrders\\V1\\Rest\\Orders\\OrdersItemsTableGateway' => 'CodeOrders\\V1\\Rest\\Orders\\OrdersItemsTableGatewayFactory',
            'CodeOrders\\V1\\Rest\\Orders\\OrdersService' => 'CodeOrders\\V1\\Rest\\Orders\\OrdersServiceFactory',
            'CodeOrders\\V1\\Rest\\Clients\\ClientsResource' => 'CodeOrders\\V1\\Rest\\Clients\\ClientsResourceFactory',
            'CodeOrders\\V1\\Rest\\Clients\\ClientsRepository' => 'CodeOrders\\V1\\Rest\\Clients\\ClientsRepositoryFactory',
            'CodeOrders\\V1\\Rest\\Ptypes\\PtypesResource' => 'CodeOrders\\V1\\Rest\\Ptypes\\PtypesResourceFactory',
            'CodeOrders\\V1\\Rest\\Ptypes\\PtypesRepository' => 'CodeOrders\\V1\\Rest\\Ptypes\\PtypesRepositoryFactory',
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'CodeOrders\\V1\\Rest\\Users\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ),
            ),
            'CodeOrders\\V1\\Rest\\Clients\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ),
            ),
            'CodeOrders\\V1\\Rest\\Orders\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ),
            ),
            'CodeOrders\\V1\\Rest\\Products\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ),
            ),
            'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ),
            ),
        ),
    ),
);
