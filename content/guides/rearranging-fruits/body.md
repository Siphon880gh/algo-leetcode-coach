## Excess copies

1. Count each cost in basket1 minus basket2; if any difference is odd, return −1.
2. For each cost, add `|difference| / 2` copies to a list `mv`; sort it.
3. Return `Σ min(x, 2 · mn)` over the first `len(mv) / 2` items, where `mn` is the smallest cost in either basket.

Examples → 1, −1. Checked against a shortest-path search over swaps on 300 random small cases.

Each swap fixes one excess on each side, so half the list is swapped and the cheaper half pays. Swapping both fruits through the global minimum costs 2 · mn, which beats a direct swap of two expensive fruits. Totals reach about 10^14, so use 64-bit.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
