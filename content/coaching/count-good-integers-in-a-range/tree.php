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
            'message' => "Read the problem statement above.\nRange from the prefix counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'F(r) − F(l − 1)', 'next' => 's2'],
                ['label' => 'F(r) − F(l)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3.\nStep back to when you dropped l itself.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leading zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Treat them as digits', 'next' => 'wrong_b'],
                ['label' => 'Skip them until the first non-zero digit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): l = 10, r = 99, k = 1 with 3-digit padding → 3 instead of 26.\nStep back to when you compared padded zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(16 · 10 · 10). Examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
