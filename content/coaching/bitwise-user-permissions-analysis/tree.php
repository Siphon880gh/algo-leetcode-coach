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
            'message' => "Problem: A table lists users and an integer whose bits are their permissions. Report the permissions every user shares and the permissions any user has, as the statement defines them. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nShared permissions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BIT_AND', 'next' => 's2'],
                ['label' => 'BIT_OR', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check → 15 instead of 5.\nStep back to when you used BIT_OR.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Any user’s permissions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SUM', 'next' => 'wrong_b'],
                ['label' => 'BIT_OR', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the guide’s check → 25 instead of 15.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s check → 5, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
