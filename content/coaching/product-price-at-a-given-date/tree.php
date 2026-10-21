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
            'message' => "Read the problem statement above.\nFilter changes after the date in WHERE?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: inside the join or subquery', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Products with only later changes would vanish.\nStep back to when you filtered in WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Change on the date itself counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use <', 'next' => 'wrong_b'],
                ['label' => 'Yes: use ≤', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A change on the date sets that day's price.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No change by the date. Price?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '10', 'next' => 'success'],
                ['label' => 'NULL', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every product starts at 10.\nStep back to when you left NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Example: 2 → 50, 1 → 35, 3 → 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
