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
            'message' => "Read the problem statement above.\nWhich domains get credit for \"900 google.mail.com\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'google.mail.com, mail.com, and com', 'next' => 's2'],
                ['label' => 'Only google.mail.com', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Visiting a subdomain also visits its parents.\nStep back to when you credited one domain.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Are the parents prefixes or suffixes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefixes', 'next' => 'wrong_b'],
                ['label' => 'Suffixes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. google.mail is not a domain; mail.com is.\nStep back to when you used prefixes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How is each output line formatted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"count domain"', 'next' => 'success'],
                ['label' => '"domain count"', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The count comes first, as in the input.\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total characters). [\"9001 discuss.leetcode.com\"] → [\"9001 leetcode.com\",\"9001 discuss.leetcode.com\",\"9001 com\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
