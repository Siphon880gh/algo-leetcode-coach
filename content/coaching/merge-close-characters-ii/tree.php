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
            'message' => "Problem: You get a lowercase string s and an integer k. Two equal letters are close when their current positions differ by at most k. While a close pair exists, take the pair with the smallest left index (then the smallest right index) and delete the right letter; positions are counted in the current string. Return the final string. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nMeasure distance in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The result so far', 'next' => 's2'],
                ['label' => 'The original string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): \"abba\", k = 2 → \"aba\" instead of \"ab\".\nStep back to when you used original indices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Close when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distance < k', 'next' => 'wrong_b'],
                ['label' => 'Distance ≤ k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): \"abcab\", k = 3 → \"abcab\" instead of \"abc\".\nStep back to when you made it strict.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → \"ab\", \"abc\", \"a\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
