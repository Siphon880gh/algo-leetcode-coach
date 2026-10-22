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
            'message' => "Read the problem statement above.\nDistance to index i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(d, n − d) with d = |i − startIndex|', 'next' => 's2'],
                ['label' => 'd', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The array is circular; Example 2 → 2 instead of 1.\nStep back to when you ignored the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Several indices hold the target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use the first one', 'next' => 'wrong_b'],
                ['label' => 'Take the smallest distance', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. words = [a,b,c,a], target = a, startIndex = 2 → 2 instead of 1.\nStep back to when you took the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · word length). Examples → 1, 1, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
