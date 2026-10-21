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
                ['label' => 'Each value x marks slot x − 1 in nums itself', 'next' => 's2'],
                ['label' => 'Put every value in a hash set, then check 1..n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A set of the values costs O(n) extra space, which the follow-up rules out.\nStep back to when you used a set.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For x = |nums[i]|, make nums[x − 1] negative.\nAfter the pass, which values are missing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i + 1 for every slot i that is negative', 'next' => 'wrong_b'],
                ['label' => 'i + 1 for every slot i that is still positive', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Negative slots were marked, so their values appeared. The missing ones are the slots nobody marked.\nStep back to when you read the marks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Read |nums[i]| because an earlier step may have flipped it. O(n) time, O(1) extra. Find All Duplicates (442) reads the same marks for repeats.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mark with abs, collect positive slots. Not 442', 'next' => 'success'],
                ['label' => 'Index with nums[i] directly, signs and all', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Using the signed value after a flip gives a negative index.\nStep back to when you used nums[i] without abs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Mark slot |x| − 1 negative, then report every slot left positive. [4,3,2,7,8,2,3,1] → [5,6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
