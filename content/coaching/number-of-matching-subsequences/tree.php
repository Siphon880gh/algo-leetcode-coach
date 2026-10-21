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
            'message' => "Read the problem statement above.\nCheck each word against s with two pointers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: that is O(words · |s|); advance all words together', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With 5000 words and |s| = 5 · 10⁴, that is too slow.\nStep back to when you checked each word separately.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Letter c of s arrives. Which words move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every word', 'next' => 'wrong_b'],
                ['label' => 'Exactly the words waiting for c, taken from its bucket', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only words whose next needed letter is c advance.\nStep back to when you moved every word.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A word advances past its last letter. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count it as a match', 'next' => 'success'],
                ['label' => 'Put it back in a bucket', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It is complete.\nStep back to when you re-queued it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s| + Σ|word|). s \"abcde\", [\"a\",\"bb\",\"acd\",\"ace\"] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
