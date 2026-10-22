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
            'message' => "Problem: Each record pairs a student id with a bench id. Return the largest number of different students on any one bench. A repeated record counts once, and with no records the answer is 0. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nCount?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct students', 'next' => 's2'],
                ['label' => 'Records', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The guide’s check → 3 instead of 2.\nStep back to when you counted records.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No records?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the max anyway', 'next' => 'wrong_b'],
                ['label' => 'Return 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The maximum of nothing is undefined.\nStep back to when you skipped the empty case.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
