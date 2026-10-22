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
            'message' => "Problem: A table lists insurance policies with a state and a fraud score. For each state, report the policies whose score is in the top percentile the statement gives, that is, among the highest-scoring policies of that state. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWindow partition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By state', 'next' => 's2'],
                ['label' => 'None (all rows)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The check keeps CA’s 0.94 and 0.92 and no NY policy.\nStep back to when you ranked globally.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order by score?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ascending', 'next' => 'wrong_b'],
                ['label' => 'Descending', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That keeps the lowest scores; the check → CA 0.10 and NY 0.2.\nStep back to when you sorted upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The check → CA 0.94, NY 0.9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
