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
            'message' => "Problem: A players table assigns players to groups, and a matches table records two players and each one's points. In every group, the winner has the most total points across all matches, with ties broken as the statement specifies (typically the lower player id). Report each group's winner. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCount only first-player points?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: stack both sides with UNION ALL', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A player can appear on either side.\nStep back to when you used one side.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "UNION or UNION ALL?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'UNION', 'next' => 'wrong_b'],
                ['label' => 'UNION ALL', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal rows from different matches would merge.\nStep back to when you used UNION.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two players tie in a group. Pick with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROW_NUMBER with the tie-break in ORDER BY', 'next' => 'success'],
                ['label' => 'RANK', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. RANK can return two winners.\nStep back to when you used RANK.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). One winner per group.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
