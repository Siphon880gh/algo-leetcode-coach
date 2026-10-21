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
            'message' => "Read the problem statement above.\nWhich plates count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only those between two candles inside the range', 'next' => 's2'],
                ['label' => 'Every plate in the range', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In **|**|***| the range [0, 5] has 4 plates, but only 2 lie between candles.\nStep back to when you counted every plate.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer a query how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan the substring', 'next' => 'wrong_b'],
                ['label' => 'Nearest candles plus a prefix count of plates', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 10^5 queries over a 10^5 string is too slow.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "First candle after left is not before the last candle before right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer 0', 'next' => 'success'],
                ['label' => 'Use the prefix difference anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That difference can be negative or count plates outside any candle pair.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). Examples → [2,3], [9,0,0,0,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
