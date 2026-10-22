## Sign counting

1. Take all positives and all negatives; if the negatives are odd in number, drop the one with the smallest absolute value.
2. If that leaves nothing, return `max(nums)`; else return the product.

Examples → 1350, 20. Checked against every non-empty subset on 500 random arrays.

Zeros never help a non-empty product unless nothing else works: [0, −5] → 0, [−5] → −5. With n ≤ 13, trying all 2^13 subsets is also fast enough. The product reaches 9^13 ≈ 2.5 · 10^12, so use 64-bit.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
