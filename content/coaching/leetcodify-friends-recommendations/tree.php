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
            'message' => "Problem: A listens table records which user listened to which song on which day; a friendship table lists pairs of friends (each pair stored once). Recommend user x to user y when they are not friends and both listened to at least three of the same songs on the same day, as the statement specifies. Recommendations go both ways (x to y and y to x); report each distinct pair with the column names the statement gives. For instance, if users 1, 2 and 3 all hear songs 10, 11, 12 on one day, user 4 shares only two of them, and users 1 and 2 are friends, the result is (1, 3), (2, 3), (3, 1), (3, 2). (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same song and same day, different users', 'next' => 's2'],
                ['label' => 'Same song only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Songs must be shared on the same day.\nStep back to when you ignored day.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Friend exclusion?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check user1 = a only', 'next' => 'wrong_b'],
                ['label' => 'Check both stored directions', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pairs are stored once in either order.\nStep back to when you checked one direction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pair and day, with COUNT(DISTINCT song) ≥ 3', 'next' => 'success'],
                ['label' => 'Pair only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Songs across different days would add up.\nStep back to when you dropped day.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → (1,3), (2,3), (3,1), (3,2).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
