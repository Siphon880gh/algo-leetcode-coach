## Submask enumeration

1. `fits[s]` = task-time sum of `s` ≤ sessionTime.
2. `dp[0] = 0`; for each `mask`, iterate submasks `s` with `fits[s]`: `dp[mask] = min(dp[mask], dp[mask ^ s] + 1)`.
3. Return `dp[full]`.

`[1,2,3], 3` → 2. `[3,1,3,1,1], 8` → 2. `[1,2,3,4,5], 15` → 1.

Submask enumeration totals 3^n ≈ 4.8 · 10^6 for n = 14. Greedy first-fit packing is not always optimal.

Time: O(3^n)  
Space: O(2^n)

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
