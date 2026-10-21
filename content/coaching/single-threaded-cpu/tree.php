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
            'message' => "Read the problem statement above.\nHeap key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(processing time, index)', 'next' => 's2'],
                ['label' => 'Enqueue time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The CPU picks the shortest available task.\nStep back to when you keyed by arrival.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "CPU idle and heap empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Advance one unit at a time', 'next' => 'wrong_b'],
                ['label' => 'Jump time to the next arrival', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Times reach 10^9.\nStep back to when you ticked one unit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Time variable size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Total processing can reach about 10^14.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [0,2,3,1], [4,3,2,0,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
