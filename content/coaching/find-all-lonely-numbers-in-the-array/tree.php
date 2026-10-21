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
            'message' => "Read the problem statement above.\nWhat to store?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A count of each value', 'next' => 's2'],
                ['label' => 'A set of values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A set forgets duplicates, so 3 in Example 2 would look lonely.\nStep back to when you used a set.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which neighbours?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only x − 1 absent', 'next' => 'wrong_b'],
                ['label' => 'Both x − 1 and x + 1 absent', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In Example 1, 5 has no 4 but 6 is present, so it is not lonely.\nStep back to when you checked one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How to check a neighbour?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Look it up in the map', 'next' => 'success'],
                ['label' => 'Scan the array for it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Up to 10^5 elements make a scan per element about 10^10 steps.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [10,8], [1,5] (any order).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
