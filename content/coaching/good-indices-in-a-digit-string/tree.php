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
            'message' => "Problem: You get a string s of digits. An index i is good when some substring ending at i equals the decimal form of i. Return all good indices in increasing order. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhich window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The |str(i)| characters ending at i', 'next' => 's2'],
                ['label' => 'The |str(i)| characters starting at i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): \"00000000010\" → [0] instead of [0, 10].\nStep back to when you started the window at i.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only s[i] with the last digit of i', 'next' => 'wrong_b'],
                ['label' => 'The whole window with str(i)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): \"00000000000\" → [0, 10] instead of [0].\nStep back to when you checked one digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → [0, 1], [], [0, 10].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
