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
            'message' => "Read the problem statement above.\nBase count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All ones in s', 'next' => 's2'],
                ['label' => 'Ones inside the substring', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [4, 3, 1, 0] instead of [4, 3, 1, 1].\nStep back to when you counted only inside.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edge blocks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use full lengths', 'next' => 'wrong_b'],
                ['label' => 'Clip them to the substring', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → [7, 7, 2] instead of [6, 7, 2].\nStep back to when you used full lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [1], [4, 3, 1, 1], [6, 7, 2], [4, 4, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
