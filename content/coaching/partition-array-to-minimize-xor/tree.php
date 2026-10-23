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
            'message' => "Read the problem statement above.\nValue of piece h … i − 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pre[i] ^ pre[h]', 'next' => 's2'],
                ['label' => 'pre[i] − pre[h]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 1.\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Search method?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search with greedy cuts', 'next' => 'wrong_b'],
                ['label' => 'DP over every cut', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 3, 5], k = 2 → 6 instead of 5.\nStep back to when you cut greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² · k). Examples → 1, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
