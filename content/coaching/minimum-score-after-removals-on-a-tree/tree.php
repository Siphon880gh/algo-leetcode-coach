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
            'message' => "Read the problem statement above.\nScore of a split?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest XOR minus smallest', 'next' => 's2'],
                ['label' => 'Largest XOR', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 10 instead of 9.\nStep back to when you dropped the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "u and v unrelated: the rest of the tree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'T XOR x[u]', 'next' => 'wrong_b'],
                ['label' => 'T XOR x[u] XOR x[v]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. v’s subtree is still inside it; Example 1 → 6 instead of 9.\nStep back to when you left x[v] in.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "v inside u’s subtree: u’s part?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x[u] XOR x[v]', 'next' => 'success'],
                ['label' => 'x[u]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. v’s subtree was cut away from it; Example 1 → 11 instead of 9.\nStep back to when you used x[u] alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 9, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
