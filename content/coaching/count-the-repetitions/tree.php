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
                ['label' => 'Greedy matching, but precompute one pass of s1 per position in s2', 'next' => 's2'],
                ['label' => 'Build str1 and str2 and match them character by character', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. str1 can be 1e8 characters long. Building it and matching character by character is too slow.\nStep back to when you built str1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Greedy: walk s1, advance pointer j in s2 on a match; wrapping j counts one s2 copy.\nWhat do you precompute?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'How many copies of str2 one pass of s1 contains', 'next' => 'wrong_b'],
                ['label' => 'For each start j: cnt[j] copies finished and nxt[j] after one pass of s1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Copies of str2 come out of copies of s2. Counting s2 is the natural unit; divide by n2 at the end.\nStep back to when you counted str2 directly.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Then run n1 passes: total += cnt[j], j = nxt[j]. Answer = total // n2. O(|s1| × |s2| + n1). The j values repeat, so cycle detection can skip ahead, but n1 <= 1e6 is already fast.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Carry j across passes, then total // n2', 'next' => 'success'],
                ['label' => 'Reset j to 0 at the start of every pass', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Matching resets each pass if you start j at 0 every time, losing partial progress across copies of s1.\nStep back to when you reset j each pass.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Precompute one s1 pass per s2 position, chain n1 passes carrying j, divide by n2. \"acb\", 4, \"ab\", 2 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
