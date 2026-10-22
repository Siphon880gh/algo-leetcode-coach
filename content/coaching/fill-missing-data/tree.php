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
            'message' => "Read the problem statement above.\nHandle missing quantities by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Filling them with 0', 'next' => 's2'],
                ['label' => 'Dropping those rows', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The rows must stay; only 2 of 4 remain.\nStep back to when you dropped rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fill where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The whole DataFrame', 'next' => 'wrong_b'],
                ['label' => 'products[quantity] only', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That would also fill gaps in other columns.\nStep back to when you filled everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Quantities → 0, 0, 779, 849.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
