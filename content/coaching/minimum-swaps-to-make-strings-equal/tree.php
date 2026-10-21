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
            'message' => "Read the problem statement above.\nCount what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mismatches by type: xy and yx', 'next' => 's2'],
                ['label' => 'Total x and y letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The cost depends on the mismatch types.\nStep back to when you counted letters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two xy mismatches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 swaps', 'next' => 'wrong_b'],
                ['label' => '1 swap', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Swap s1[i] with s2[j] to fix both at once.\nStep back to when you used 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One xy and one yx left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 swaps', 'next' => 'success'],
                ['label' => '1 swap', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One swap turns them into two of the same type first.\nStep back to when you used 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"xx\", \"yy\" → 1. \"xy\", \"yx\" → 2. \"xx\", \"xy\" → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
