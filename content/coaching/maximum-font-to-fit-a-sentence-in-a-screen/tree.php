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
            'message' => "Problem: Given a text, a screen width w and height h, a sorted array of font sizes and an interface that reports a character's width and the line height at a font size, return the largest font that fits the text on one line (total width ≤ w and height ≤ h), or −1. For instance, if font 6 needs width 48 with w = 40 but font 5 fits, the answer is 5. (Restated from memory; limits and examples may differ slightly.)\nWhy binary search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bigger font never fits better', 'next' => 's2'],
                ['label' => 'Fonts are random', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The fonts are sorted and widths grow with size.\nStep back to when you scanned linearly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fit test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Width only', 'next' => 'wrong_b'],
                ['label' => 'Height ≤ h and Σ widths ≤ w', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The line height must fit too.\nStep back to when you skipped height.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Nothing fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return the smallest font', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A font that does not fit is not an answer.\nStep back to when you returned the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log F · |text|). Constructed check → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
