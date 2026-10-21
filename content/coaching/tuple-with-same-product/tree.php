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
            'message' => "Read the problem statement above.\nWhat to count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Products of unordered pairs', 'next' => 's2'],
                ['label' => 'All 4-element tuples directly', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. O(n^4) is far too slow for n = 1000.\nStep back to when you enumerated tuples.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tuples per two matching pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4', 'next' => 'wrong_b'],
                ['label' => '8', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each pair has 2 orders and the pairs can swap sides: 2 · 2 · 2.\nStep back to when you used 4.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can two pairs share an element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: distinct values make equal products disjoint', 'next' => 'success'],
                ['label' => 'Yes, subtract overlaps', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. a·b = a·c forces b = c, which is impossible here.\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 8, 16.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
