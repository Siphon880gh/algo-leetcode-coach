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
            'message' => "Problem: Given strings source and target, return the fewest subsequences of source whose concatenation equals target, or −1 if that is impossible. source = \"abc\", target = \"abcbc\" → 2. source = \"abc\", target = \"acdbc\" → −1. source = \"xyz\", target = \"xzyxz\" → 3. (Restated from memory; limits and examples may differ slightly.)\nHow much of target should one subsequence cover?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As much as possible, matching letters in order', 'next' => 's2'],
                ['label' => 'One letter', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A longest match per pass is optimal.\nStep back to when you took one letter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A full pass over source matches nothing. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start another pass', 'next' => 'wrong_b'],
                ['label' => 'Return −1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That letter is not in source, so you would loop forever.\nStep back to when you started another pass.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you speed up each match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A next-occurrence table per position and letter', 'next' => 'success'],
                ['label' => 'Sort source', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Order in source matters for subsequences.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|source| · |target|), or O(26 · |source| + |target|) with the table. \"abc\", \"abcbc\" → 2. \"abc\", \"acdbc\" → −1. \"xyz\", \"xzyxz\" → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
