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
            'message' => "Problem: Two tables list the dates a daily task failed and the dates it succeeded. For the date range in the statement, report each maximal run of consecutive days with one state, with its first and last dates, ordered by start. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFilter the range before or after numbering?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before', 'next' => 's2'],
                ['label' => 'After', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Numbers must count only the kept days.\nStep back to when you numbered first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Partition the row number by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 'wrong_b'],
                ['label' => 'State', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each state needs its own sequence.\nStep back to when you numbered all days together.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'State and date minus row number', 'next' => 'success'],
                ['label' => 'State only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That merges separate runs.\nStep back to when you grouped by state.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). One row per run with MIN and MAX dates.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
