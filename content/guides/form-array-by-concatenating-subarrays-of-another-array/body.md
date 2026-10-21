## Leftmost placement

1. `i = 0`.
2. For each group `g`: advance `i` until `nums[i : i + len(g)] == g` or it no longer fits (→ false).
3. Set `i += len(g)`.
4. All placed → true.

Example 1 → true. Example 2 → false (order matters). Example 3 → false (the groups would overlap at `3`).

Jump past the whole match so groups stay disjoint. KMP per group makes it linear, but the naive scan is fine for these limits.

Time: O(len(nums) · total group length)  
Space: O(1)

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
