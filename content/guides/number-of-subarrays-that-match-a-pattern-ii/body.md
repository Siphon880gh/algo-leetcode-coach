## Pattern search on signs

1. s[i] = sign(nums[i + 1] − nums[i]) for i = 0 … n − 2.
2. f = KMP failure table of pattern. Scan s with j = 0; on a full match (j = m) count it and set j = f[m − 1].

Examples → 4, 2. Matches part I’s direct check on 3,000 random arrays.

After a match, fall back with the failure table, not to 0: resetting j = 0 misses overlaps and gives example 1 → 2 instead of 4. Checking every start directly costs up to (n − m) · m ≈ 2.5 · 10^11 at m = n / 2.

Time: O(n + m)  
Space: O(n + m)

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
