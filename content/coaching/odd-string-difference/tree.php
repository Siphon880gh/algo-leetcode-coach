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
            'message' => "Read the problem statement above.\nFind the odd word how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one whose array appears once', 'next' => 's2'],
                ['label' => 'The first word whose array differs from words[0]’s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. words[0] may be the odd one; [abc, adc, wzy] → adc instead of abc.\nStep back to when you compared with words[0].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Store each difference as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Absolute value', 'next' => 'wrong_b'],
                ['label' => 'Signed', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. ab and ba then match; [ab, ba, cd] has no unique array instead of ba.\nStep back to when you dropped the sign.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → abc, bob.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
