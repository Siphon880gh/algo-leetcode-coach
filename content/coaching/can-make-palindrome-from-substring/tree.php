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
            'message' => "Read the problem statement above.\nCount letters per query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: prefix parity masks', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 10⁵ queries of 10⁵ letters is too slow.\nStep back to when you counted per query.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Odd letters in s[l..r]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'popcount(pre[r] ^ pre[l])', 'next' => 'wrong_b'],
                ['label' => 'popcount(pre[r + 1] ^ pre[l])', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That drops s[r].\nStep back to when you used pre[r].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Accept when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'odd // 2 ≤ k', 'next' => 'success'],
                ['label' => 'odd ≤ k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One replacement fixes two odd letters.\nStep back to when you compared odd with k.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). \"abcda\" queries → [true,false,false,true,true]. \"lyb\", [[0,1,0],[2,2,1]] → [false,true].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
