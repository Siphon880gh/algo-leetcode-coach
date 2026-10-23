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
            'message' => "Read the problem statement above.\nArrangements of the remaining half?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(letters left)! / Π(count)!', 'next' => 's2'],
                ['label' => '(letters left)!', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. caccac, k = 2 → \"\" instead of caccac.\nStep back to when you ignored repeated letters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k exceeds the total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Wrap around with k mod total', 'next' => 'wrong_b'],
                ['label' => 'Return ""', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → aa instead of \"\".\nStep back to when you wrapped around.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 26 · 26). Examples → baab, \"\", abcba.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
