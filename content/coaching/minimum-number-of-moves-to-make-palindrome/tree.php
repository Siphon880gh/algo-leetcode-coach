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
            'message' => "Read the problem statement above.\nPartner for s[0]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its last copy', 'next' => 's2'],
                ['label' => 'Its nearest copy', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. bbcbbc → 4 instead of 2.\nStep back to when you took the nearest copy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s[0] has no partner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop it at no cost', 'next' => 'wrong_b'],
                ['label' => 'It is the middle: swap it right once and continue', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. abb → 0 instead of 1; it still has to move to the centre.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Search over swap sequences?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the greedy is optimal', 'next' => 'success'],
                ['label' => 'BFS over strings', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. n reaches 2000, so the number of strings explodes.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
