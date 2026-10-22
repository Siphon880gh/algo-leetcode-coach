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
            'message' => "Read the problem statement above.\nTie on frequency?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Larger value first', 'next' => 's2'],
                ['label' => 'Smaller value first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [6, 7, 12].\nStep back to when you preferred smaller values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fewer than x distinct values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Record 0', 'next' => 'wrong_b'],
                ['label' => 'Sum the whole window', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 1, 2], k = 2, x = 2 → [0, 3] instead of [2, 3].\nStep back to when you recorded 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k log k). Examples → [6, 10, 12], [11, 15, 15, 15, 12].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
