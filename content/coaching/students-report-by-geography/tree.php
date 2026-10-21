<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: A student table gives each student's name and continent, with three continents in the data. Pivot it so each continent becomes a column of its students' names in alphabetical order, one name per row, with nulls where a continent runs out. The statement guarantees which continent has the most students. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich output row does each name go on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its alphabetical position inside its continent: ROW_NUMBER() OVER (PARTITION BY continent ORDER BY name)', 'next' => 's2'],
                ['label' => 'Its position in the whole table', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The first name of every continent must share row 1.\nStep back to when you numbered the whole table.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you pivot?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'GROUP BY name', 'next' => 'wrong_b'],
                ['label' => 'GROUP BY rn with MAX(CASE WHEN continent = … THEN name END) per column', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every student would get a row of their own.\nStep back to when you grouped by name.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do the names get sorted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Inside the window, before the pivot', 'next' => 'success'],
                ['label' => 'After the pivot, with ORDER BY on the columns', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The pivot already decided which names share a row, so sorting afterward cannot fix the order inside each column.\nStep back to when you sorted at the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. ROW_NUMBER per continent, then GROUP BY rn with MAX(CASE …): O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
