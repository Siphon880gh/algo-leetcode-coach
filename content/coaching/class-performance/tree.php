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
            'message' => "Problem: A table lists students with their scores on several assignments. Report the difference between the highest and the lowest total score, where a student’s total is the sum of their assignment scores. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nDifference of?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Student totals', 'next' => 's2'],
                ['label' => 'Single assignment scores', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The sample → 80 instead of 90.\nStep back to when you used single scores.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Aggregate?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'MAX(total)', 'next' => 'wrong_b'],
                ['label' => 'MAX(total) − MIN(total)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the top total, 240, not a difference.\nStep back to when you dropped MIN.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Sample → 90.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
