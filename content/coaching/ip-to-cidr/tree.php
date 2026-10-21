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
            'message' => "Problem: Problem: Given a starting IPv4 address and a count n, return the fewest CIDR blocks that together cover exactly the n consecutive addresses starting there. (Restated from memory; limits and examples may differ slightly.)\nHow big can a block starting at address x be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most x & −x, the largest power of two dividing x', 'next' => 's2'],
                ['label' => 'Any power of two', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A block of size 2^b must start at a multiple of 2^b.\nStep back to when you ignored alignment.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "That block is larger than the remaining n. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use it anyway', 'next' => 'wrong_b'],
                ['label' => 'Halve it until it fits', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It would cover addresses outside the range.\nStep back to when you overshot.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How is a block of size 2^b written?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The start address with prefix 32 − b', 'next' => 'success'],
                ['label' => 'The start address with prefix b', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Larger blocks have shorter prefixes.\nStep back to when you used b.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Greedy aligned blocks: O(32 · log n). \"255.0.0.7\", n = 10 → [\"255.0.0.7/32\",\"255.0.0.8/29\",\"255.0.0.16/32\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
