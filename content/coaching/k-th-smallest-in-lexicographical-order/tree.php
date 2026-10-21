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
                ['label' => 'Generate the order with the 386 preorder walk and stop at k', 'next' => 'wrong_a'],
                ['label' => 'Picture a 10-ary prefix tree and count whole subtrees at once', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Generating or walking 1e9 numbers is too slow. 386's preorder walk lists every number one at a time.\nStep back to when you generated the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "count(cur) = how many numbers in [1, n] start with cur. Walk levels: first = cur, last = cur + 1; add min(n + 1, last) − first while first <= n; multiply both by 10.\nStart at cur = 1, k −= 1. If k >= count(cur)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the subtree: k −= count(cur), cur += 1', 'next' => 's3'],
                ['label' => 'Descend: cur *= 10', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. If the answer were under cur, k would be smaller than its subtree size. k >= count(cur) means the whole subtree comes before it.\nStep back to when you chose skip or descend.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Otherwise descend: k −= 1 (cur itself is one number), cur *= 10. Stop when k is 0. About log n moves per level, each O(log n): O(log² n). Use 64-bit math in count.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip with k −= count, descend with k −= 1. Not 386', 'next' => 'success'],
                ['label' => 'Descend with cur *= 10 and leave k unchanged', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Stepping into cur × 10 passes cur itself, which is one number in the order. Forgetting k −= 1 lands one too far.\nStep back to when you descended without counting cur.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count the prefix subtree, skip it or step into it, and pay 1 for each step down. n = 13, k = 2 → 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
