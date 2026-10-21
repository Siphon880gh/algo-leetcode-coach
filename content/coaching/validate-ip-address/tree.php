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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Split on . or :, check the part count, then check each part by the exact rules', 'next' => 's2'],
                ['label' => 'Use a built-in IP parser or a loose regex', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A loose regex or library parser accepts forms this problem rejects, like leading zeros in IPv4 or :: in IPv6.\nStep back to when you trusted a general parser.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "IPv4 part rules.\nWhich part is valid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any digits that parse to a value ≤ 255, so "01" is fine', 'next' => 'wrong_b'],
                ['label' => '1 to 3 digits, value ≤ 255, no leading zero unless the part is "0"', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"01\" has a leading zero, which IPv4 rejects here. Only \"0\" itself may start with 0.\nStep back to when you allowed leading zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "IPv6: exactly 8 parts, each 1 to 4 characters from 0-9, a-f, A-F. Leading zeros are allowed. Make sure the split keeps empty parts, so \"1.1.1.1.\" has 5 parts and fails.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exact counts, per-part rules, empty parts fail, no ::', 'next' => 'success'],
                ['label' => 'Allow :: to stand for missing zero groups', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. This problem has no :: shorthand. It produces an empty part, which fails the 1 to 4 length rule.\nStep back to when you allowed ::.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Split, require 4 or 8 parts, check each part exactly. \"256.256.256.256\" → Neither.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
