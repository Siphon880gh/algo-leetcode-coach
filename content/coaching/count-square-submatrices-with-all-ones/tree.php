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
            'message' => "Read the problem statement above.\nCombine neighbours with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min', 'next' => 's2'],
                ['label' => 'max', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The smallest neighbour limits the square.\nStep back to when you took the max.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A cell with 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Copy a neighbour', 'next' => 'wrong_b'],
                ['label' => 'dp = 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. No square ends on a 0.\nStep back to when you copied.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum of all dp', 'next' => 'success'],
                ['label' => 'Max dp', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Max gives the largest side, not the count.\nStep back to when you took the max.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). First example → 15. Second → 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
