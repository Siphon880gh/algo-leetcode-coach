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
            'message' => "Problem: A table gives each distinct number with how many times it occurs. Return the median of the list you get by repeating every number by its frequency, rounded as the statement specifies. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nExpand the rows into the full list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use running sums of frequency', 'next' => 's2'],
                ['label' => 'Yes: repeat each num frequency times, then take the middle', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Frequencies can be large, and you only need to know which block holds the middle.\nStep back to when you expanded the list.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which nums are median values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the num where the running sum first passes total / 2', 'next' => 'wrong_b'],
                ['label' => 'Those where the sum up to num and the sum from num both reach total / 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With an even total the two middle values can sit in two different blocks, and you need both.\nStep back to when you kept one num.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you combine them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROUND(AVG(num), 1) over those rows', 'next' => 'success'],
                ['label' => 'SUM(num × frequency) / total', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is the mean, not the median.\nStep back to when you took the mean.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two running sums, keep the rows where both reach half, and average: O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
