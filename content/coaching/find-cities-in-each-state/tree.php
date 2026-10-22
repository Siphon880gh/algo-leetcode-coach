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
            'message' => "Problem: A table lists cities and the state each is in. For each state, report its cities as one list in the format the statement asks. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGroup by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'State only', 'next' => 's2'],
                ['label' => 'State and city', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That returns one row per city.\nStep back to when you grouped by city too.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order inside the list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whatever order the rows arrive', 'next' => 'wrong_b'],
                ['label' => 'Sorted by city', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the guide’s check Texas → Houston, Austin, Dallas instead of Austin, Dallas, Houston.\nStep back to when you left it unordered.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. The guide’s check → Ohio: Akron, Dayton; Texas: Austin, Dallas, Houston.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
