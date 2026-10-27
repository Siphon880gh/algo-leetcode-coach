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
            'message' => "State:\nnums = [3, 1, 5]\ntarget = 6\nsum = 0\npath = []\n\nWhat is the first decision about 3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try both: skip 3 and take 3, exploring two branches', 'next' => 'after_branch'],
                ['label' => 'You must take 3 because it comes first', 'next' => 'w_must'],
            ],
        ],
        'w_must' => [
            'message' => "Wrong.\n\nSubset sum explores both including and excluding each number. Skipping 3 still finds {1, 5}.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_branch' => [
            'message' => "State:\nthe branch where 3 is skipped\nsum = 0\ntake 1, so sum = 1\ntake 5, so sum = 6\n\nWhich subset is valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '{1, 5}', 'next' => 'ask_prune'],
                ['label' => '{3, 1}, which sums to 4', 'next' => 'w_sub'],
            ],
        ],
        'w_sub' => [
            'message' => "Wrong.\n\n3 + 1 = 4, not 6. The branch that skipped 3 and then took 1 and 5 works.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'after_branch',
            'choices' => [],
        ],
        'ask_prune' => [
            'message' => "State:\nthe path sum is already 7, and the target is 6\nmore numbers are left\n\nWhat do you do next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prune: stop this branch, because the sum is already too big', 'next' => 'success'],
                ['label' => 'Keep adding, in case negative numbers appear later', 'next' => 'w_prune'],
            ],
        ],
        'w_prune' => [
            'message' => "Wrong.\n\nWith non-negative numbers, an overshoot can never recover. Prune.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_prune',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Start at sum 0, and include or exclude each number.\n- {1, 5} reaches 6.\n- Prune when the sum exceeds the target.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
