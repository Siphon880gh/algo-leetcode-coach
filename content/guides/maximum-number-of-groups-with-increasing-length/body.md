## Staircase

1. Sort usageLimits ascending; `total = 0`, `k = 0`.
2. For each u: `total += u`; if `total ≥ (k + 1)(k + 2) / 2`, `k += 1`.
3. Return k.

Examples → 3, 2, 1. Checked against an exhaustive search over group assignments on 300 random small inputs.

Sorting matters: the small limits must be counted first, since a number can appear at most once per group. Unsorted, [4, 1, 1, 4] → 4 instead of 3. The total reaches 10^14, so use 64-bit.

Time: O(n log n)  
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
