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
                ['label' => 'Use the array itself: value x marks slot x − 1', 'next' => 's2'],
                ['label' => 'Store seen values in a hash set, or sort and compare neighbors', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A hash set is O(n) extra space, and sorting is O(n log n). The follow-up rules both out.\nStep back to when you used a set or a sort.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Walk i. x = |nums[i]|.\nWhat do you do with slot x − 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use x = nums[i] as is, without abs', 'next' => 'wrong_b'],
                ['label' => 'If nums[x − 1] < 0, x is a duplicate; else flip nums[x − 1] negative', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Reading nums[i] without abs can give a negative index after an earlier flip.\nStep back to when you used the signed value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Each value is visited once: O(n) time, O(1) extra. Cycle sort also works. 448 uses the same marks to find missing values; 287 forbids changing the array.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'abs to read, negative mark means repeat. Not 287 / 448', 'next' => 'success'],
                ['label' => 'Add every x to the answer, then remove singles', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A value seen twice is a duplicate the second time only. Adding x on every visit lists every value.\nStep back to when you added x before checking the mark.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Mark slot x − 1 negative; finding it already negative means x repeats. [4,3,2,7,8,2,3,1] → [2,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
