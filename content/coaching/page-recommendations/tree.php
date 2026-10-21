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
            'message' => "Problem: A friendship table lists pairs of friends (in either column) and a likes table lists which user liked which page. For the user named in the statement, return the distinct pages their friends liked that the user has not liked. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFriends from which column?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both, via UNION', 'next' => 's2'],
                ['label' => 'Only user2_id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A friendship can be stored either way round.\nStep back to when you read one column.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pages the user already likes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them', 'next' => 'wrong_b'],
                ['label' => 'Exclude them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Recommendations must be new pages.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two friends like the same page?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use DISTINCT', 'next' => 'success'],
                ['label' => 'List it twice', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each page appears once.\nStep back to when you skipped DISTINCT.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One UNION subquery plus NOT IN, with DISTINCT.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
