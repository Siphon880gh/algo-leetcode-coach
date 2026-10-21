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
            'message' => "Problem: A friendship table lists pairs of user ids who are friends (each pair stored once, in either column); a likes table lists which user likes which page. For every user, recommend each page liked by at least one friend that the user does not already like, together with how many friends like it. Use the output column names and order the statement specifies. For instance, with friends 1–2, 1–3, 2–3 and likes 1:{10}, 2:{20, 30}, 3:{20}: user 1 gets page 20 (2 friends) and 30 (1); user 2 gets 10 (1); user 3 gets 10 (1) and 30 (1). (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFriendship directions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both, via UNION ALL', 'next' => 's2'],
                ['label' => 'Only user1 → user2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Pairs are stored once, so half would be missed.\nStep back to when you used one direction.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Exclude pages the user already likes by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Matching the page only', 'next' => 'wrong_b'],
                ['label' => 'Matching both user and page', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That removes pages someone else likes.\nStep back to when you matched page alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count of friends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*) per user and page', 'next' => 'success'],
                ['label' => 'COUNT(DISTINCT page)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That always gives 1 per group.\nStep back to when you counted pages.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → (1,20,2), (1,30,1), (2,10,1), (3,10,1), (3,30,1).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
