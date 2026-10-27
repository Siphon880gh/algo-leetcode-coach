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
            'message' => "State:\namount = 36\ncoins = [25, 10, 5, 1]\n\nWhich coin does greedy take first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '25, the largest coin that fits', 'next' => 'counter'],
                ['label' => '1, because you should always take the smallest coin first', 'next' => 'w_small'],
            ],
        ],
        'w_small' => [
            'message' => "Wrong.\n\nThis greedy rule takes the largest coin that fits, not the smallest.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'counter' => [
            'message' => "State:\ncoins = [1, 3, 4]\namount = 6\ngreedy takes 4 + 1 + 1, which is 3 coins\n\nWhat is the best possible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3 + 3, which is 2 coins, so greedy failed for these coins', 'next' => 'proof'],
                ['label' => 'Still 3 coins, because greedy is optimal for any coins', 'next' => 'w_always'],
            ],
        ],
        'w_always' => [
            'message' => "Wrong.\n\nGreedy coin change only works for special coin sets. This set is a classic counterexample.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'counter',
            'choices' => [],
        ],
        'proof' => [
            'message' => "State:\nyou want to submit a greedy solution in an interview\n\nWhat else do you need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A proof or a known safe pattern, or else consider DP', 'next' => 'success'],
                ['label' => 'Nothing, because one passing sample is enough', 'next' => 'w_sample'],
            ],
        ],
        'w_sample' => [
            'message' => "Wrong.\n\nOne sample does not prove the answer is always best. Look for a counterexample or a proof.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'proof',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Greedy commits to the locally best choice.\n- It is only safe with a proof or a known pattern.\n- A counterexample means you should switch to DP or search.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
