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
            'message' => "State:\ndp = [0, 0, 0, 0, 0]\nW = 4\nnext item: A (1, 15)\n0-1 rule: each item once\n\nWhich way do you scan c?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From 4 down to 1 (high to low)', 'next' => 'after_dir'],
                ['label' => 'From 1 up to 4 (low to high)', 'next' => 'w_dir'],
            ],
        ],
        'w_dir' => [
            'message' => "Wrong.\n\nScanning upward lets a freshly updated small capacity feed a larger one in the same pass, so A could be used twice.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'after_dir' => [
            'message' => "State:\nafter A, dp = [0, 15, 15, 15, 15]\nnow B (3, 20), still scanning from high to low\nupdate c = 4: max(15, dp[1] + 20)\n\nWhat is the new dp[4]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '35', 'next' => 'ask_final'],
                ['label' => '20', 'next' => 'w_35'],
            ],
        ],
        'w_35' => [
            'message' => "Wrong.\n\ndp[1] is still 15, from A alone. 15 + 20 = 35.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'after_dir',
            'choices' => [],
        ],
        'ask_final' => [
            'message' => "State:\ndp[4] = 35 after A and B\nadd C (4, 30): max(35, dp[0] + 30) = max(35, 30)\n\nWhat is the final answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '35, the same best value as the full table', 'next' => 'success'],
                ['label' => '30, because C replaces everything', 'next' => 'w_c'],
            ],
        ],
        'w_c' => [
            'message' => "Wrong.\n\nThe max keeps 35. The one-array version must give the same answer as the full table.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'ask_final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Use one array and scan capacity backward.\n- Each item is still used at most once.\n- You get the same 35 as the full table.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
