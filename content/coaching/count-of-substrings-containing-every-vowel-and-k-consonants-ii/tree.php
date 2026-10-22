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
            'message' => "Read the problem statement above.\nScan?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two sliding windows', 'next' => 's2'],
                ['label' => 'Every substring', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. About 2 · 10^10 substrings.\nStep back to when you checked them all.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For each r add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r − l + 1', 'next' => 'wrong_b'],
                ['label' => 'l (the valid starts)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts the invalid starts: example 3 → −3 instead of 3.\nStep back to when you added r − l + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 0, 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
