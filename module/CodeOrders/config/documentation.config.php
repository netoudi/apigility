<?php
return array(
    'CodeOrders\\V1\\Rest\\Ptypes\\Controller' => array(
        'description' => 'Handels payment types',
        'collection' => array(
            'description' => 'Collection of PaymentTypes',
            'GET' => array(
                'description' => 'List all payment types',
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes"
       },
       "first": {
           "href": "/ptypes?page={page}"
       },
       "prev": {
           "href": "/ptypes?page={page}"
       },
       "next": {
           "href": "/ptypes?page={page}"
       },
       "last": {
           "href": "/ptypes?page={page}"
       }
   }
   "_embedded": {
       "ptypes": [
           {
               "_links": {
                   "self": {
                       "href": "/ptypes[/:ptypes_id]"
                   }
               }
              "name": "Name of payment type."
           }
       ]
   }
}',
            ),
            'POST' => array(
                'description' => 'Create a new payment type',
                'request' => '{
   "name": "Name of payment type."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes[/:ptypes_id]"
       }
   }
   "name": "Name of payment type."
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'description' => 'Returns a payment type',
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes[/:ptypes_id]"
       }
   }
   "name": "Name of payment type."
}',
            ),
            'description' => 'PaymentType Enttity',
            'PATCH' => array(
                'description' => 'Update partially a payment type',
                'request' => '{
   "name": "Name of payment type."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes[/:ptypes_id]"
       }
   }
   "name": "Name of payment type."
}',
            ),
            'PUT' => array(
                'description' => 'Update a payment type',
                'request' => '{
   "name": "Name of payment type."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes[/:ptypes_id]"
       }
   }
   "name": "Name of payment type."
}',
            ),
            'DELETE' => array(
                'description' => 'Delete a payment type',
                'request' => '{
   "name": "Name of payment type."
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/ptypes[/:ptypes_id]"
       }
   }
   "name": "Name of payment type."
}',
            ),
        ),
    ),
);
