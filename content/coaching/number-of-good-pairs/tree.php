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
            'message' => "Read the problem statement above.\nOrder of update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add, then increment', 'next' => 's2'],
                ['label' => 'Increment, then add', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That pairs an element with itself.\nStep back to when you incremented first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count (i, j) and (j, i)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both', 'next' => 'wrong_b'],
                ['label' => 'Only i < j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,1,1,1] → 6, not 12.\nStep back to when you counted both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Formula alternative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ c(c − 1)/2', 'next' => 'success'],
                ['label' => 'Σ c²', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Pairs are combinations.\nStep back to when you squared.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,1,1,3] → 4. [1,1,1,1] → 6. [1,2,3] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
