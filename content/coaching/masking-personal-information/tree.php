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
            'message' => "Read the problem statement above.\nHow do you tell an email from a phone number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It contains "@"', 'next' => 's2'],
                ['label' => 'Its length is more than 10', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Length does not separate them; an email can be any length.\nStep back to when you checked the length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Email: how many stars go between the first and last letter of the name?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One per hidden letter', 'next' => 'wrong_b'],
                ['label' => 'Always five', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The mask is fixed at five stars so the name length stays hidden.\nStep back to when you counted hidden letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A phone number has 12 digits. What prefix comes before \"***-***-XXXX\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"+**-", one star per country-code digit', 'next' => 'success'],
                ['label' => '"+***-", always three stars', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The country code has (digits − 10) digits, here 2.\nStep back to when you fixed three stars.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"LeetCode@LeetCode.com\" → \"l*****e@leetcode.com\". \"1(234)567-890\" → \"***-***-7890\". \"86-(10)12345678\" → \"+**-***-***-5678\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
