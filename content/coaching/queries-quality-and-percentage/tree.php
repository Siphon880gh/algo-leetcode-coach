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
            'message' => "Read the problem statement above.\nQuality?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'AVG(rating / position)', 'next' => 's2'],
                ['label' => 'AVG(rating) / AVG(position)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Quality is the average of each row's ratio.\nStep back to when you divided averages.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Poor query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'rating ≤ 3', 'next' => 'wrong_b'],
                ['label' => 'rating < 3', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A rating of 3 is not poor.\nStep back to when you included 3.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Duplicate rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each row', 'next' => 'success'],
                ['label' => 'Remove duplicates first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every row is a query result.\nStep back to when you removed duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Example: Dog → 2.50, 33.33. Cat → 0.66, 33.33.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
