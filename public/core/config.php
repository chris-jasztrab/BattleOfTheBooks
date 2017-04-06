<?php

namespace AjaxLiveSearch\core;

if (count(get_included_files()) === 1) {
    exit('Direct access not permitted.');
}

/**
 * Class Config
 */
class Config
{
    /**
     * @var array
     */
    private static $configs = [
        // ***** Database ***** //
        'dataSources'           => [
            'ls_query' => [
                'host'               => 'localhost',
                'database'           => 'battleofthebooks',
                'username'           => 'root',
                'pass'               => 'MPL@dm1n',
                'table'              => 'questions_ajax',
                // specify the name of search columns
                'searchColumns'      => ['author_first_name'],


                // specify order by column. This is optional
                'orderBy'            => '',
                // specify order direction e.g. ASC or DESC. This is optional
                'orderDirection'     => '',
                /**
                 * filter the result by entering table column names
                 * to get all the columns, remove filterResult or make it an empty array
                 */
                'filterResult'       => ['author_first_name', 'author_last_name'],
                /**
                 * specify search query comparison operator.
                 * possible values for comparison operators are: 'LIKE' and '='. this is required
                 */
                'comparisonOperator' => 'LIKE',
                /**
                 * searchPattern is used to specify how the query is searched.
                 * possible values are: 'q', '*q', 'q*', '*q*'. this is required
                 */
                'searchPattern'      => 'q*',
                // specify search query case sensitivity
                'caseSensitive'      => false,
                // to limit the maximum number of result uncomment this:
                'maxResult' => 5,
                // to display column header, change 'active' value to true
                'displayHeader' => [
                    'active' => true,
                    'mapper' => [
                        'author_first_name' => 'First Name',  'author_last_name' => 'Last Name',
//                        'your_second_column' => 'Your Desired Second Title'
                    ]
                ],
                'type'               => 'mysql',
            ],
            'ls_query_2' => [
              'host'               => 'localhost',
              'database'           => 'battleofthebooks',
              'username'           => 'root',
              'pass'               => 'MPL@dm1n',
              'table'              => 'questions_ajax',
              // specify the name of search columns
              'searchColumns'      => ['author_last_name'],
                'orderBy'            => '',
                'orderDirection'     => '',
                'filterResult'       => ['author_first_name', 'author_last_name'],
                'comparisonOperator' => 'LIKE',
                'searchPattern'      => 'q*',
                'caseSensitive'      => false,
                'maxResult' => 5,
                'displayHeader' => [
                    'active' => true,
                    'mapper' => [
                        'author_first_name' => 'First Name',  'author_last_name' => 'Last Name',
//                        'your_second_column' => 'Your Desired Second Title'
                    ]
                ],
                'type'               => 'mysql',
            ],

            'mainMongo' => [
                'server'       => 'your_server',
                'database'     => 'local',
                'collection'   => 'your_collection',
                'filterResult' => [],
                'searchField'  => 'your_collection_search_field',
                'type'         => 'mongo',
            ]
        ],
        // ***** Form ***** //
        'antiBot'               => "ajaxlivesearch_guard",
        // Assigning more than 3 seconds is not recommended
        'searchStartTimeOffset' => 2,
        // ***** Search Input ***** //
        'maxInputLength'        => 20,
        // ***** Template ***** //
        'template' => 'default.php',
    ];

    /**
     *
     * @param  $key
     * @throws \Exception
     * @return mixed
     */
    public static function getConfig($key)
    {
        if (!array_key_exists($key, static::$configs)) {
            throw new \Exception("Key: {$key} does not exist in the configs");
        }

        return static::$configs[$key];
    }
}
