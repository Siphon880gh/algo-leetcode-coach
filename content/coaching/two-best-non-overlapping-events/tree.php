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
            'message' => "Read the problem statement above.\nCan an event start at the time another ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: times are inclusive, so start ≥ end + 1', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [1,3,2] and [3,4,3] share time 3, so together they are not allowed.\nStep back to when you allowed a shared endpoint.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Must you take two events?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly two', 'next' => 'wrong_b'],
                ['label' => 'At most two; one alone can win', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 5 is the single event [1,5,5].\nStep back to when you forced a pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Find the best partner how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search sorted starts, read a suffix max', 'next' => 'success'],
                ['label' => 'Try every pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With 10^5 events that is about 5 · 10^9 pairs.\nStep back to when you tried every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 4, 5, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
