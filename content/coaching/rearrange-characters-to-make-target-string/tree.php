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
            'message' => "Read the problem statement above.\nCopies a letter allows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count in s / count in target', 'next' => 's2'],
                ['label' => 'count in s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 needs five a per copy → 5 instead of 1.\nStep back to when you ignored repeats in target.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Take the minimum over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every letter of s', 'next' => 'wrong_b'],
                ['label' => 'Letters of target', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 has a single i, which target never uses → 1 instead of 2.\nStep back to when you included every letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Division?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Round down', 'next' => 'success'],
                ['label' => 'Exact', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. s = aaa, target = aa → 1.5 instead of 1.\nStep back to when you used exact division.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s| + |target|). Examples → 2, 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
