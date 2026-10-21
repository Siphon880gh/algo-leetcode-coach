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
            'message' => "Problem: A scores table records a player's gender, a day, and the points scored. For each gender and day, report the running total of that gender's points up to that day, ordered by gender and day. For instance, scores 10, 5, 20 on three successive days give 10, 15, 35. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nPartition by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Gender', 'next' => 's2'],
                ['label' => 'Player', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The total is per gender.\nStep back to when you partitioned by player.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window ordering?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'None', 'next' => 'wrong_b'],
                ['label' => 'ORDER BY day', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Without it every row gets the full total.\nStep back to when you omitted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Without windows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Self-join on gender and day ≤', 'next' => 'success'],
                ['label' => 'GROUP BY day only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That gives daily, not cumulative, totals.\nStep back to when you grouped by day.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One windowed SUM, ordered by gender and day.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
