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
            'message' => "Read the problem statement above.\nA letter missing its other case?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It can never be in a nice substring, so split on it', 'next' => 's2'],
                ['label' => 'Skip it and continue the window', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Any substring containing it fails.\nStep back to when you kept it in the window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie between halves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefer the right', 'next' => 'wrong_b'],
                ['label' => 'Prefer the left result', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The earliest occurrence must win.\nStep back to when you preferred the right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Base case?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Length < 2 → empty', 'next' => 'success'],
                ['label' => 'Length 0 only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A single letter is never nice.\nStep back to when you returned it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) worst case. Examples → aAa, Bb, empty.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
