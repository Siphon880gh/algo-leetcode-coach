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
                ['label' => 'Slide a window; count letters; track the top count mx', 'next' => 's2'],
                ['label' => 'Check every substring and count how many letters differ from its majority', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Trying every substring and counting is O(n²) or worse at n = 1e5.\nStep back to when you checked all substrings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window [l, r] with counts. mx = highest count of any one letter seen.\nWhen must l move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the window holds more than k distinct letters', 'next' => 'wrong_b'],
                ['label' => 'When (r − l + 1) − mx > k: shift l by one and drop its count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Distinct letters are not the limit; replacements are. \"AABABBA\" with k = 1 has 2 distinct letters everywhere.\nStep back to when you limited distinct letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You may keep mx as a historical max that never drops: a stale mx only delays shrinking, and the answer only grows when a truly larger mx shows up. O(n) time, O(26) space. Longest Substring Without Repeating Characters (3) and At Most K Distinct (340) are different rules.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Legal while length − mx <= k. One-step slide. Not 3 / 340', 'next' => 'success'],
                ['label' => 'Force the target letter to be the leftmost letter in the window', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The best run need not use the first letter of the window. \"BAAA\" with k = 1 → 4 by changing B.\nStep back to when you fixed the target letter to s[l].",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Window is legal while length minus mx is at most k. \"ABAB\", k = 2 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
