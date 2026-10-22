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
            'message' => "Read the problem statement above.\nScores to compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the earliest and latest dates', 'next' => 's2'],
                ['label' => 'MIN and MAX', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The example also returns (101, Physics, 60, 65).\nStep back to when you used MIN and MAX.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "latest_score order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'exam_date ascending', 'next' => 'wrong_b'],
                ['label' => 'exam_date DESC', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The example → no rows instead of 3.\nStep back to when you kept ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Example → (101, Math, 70, 85), (102, Math, 80, 85), (104, Physics, 75, 85).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
