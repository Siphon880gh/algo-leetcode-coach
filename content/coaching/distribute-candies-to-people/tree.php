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
            'message' => "Read the problem statement above.\nIs simulation fast enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: only about √(2 · candies) handouts happen', 'next' => 's2'],
                ['label' => 'No', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The handouts grow, so they end quickly.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fewer candies remain than the next handout. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the person', 'next' => 'wrong_b'],
                ['label' => 'Give all that remain', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last person gets the rest.\nStep back to when you skipped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which person gets handout i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i % n', 'next' => 'success'],
                ['label' => 'i // n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Handouts go around the circle.\nStep back to when you used i // n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√candies + n). candies = 7, n = 4 → [1,2,3,1]. candies = 10, n = 3 → [5,2,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
