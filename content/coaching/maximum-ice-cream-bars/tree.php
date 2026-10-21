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
            'message' => "Read the problem statement above.\nWhich bars first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cheapest', 'next' => 's2'],
                ['label' => 'Most expensive', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Expensive bars use coins that could buy several cheap ones.\nStep back to when you started expensive.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sorting method required?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Comparison sort', 'next' => 'wrong_b'],
                ['label' => 'Counting sort', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement asks for counting sort.\nStep back to when you used a comparison sort.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Partial price level?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take coins // price, then stop', 'next' => 'success'],
                ['label' => 'Skip the whole level', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You may still afford some bars at that price.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + max cost). Examples → 4, 0, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
