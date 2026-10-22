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
            'message' => "Read the problem statement above.\nRange count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count(finish) − count(start − 1)', 'next' => 's2'],
                ['label' => 'count(finish) − count(start)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That drops start itself; start = 124 in example 1 → 4 instead of 5.\nStep back to when you subtracted count(start).",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Choices per free digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'limit (1 … limit)', 'next' => 'wrong_b'],
                ['label' => 'limit + 1 (0 … limit)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Zeros are allowed; example 1 → 4 instead of 5.\nStep back to when you left out 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log finish). Examples → 5, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
