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
                ['label' => 'Floyd slow and fast pointers from each start, checking the sign every step', 'next' => 's2'],
                ['label' => 'DFS from each start with a fresh visited set', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A fresh visited set per start makes it O(n²) time and O(n) space, and a plain visited check does not enforce one direction.\nStep back to when you used a visited set per start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "next(i) = ((i + nums[i]) % n + n) % n. Move slow one step, fast two, while nums at fast and next(fast) have the same sign as nums[i].\nThey meet. Are you done?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, any meeting means a valid cycle', 'next' => 'wrong_b'],
                ['label' => 'Only if the meeting node is not a self-loop; then return true', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A self-loop (next(i) == i) has length 1, which does not count. [−1,−2,−3,−4,−5,6] meets only at index 5, which points to itself.\nStep back to when you returned true on any meeting.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "If a start fails, walk its path again and set each value to 0 while the sign holds. Zero marks dead indexes, so each index is processed once: O(n) time, O(1) space. Linked List Cycle (141) is plain Floyd.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same sign, length > 1, zero out failed paths. Not 141 alone', 'next' => 'success'],
                ['label' => 'Ignore the sign; any cycle counts', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A path that changes direction is not a valid cycle, even if it repeats.\nStep back to when you dropped the sign check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Floyd per start with a sign check, reject self-loops, zero out dead paths. [2,−1,1,2,2] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
