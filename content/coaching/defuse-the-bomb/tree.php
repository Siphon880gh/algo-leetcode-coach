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
            'message' => "Read the problem statement above.\nk = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All zeros', 'next' => 's2'],
                ['label' => 'Copy code', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The rule replaces every value with 0.\nStep back to when you copied.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Index wrap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clamp at the ends', 'next' => 'wrong_b'],
                ['label' => 'Use (i + j) mod n', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The code is circular.\nStep back to when you clamped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Write results?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Into a new array', 'next' => 'success'],
                ['label' => 'In place', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Later sums need the original values.\nStep back to when you overwrote.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · |k|). Examples → [12,10,16,13], [0,0,0,0], [12,5,6,13].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
