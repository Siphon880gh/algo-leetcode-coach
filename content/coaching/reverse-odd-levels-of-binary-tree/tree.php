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
            'message' => "Read the problem statement above.\nNext pairs after (a, b)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(a.left, b.right) and (a.right, b.left)', 'next' => 's2'],
                ['label' => '(a.left, b.left) and (a.right, b.right)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Those are not mirror images; root = [0,1,…,14] gives level 3 as 11 … 14, 7 … 10 instead of 14 … 7.\nStep back to when you paired same sides.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Swap on which levels?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Even', 'next' => 'wrong_b'],
                ['label' => 'Odd', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [7,13,11] instead of [7,11,13].\nStep back to when you swapped even levels.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "First call?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'go(root.left, root.right, 1)', 'next' => 'success'],
                ['label' => 'go(root, root, 0)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each pair is then visited twice and swapped back; Example 2 → [7,13,11] instead of [7,11,13].\nStep back to when you started at the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [2,5,3,8,13,21,34], [7,11,13], [0,2,1,0,0,0,0,2,2,2,2,1,1,1,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
