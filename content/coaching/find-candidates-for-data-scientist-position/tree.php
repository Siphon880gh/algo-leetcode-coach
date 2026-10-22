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
            'message' => "Problem: A table lists candidates and their skills, one row per candidate and skill. Report the candidates who have every skill in the required list the statement names. Table, column and output names, the exact skills, and the ordering are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCount with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(DISTINCT skill)', 'next' => 's2'],
                ['label' => 'COUNT(*)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A repeated row counts twice; the check also returns candidate 4.\nStep back to when you used COUNT(*).",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Filter to required skills first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, count all skills', 'next' => 'wrong_b'],
                ['label' => 'Yes, WHERE skill IN (…)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Extra skills push the count past the list size; the check drops candidate 3.\nStep back to when you skipped the filter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The check → 1 and 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
