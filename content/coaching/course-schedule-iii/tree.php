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
            'message' => "Read the problem statement above.\nIn what order do you consider the courses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By lastDay', 'next' => 's2'],
                ['label' => 'By duration', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A short course with a late deadline does not need to go first; deadlines decide the order.\nStep back to when you sorted by duration.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The new course pushes the total past its deadline. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the new course', 'next' => 'wrong_b'],
                ['label' => 'Drop the longest course taken so far (max-heap)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Dropping a longer earlier course keeps the same count and frees more time for later ones.\nStep back to when you skipped the new course.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of courses left in the heap', 'next' => 'success'],
                ['label' => 'The total time taken', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The question asks how many courses you can take.\nStep back to when you returned the time.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sort by deadline, max-heap of durations, drop the longest on overflow: O(n log n). [[100,200],[200,1300],[1000,1250],[2000,3200]] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
