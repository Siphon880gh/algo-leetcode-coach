## Monotone walk

1. `i = j = 0`.
2. While both in range: if `nums1[i] ≤ nums2[j]`, `best = max(best, j − i)`, `j += 1`; else `i += 1`.

Example 1 → 2. Example 2 → 1. Example 3 → 2.

When `i > j`, `j − i` is negative and never beats `best ≥ 0`, so no extra check is needed. Binary search per `i` also works in O(n log m).

Time: O(n + m)  
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
