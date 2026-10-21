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
            'message' => "Read the problem statement above.\nWhy can you binary search on L?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A duplicate of length L contains one of length L − 1', 'next' => 's2'],
                ['label' => 'Longer substrings are rarer', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You need monotonicity, not frequency.\nStep back to when you said rarer.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you test one L in linear time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare every pair of windows', 'next' => 'wrong_b'],
                ['label' => 'Rolling hash over every window of length L', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is quadratic per test.\nStep back to when you compared pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two windows share a hash. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare the substrings to rule out a collision', 'next' => 'success'],
                ['label' => 'Accept it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Different strings can share a hash.\nStep back to when you accepted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n) expected. \"banana\" → \"ana\". \"abcd\" → \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
