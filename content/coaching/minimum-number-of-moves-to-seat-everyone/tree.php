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
            'message' => "Read the problem statement above.\nHow to match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort both and pair in order', 'next' => 's2'],
                ['label' => 'Send each student to the nearest free seat in input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Seats [1,4], students [3,4]: 3 takes 4 and 4 walks to 1 for 4 moves, but sorted pairing costs 2.\nStep back to when you matched greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Total cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest single distance', 'next' => 'wrong_b'],
                ['label' => 'Sum of |seat − student|', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every move counts.\nStep back to when you took the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Several students or seats at one position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorting handles it', 'next' => 'success'],
                ['label' => 'Remove duplicates first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each seat and student counts once each; Example 3 has two seats at 2.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 4, 7, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
