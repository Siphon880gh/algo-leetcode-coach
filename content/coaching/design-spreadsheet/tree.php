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
            'message' => "Read the problem statement above.\nCell key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The whole name, like B10', 'next' => 's2'],
                ['label' => 'Its first two characters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. After setCell B10 = 7, =B1+B10 → 14 instead of 7.\nStep back to when you cut the name.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Term starting with a digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A cell name', 'next' => 'wrong_b'],
                ['label' => 'A number', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. =5+7 → 0 instead of 12.\nStep back to when you looked it up as a cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(formula length) per call. Example → [null, 12, null, 16, null, 25, null, 15].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
