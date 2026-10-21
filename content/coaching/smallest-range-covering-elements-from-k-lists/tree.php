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
            'message' => "Read the problem statement above.\nTry every pair of values as a range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep one pointer per list in a min-heap, plus the running max', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is far too many ranges, and each one needs a coverage check.\nStep back to when you tried every range.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which list do you advance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one holding the current maximum', 'next' => 'wrong_b'],
                ['label' => 'The one holding the current minimum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Moving the maximum up can only widen the range.\nStep back to when you advanced the max.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the list holding the minimum has no next value', 'next' => 'success'],
                ['label' => 'When any list reaches its last value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A list at its last value can still be covered; you only stop when you would have to move past it.\nStep back to when you stopped early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Min-heap of one value per list, running max, advance the min: O(N log k) time. [[4,10,15,24,26],[0,9,12,20],[5,18,22,30]] → [20,24].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
