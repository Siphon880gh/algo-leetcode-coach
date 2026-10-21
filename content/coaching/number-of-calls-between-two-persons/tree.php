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
            'message' => "Problem: Given a calls table (caller, callee, duration), report for each unordered pair of people, listed with the smaller id first, the number of calls between them and their total duration, with the column names the statement specifies. For instance, calls 1 → 2 (60 s) and 2 → 1 (30 s) give the pair (1, 2) with 2 calls and 90 s. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGroup by raw (from, to)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: normalise the pair first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 1 → 2 and 2 → 1 would be separate rows.\nStep back to when you grouped raw.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Normalise with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ABS of the difference', 'next' => 'wrong_b'],
                ['label' => 'LEAST and GREATEST', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You need the two ids, not their gap.\nStep back to when you used ABS.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Aggregates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*) and SUM(duration)', 'next' => 'success'],
                ['label' => 'COUNT(DISTINCT duration)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each call counts, even with equal durations.\nStep back to when you used DISTINCT.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check: (1, 2) → 2 calls, 90.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
