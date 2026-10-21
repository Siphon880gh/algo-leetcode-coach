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
            'message' => "Read the problem statement above.\nGROUP BY a CASE category?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, empty categories vanish', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A category with no accounts would be missing.\nStep back to when you grouped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Average range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '> 20000 AND < 50000', 'next' => 'wrong_b'],
                ['label' => 'BETWEEN 20000 AND 50000, inclusive', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both bounds belong to Average.\nStep back to when you excluded them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine rows with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'UNION ALL', 'next' => 'success'],
                ['label' => 'JOIN', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The three rows are stacked, not joined.\nStep back to when you joined.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → Low 1, Average 0, High 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
