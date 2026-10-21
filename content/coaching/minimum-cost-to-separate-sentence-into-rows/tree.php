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
            'message' => "Problem: A sentence of words separated by single spaces must be split into rows of at most k characters each, keeping word order and never splitting a word. A row of length len costs (k − len)², except that the last row costs nothing. Return the minimum total cost. For instance, \"i love leetcode\" with k = 12 → 36; \"apples and bananas taste great\" with k = 7 → 21; \"a\" with k = 5 → 0. (Restated from memory; limits and examples may differ slightly.)\nPack each row as full as possible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: try every row end with DP', 'next' => 's2'],
                ['label' => 'Yes, greedy filling', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Words cc a b bbb with k = 4: greedy rows cc a | b | bbb cost 9, but cc | a b | bbb cost 5.\nStep back to when you chose greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Row length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum of word lengths only', 'next' => 'wrong_b'],
                ['label' => 'Word lengths plus one space between words', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The spaces inside a row count toward k.\nStep back to when you dropped the spaces.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cost of the last row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => '(k − len)² like the others', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The last row is free; i love leetcode with k = 12 is 36 only with that rule.\nStep back to when you charged it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k) states and transitions. Constructed checks → 36, 21, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
