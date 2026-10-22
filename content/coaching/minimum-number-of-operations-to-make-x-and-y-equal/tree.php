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
            'message' => "Read the problem statement above.\nDivide whenever you can?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: also compare x − y', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. x = 5, y = 4 → 4 (5 → 1 → 4) instead of 1.\nStep back to when you always divided.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Reach a multiple by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stepping down only', 'next' => 'wrong_b'],
                ['label' => 'Stepping down or up', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. x = 4, y = 1 → 3 instead of 2 (4 → 5 → 1).\nStep back to when you only stepped down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 3, 4, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
