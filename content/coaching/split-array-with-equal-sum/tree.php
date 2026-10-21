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
            'message' => "Problem: nums has up to 2000 values. Find cuts 0 < i, i + 1 < j, j + 1 < k < n − 1 so the four parts between the cuts (cut elements dropped) all have the same sum. [1,2,1,2,1,2,1] → true (i = 1, j = 3, k = 5). (Restated from memory; limits and examples may differ slightly.)\nTry every (i, j, k)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: fix the middle cut j first', 'next' => 's2'],
                ['label' => 'Yes: three loops over prefix sums', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Three loops are O(n³), about 8e9 steps at n = 2000.\nStep back to when you tried every triple.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "j is fixed. What do you keep from the left side?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the largest left sum', 'next' => 'wrong_b'],
                ['label' => 'For each i with part 1 == part 2, add that sum to a set', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The right side must match exactly, and any equal left sum could be the one, so keep them all.\nStep back to when you kept one sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Now the right side. What do you check for each k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'part 3 == part 4 and that sum is in the set: return true', 'next' => 'success'],
                ['label' => 'Include nums[j] in parts 2 and 3', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Cut elements belong to no part; the prefix differences must skip i, j and k.\nStep back to when you counted the cut elements.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Fix j, keep a set of left sums, scan right for a match: O(n²) time, O(n) space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
