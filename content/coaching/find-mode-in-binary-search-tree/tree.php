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
                ['label' => 'Inorder walk: equal values arrive in a row', 'next' => 's2'],
                ['label' => 'Count all values in a hash map', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A hash map works but uses O(n) space and ignores the BST order.\nStep back to when you counted with a map.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Inorder reaches value v.\nHow do you update the run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt += 1 if v == root.val', 'next' => 'wrong_b'],
                ['label' => 'cnt += 1 if v == prev, else cnt = 1; then prev = v', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Values are equal only in a run. Comparing to the root value says nothing about runs.\nStep back to when you compared with the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "cnt > best: best = cnt, ans = [v]. cnt == best: append v. O(n) time, O(h) space.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Inorder runs: reset on a new best, append on a tie', 'next' => 'success'],
                ['label' => 'Reset the list whenever cnt >= best', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Clearing the list on a tie drops modes; [1,2] both appear once and both are answers.\nStep back to when you cleared on a tie.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Inorder runs with prev, cnt, best. [1,null,2,2] → [2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
