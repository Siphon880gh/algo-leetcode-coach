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
            'message' => "Read the problem statement above.\nWhich elements can pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any two equal values', 'next' => 's2'],
                ['label' => 'Only adjacent equal values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 1 pair instead of 3.\nStep back to when you paired neighbours only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairs from a value seen c times?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c / 2 rounded up', 'next' => 'wrong_b'],
                ['label' => 'c / 2 rounded down', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A single leftover cannot pair; Example 1 → 4 pairs instead of 3.\nStep back to when you rounded up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Leftover count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − 2 · pairs', 'next' => 'success'],
                ['label' => 'n − pairs', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each pair removes two numbers; Example 1 → 4 instead of 1.\nStep back to when you subtracted pairs once.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [3,1], [1,0], [0,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
