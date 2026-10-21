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
            'message' => "Problem: An experiments table records each experiment's platform and name, drawn from fixed lists given in the statement (for example Android, IOS, Web and Reading, Sports, Programming). Report the number of experiments for every platform–name combination, including combinations with zero, using the column names the statement gives. For instance, with experiments IOS-Programming, IOS-Sports, Android-Reading, Web-Reading twice and Web-Programming, Web-Reading has 2, four other combinations have 1, and the remaining four have 0. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCombinations with zero experiments?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Build all platform × name pairs first', 'next' => 's2'],
                ['label' => 'GROUP BY on the experiments table alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Missing combinations never appear in that table, so they would vanish instead of showing 0.\nStep back to when you grouped the table directly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join the experiments how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'INNER JOIN', 'next' => 'wrong_b'],
                ['label' => 'LEFT JOIN onto the pairs', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An inner join drops the empty combinations again.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What to count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT of the experiment id column', 'next' => 'success'],
                ['label' => 'COUNT(*)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A left-joined empty combination still has one row, so COUNT(*) gives 1.\nStep back to when you used COUNT(*).",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → Web-Reading 2, four combinations 1, the rest 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
