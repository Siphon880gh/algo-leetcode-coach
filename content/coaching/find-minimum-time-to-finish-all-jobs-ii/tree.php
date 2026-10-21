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
            'message' => "Problem: You are given two integer arrays jobs and workers of equal length, where jobs[i] is the time job i needs and workers[j] is how much time worker j can work each day. Assign each job to exactly one worker and each worker exactly one job. Return the minimum number of days needed to finish all the jobs. For instance, jobs [5,2,4], workers [1,7,5] → 2; jobs [3,18,15,9], workers [6,5,1,3] → 3. (Restated from memory; limits and examples may differ slightly.)\nPair jobs with workers how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both sorted, in order', 'next' => 's2'],
                ['label' => 'As given', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The first constructed case → 5 instead of 2.\nStep back to when you paired them as given.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Days for one pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'job / worker rounded down', 'next' => 'wrong_b'],
                ['label' => 'ceil(job / worker)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. jobs [3], workers [2] → 1 instead of 2: one day of 2 leaves 1 to do.\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine the pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest day count', 'next' => 'success'],
                ['label' => 'Sum of day counts', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Workers work at the same time; the first constructed case → 4 instead of 2.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed cases → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
