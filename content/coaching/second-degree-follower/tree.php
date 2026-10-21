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
            'message' => "Problem: A follow table lists unique (followee, follower) pairs. A second-degree follower follows at least one user and is followed by at least one user. Report each such user with their number of followers, ordered by user. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWho qualifies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Users who appear both as a followee and as a follower', 'next' => 's2'],
                ['label' => 'Anyone who appears as a follower', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. They must also be followed by someone.\nStep back to when you only checked following.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What does num count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The people they follow', 'next' => 'wrong_b'],
                ['label' => 'Their own followers: GROUP BY followee', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. num is how many followers the user has.\nStep back to when you counted the wrong direction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you apply the filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE followee IN (SELECT follower FROM Follow)', 'next' => 'success'],
                ['label' => 'Self-join Follow and COUNT(*)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A self-join multiplies each user's rows by the number of people they follow, so the counts inflate.\nStep back to when you self-joined.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Group by followee, keep the ones who also follow, order by name: O(n) with hashing.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
