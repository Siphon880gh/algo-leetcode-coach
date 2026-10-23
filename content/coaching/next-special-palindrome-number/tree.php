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
            'message' => "Read the problem statement above.\nAnswer must be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly greater than n', 'next' => 's2'],
                ['label' => 'At least n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 22 → 22 instead of 212.\nStep back to when you allowed n itself.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Digits with an odd count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly one', 'next' => 'wrong_b'],
                ['label' => 'At most one', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 1 → 212 instead of 22.\nStep back to when you required an odd digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(P log P) once, O(log P) per query. Examples → 22, 212.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
