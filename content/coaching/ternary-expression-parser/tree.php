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
            'message' => "Problem: a valid ternary expression of length 5 to 1e4 with T, F, one-digit numbers, ? and :. Groups right to left. Return the result. \"T?2:3\" → \"2\". \"F?1:T?4:5\" → \"4\". \"T?T?F:5:3\" → \"F\". (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan from right to left and push values onto a stack', 'next' => 's2'],
                ['label' => 'Scan left to right and pop at every :', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Left to right with an operator stack groups the wrong way. \"F?1:T?4:5\" must be F ? 1 : (T ? 4 : 5).\nStep back to when you scanned left to right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Skip ':'. Push digits, T and F.\nWhat happens at '?'?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always keep the top of the stack and drop the one below', 'next' => 'wrong_b'],
                ['label' => 'Read the condition to its left; pop true and false branches; push the chosen one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The top of the stack is the true branch (it was pushed last, so it is the left one). Picking by position without the condition ignores the T or F.\nStep back to when you handled '?'.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Each character is pushed and popped at most once: O(n) time, O(n) space. A recursive parser that matches ? with its : also works.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left, resolve at each ?, one char per value', 'next' => 'success'],
                ['label' => 'Join consecutive digits into multi-digit numbers', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every number is one digit, so each digit is its own value. Joining digits would turn \"T?1:2\" into 12.\nStep back to when you combined digits.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Scan right to left, push values, resolve at each ? with the condition. \"T?T?F:5:3\" → \"F\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
