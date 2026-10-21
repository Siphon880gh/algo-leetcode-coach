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
            'message' => "Read the problem statement above.\nGroup by pid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count per tiv_2015 and per (lat, lon)', 'next' => 's2'],
                ['label' => 'Yes: one group per policy', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each pid is unique, so every group has one row and every count is 1.\nStep back to when you grouped by pid.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you count without losing the rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One GROUP BY tiv_2015, lat, lon', 'next' => 'wrong_b'],
                ['label' => 'COUNT(*) OVER (PARTITION BY tiv_2015) and COUNT(*) OVER (PARTITION BY lat, lon)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Putting both keys in one group mixes the two conditions.\nStep back to when you grouped by everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which rows do you sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'same_2015 > 1 AND same_place = 1', 'next' => 'success'],
                ['label' => 'same_2015 > 1 OR same_place = 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A policy must pass both tests.\nStep back to when you used OR.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two window counts, both conditions, ROUND(SUM(tiv_2016), 2): O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
