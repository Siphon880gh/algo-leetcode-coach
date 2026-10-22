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
            'message' => "Read the problem statement above.\nTwo or more extra copies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count them by binomials', 'next' => 's2'],
                ['label' => 'Skip them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 0 instead of 4.\nStep back to when you skipped them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Exactly one extra copy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count every pick', 'next' => 'wrong_b'],
                ['label' => 'The other three picks must all differ', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 6 instead of 4.\nStep back to when you counted every pick.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · D). Examples → 6, 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
