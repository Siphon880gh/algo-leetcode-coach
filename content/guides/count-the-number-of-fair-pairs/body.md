## Two counts

1. Sort `nums`.
2. `count(x)`: `j = n − 1`; for each `i`, move `j` left while `j > i` and `nums[i] + nums[j] > x`; add `j − i`.
3. Return `count(upper) − count(lower − 1)`.

Examples → 6, 1. Checked against all pairs on 300 random arrays.

Sorting changes indices, but each unordered pair of positions is still counted once. Sums reach 2 · 10^9 and the count about 5 · 10^9, so use 64-bit for both.

Time: O(n log n)  
Space: O(1) besides sorting

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
