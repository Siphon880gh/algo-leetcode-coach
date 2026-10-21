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
                ['label' => 'Try every pair i, j and keep the best XOR', 'next' => 'wrong_a'],
                ['label' => 'Insert every value into a binary trie of 31 bits, high bit first', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Checking every pair is O(n²), about 2e10 XORs at n = 2e5.\nStep back to when you chose the all-pairs loop.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Each root-to-leaf path is one number, bit 30 down to bit 0. To query x, go bit by bit from the top.\nAt bit i of x is v. Which child do you prefer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The child with bit v XOR 1, if it exists. Then set bit i in the answer', 'next' => 's3'],
                ['label' => 'The child with the same bit v, to stay close to x', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Following the same bit makes that XOR bit 0. A 1 in a higher bit beats every lower bit combined, so you want the opposite bit whenever it exists.\nStep back to when you picked which child to follow.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Greedy from the high bit is optimal because bit i outweighs bits i − 1 through 0. Query every x, keep the max. O(31 n) time and space. Single Number (136) XORs everything together, which is a different problem.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'High bit first, opposite child when it exists. O(31 n). Not 136', 'next' => 'success'],
                ['label' => 'Walk from bit 0 up to bit 30 instead', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Values fit in bits 30 down to 0. Starting at bit 31 or skipping to bit 0 first changes the order and breaks the greedy.\nStep back to when you chose which bit to start from.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. 31-bit trie, high bit first, opposite child when you can. [3,10,5,25,2,8] → 28.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
