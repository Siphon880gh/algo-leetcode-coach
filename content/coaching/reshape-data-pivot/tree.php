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
            'message' => "Read the problem statement above.\nReshape with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pivot', 'next' => 's2'],
                ['label' => 'groupby(city) and sum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That collapses the months: 2 values instead of a 5 × 2 table.\nStep back to when you grouped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "index and columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'index=city, columns=month', 'next' => 'wrong_b'],
                ['label' => 'index=month, columns=city', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You get one row per city (2 × 5).\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Months April … May as rows, ElPaso and Jacksonville as columns.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
