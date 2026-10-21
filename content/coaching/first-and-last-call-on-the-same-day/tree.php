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
            'message' => "Problem: A calls table records a caller, a recipient and a call time. Counting calls in both directions, report the ids of users whose first and last calls on at least one day were with the same person, as the statement specifies. For instance, with calls 8→4 and 4→8 on one day, a single call 5→1 on another, and on a third day 8→3, 11→3, 8→11: users 1, 4, 5 and 8 qualify (8 through the first day), while 3 and 11 do not. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich calls belong to a user?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Calls they made and calls they received', 'next' => 's2'],
                ['label' => 'Only calls they made', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Received calls count too; user 1 in the example only receives.\nStep back to when you used the caller side only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How to find the first and last call per day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MIN and MAX of the other user id', 'next' => 'wrong_b'],
                ['label' => 'ROW_NUMBER by time ascending and descending', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The smallest id is not the earliest call.\nStep back to when you took MIN of ids.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A user with a single call that day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Qualifies: first and last are the same call', 'next' => 'success'],
                ['label' => 'Excluded', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One call is both the first and the last; user 5 in the example qualifies.\nStep back to when you excluded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → users 1, 4, 5, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
