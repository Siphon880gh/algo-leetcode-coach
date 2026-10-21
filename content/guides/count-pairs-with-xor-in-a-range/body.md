## f(lim) = #pairs with XOR < lim

For each `x` (before inserting it), walk bits from high to low with `node`:

1. Limit bit 1: all numbers in `node[xbit]` make that XOR bit 0 < 1, so add their count; continue into `node[xbit ^ 1]`.
2. Limit bit 0: continue into `node[xbit]` (XOR bit must also be 0).
3. Then insert `x`, incrementing counts on its path.

Return `f(high + 1) − f(low)`. Example 1 → 6. Example 2 → 8.

15 bits cover values up to 2 · 10^4. Counting XOR < lim (strict) makes the range subtraction clean; checked against brute force on random inputs.

Time: O(n · 15)  
Space: O(n · 15)

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
