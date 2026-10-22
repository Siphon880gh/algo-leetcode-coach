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
            'message' => "Read the problem statement above.\nWhich indices does i measure against?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Indices with the same value', 'next' => 's2'],
                ['label' => 'All indices', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Only equal values count; Example 2 → [3,2,3] instead of [0,0,0].\nStep back to when you used every index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does i join the left sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before', 'next' => 'wrong_b'],
                ['label' => 'After computing arr[i]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Then i is counted on its own left side; Example 1 → [5,−2,−1,−2,−8] instead of [5,0,3,4,0].\nStep back to when you added it early.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [5,0,3,4,0], [0,0,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
