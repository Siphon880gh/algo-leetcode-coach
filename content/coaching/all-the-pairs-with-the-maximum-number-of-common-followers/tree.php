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
            'message' => "Problem: A relations table lists (user, follower) pairs. For every pair of users, count the followers they have in common; report the pairs (smaller user id first, as the statement specifies) whose count equals the maximum over all pairs, using the column names it gives. For instance, if users 1 and 7 are both followed by 3, 4 and 5, while user 2 is followed by 3, 4 and 6, the pair (1, 7) has 3 common followers and is the only one reported. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nPair condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a.user < b.user', 'next' => 's2'],
                ['label' => 'a.user <> b.user', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each pair would appear twice.\nStep back to when you used <>.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep which pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the first with LIMIT 1', 'next' => 'wrong_b'],
                ['label' => 'All with count = max', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ties at the maximum must all be reported.\nStep back to when you used LIMIT 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Join on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same follower', 'next' => 'success'],
                ['label' => 'Same user', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Common followers share the follower id.\nStep back to when you joined on user.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → (1, 7, 3).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
