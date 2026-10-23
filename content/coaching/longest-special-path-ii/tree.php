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
            'message' => "Read the problem statement above.\nWindow start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After the second largest repeat start', 'next' => 's2'],
                ['label' => 'After the largest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [8, 3] instead of [9, 3].\nStep back to when you allowed no repeat.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ties on length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Most nodes', 'next' => 'wrong_b'],
                ['label' => 'Fewest nodes', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [9, 4] instead of [9, 3].\nStep back to when you kept the longer path.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [9, 3], [5, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
