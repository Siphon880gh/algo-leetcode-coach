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
            'message' => "Read the problem statement above.\nStates per cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two: next action odd or even', 'next' => 's2'],
                ['label' => 'One', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 10 instead of 7.\nStep back to when you kept one state per cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Moves allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only right or down, no penalties', 'next' => 'wrong_b'],
                ['label' => 'Any neighbour, plus waiting, with penalties when breaking the rule', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 7 instead of 8.\nStep back to when you dropped the penalties.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn log(mn)). Examples → 8, 7, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
