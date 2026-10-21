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
            'message' => "Read the problem statement above.\nScan divisors up to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '√x', 'next' => 's2'],
                ['label' => 'x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each divisor below the root pairs with one above.\nStep back to when you scanned to x.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Perfect squares?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count it twice', 'next' => 'wrong_b'],
                ['label' => 'Count the root once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A set avoids double counting.\nStep back to when you counted it twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "More than four found?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop early', 'next' => 'success'],
                ['label' => 'Keep scanning', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The number already fails.\nStep back to when you kept scanning.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · √max). [21,4,7] → 32. [21,21] → 64. [1,2,3,4,5] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
