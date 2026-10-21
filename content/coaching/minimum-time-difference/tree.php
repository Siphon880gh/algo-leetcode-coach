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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Minutes, sort, check neighbors', 'next' => 's2'],
                ['label' => 'Compare every pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. All pairs is about 2e8 comparisons.\nStep back to when you compared all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sorted minutes t.\nWhat else besides t[i + 1] − t[i]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing else', 'next' => 'wrong_b'],
                ['label' => 'The wrap: t[0] + 1440 − t[−1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"23:59\" and \"00:00\" are 1 minute apart across midnight.\nStep back to when you skipped the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "More than 1440 times guarantees a duplicate: return 0. O(n log n), or O(n + 1440) with buckets.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Minutes, sorted neighbors, plus the wrap', 'next' => 'success'],
                ['label' => 'Sort the strings and diff HH and MM separately', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Comparing strings as text gives no distance; you need minutes.\nStep back to when you diffed the strings.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Neighbors on a circle including the wrap. → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
