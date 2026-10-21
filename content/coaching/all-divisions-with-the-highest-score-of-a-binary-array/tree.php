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
            'message' => "Read the problem statement above.\nWhich splits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every i from 0 to n', 'next' => 's2'],
                ['label' => 'Only 1 … n − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 [0,0,1,0] → [2,4]; i = 4 empties the right part.\nStep back to when you skipped the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Score at each i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recount both parts', 'next' => 'wrong_b'],
                ['label' => 'Update from i − 1 by one element', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Up to 10^5 splits each recounted is about 10^10 steps.\nStep back to when you recounted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What to return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every index with the maximum', 'next' => 'success'],
                ['label' => 'The first maximum', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → [2,4], not [2].\nStep back to when you kept one index.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [2,4], [3], [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
