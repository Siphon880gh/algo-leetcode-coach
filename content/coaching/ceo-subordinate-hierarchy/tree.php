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
            'message' => "Problem: A table lists employees with their manager and salary; the CEO has no manager. For every employee under the CEO, directly or indirectly, report how many levels below the CEO they are and how their salary compares with the CEO’s, as the statement defines. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nReach indirect reports?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recursive CTE', 'next' => 's2'],
                ['label' => 'One join on the CEO', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check that returns only 2 and 3.\nStep back to when you joined once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "CEO’s level in the seed row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => '0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Under the guide’s assumption employee 2 → level 2 instead of 1.\nStep back to when you seeded 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. The guide’s check → (2, 1, −80), (3, 1, −100), (4, 2, −110), (5, 3, −140).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
