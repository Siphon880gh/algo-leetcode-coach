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
            'message' => "Read the problem statement above.\nSort order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Descending', 'next' => 's2'],
                ['label' => 'Ascending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Best dishes should be considered first and cooked last.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x < 0', 'next' => 'wrong_b'],
                ['label' => 'prefix + x ≤ 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A small negative can still raise the total.\nStep back to when you stopped at the first negative.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Adding a dish adds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The new prefix sum', 'next' => 'success'],
                ['label' => 'x · position', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every chosen dish shifts one slot later.\nStep back to when you used the position.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [-1,-8,0,5,-9] → 14. [4,3,2] → 20. [-1,-4,-5] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
