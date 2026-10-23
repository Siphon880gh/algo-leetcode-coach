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
            'message' => "State:\namount = 36\ncoins = [25, 10, 5, 1]\n\nGreedy first coin?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '25 — largest coin that fits', 'next' => 'counter'],
                ['label' => '1 — always take the smallest coin first', 'next' => 'w_small'],
            ],
        ],
        'w_small' => [
            'message' => "Wrong.\n\nThis coin greedy takes the largest fitting coin, not the smallest.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'counter' => [
            'message' => "State:\ncoins = [1, 3, 4]\namount = 6\n\nGreedy 4+1+1 uses 3 coins. Best is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3+3 = 2 coins — greedy failed on this set', 'next' => 'proof'],
                ['label' => 'Still 3 — greedy is always optimal for any coins', 'next' => 'w_always'],
            ],
        ],
        'w_always' => [
            'message' => "Wrong.\n\nCoin greedy needs special denominations. This set is a classic counterexample.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'counter',
            'choices' => [],
        ],
        'proof' => [
            'message' => "State:\nyou want to ship a greedy solution in an interview\n\nWhat else do you need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A proof or known safe pattern — else consider DP', 'next' => 'success'],
                ['label' => 'Nothing — one green sample is enough', 'next' => 'w_sample'],
            ],
        ],
        'w_sample' => [
            'message' => "Wrong.\n\nOne sample does not prove optimality. Ask for a counterexample or a proof.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'proof',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Greedy commits to local best\n- Safe only with a proof/pattern\n- Counterexamples mean switch to DP/search\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
