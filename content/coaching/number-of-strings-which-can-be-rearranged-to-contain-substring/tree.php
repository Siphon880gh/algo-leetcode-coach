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
            'message' => "Read the problem statement above.\nCount how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Complement with inclusion–exclusion', 'next' => 's2'],
                ['label' => 'Try every string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. There are 26^n strings.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Bad set for e?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No e', 'next' => 'wrong_b'],
                ['label' => 'At most one e', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. leet needs two; n = 4 → 588 instead of 12.\nStep back to when you used no e.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). Examples → 12, 83943898.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
