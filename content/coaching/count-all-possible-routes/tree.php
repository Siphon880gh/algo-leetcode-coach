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
            'message' => "Read the problem statement above.\nStop on reaching finish?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count it and keep going', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Routes may pass through finish and return.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "State?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(city, path so far)', 'next' => 'wrong_b'],
                ['label' => '(city, fuel left)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The future depends only on city and fuel.\nStep back to when you stored paths.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n² · fuel)', 'next' => 'success'],
                ['label' => 'Exponential', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Memoisation leaves n · fuel states, each looping n cities.\nStep back to when you estimated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example 1 → 4. Example 2 → 5. Example 3 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
