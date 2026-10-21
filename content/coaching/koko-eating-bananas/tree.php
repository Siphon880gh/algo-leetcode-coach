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
            'message' => "Read the problem statement above.\nTry every speed from 1 upward?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: binary search, since hours only fall as k grows', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(max · n), with piles up to 10⁹.\nStep back to when you tried every speed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is the search range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1, sum(piles)]', 'next' => 'wrong_b'],
                ['label' => '[1, max(piles)]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any speed above max(piles) still takes one hour per pile, so it is never needed.\nStep back to when you used the sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many hours does a pile p take at speed k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(p + k − 1) // k', 'next' => 'success'],
                ['label' => 'p // k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A partial hour still costs a full hour.\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). [3,6,7,11], h = 8 → 4. [30,11,23,4,20], h = 5 → 30. [30,11,23,4,20], h = 6 → 23.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
