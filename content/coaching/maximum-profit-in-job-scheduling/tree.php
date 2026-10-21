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
            'message' => "Read the problem statement above.\nGreedy by highest profit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: DP', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One big job can block two that sum higher.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start time', 'next' => 'wrong_b'],
                ['label' => 'End time', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The DP needs all earlier-ending jobs processed.\nStep back to when you sorted by start.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compatible previous job ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '≤ this start', 'next' => 'success'],
                ['label' => '< this start', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A job may start when another ends.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). First example → 120. Second → 150. Third → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
