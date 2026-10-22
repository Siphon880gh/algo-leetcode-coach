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
            'message' => "Read the problem statement above.\nRank cheeses for mouse 1 by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'reward1 − reward2', 'next' => 's2'],
                ['label' => 'reward1 alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A cheese mouse 2 also loves costs more to switch; reward1 = [5,4], reward2 = [5,1], k = 1 → 6 instead of 9.\nStep back to when you ranked by reward1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add the k gains to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'Σ reward2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The gains are changes from mouse 2 eating everything; Example 1 → 5 instead of 15.\nStep back to when you dropped the base.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 15, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
