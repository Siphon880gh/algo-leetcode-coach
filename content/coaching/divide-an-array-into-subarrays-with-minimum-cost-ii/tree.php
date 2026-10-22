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
            'message' => "Read the problem statement above.\nWhich k − 1 starts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The k − 1 smallest inside one window of dist + 1 positions', 'next' => 's2'],
                ['label' => 'The k − 1 smallest of nums[1 …]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That ignores dist; example 3 → 27 instead of 36.\nStep back to when you picked from the whole array.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep the window’s smallest sum how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort each window again', 'next' => 'wrong_b'],
                ['label' => 'Two balanced multisets with a running sum', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With dist about n / 2 that sorts about 2.5 · 10^9 elements in total.\nStep back to when you re-sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 5, 15, 36.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
