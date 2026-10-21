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
            'message' => "Read the problem statement above.\nCombine the two conditions with AND or OR?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'OR: either threshold makes a country big', 'next' => 's2'],
                ['label' => 'AND', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A country only has to pass one of the two tests.\nStep back to when you used AND.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "> or >=?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '>', 'next' => 'wrong_b'],
                ['label' => '>=: at least 3000000 km² or at least 25000000 people', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The thresholds say at least, so a country exactly at the limit counts.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Rewrite it so each side can use its own index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'UNION of two queries, one per condition', 'next' => 'success'],
                ['label' => 'UNION ALL of the two queries', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A country that passes both tests would appear twice; UNION removes the duplicate.\nStep back to when you used UNION ALL.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. area >= 3000000 OR population >= 25000000, or a UNION of the two: O(n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
